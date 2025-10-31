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
    
    @include('front.layout.header')
    <div class="booking-overlay"></div>
    @include('front.layout.popup')
    
    @yield('main')
    
    @include('front.layout.footer')
    @include('front.layout.footer-links')
</body>

</html>