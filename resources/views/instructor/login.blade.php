 @extends('front.layout.app')

@section('title')
Login
@endsection

@section('main')
    <main class="main">
 

      <!-- login area -->
      <div class="auth-area py-120">
        <div class="container">
          <div class="col-md-5 mx-auto">
            <div class="auth-form">
              <div class="auth-header">
                  @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                <img src="{{ asset('assets/logo/' . $gs->logo )}}" alt="" />
                <p>Login with your Instructor account</p>
              </div>
              <form action="{{ route('instructor.login.submit') }}" method="POST">
                  @csrf
                <div class="form-group">
                  <div class="form-icon">
                    <i class="far fa-envelope"></i>
                    <input name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid  @enderror" placeholder="Username" />
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-icon">
                    <i class="far fa-key"></i>
                    <input name="password" type="password" id="password" class="form-control" placeholder="******" />
                    <span class="password-view"><i class="far fa-eye-slash"></i></span>
                  </div>
                </div>
                <div class="auth-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="remember" />
                    <label class="form-check-label" for="remember"> Remember Me </label>
                  </div>
                  <a href="{{ route('instructor.UserForget') }}" class="auth-group-link">Forgot Password?</a>
                </div>
                <div class="auth-btn">
                  <button type="submit" class="theme-btn"><span class="far fa-sign-in"></span> Login</button>
                </div>
              </form>
              
            </div>
          </div>
        </div>
      </div>
      <!-- login area end -->
    </main>

   @endsection