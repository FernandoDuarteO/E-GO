<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>

    <!-- CSS globales -->
    <link href="{{ asset('assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">

    @stack('styles') <!-- CSS adicional para cada página -->
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- Wrapper principal -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical">
        
        @include('partials.header')  <!-- Aquí metes tu header -->

        <!-- Contenido dinámico -->
        <div class="page-wrapper">
            @yield('content')
        </div>

    </div>

    <!-- JS globales -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>

    @stack('scripts') <!-- JS adicional para cada página -->
</body>
</html>
