<nav id="sidebar" class="col-lg-2 col-md-3 d-md-block sidebar collapse" role="navigation" aria-label="Barra lateral principal">
    <!-- Load externals (kept here as in your original) -->
    <script src="https://kit.fontawesome.com/1e17b73e36.js" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

    <div class="position-sticky pt-3" style="padding-bottom:24px;">
        <!-- Logo -->
        <div class="px-3 mb-4" style="display:flex; align-items:center; gap:12px;">
            <a href="{{ route('dashboard') }}" aria-label="Inicio">
                <img src="{{ asset('assets/images/E-GO_LOGO.png') }}" alt="E-GO Logo" style="height:50px; width:auto; object-fit:contain;">
            </a>
        </div>

        <!-- Acceso directo al Dashboard -->
        <ul class="nav flex-column mb-4" role="menu" aria-label="Sección inicio">
            <li class="nav-item mb-2">
                <span class="nav-section-title px-3 text-uppercase small text-muted">Inicio</span>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 {{ Request::routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}" role="menuitem" aria-current="{{ Request::routeIs('dashboard') ? 'page' : 'false' }}">
                    <i class="fa-solid fa-house" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <!-- Navigation: Gestión de tienda -->
        <ul class="nav flex-column mb-3" role="menu" aria-label="Gestión de tienda">
            <li class="nav-item mb-2">
                <span class="nav-section-title px-3 text-uppercase small text-muted">Gestión de tienda</span>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 {{ Request::routeIs('products.*') ? 'active' : '' }}"
                   href="{{ route('products.index') }}" role="menuitem" aria-current="{{ Request::routeIs('products.*') ? 'page' : 'false' }}">
                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                    <span>Publicaciones</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 {{ Request::routeIs('chats.*') ? 'active' : '' }}"
                   href="{{ route('chats.index') }}" role="menuitem" aria-current="{{ Request::routeIs('chats.*') ? 'page' : 'false' }}">
                    <i class="fa-solid fa-message" aria-hidden="true"></i>
                    <span>Chat</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 {{ Request::routeIs('ventas.*') ? 'active' : '' }}"
                   href="{{ route('ventas.index') }}" role="menuitem" aria-current="{{ Request::routeIs('ventas.*') ? 'page' : 'false' }}">
                    <i class="fa-solid fa-shop" aria-hidden="true"></i>
                    <span>Ventas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 {{ Request::routeIs('pedidos.*') ? 'active' : '' }}"
                   href="{{ route('pedidos.index') }}" role="menuitem" aria-current="{{ Request::routeIs('pedidos.*') ? 'page' : 'false' }}">
                    <i class="fa-solid fa-clipboard" aria-hidden="true"></i>
                    <span>Pedidos</span>
                </a>
            </li>
        </ul>

        <!-- Navigation: Herramientas -->
        <ul class="nav flex-column mb-4" role="menu" aria-label="Herramientas">
            <li class="nav-item mb-2">
                <span class="nav-section-title px-3 text-uppercase small text-muted">Herramientas</span>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 {{ Request::routeIs('compras.*') ? 'active' : '' }}"
                   href="{{ route('compras.index') }}" role="menuitem" aria-current="{{ Request::routeIs('compras.*') ? 'page' : 'false' }}">
                    <i class="fa-solid fa-desktop" aria-hidden="true"></i>
                    <span>Cursos informativos</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 {{ Request::routeIs('deliveries') ? 'active' : '' }}"
                   href="{{ route('deliveries') }}" role="menuitem" aria-current="{{ Request::routeIs('deliveries') ? 'page' : 'false' }}">
                    <i class="fa-solid fa-truck" aria-hidden="true"></i>
                    <span>Deliverys</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar sticky JS: place immediately after the sidebar markup (NO TOCA el header ni sus estilos) -->
<script>
  (function () {
    // Selector del sidebar (usa el id que añadimos)
    const sidebarSelector = 'nav#sidebar';
    const sidebar = document.querySelector(sidebarSelector);
    if (!sidebar) return;

    // **NO** tocamos el header ni leemos/ajustamos su altura.
    // Este script solo fija el sidebar cuando el usuario baja y lo restaura al subir.
    // No modifica ni asume nada respecto al header/topbar.

    // Guardar estilos inline originales para restaurar luego
    const orig = {
      position: sidebar.style.position || '',
      top: sidebar.style.top || '',
      left: sidebar.style.left || '',
      width: sidebar.style.width || '',
      height: sidebar.style.height || '',
      overflowY: sidebar.style.overflowY || '',
      zIndex: sidebar.style.zIndex || ''
    };

    // Posición original del sidebar en la página
    let sidebarTop = null;
    function computeTop() {
      const rect = sidebar.getBoundingClientRect();
      sidebarTop = rect.top + window.scrollY;
    }
    setTimeout(computeTop, 40);

    // Fija el sidebar usando top = 0 (NO interviene en header)
    function fix() {
      const rect = sidebar.getBoundingClientRect();
      const left = rect.left;
      const width = rect.width;
      sidebar.style.position = 'fixed';
      sidebar.style.top = '0px';                 // top fijo en 0 — NO se toca el header
      sidebar.style.left = left + 'px';
      sidebar.style.width = width + 'px';
      sidebar.style.height = window.innerHeight + 'px';
      sidebar.style.overflowY = 'auto';
      sidebar.style.zIndex = 1050;
      sidebar.classList.add('js-sidebar-fixed');
    }

    // Restaurar estilos originales
    function unfix() {
      sidebar.style.position = orig.position;
      sidebar.style.top = orig.top;
      sidebar.style.left = orig.left;
      sidebar.style.width = orig.width;
      sidebar.style.height = orig.height;
      sidebar.style.overflowY = orig.overflowY;
      sidebar.style.zIndex = orig.zIndex;
      sidebar.classList.remove('js-sidebar-fixed');
    }

    // Throttle con requestAnimationFrame
    let ticking = false;
    function onScroll() {
      if (sidebarTop === null) computeTop();
      if (!ticking) {
        window.requestAnimationFrame(function () {
          const y = window.scrollY || window.pageYOffset;
          if (y > sidebarTop) {
            if (sidebar.style.position !== 'fixed') fix();
          } else {
            if (sidebar.style.position === 'fixed') unfix();
          }
          ticking = false;
        });
        ticking = true;
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });

    window.addEventListener('resize', function () {
      const wasFixed = sidebar.style.position === 'fixed';
      if (wasFixed) {
        unfix();
        computeTop();
        setTimeout(() => { fix(); }, 60);
      } else {
        computeTop();
      }
    });

    // Manejo eventos collapse de bootstrap (si aplica)
    document.addEventListener('shown.bs.collapse', function () { computeTop(); setTimeout(onScroll, 50); });
    document.addEventListener('hidden.bs.collapse', function () { computeTop(); setTimeout(onScroll, 50); });

    // Chequeo inicial al cargar
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
      setTimeout(onScroll, 60);
    } else {
      document.addEventListener('DOMContentLoaded', function () { computeTop(); setTimeout(onScroll, 60); });
    }

    // Helper debug
    window.__sidebarFix = { recompute: computeTop, restore: unfix };
  })();
</script>