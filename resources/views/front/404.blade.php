 @extends('front.layout.app')
@section('title')
Looks Like You’re Lost
@endsection
@section('main')


    <main class="main">
 
      <!-- error area -->
      <div class="error-area py-120">
        <div class="container">
          <div class="col-md-8 mx-auto">
            <div class="error-wrap">
              <div class="error-img">
                <img src="/assets/front/img/error/404.html" alt="" />
              </div>
              <h2>Opos... Page Not Found!</h2>
              <p>The page you looking for not found may be it not exist or removed.</p>
              <a href="{{ route('front.home') }}" class="theme-btn">Go Back Home <i class="far fa-home"></i></a>
            </div>
          </div>
        </div>
      </div>
      <!-- error area end -->
    </main>

  @endsection