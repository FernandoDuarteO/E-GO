<script src="https://kit.fontawesome.com/1e17b73e36.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<nav class="col-lg-2 col-md-3 d-md-block sidebar collapse">
    <div class="position-sticky pt-3">
        <!-- Logo -->
        <div style="display: flex; align-items: center; gap: 12px;">
            <img src="assets/images/E-GO_LOGO.png" alt="E-GO Logo" style="height: 50px; width: auto; object-fit: contain;">
        </div>

        <!-- Acceso directo al Dashboard -->
        <ul class="nav flex-column mb-4">
            <li class="nav-item mb-2">
                <span class="nav-section-title px-3 text-uppercase small text-muted">Inicio</span>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>

        </ul>
        <!-- Navigation -->
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <span class="nav-section-title px-3 text-uppercase small text-muted">Gestión de tienda</span>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('products') ? 'active' : '' }}" href="{{ route('products.index') }}">
                    <i class="fa-solid fa-plus"></i>
                    Publicaciones
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('chat') ? 'active' : '' }}" href="{{ route('chats.index') }}">
                    <i class="fa-solid fa-message"></i>
                    Chat
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('ventas') ? 'active' : '' }}" href="{{ route('ventas.index') }}">
                    <i class="fa-solid fa-shop"></i>
                    Ventas
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('pedidos') ? 'active' : '' }}" href="{{ route('pedidos.index') }}">
                    <i class="fa-solid fa-clipboard"></i>
                    Pedidos
                </a>
            </li>
        </ul>

        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <span class="nav-section-title px-3 text-uppercase small text-muted">Herramientas</span>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('costos') ? 'active' : '' }}" href="{{ route('costos.index') }}">
                    <i class="fa-solid fa-calculator"></i>
                    Calculadora de Costos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('compras') ? 'active' : '' }}" href="{{ route('compras.index') }}">
                    <i class="fa-solid fa-desktop"></i>
                    Cursos informativos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('compras') ? 'active' : '' }}" href="{{ route('compras.index') }}">
                    <i class="fa-solid fa-truck"></i>
                    Deliverys
                </a>
            </li>
        </ul>
    </div>

</nav>
