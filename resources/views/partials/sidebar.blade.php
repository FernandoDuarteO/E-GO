<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Adminmart</h2>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <h3>Dashboard</h3>
            <ul>
                <li class="{{ Request::is('productos') ? 'active' : '' }}">
                    <a href="{{ route('productos.index') }}">
                        <span>📦</span> Productos
                    </a>
                </li>
                <li class="{{ Request::is('chat') ? 'active' : '' }}">
                    <a href="{{ route('chat.index') }}">
                        <span>💬</span> Chat
                    </a>
                </li>
                <li class="{{ Request::is('ventas') ? 'active' : '' }}">
                    <a href="{{ route('ventas.index') }}">
                        <span>💰</span> Ventas
                    </a>
                </li>
                <li class="{{ Request::is('pedidos') ? 'active' : '' }}">
                    <a href="{{ route('pedidos.index') }}">
                        <span>📋</span> Pedidos
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
