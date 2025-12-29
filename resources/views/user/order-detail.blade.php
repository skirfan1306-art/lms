@extends('front.layout.app')
@section('title')
Dashboard
@endsection
@section('main')

    <main class="main">

      <!-- user order details -->
      <div class="user-account py-100">
        <div class="container">
          <div class="row g-4">
            @include('user.layout.sidebar')
            <div class="col-lg-8 col-xl-9">
              <div class="user-wrapper">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="user-card user-order-detail">
                      <div class="header">
                        <h4 class="title">Order Details (#{{ request()->segment(3) }})</h4>
                        <div class="right">
                          <a href="{{ redirect()->back()->getTargetUrl() }}" class="theme-btn">Go Back<i class="fas fa-arrow-right"></i></a>
                        </div>
                      </div>
                      <div class="user-table table-responsive">
                        <table class="table table-borderless text-nowrap">
                          <thead>
                            <tr>
                              <th>Course</th>
                              <th>Category</th>
                              <th>Price</th>
                            </tr>
                          </thead>
                          <tbody>
                        @foreach($orders as $item)
                            <tr>
                              <td>
                                <div class="content">
                                  <div class="img">
                                    <a href="{{ route('front.course-single', $item->course->slug) }}"><img src="{{ asset('assets/front/images/course/' . $item->course->image) }}" alt="" /></a>
                                  </div>
                                  <div class="info">
                                    <h6><a href="{{ route('front.course-single', $item->course->slug) }}">{{ Str::limit($item->course->name, 35) }}</a></h6>
                                  </div>
                                </div>
                              </td>
                              <td>{{$item->course->category->name}}</td>
                              <td>${{$item->course_amount}}</td>
                            </tr>
                        @endforeach
                          </tbody>
                        </table>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="order-detail-content">
                            <h5>Other Details </h5>
                            <p>Order Date: {{ $item->created_at->format('F d, Y') }}</p>
                            <p>Total Course: {{ $orders->count() }}</p>
                            <p>Payment Method: {{ ucfirst($item->payment_method) }}</p> 
                            <p>Payment Status: <span class="badge badge-success">Paid</span></p>
                            <p>Tnx ID: {{ $item->transaction_id }}</p>
                            
                            @if(!empty($item->coupon_code))
                            <p>Coupon Code: {{ $item->coupon_code }}</p>
                            <p>Coupon Discount: ${{ $item->coupon_discount }}</p>
                            @endif
                            
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="order-detail-content">
                            <h5>Order Summary</h5>
                            <ul>
                              <li>Subtotal<span>${{ $item->total_amount }}</span></li>
                              @if(!empty($item->coupon_code))
                              <li>Discount<span>${{ $item->coupon_discount }}</span></li>
                              @endif
                              <li>Tax<span>$0.00</span></li>
                              <li>Total<span>${{ $item->pay_amount }}</span></li>
                            </ul>
                            <p class="mt-4">Paid by {{ ucfirst($item->payment_method) }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- user order details end -->
    </main>

@endsection