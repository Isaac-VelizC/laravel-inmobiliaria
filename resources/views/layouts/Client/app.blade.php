<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{ asset('assets/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{ asset('assets/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet
    @vite(['resources/css/app.css', 'resources/js/app.js'])">

</head>

<body>
    <div id="app">
        @include('layouts.client.navbar')

        <main class="py-4">
            @yield('content')
        </main>
        @include('layouts.client.footer')

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        <div id="preloader"></div>

        <!-- JavaScript Libraries -->
        <script src="{{ asset('assets/lib/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/lib/jquery/jquery-migrate.min.js')}}"></script>
        <script src="{{ asset('assets/lib/popper/popper.min.js')}}"></script>
        <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('assets/lib/easing/easing.min.js')}}"></script>
        <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('assets/lib/scrollreveal/scrollreveal.min.js')}}"></script>
        <!-- Contact Form JavaScript File -->
        <script src="{{ asset('assets/contactform/contactform.js')}}"></script>

        <!-- Template Main Javascript File -->
        <script src="{{ asset('assets/js/main.js')}}"></script>

    </div>
</body>

</html>