<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Course;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Exception;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $user = Auth::user();
        $cart = Cart::with(['user', 'course'])->where('status', 'pending')->where('user_id', $user->id)->get();
        
        return view('front.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['redirect' => route('login')], 401);
        }

        $user = Auth::user();

        // validate input
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer|exists:courses,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $courseId = $request->input('course_id');

        try {
            // Prevent duplicate cart items:
            $cart = Cart::where('status', 'pending')->where('user_id', $user->id)->where('course_id', $courseId)->first();

            if ($cart) {
                return response()->json([
                    'success' => true,
                    'message' => 'Course already in cart',
                    'cart_count' => Cart::where('status', 'pending')->where('user_id', $user->id)->count()
                ]);
            }

            // create the cart entry
            $new = Cart::create([
                'user_id' => $user->id,
                'course_id' => $courseId,
                'status' => 'pending'
            ]);
            
            if (session()->has('coupon')){
                Session::forget('coupon');
            }

            return response()->json([
                'success' => true,
                'message' => 'Course added to cart',
                'cart_count' => Cart::where('status', 'pending')->where('user_id', $user->id)->count()
            ], 201);

        } catch (Exception $e) {
            // log exception and return friendly error
            \Log::error('Add to cart failed: '.$e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Could not add to cart right now'
            ], 500);
        }
    }
    

    public function removeFromCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['redirect' => route('login')], 401);
        }
    
        $cartId = $request->input('cart_id');
    
        if (!$cartId) {
            return response()->json(['success' => false, 'message' => 'Cart id is required'], 422);
        }
    
        $cart = Cart::where('status', 'pending')->where('id', $cartId)->where('user_id', Auth::id())->first();
    
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }
    
        try {
            $cart->delete();
    
            $cart2 = Cart::with('course')->where('status', 'pending')->where('user_id', Auth::id())->get();
                    
            $cartCount = $cart2->count();
            
            if ($cartCount <= 0) {
                Session::forget('coupon');
            }
            
            $subTotal = $cart2->sum(fn ($item) => $item->course->sale_price);
            $finalTotal = $subTotal;
            $discount = 0;
            
            if (session()->has('coupon')){
                $finalTotal = $subTotal;
                $coupon = session('coupon');
                $couponId   = $coupon['id'] ?? null;
                $couponCode = $coupon['code'] ?? null;
                $couponType = $coupon['type'] ?? null;
                $discount   = $coupon['discount'] ?? 0;
                
                $couponQuery = Coupon::where('id', $couponId)->where('status', '1')->first();
                
                if ($couponType == 'cart') {
                    $discount = $this->calculateDiscount($couponQuery, $subTotal);
                    $finalTotal    = max($subTotal - $discount, 0);
                    
                    Session::put('coupon.discount', number_format(round($discount, 0, PHP_ROUND_HALF_UP), 2));

                }
                
                if ($couponType == 'course') {
                    $item = $cart2->firstWhere('course_id', $couponQuery->course_id);
        
                    $price    = $item->course->sale_price;
                    $discount = $this->calculateDiscount($coupon, $price);
                    $finalTotal    = max($price - $discount, 0);
                    
                    Session::put('coupon.discount', number_format(round($discount, 0, PHP_ROUND_HALF_UP), 2));
                    
                    if (!$item) {
                        $discount = 0;
                        $finalTotal = $subTotal;
                        Session::forget('coupon');
                    }
                }
                
                // if($discount >= $couponQuery->min_purchase){
                //     $discount = 0;
                //     Session::forget('coupon');
                // }
                
                if($subTotal < $couponQuery->min_purchase){
                    $discount = 0;
                    $finalTotal = $subTotal;
                    Session::forget('coupon');
                }
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Removed from cart',
                'cart_count' => $cartCount,
                'cart_id' => $cartId,
                'subtotal' => number_format($subTotal, 2),
                'discount' => number_format(round($discount, 0, PHP_ROUND_HALF_UP), 2),
                'final_total' => number_format(round($finalTotal, 0, PHP_ROUND_HALF_UP), 2),
            ]);
        } catch (\Exception $e) {
            \Log::error('Cart remove error: '.$e->getMessage());
            return response()->json(['success' => false, 'message' => 'Could not remove item'], 500);
        }
    }
    
    private function calculateDiscount($coupon, $amount)
    {
        if ($coupon->discount_type === 'percent') {
            return ($amount * $coupon->discount_value) / 100;
        }

        return min($coupon->discount_value, $amount);
    }

}
