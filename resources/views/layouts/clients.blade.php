<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-GO- Dashboard</title>

    <!-- CSRF token (usado por fetch/AJAX) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Header/Navbar SIEMPRE arriba y ancho completo -->
    @include('partials.headerClients')

    <div class="container-fluid px-0">
        <!-- Main Content: ocupa todo el ancho sin sidebar -->
        <main class="mt-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Inicializar contador de carrito si existe el badge en el layout/partial header -->
    <script>
        // Proporciona un valor inicial al frontend (basado en la sesión).
        // No modifica nada visual si el header ya maneja su propio contador.
        window.CartInitialCount = {{ count(session('cart', [])) }};

        document.addEventListener('DOMContentLoaded', function () {
            try {
                const badge = document.getElementById('cartBadge');
                if (badge) {
                    // Solo actualizar si el badge está presente en el DOM
                    badge.textContent = window.CartInitialCount;
                }
            } catch (e) {
                // no bloquear nada si hay errores
                console.error('cart init error', e);
            }
        });
    </script>
</body>
</html>