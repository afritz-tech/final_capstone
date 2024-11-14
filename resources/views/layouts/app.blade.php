<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>C. Hub</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <link href="{{ asset('front/img/favicon.ico') }}" rel="icon" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

    <link href="{{ asset('front/lib/flaticon/font/flaticon.css') }}" rel="stylesheet" />

    <link href="{{ asset('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet" />

    @yield('style')

</head>

<body>

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <a href="#" class="p-3 btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('front/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('front/lib/lightbox/js/lightbox.min.js') }}"></script>

    <script src="{{ asset('front/js/main.js') }}"></script>

    @yield('script')

</body>

</html>
