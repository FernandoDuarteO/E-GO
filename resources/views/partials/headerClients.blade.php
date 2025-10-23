<meta name="viewport" content="width=device-width, initial-scale=1.0">
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow-sm w-100" style="left:0;">
    <div class="container-fluid">
        <!-- LOGO E-GO (copiado de sidebar) -->
        <div style="display: flex; align-items: center; gap: 12px;">
            <img src="{{ asset('assets/images/E-GO_LOGO.png') }}" alt="E-GO Logo" style="height: 40px; width: auto; object-fit: contain;">
        </div>

        <!-- Search -->
        <form class="d-none d-sm-inline-block form-inline ms-auto me-0 my-2 my-md-0 search-container">
            <div class="input-group">
                <input type="text" class="form-control border-0 small" placeholder="Search..." aria-label="Search">
            </div>
        </form>

        <!-- User Info -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="me-2 d-none d-lg-inline text-gray-600 small">
                        {{ Auth::user()->name ?? 'Usuario' }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('clients.index') }}">Perfil</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">Cerrar sesión</button>
                        </form>
                    </li>
                                    <li>
                    <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('¿Seguro que quieres eliminar tu cuenta? Esta acción no se puede deshacer.');">
                        @csrf
                        @method('DELETE')
                        <button class="dropdown-item text-danger" type="submit">
                            <i class="bi bi-trash3"></i> Eliminar cuenta
                        </button>
                    </form>
                </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
