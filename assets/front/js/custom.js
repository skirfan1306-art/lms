$(document).ready(function () { 
    $(".toast.show").each(function () {
        let toast = $(this);
        setTimeout(function () {
            toast.removeClass("show");
        }, 5000);
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function SuccessAlert(message) {
    let toastHtml = `
        <div class="toast align-items-center text-bg-success border-0"
             role="alert" aria-live="assertive" aria-atomic="true"
             data-bs-delay="5000" data-bs-autohide="true">
            <div class="d-flex">
                <div class="toast-body d-flex gap-2 align-items-center">
                    <i class="fa-solid fa-circle-check fa-lg"></i>
                    <div>
                      <span class="small">${message}</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>`;

    let $toast = $(toastHtml).appendTo(".toast-container");

    let toast = new bootstrap.Toast($toast[0]);
    toast.show();

    // Auto remove after 5 seconds
    setTimeout(() => {
        $toast.remove();
    }, 5500);
}


function ErrorAlert(message) {
    let toastHtml = `
        <div class="toast text-bg-danger border-0"
             role="alert" aria-live="assertive" aria-atomic="true"
             data-bs-delay="5000" data-bs-autohide="true">
            <div class="d-flex">
                <div class="toast-body d-flex gap-2 align-items-center">
                    <i class="fa-solid fa-circle-xmark"></i>
                    <div>
                      <span>${message}</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>`;

    let $toast = $(toastHtml).appendTo(".toast-container");

    let toast = new bootstrap.Toast($toast[0]);
    toast.show();

    // Auto remove after 5 seconds
    setTimeout(() => {
        $toast.remove();
    }, 5500);
}



$(document).on('click', '.addToCart', function(e) {
  e.preventDefault();

  var $btn = $(this);

  // read course id from data attribute (supports data-course-id or data-id)
  var courseId = $btn.data('courseId') || $btn.data('id') || $btn.attr('data-id');
  if (!courseId) {
    console.error('No course id found on button');
    return;
  }

  // UI lock
  $btn.prop('disabled', true);
  var originalHtml = $btn.html();
  $btn.html('Processing...');

  var token = $('meta[name="csrf-token"]').attr('content') || '';

  $.ajax({
    url: '/cart/add',
    method: 'POST',
    data: JSON.stringify({ course_id: courseId }),
    contentType: 'application/json; charset=utf-8',
    dataType: 'json',

    success: function(json, textStatus, jqXHR) {
      // If server indicates redirect (guest), do it
      if (json && json.redirect) {
        window.location.href = json.redirect;
        return;
      }

      if (json && json.success) {
        // update cart count if provided
        var $countEl = $('#cart-count');
        if ($countEl.length) {
          if (typeof json.cart_count !== 'undefined' && json.cart_count !== null) {
            $countEl.text(json.cart_count);
          } else {
            // fallback increment
            var cur = parseInt($countEl.text() || '0', 10);
            $countEl.text(cur + 1);
          }
        }

        SuccessAlert(json.message || 'Added to cart!');
      } else {
        ErrorAlert((json && json.message) ? json.message : 'Unexpected response from server.');
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      // 401 Unauthorized -> redirect to login if server returned redirect url
      if (jqXHR.status === 401) {
        var redirectUrl;
        try {
          redirectUrl = jqXHR.responseJSON && jqXHR.responseJSON.redirect;
        } catch(e) { /* ignore */ }
        window.location.href = redirectUrl || '/login';
        return;
      }

      // try to show JSON message if present
      var errMsg = 'An error occurred. Check console for details.';
      if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
        errMsg = jqXHR.responseJSON.message;
      } else if (jqXHR.responseText) {
        // try to parse plain text JSON
        try {
          var parsed = JSON.parse(jqXHR.responseText);
          if (parsed && parsed.message) errMsg = parsed.message;
        } catch(e) { /* not JSON */ }
      }

      ErrorAlert(errMsg);
      console.error('Add to cart error:', jqXHR, textStatus, errorThrown);
    },
    complete: function() {
      // restore UI
      $btn.prop('disabled', false);
      $btn.html(originalHtml);
    }
  });
});



$(document).on('click', '.removeToCart', function(e) {
  e.preventDefault();
  var $btn = $(this);
  var cartId = $btn.data('cart-id');

  if (!cartId) {
    console.error('No cart id found on remove button');
    return;
  }

  // UI feedback
  $btn.prop('disabled', true);
  var originalHtml = $btn.html();
  $btn.html('<i class="fas fa-spinner fa-spin"></i>');

  var token = $('meta[name="csrf-token"]').attr('content') || '';

  $.ajax({
    url: '/cart/remove',
    method: 'POST',
    data: JSON.stringify({ cart_id: cartId }),
    contentType: 'application/json; charset=utf-8',
    dataType: 'json',

    success: function(json) {
      if (json && json.redirect) {
        window.location.href = json.redirect;
        return;
      }

      if (json && json.success) {
        // remove the table row
        $('#cart-row-' + cartId).fadeOut(200, function() { $(this).remove(); });
        
        $(".subtotal").text(json.subtotal);
        $(".discount").text(json.discount);
        $(".final_total").text(json.final_total);
        
        if(json.discount == 0){
            $("#coupon_code").prop("readonly", false).val('');
            $("#cancelCouponBtn").addClass("d-none");
            $("#applyCouponBtn").removeClass("d-none");
        }

        var $countEl = $('#cart-count');
        var $isCart = $('.isCart');
        var $emptyCart = $('.emptyCart');
        
        if ($countEl.length) {
            if (typeof json.cart_count !== 'undefined' && json.cart_count !== null) {
                $countEl.text(json.cart_count);
            } else {
                var cur = parseInt($countEl.text() || '0', 10);
                $countEl.text(Math.max(0, cur - 1));
            }
        }
        
        // Check if cart is empty now
        var newCount = parseInt($countEl.text(), 10);
        
        if (newCount <= 0) {
            // hide cart section
            $isCart.fadeOut(300, function () {
                // show empty cart section
                $emptyCart.removeClass('d-none').hide().fadeIn(300);
            });
        }


        // optional empty-cart fallback: if no rows left show a message
        if ($('tbody tr').length === 0) {
          $('tbody').html('<tr><td colspan="4" class="text-center">Your cart is empty.</td></tr>');
        }

        SuccessAlert(json.message || 'Item removed from cart.');
      } else {
        ErrorAlert((json && json.message) ? json.message : 'Could not remove item.');
      }
    },
    error: function(jqXHR) {
      if (jqXHR.status === 401) {
        var redirect = jqXHR.responseJSON && jqXHR.responseJSON.redirect;
        window.location.href = redirect || '{{ route("login") }}';
        return;
      }

      var errMsg = 'An error occurred. Check console for details.';
      if (jqXHR.responseJSON && jqXHR.responseJSON.message) errMsg = jqXHR.responseJSON.message;
      ErrorAlert(errMsg);
      console.error('Remove cart error:', jqXHR);
    },
    complete: function() {
      $btn.prop('disabled', false);
      $btn.html(originalHtml);
    }
  });
});



$(document).ready(function () {

    let applyBtn   = $("#applyCouponBtn");
    let cancelBtn  = $("#cancelCouponBtn");
    let couponInput = $("#coupon_code");

    applyBtn.on("click", function () {
        
        let code = couponInput.val().trim();

        if (code === '') {
            ErrorAlert('Please enter a coupon code to continue.');
            return;
        }

        let originalText = applyBtn.text();

        $.ajax({
            url: "/coupon/apply",
            type: "POST",
            data: {
                code: code,
            },
            beforeSend: function () {
                applyBtn.prop("disabled", true).text("Checking...");
            },
            success: function (res) {

                if (res.status === true) {

                    $(".discount").text(res.discount);
                    $(".final_total").text(res.final_total);

                    applyBtn.addClass("d-none");
                    cancelBtn.removeClass("d-none");
                    couponInput.prop("readonly", true);

                    SuccessAlert(res.msg || 'Coupon applied successfully');

                } else {
                    ErrorAlert(res.msg || 'This coupon is not valid.');
                }
            },
            error: function () {
                ErrorAlert('Something went wrong. Please try again later.');
            },
            complete: function () {
                applyBtn.prop("disabled", false).text(originalText);
            }
        });
    });

    cancelBtn.on("click", function () {

        $.ajax({
            url: "/coupon/cancel",
            type: "POST",

            success: function (res) {

                $(".discount").text(res.discount);
                $(".final_total").text(res.final_total);

                couponInput.prop("readonly", false).val('');
                cancelBtn.addClass("d-none");
                applyBtn.removeClass("d-none");

                SuccessAlert('Coupon removed successfully.');
            }
        });

    });

});
