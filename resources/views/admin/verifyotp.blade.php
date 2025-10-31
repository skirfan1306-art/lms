@extends('admin.layout.app')

@section('page.title')
OTP Verification
@endsection

@section('main.content')

<div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <a href="/" class="d-inline-block auth-logo">
                                    <img src="{{ asset('assets/logo/' . $gs->footer_logo) }}" alt="" height="40">
                                </a>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 card-bg-fill">

                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <div class="avatar-lg mx-auto">
                                        <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                                            <i class="ri-mail-line"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-2 mt-4">
                                    <div class="text-muted text-center mb-4 mx-lg-3">
                                        <h4>Verify Your Email</h4>
                                        <p>Please enter the 4 digit code sent to <span class="fw-semibold">{{ $email ?? "Your Mail" }}</span></p>
                                    </div>

                                    <form method="POST" action="{{ route('admin.forgot.otp.verify') }}">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $email ?? 0 }}">
                                        <input type="hidden" name="otp" id="otp">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="mb-3">
                                                    <label for="digit1-input" class="visually-hidden">Digit 1</label>
                                                    <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(1, event)" maxLength="1" id="digit1-input">
                                                </div>
                                            </div><!-- end col -->
                                    
                                            <div class="col-3">
                                                <div class="mb-3">
                                                    <label for="digit2-input" class="visually-hidden">Digit 2</label>
                                                    <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(2, event)" maxLength="1" id="digit2-input">
                                                </div>
                                            </div><!-- end col -->
                                    
                                            <div class="col-3">
                                                <div class="mb-3">
                                                    <label for="digit3-input" class="visually-hidden">Digit 3</label>
                                                    <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(3, event)" maxLength="1" id="digit3-input">
                                                </div>
                                            </div><!-- end col -->
                                    
                                            <div class="col-3">
                                                <div class="mb-3">
                                                    <label for="digit4-input" class="visually-hidden">Digit 4</label>
                                                    <input type="text" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(4, event)" maxLength="1" id="digit4-input">
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <div class="mt-3">
                                        <button type="submit" class="btn btn-success w-100">Confirm</button>
                                    </div>
                                    </form><!-- end form -->

                                    
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->                      

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        @include('admin.layout.footer')
    </div>

@endsection

@section('scripts')
<script src="{{ asset('assets/admin/js/pages/two-step-verification.init.js') }}"></script>
<script>
    function moveToNext(current, event) {
        let input = event.target;
        if (input.value.length === 1 && current < 4) {
            document.getElementById(`digit${current+1}-input`).focus();
        }

        // collect all digits
        let otp = '';
        for (let i = 1; i <= 4; i++) {
            otp += document.getElementById(`digit${i}-input`).value;
        }
        document.getElementById('otp').value = otp;
    }
</script>

@endsection