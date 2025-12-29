<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function applyCoupon(Request $req)
    {
        $req->validate([
            'code' => 'required'
        ]);

        $coupon = Coupon::where('code', $req->code)
                        ->where('status', '1')
                        ->first();

        if (!$coupon) {
            return response()->json([
                'status' => false,
                'msg' => 'Invalid coupon code.'
            ]);
        }

        $today = now()->toDateString();

        if ($coupon->start_date && $coupon->start_date > $today) {
            return response()->json([
                'status' => false,
                'msg' => 'This coupon is not active yet.'
            ]);
        }

        if ($coupon->end_date && $coupon->end_date < $today) {
            return response()->json([
                'status' => false,
                'msg' => 'This coupon has expired.'
            ]);
        }

        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            return response()->json([
                'status' => false,
                'msg' => 'Coupon usage limit has been reached.'
            ]);
        }

        $user = Auth::user();

        $cart = Cart::with('course')
                    ->where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->get();

        if ($cart->isEmpty()) {
            return response()->json([
                'status' => false,
                'msg' => 'Your cart is empty.'
            ]);
        }

        $subTotal = $cart->sum(function ($item) {
            return $item->course->sale_price;
        });
            
        /* =========================
           APPLY TO FULL CART
        ==========================*/
        if ($coupon->apply_type === 'cart') {

            $discount = $this->calculateDiscount($coupon, $subTotal);
            $final    = max($subTotal - $discount, 0);

            Session::put('coupon', [
                'id'       => $coupon->id,
                'code'     => $coupon->code,
                'discount' => number_format(round($discount, 0, PHP_ROUND_HALF_UP), 2),
                'type'     => 'cart'
            ]);

            return response()->json([
                'status' => true,
                'msg' => 'Coupon applied to your cart successfully.',
                'discount' => number_format(round($discount, 0, PHP_ROUND_HALF_UP), 2),
                'final_total' => number_format(round($final, 0, PHP_ROUND_HALF_UP), 2)
            ]);
        }

        /* =========================
           APPLY TO SINGLE COURSE
        ==========================*/
        if ($coupon->apply_type === 'course') {

            $item = $cart->firstWhere('course_id', $coupon->course_id);

            if (!$item) {
                return response()->json([
                    'status' => false,
                    'msg' => 'This coupon is not applicable to your cart items.'
                ]);
            }

            $price    = $item->course->sale_price;
            $discount = $this->calculateDiscount($coupon, $price);
            $final    = max($subTotal - $discount, 0);

            Session::put('coupon', [
                'id'       => $coupon->id,
                'code'     => $coupon->code,
                'discount' => number_format(round($discount, 0, PHP_ROUND_HALF_UP), 2),
                'type'     => 'course',
                'course_id'=> $coupon->course_id
            ]);

            return response()->json([
                'status' => true,
                'msg' => 'Coupon applied to selected course.',
                'discount' => number_format(round($discount, 0, PHP_ROUND_HALF_UP), 2),
                'final_total' => number_format(round($final, 0, PHP_ROUND_HALF_UP), 2)
            ]);
        }

        return response()->json([
            'status' => false,
            'msg' => 'Invalid coupon type.'
        ]);
    }

    public function cancelCoupon()
    {
        Session::forget('coupon');
        
        $user = Auth::user();

        $cart = Cart::with('course')
                    ->where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->get();
        $subTotal = $cart->sum(fn ($item) => $item->course->sale_price);

        return response()->json([
            'discount' => number_format(0, 2),
            'final_total' => number_format($subTotal, 2)
        ]);
    }

    private function calculateDiscount($coupon, $amount)
    {
        if ($coupon->discount_type === 'percent') {
            return ($amount * $coupon->discount_value) / 100;
        }

        return min($coupon->discount_value, $amount);
    }
}
