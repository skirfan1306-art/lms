<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Cart;
use App\Models\CourseOrder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $user = Auth::user();
        $cart = Cart::with(['user', 'course'])->where('status', 'pending')->where('user_id', $user->id)->get();
        
        return view('front.course-checkout', compact('cart'));

    }
    
public function pay(Request $req)
{
    $user = Auth::user();

    $cart = Cart::with('course')
        ->where('status', 'pending')
        ->where('user_id', $user->id)
        ->get();

    if ($cart->isEmpty()) {
        return redirect()->back()->with('error', 'Cart is empty');
    }
    
    $cartCount = $cart->count();

    $couponCode = null;
    $couponType = null;
    $couponDiscount = 0;

    if (session()->has('coupon')) {
        $coupon = session('coupon');
        $couponCode     = $coupon['code'] ?? null;
        $couponType     = $coupon['type'] ?? null;
        $couponCID     = $coupon['course_id'] ?? null;
        $couponDiscount = (float) ($coupon['discount'] ?? 0);
    }

    do {
        $uniqueId = Str::upper(Str::random(5)) . random_int(10000, 99999);
    } while (CourseOrder::where('order_no', $uniqueId)->exists());

    $totalAmount = $cart->sum(function ($item) {
        return $item->course->sale_price;
    });
    $payAmount   = max(0, $totalAmount - $couponDiscount);

    foreach ($cart as $c) {
        
        $couponApplied = '0';
        if (session()->has('coupon')) {
            if($couponType == 'cart'){
                $couponApplied = '1';
            }else{
                $couponApplied = $couponCID == $c->course_id ? '1' : '0';
            }
        }
        
        CourseOrder::create([
            'order_no'        => $uniqueId,
            'user_id'         => $user->id,
            'course_id'       => $c->course_id,
            'course_amount'   => $c->course->sale_price,

            'total_amount'    => $totalAmount,
            'pay_amount'      => $payAmount,

            'payment_method'  => 'online',
            'payment_status'  => 'paid', // or pending
            'transaction_id'  => null,
            'order_status'    => 'active',

            'coupon_code'     => $couponCode,
            'coupon_type'     => $couponType,
            'coupon_applied'     => $couponApplied,
            'coupon_discount' => $couponDiscount,
        ]);
    }

    session()->put('tmpOrder', $uniqueId);
    session()->put('tmpCourse', $cartCount);

    $cart->each->delete();
    session()->forget('coupon');

    return redirect()->route('front.thankyou');
}


}
