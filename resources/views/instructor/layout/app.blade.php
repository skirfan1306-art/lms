<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<head>

    <meta charset="utf-8" />
    <title>{{ $gs->title ?? 'LMS' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @include('instructor.layout.header-links')
</head>

<body>
@php
    $authPages = ['instructor.login'];
@endphp
    <!-- Begin page -->
    <div id="layout-wrapper">
@if (!request()->routeIs($authPages))
@include('instructor.layout.header')
@endif


<!------------------ *** Success & Error Alerts Start *** -------------->
@session('success')
<div class="alert alert-info alert-border-left alert-dismissible fade show material-shadow" role="alert"
style="position: fixed; left: 50%; z-index: 9999999999; width: max-content; top: 10px; transform: translateX(-50%);" >
    <i class="ri-check-double-line align-middle"></i> <strong>Success</strong> - {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession
@session('error')
<div class="alert alert-danger alert-border-left alert-dismissible fade show material-shadow" role="alert"
style="position: fixed; left: 50%; z-index: 9999999999; width: max-content; top: 10px; transform: translateX(-50%);">
    <i class="ri-error-warning-line me-3 align-middle"></i> <strong>Danger</strong> - {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession
@if ($errors->any())
    <div class="alert alert-danger alert-border-left alert-dismissible fade show material-shadow" 
         style="position: fixed; left: 50%; z-index: 9999999999; width: max-content; top: 10px; transform: translateX(-50%);" 
         role="alert">
        <i class="ri-error-warning-line me-3 align-middle"></i> 
        <strong>Danger</strong> - Please fix the following errors:
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Success Alert -->
<div id="successAlert" class="alert alert-info alert-border-left alert-dismissible fade material-shadow"
     role="alert"
     style="display:none; position: fixed; left: 50%; z-index: 9999999999; width: max-content; top: 10px; transform: translateX(-50%);">
    <i class="ri-check-double-line align-middle"></i> 
    <strong>Success</strong> - <span class="msg"></span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<!-- Danger Alert -->
<div id="errorAlert" class="alert alert-danger alert-border-left alert-dismissible fade material-shadow"
     role="alert"
     style="display:none; position: fixed; left: 50%; z-index: 9999999999; width: max-content; top: 10px; transform: translateX(-50%);">
    <i class="ri-error-warning-line me-3 align-middle"></i> 
    <strong>Danger</strong> - <span class="msg"></span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

 <!-- ----- *** Success & Error Alerts End *** -- ---------->


        <!-- ========== App Menu ========== -->
        @if (!request()->routeIs($authPages))
        @include('instructor.layout.sidebar')
        @endif
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        @yield('main.content')
        
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top" style="bottom: 40px">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    @include('instructor.layout.footer-links')
    

<script>
function showAlert(type, message, timeout = 3500) {
    const successAlert = document.getElementById('successAlert');
    const errorAlert = document.getElementById('errorAlert');

    if (successAlert) {
        successAlert.classList.remove('show');
        successAlert.style.display = 'none';
    }
    if (errorAlert) {
        errorAlert.classList.remove('show');
        errorAlert.style.display = 'none';
    }

    let alertBox = null;
    if (type === 'success') alertBox = successAlert;
    else if (type === 'error') alertBox = errorAlert;

    if (!alertBox) return; 

    const msgEl = alertBox.querySelector('.msg');
    if (msgEl) msgEl.innerText = message;
    alertBox.style.display = 'block';
    alertBox.classList.add('show');

    clearTimeout(alertBox.__hideTimer);
    alertBox.__hideTimer = setTimeout(function () {
        alertBox.classList.remove('show');
        alertBox.style.display = 'none';
    }, timeout);
}
</script>

</body>
</html>