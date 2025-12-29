@extends('front.layout.app')
@section('title')
Register
@endsection
@section('main')

    <main class="main">
   

      <!-- register area -->
      <div class="auth-area py-120">
        <div class="container">
          <div class="col-md-5 mx-auto">
            <div class="auth-form">
                @if(session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif
                
              <div class="auth-header">
                <img src="{{ asset('assets/logo/' . $gs->logo) }}" alt="" />
                <p>Create your free account</p>
              </div>
              <form action="{{ route('front.register') }}" method="POST" >
                  @csrf
                <div class="form-group">
                  <div class="form-icon">
                    <i class="far fa-user-tie"></i>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Your Name*" />
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-icon">
                    <i class="far fa-envelope"></i>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Your Email*" />
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-icon">
                    <i class="far fa-phone"></i>
                    <input name="number" type="text" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}" placeholder="Your Contact Number*" />
                    @error('number')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-icon">
                    <i class="far fa-key"></i>
                    <input name="password" type="password" id="password" class="form-control" placeholder="Your Password*" />
                    <span class="password-view"><i class="far fa-eye-slash"></i></span>
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-icon">
                    <i class="far fa-key"></i>
                    <input name="password_confirmation" type="password" id="cpassword" class="form-control" placeholder="Confirm Password*" />
                     
                    @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="auth-group">
                  <div class="form-check">
                    <input name="term" class="form-check-input @error('term') is-invalid @enderror" type="checkbox" value="1" id="agree" />
                    <label class="form-check-label" for="agree">
                      I agree with the <a href="#" class="auth-group-link">Terms Of Service.</a>
                    </label>
                    @error('term')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="auth-btn">
                  <button type="submit" class="theme-btn"><span class="far fa-paper-plane"></span> Register</button>
                </div>
              </form>
              <div class="auth-bottom">
                <div class="auth-social">
                  <p>Continue with social media</p>
                  <div class="auth-social-list">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                  </div>
                </div>
                <p class="auth-bottom-text">Already have an account? <a href="{{ route('front.login') }}">Login.</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- register area end -->
    </main>
 @endsection