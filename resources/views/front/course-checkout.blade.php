@extends('front.layout.app')

@section('title')
Checkout
@endsection

@section('main') 

    <main class="main">
      <!-- breadcrumb -->
      <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.html)">
        <div class="container">
          <h2 class="breadcrumb-title">Course Checkout</h2>
          <ul class="breadcrumb-menu">
            <li><a href="{{route('front.home')}}">Home</a></li>
            <li class="active">Course Checkout</li>
          </ul>
        </div>
      </div>
      <!-- breadcrumb end -->

      <!-- checkout area -->
      <div class="checkout-area py-120">
        <div class="container">
          <div class="checkout-wrap">
            <div class="row">
              <div class="col-lg-8">
                <div class="checkout-step">
                  <div class="accordion" id="checkout">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#checkoutStep1" aria-expanded="true" aria-controls="checkoutStep1">
                          Your Billing Info
                        </button>
                      </h2>
                      <div id="checkoutStep1" class="accordion-collapse collapse show" data-bs-parent="#checkout">
                        <div class="accordion-body">
                          <div class="checkout-form">
                            <form action="{{route('front.pay')}}" method="POST">
                                @csrf
                              <div class="row">
                                <div class="col-12">
                                  <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" value="{{ Auth::user()->name ?? '' }}" name="name" readonly/>
                                  </div>
                                </div>
                                
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Email Address" value="{{ Auth::user()->email ?? '' }}" name="email" readonly/>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" placeholder="Phone Number" value="{{ Auth::user()->number ?? '' }}" name="number" readonly/>
                                  </div>
                                </div>
                                
                              </div>
                              <input type="submit" id="submit-input" class="d-none">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="cart-summary mt-0">
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
                    <label for="submit-input" class="theme-btn">Pay Now<i class="fas fa-arrow-right"></i></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- checkout area end -->
    </main>

@endsection
@section('scripts')
<script>

</script>
@endsection