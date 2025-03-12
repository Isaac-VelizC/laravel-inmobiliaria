<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/dashboard/images/favicon.svg')}}" type="image/x-icon" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/lineicons.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/materialdesignicons.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/fullcalendar.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/main.css')}}" />
    <!-- Scripts -->
    <link href="{{ asset('assets/dashboard/DataTables/datatables.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css">
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- ======== Preloader =========== -->
    <!---div-- id="preloader">
        <div class="spinner"></div>
    </!---div-->
    <!-- ======== Preloader =========== -->
    
    @include('layouts.admin.sidebar')

    <main class="main-wrapper">
        @include('layouts.admin.navbar')
        @yield('content')
        @include('layouts.admin.footer')
    </main>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="{{ asset('assets/dashboard/DataTables/datatables.min.js')}}"></script>
    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{ asset('assets/dashboard/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/Chart.min.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/dynamic-pie-chart.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/moment.min.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/fullcalendar.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/jvectormap.min.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/world-merc.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/polyfill.js')}}"></script>
    <script src="{{ asset('assets/dashboard/js/main.js')}}"></script>
    @stack('scripts') {{-- Para agregar scripts específicos de cada vista --}}
</body>

</html>