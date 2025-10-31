$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    'Accept': 'application/json' // force Laravel to return JSON errors
  }
});

// -------- User Registration ----------
$('#registerBtn').click(function (e) {
    e.preventDefault();

    var btn = $(this);
    btn.prop('disabled', true).text('Processing...');

    let url = btn.data('url');

    $.ajax({
        url: url,
        method: "POST",
        data: $('#createAccountForm').serialize(),
        success: function (response) {
            if (response.success) {
                $('#msg').html('<p style="color:green;">' + response.message + '</p>');
                $('#createAccountForm')[0].reset();
            } else {
                $('#msg').html('<p style="color:red;">' + (response.message || 'Something went wrong') + '</p>');
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.error('Register AJAX error:', textStatus, errorThrown, xhr);

            // Better error extraction
            let msg = 'Something went wrong. Try again.';
            if (xhr.responseJSON) {
                // JSON response: either message or validation errors
                if (xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                } else if (xhr.responseJSON.errors) {
                    // join first error from each field
                    msg = Object.values(xhr.responseJSON.errors).map(arr => arr[0]).join('<br>');
                }
            } else {
                // No JSON (likely 419/500). Give helpful hint
                if (xhr.status === 419) {
                    msg = 'Session expired (CSRF token mismatch). Refresh page and try again.';
                } else if (xhr.status === 500) {
                    msg = 'Server error';
                } else {
                    msg = 'Unexpected error: ' + xhr.status + ' ' + errorThrown;
                }
            }

            $('#msg').html('<p style="color:red;">' + msg + '</p>');
        },
        complete: function () {
            btn.prop('disabled', false).text('Create Account');
        }
    });
});



$('#loginBtn').click(function(e) {
    e.preventDefault();

    var btn = $(this);
    btn.prop('disabled', true).text('Processing...');

    let url = btn.data('url');

    $.ajax({
        url: url,
        method: "POST",
        data: $('#loginForm').serialize(),
        success: function(response) {
            if (response.success) {
                $('#loginMsg').html('<p style="color:green;">' + response.message + '</p>');
                $('#loginForm')[0].reset();

                // Redirect after short delay
                setTimeout(() => {
                    window.location.href = response.redirect_url;
                }, 1000);
            } else {
                $('#loginMsg').html('<p style="color:red;">' + (response.message || 'Invalid credentials') + '</p>');
            }
        },
        error: function(xhr) {
            let msg = 'Something went wrong. Try again.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }
            $('#loginMsg').html('<p style="color:red;">' + msg + '</p>');
        },
        complete: function() {
            btn.prop('disabled', false).text('Log In');
        }
    });
});

