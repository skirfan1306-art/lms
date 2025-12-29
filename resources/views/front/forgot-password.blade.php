@extends('front.layout.app')
@section('title')
Forget Password
@endsection
@section('main')

    <main class="main">
 

      <!-- forgot password area -->
      <div class="auth-area py-120">
        <div class="container">
          <div class="col-md-5 mx-auto">
            <div class="auth-form">
              <div class="auth-header">
                  <div id="alert-success" class="alert alert-success" role="alert" style="display:none"></div>
                  <div id="alert-danger" class="alert alert-danger" role="alert" style="display:none"></div>
                <img src="{{ asset('assets/logo/' . $gs->logo ) }}" alt="" />
                <p>Reset your edubo account password</p>
              </div>
              <div id="forget-pass">
                <div class="form-group email-sec">
                 <div class="form-icon">
                    <i class="far fa-envelope"></i>
                    <input id="email" name="otp" type="email" class="form-control" placeholder="Your Email" required />
                  </div>
                </div>
                <div class="otp-sec">
                
                </div>
                <div class="pass-sec">
                
                </div>
                <div class="auth-btn">
                  <button type="button" class="otp-btn theme-btn main-btn"><span class="far fa-key"></span> Send OTP</button>
                  
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- forgot password area end -->
    </main>

@endsection

@section('scripts')

<script>
    $(document).ready(function(){
        
        let blockRefresh = false;
        var email = '';
        var succesAlertMsg = $('#alert-success');
        var dangerAlertMsg = $('#alert-danger');
        
        // send OTP
       $(document).on('click', '.otp-btn', function () {
              blockRefresh = true;
             email = $("#email").val();
            
            $.ajax({
                url: '/forgot-password/send-otp',
                type: "POST",
                data: {
                    email: email,
                    _token : "{{ csrf_token() }}"
                },
                 success: function (res) {
                     if(res.status == 'success'){
                         dangerAlertMsg.hide();
                         $("#email").prop('readonly', true).addClass('is-valid').removeClass('is-invalid');
                            succesAlertMsg.text(res.message).show();
                            $('.main-btn').removeClass('otp-btn').addClass('verify-btn').text('Submit OTP');
                            $('.otp-sec').append(`<div class="form-group">
                                                     <div class="form-icon">
                                                        <i class="far fa-key"></i>
                                                        <input id="otp" name="otp" type="text" oninput="this.value=this.value.slice(0,4)" class="form-control" placeholder="Enter OTP" required />
                                                      </div>
                                                    </div>`);
                                                    
                     }else{
                          $("#email").prop('readonly', false).addClass('is-valid').removeClass('is-invalid');
                         succesAlertMsg.hide();
                         dangerAlertMsg.text(res.message).show();
                     }
                    },
                error: function () {
                     $("#email").prop('readonly', false).addClass('is-valid').removeClass('is-invalid');
                    succesAlertMsg.hide();
                    dangerAlertMsg.text("Something went wrong! Try again later").show();
                }
            })
        });
        
        // Verify OTP
        $(document).on('click', '.verify-btn', function () {
        blockRefresh = true;
            var otp = $("#otp").val();
            $.ajax({
                url: '/forgot-password/verify-otp',
                type: "POST",
                data: {
                    email: email,
                    otp: otp,
                    _token : "{{ csrf_token() }}"
                },
                 success: function (res) {
             console.log(res);
                     if(res.status == 'success'){
                         dangerAlertMsg.hide();
                         $(".otp-sec").html('');
                         $("#email").hide();
                            succesAlertMsg.text(res.message).show();
                            $('.main-btn').removeClass('verify-btn').addClass('reset-pass-btn').text('Set Password');
                            $('.otp-sec').html('');
                            $('.email-sec').html('');
                            $('.pass-sec').append(`<div class="form-group">
                                                      <div class="form-icon">
                                                        <i class="far fa-key"></i>
                                                        <input name="password" type="password" id="password" class="form-control" placeholder="Your Password*" required>
                                                        <span class="password-view"><i class="far fa-eye-slash"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                      <div class="form-icon">
                                                        <i class="far fa-key"></i>
                                                        <input name="password_confirmation" type="password" id="c_password" class="form-control" placeholder="Confirm Password*" required>
                                                         
                                                        </div>
                                                    </div>`);
                                                    
                     }else{
                         succesAlertMsg.hide();
                         dangerAlertMsg.text(res.message).show();
                     }
                    },
                error: function () { 
                    succesAlertMsg.hide();
                    dangerAlertMsg.text("Something went wrong! Try again later").show();
                }
            })
        });
        
        
        // Reset Password
        $(document).on('click', '.reset-pass-btn', function () {
        blockRefresh = true;
            var password = $("#password").val();
            var password_confirmation = $("#c_password").val();
            $.ajax({
                url: '/forgot-password/reset-password',
                type: "POST",
                data: {
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation,
                    _token : "{{ csrf_token() }}"
                },
                 success: function (res) {
             console.log(res);
                     if(res.status == 'success'){
                         dangerAlertMsg.hide();
                         $(".otp-sec").html('');
                         $("#email").hide();
                            succesAlertMsg.text(res.message).show();
                            blockRefresh = false;
                             setTimeout(function () {
                                window.location.href = "login";  
                            }, 2000);
                             
                     }else{
                         succesAlertMsg.hide();
                         dangerAlertMsg.text(res.message).show();
                     }
                    },
                error: function () { 
                    succesAlertMsg.hide();
                    
                    dangerAlertMsg.text("Something went wrong! Try again later").show();
                }
            })
        });
        
        
        
    window.onbeforeunload = function () {
        if (blockRefresh) {
            return "OTP process is in progress. Are you sure you want to leave?";
        }
    };
   function validatePassword() {
    succesAlertMsg.hide();
    dangerAlertMsg.hide();

    let password = $("#password").val();
    let confirmPassword = $("#c_password").val();

    let regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/;

    // reset states
    $("#password, #c_password").removeClass('is-valid is-invalid');

    // empty password
    if (!password) {
        return false;
    }

    // password strength validation
    if (!regex.test(password)) {
        $("#password").addClass('is-invalid');
        dangerAlertMsg.text(
            "Password must be 8+ chars, include uppercase, lowercase, number & special character."
        ).show();
        return false;
    }

    $("#password").addClass('is-valid');

    // confirm password empty (do not show error yet)
    if (!confirmPassword) {
        return false;
    }

    // password mismatch
    if (password !== confirmPassword) {
        $("#c_password").addClass('is-invalid');
        dangerAlertMsg.text("Password and Confirm Password do not match.").show();
        return false;
    }

    // confirm password matched
    $("#c_password").addClass('is-valid');

    return true;
}

$(document).on('keyup', '#password, #c_password', function () {
    validatePassword();
});

    })
     
$(document).on('click', '.password-view', function () {
    var $input = $('#password'); 

    $(this).toggleClass('show');

    if ($(this).hasClass('show')) {
        $input.attr('type', 'text');
        
    } else {
        $input.attr('type', 'password'); 
    }
});
</script>
 

@endsection


  