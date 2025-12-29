@extends('front.layout.app')

@section('title')
Cart
@endsection

@section('main') 
    <main class="main">
      <!-- breadcrumb -->
      <div class="site-breadcrumb" style="background: url(/assets/front/img/breadcrumb/01.png)">
        <div class="container">
          <h2 class="breadcrumb-title">Course Cart</h2>
          <ul class="breadcrumb-menu">
            <li><a href="{{route('front.home')}}">Home</a></li>
            <li class="active">Course Cart</li>
          </ul>
        </div>
      </div>
      <!-- breadcrumb end -->
      <div class="cart-area py-120">
        <div class="container">
          <div class="cart-wrap">
              <center class="site-breadcrumb pt-5 pb-5 pt-md-3 pb-md-3 emptyCart d-none">
                <h2 class="breadcrumb-title mb-5 mb-md-3">Cart is empty!</h2>
                <div class="cart-btn">
                    <a href="{{ route('front.course') }}" class="theme-btn" style="text-decoration:none"><span class="fas fa-plus"></span> Add Course</a>
                </div>
            </center>
            
            @if($cart->isEmpty())
            <center class="site-breadcrumb pt-5 pb-5 pt-md-3 pb-md-3">
                <h2 class="breadcrumb-title mb-5 mb-md-3">Cart is empty!</h2>
                <div class="cart-btn">
                    <a href="{{ route('front.course') }}" class="theme-btn" style="text-decoration:none"><span class="fas fa-plus"></span> Add Course</a>
                </div>
            </center>
            @else
            <div class="row isCart">
              <div class="col-lg-8">
                <div class="cart-table">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Course Name</th>
                          <th>Price</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                    @foreach ($cart as $item)
                        <tr id="cart-row-{{ $item->id }}">
                          <td>
                            <div class="cart-img">
                              <a href="{{ route('front.course-single', $item->course->slug) }}"><img src="{{ asset('assets/front/images/course/' . $item->course->image) }}"/></a>
                            </div>
                          </td>
                          <td>
                            <div class="cart-content">
                              <h5 class="cart-name"><a href="{{ route('front.course-single', $item->course->slug) }}">{{ Str::limit($item->course->name, 42) }}</a></h5>
                              <div class="cart-info">
                                <p><span>Syllabus:</span>{{ \App\Models\Syllabus::where('course_id', $item->course->id)->count() ?? 0 }}</p>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="cart-price">
                              <span>${{ $item->course->sale_price }}</span>
                            </div>
                          </td>
                          
                          <td>
                            <a href="javascript:void(0)" class="cart-remove removeToCart" data-cart-id="{{ $item->id }}"><i class="far fa-times"></i></a>
                          </td>
                        </tr>
                    @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="cart-footer">
                  <div class="row">
                    <div class="col-md-7 col-lg-6">
                      <div class="cart-coupon">
                        <div class="form-group">
                        @php
                        $couponCode = '';
                            if (session()->has('coupon')) {
                                $coupon = session('coupon');
                        
                                $couponId   = $coupon['id'] ?? null;
                                $couponCode = $coupon['code'] ?? null;
                                $couponType = $coupon['type'] ?? null;
                            }
                        @endphp
                        @if(!empty($couponCode))
                          <input type="text" class="form-control" value="{{$couponCode}}" placeholder="Enter Coupon Code" id="coupon_code" readonly/>
                          <button class="theme-btn d-none" type="button" id="applyCouponBtn">Apply Coupon</button>
                          <button class="theme-btn" style="background:var(--gradient2);" type="button" id="cancelCouponBtn">Cancel Coupon</button>
                        @else
                        <input type="text" class="form-control" placeholder="Enter Coupon Code" id="coupon_code" />
                        <button class="theme-btn" type="button" id="applyCouponBtn">Apply Coupon</button>
                        <button class="theme-btn d-none" style="background:var(--gradient2);" type="button" id="cancelCouponBtn">Cancel Coupon</button>
                        @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 col-lg-6">
                      <div class="cart-btn text-md-end">
                        <a href="{{ route('front.course') }}" class="theme-btn"><span class="fas fa-arrow-left"></span> Add More Course</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="cart-summary">
                  <h5>Cart Summary</h5>
                @php
                    $subTotal = $cart->sum(function ($item) {
                        return $item->course->sale_price;
                    });
                
                    $discount = 0;
                    $tax = 0;
                    $total = $subTotal - $discount + $tax;
                    
                    if (session()->has('coupon')) {
                        $coupon = session('coupon');
                        $discount   = $coupon['discount'] ?? 0;
                        $total = $total - $discount;
                    }
                @endphp
                  <ul>
                    <li><strong>Sub Total:</strong> <span>$<span class="subtotal">{{ number_format($subTotal, 2) }}</span></span></li>
                    <li><strong>Discount:</strong> <span>$<span class="discount">{{ number_format($discount, 2) }}</span></span></li>
                    <li><strong>Taxes:</strong> <span>$<span class="tax">{{ number_format($tax, 2) }}</span></span></li>
                    <li class="cart-total"><strong>Total:</strong> <span>$<span class="final_total">{{ number_format($total, 2) }}</span></span></li>
                  </ul>
                  <div class="text-end mt-40">
                    <a href="{{route('front.checkout')}}" class="theme-btn">Checkout Now<i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </main>

@endsection
@section('scripts')
<script>

</script>
@endsection