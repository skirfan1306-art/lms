@extends('front.layout.app')

@section('title')
ThankYou
@endsection

@section('main') 

    <main class="main">
      <!-- breadcrumb -->
      <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.html)">
        <div class="container">
          <h2 class="breadcrumb-title">Checkout Complete</h2>
          <ul class="breadcrumb-menu">
            <li><a href="{{route('front.home')}}">Home</a></li>
            <li class="active">Checkout Complete</li>
          </ul>
        </div>
      </div>
      <!-- breadcrumb end -->

      <!-- checkout-complete -->
      <div class="checkout-complete py-120">
        <div class="container">
          <div class="row">
            <div class="col-md-7 mx-auto">
              <div class="content">
                <div class="icon"><i class="far fa-check"></i></div>
                <h3 class="mb-3">Thank you for your Purchase!</h3>
                
                @if(session()->has('tmpOrder'))
                    <span>Order Number: <b>{{ session('tmpOrder') }}</b></span><br>
                @endif
                @if(session()->has('tmpCourse'))
                <span>Courses Purchased: <b>{{ session('tmpCourse') }}</b></span>
                @endif
                
                <p>You now have access to your purchased courses. You can start learning right away by visiting your dashboard.</p>
                <a href="/" class="theme-btn">Go Back Home<i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- checkout-complete end -->
    </main>

@endsection