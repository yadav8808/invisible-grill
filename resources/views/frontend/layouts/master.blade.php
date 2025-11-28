<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smash - Bootstrap Business Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.png') }}" type="image/png">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/LineIcons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

    @stack('css')
</head>
<body>

    <!-- Header -->
    @include('frontend.layouts.header')

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    @include('frontend.layouts.footer')
    @stack('js')
</body>
</html>
