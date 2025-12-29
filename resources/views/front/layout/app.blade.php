<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $gs->title }} | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/' . $gs->favicon ) }}">
    @include('front.layout.header-links')

</head>

<body>
     

<!-- Toast container (bottom-right) -->
<div class="toast-container position-fixed top-0 end-0 p-4">
@if (session('success'))
  <div id="appToast"
       class="toast align-items-center text-bg-success border-0 show"
       role="alert" aria-live="assertive" aria-atomic="true"
       data-bs-delay="4000" data-bs-autohide="true">
    <div class="d-flex">
      <div class="toast-body d-flex gap-2 align-items-center">
        <i class="fa-solid fa-circle-check fa-lg" aria-hidden="true"></i>
        <div>
          <span class="small">{{ session('success') ?? "Your action was completed." }}</span>
        </div>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto"
              data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
@endif
@if (session('error'))  
  <div id="toastDanger"
       class="toast text-bg-danger border-0 show"
       role="alert" aria-live="assertive" aria-atomic="true"
       data-bs-delay="4000" data-bs-autohide="true">
    <div class="d-flex">
      <div class="toast-body d-flex gap-2 align-items-center">
        <i class="fa-solid fa-circle-xmark"></i>
        <div>
          <span>{{ session('error') ?? "Something went wrong." }}</span>
        </div>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto"
              data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
@endif
</div>

     <div class="preloader">
      <div class="loader-ripple">
        <div></div>
        <div></div>
      </div>
    </div>
    @include('front.layout.header')
    
    @yield('main')
    
    @include('front.layout.footer')
    
    @include('front.layout.footer-links')


</body>

</html>