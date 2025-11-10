@php
use Illuminate\Support\Facades\Storage;
$user = Auth::user();
@endphp

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
/* Compact, entrepreneur-like bubble + shared navbar styles */

/* Search */
.search-container .form-control {
  border-radius: 999px;
  padding-left: 1rem;
  padding-right: 1rem;
  box-shadow: 0 6px 20px rgba(99,102,241,0.06);
  max-width: 640px;
}

/* Navbar base */
.navbar.topbar { background: #fff; }

/* Logo */
.navbar .brand-logo {
  height: 56px;
  width: auto;
  object-fit: contain;
  display: block;
}

/* Cart button */
.navbar .cart-btn {
  width: 54px;
  height: 54px;
  padding: 6px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 12px;
  background: transparent;
  border: 0;
  cursor: pointer;
  transition: transform .12s ease;
  position: relative;
}
.navbar .cart-btn svg,
.navbar .cart-btn svg * { stroke: #6c5bd8 !important; fill: none !important; stroke-width: 1.6; }
.navbar .cart-btn svg { width:22px; height:22px; display:block; }
.navbar .cart-btn:hover svg,
.navbar .cart-btn:hover svg * { stroke: #F6B200 !important; }

.cart-badge {
  position:absolute;
  top:6px;
  right:6px;
  min-width:20px;
  height:20px;
  padding:0 6px;
  background:#f6b200;
  color:#111;
  font-weight:700;
  font-size:12px;
  border-radius:999px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  box-shadow:0 6px 18px rgba(31,33,64,0.12);
}

/* profile icon */
.navbar .profile-icon-btn {
  width: 64px;
  height: 64px;
  padding: 8px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 12px;
  background: transparent;
  border: 0;
  cursor: pointer;
  transition: transform .12s ease;
}
.navbar .profile-icon-btn svg { width: 30px; height: 30px; display:block; }
.navbar .profile-icon-btn svg * { stroke: #6c5bd8; stroke-width: 1.8; fill: none; transition: stroke .12s ease; }
.navbar .profile-icon-btn:hover svg * { stroke: #F6B200; }

/* compact profile bubble (match entrepreneur proportions) */
.profile-bubble { position: relative; }
.profile-bubble .dropdown-menu {
  background: transparent;
  border: none;
  padding: 0;
  min-width: 220px;    /* compact width */
  right: 8px;
  z-index: 4000;
  margin-top: 6px;
  display: none;
}
.profile-bubble .dropdown-menu.show { display: block; }

/* outer card */
.profile-bubble .bubble-card {
  background: #efe8ff;
  border-radius: 12px;
  overflow: visible;
  padding-bottom: 4px;
  box-shadow: 0 10px 24px rgba(16,24,40,0.08);
  position: relative;
}

/* pointer */
.profile-bubble .bubble-pointer {
  position: absolute;
  top: -10px;
  left: 18px;
  width: 14px;
  height: 14px;
  background: #efe8ff;
  transform: rotate(45deg);
  border-top-left-radius: 2px;
  z-index: 2;
  box-shadow: -1px -1px 0 rgba(0,0,0,0.02);
}

/* header */
.profile-bubble .bubble-header {
  display:flex;
  align-items:center;
  gap:10px;
  padding:8px 10px;
  border-top-left-radius:12px;
  border-top-right-radius:12px;
}
.profile-bubble .bubble-header img.avatar { width:40px; height:40px; object-fit:cover; border-radius:50%; border:2px solid rgba(0,0,0,0.06); display:block; }
.profile-bubble .user-name { font-weight:700; font-size:13px; color:#0b0b0b; line-height:1.05; }
.profile-bubble .user-email { font-size:11px; color:#6c757d; margin-top:2px; }

/* inner menu */
.profile-bubble .bubble-inner { background:#fff; margin:8px; border-radius:8px; overflow:hidden; border: 1px solid rgba(0,0,0,0.03); }
.profile-bubble .menu-list .list-item { display:flex; align-items:center; gap:12px; padding:10px 12px; font-size:14px; color:#0b0b0b; text-decoration:none; }
.profile-bubble .menu-list .list-item + .list-item { border-top: 1px solid rgba(0,0,0,0.04); }

/* nicer icons using Font Awesome */
.profile-bubble .menu-list .list-item .icon { width:28px; height:28px; display:inline-flex; align-items:center; justify-content:center; flex:0 0 28px; }
.profile-bubble .menu-list .list-item .icon i { font-size:18px; color: #6c5bd8; display:inline-block; width:22px; text-align:center; }

/* danger */
.profile-bubble .menu-list .list-item.danger { color:#c92b2b; }
.profile-bubble .menu-list .list-item.danger .icon i { color:#c92b2b; }

.profile-bubble .menu-list .list-item:hover { background:#fbf8ff; text-decoration:none; }
.profile-bubble .menu-list .list-item:focus { outline:none; background:#f8f7ff; }

@media (max-width:576px) {
  .profile-bubble .dropdown-menu { min-width:200px; right:0; }
}
</style>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow-sm w-100" style="left:0;">
  <div class="container-fluid">
    <!-- LOGO -->
    <div style="display:flex;align-items:center;gap:12px;">
      <img src="{{ asset('assets/images/E-GO_LOGO.png') }}" alt="E-GO Logo" class="brand-logo" />
    </div>

    <!-- Search (center) -->
    <form class="d-none d-sm-inline-block form-inline ms-auto me-0 my-2 my-md-0 search-container">
      <div class="input-group" style="max-width:640px;">
        <input type="text" class="form-control border-0 small rounded-pill px-4" placeholder="Search..." aria-label="Search">
      </div>
    </form>

    <!-- Right: cart + profile -->
    <ul class="navbar-nav ms-auto align-items-center">

      <!-- Cart -->
      <li class="nav-item me-2">
        <a href="{{ route('cart.index') }}" class="nav-link cart-btn" aria-label="Ver carrito" title="Carrito">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" role="img">
            <circle cx="9" cy="21" r="1.5"></circle>
            <circle cx="20" cy="21" r="1.5"></circle>
            <path d="M1 1h3l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            <path d="M6 6h15"></path>
          </svg>

          @php $cartCount = count(session('cart', [])); @endphp
          @if($cartCount > 0)
            <span class="cart-badge" id="cartBadge">{{ $cartCount }}</span>
          @endif
        </a>
      </li>

      <!-- Profile bubble -->
      <li class="nav-item dropdown profile-bubble">
        @php
          $initials = 'U';
          if ($user && !empty($user->name)) {
              $parts = preg_split('/\s+/', trim($user->name));
              $initials = count($parts) >= 2 ? mb_strtoupper(mb_substr($parts[0],0,1) . mb_substr($parts[1],0,1)) : mb_strtoupper(mb_substr($parts[0],0,1));
          }
          $avatarUrl = null;
          if ($user && !empty($user->media_file ?? null)) {
              $media = $user->media_file;
              if (preg_match('/^https?:\\/\\//i', $media)) { $avatarUrl = $media; }
              else {
                  try { $maybe = Storage::url($media); if ($maybe) $avatarUrl = $maybe; } catch (\Throwable $_) {}
                  if (empty($avatarUrl) && strpos($media,'public/')===0) {
                      try { $avatarUrl = Storage::url(preg_replace('/^public\\//','',$media)); } catch (\Throwable $_) {}
                  }
                  if (empty($avatarUrl)) $avatarUrl = asset('storage/' . ltrim($media, '/'));
                  if (empty($avatarUrl)) $avatarUrl = asset($media);
              }
              if (!empty($avatarUrl) && !preg_match('/[?&]t=\\d+$/', $avatarUrl)) {
                  $avatarUrl .= (strpos($avatarUrl,'?')===false ? '?' : '&') . 't=' . time();
              }
          }
          $svgFallback = 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="128" height="128"><rect rx="64" width="100%" height="100%" fill="#efe8ff"/><text x="50%" y="50%" dy="0.35em" font-family="Arial, Helvetica, sans-serif" text-anchor="middle" font-size="48" fill="#5b3dd9">'.$initials.'</text></svg>');
        @endphp

        <button type="button"
                class="nav-link profile-icon-btn dropdown-toggle"
                id="clientProfileBtn"
                aria-haspopup="true"
                aria-expanded="false"
                aria-label="Abrir menú de usuario"
                onclick="window.__toggleClientProfile && window.__toggleClientProfile(event, this)">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" role="img">
            <circle cx="12" cy="12" r="10.25" stroke-linecap="round" stroke-linejoin="round" />
            <circle cx="12" cy="8.2" r="2.4" />
            <path d="M6.5 18c0-3.15 3.05-5.5 5.5-5.5s5.5 2.35 5.5 5.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="clientProfileBtn" role="menu">
          <div class="bubble-card">
            <div class="bubble-pointer" aria-hidden="true"></div>

            <div class="bubble-header">
              @if(!empty($avatarUrl))
                <img class="avatar" src="{{ $avatarUrl }}" alt="avatar" onerror="this.onerror=null;this.src='{{ $svgFallback }}';">
              @else
                <div class="avatar" style="width:40px;height:40px;border-radius:50%;background:#efe8ff;display:inline-flex;align-items:center;justify-content:center;font-weight:700;color:#5b3dd9;">
                  {{ $initials ?: 'U' }}
                </div>
              @endif

              <div>
                <div class="user-name">{{ $user->name ?? 'Usuario' }}</div>
                @if(!empty($user->email))
                  <div class="user-email">{{ $user->email }}</div>
                @endif
              </div>
            </div>

            <div class="bubble-inner">
              <div class="menu-list list-group list-group-flush">

                <!-- Perfil: clients index -->
                <a href="{{ route('clients.index') }}" class="list-item list-group-item" role="menuitem">
                  <span class="icon" aria-hidden="true"><i class="fas fa-user"></i></span>
                  Tu perfil
                </a>

                <!-- Inicio (reemplaza pedidos/chats/carrito) -->
                <a href="{{ route('clients.products') }}" class="list-item list-group-item" role="menuitem">
                  <span class="icon" aria-hidden="true"><i class="fas fa-home"></i></span>
                  Inicio
                </a>

                <div class="divider"></div>

                <!-- Cerrar sesión -->
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                  @csrf
                  <button type="submit" class="list-item list-group-item" style="background:transparent;border:0;" role="menuitem">
                    <span class="icon" aria-hidden="true"><i class="fas fa-sign-out-alt"></i></span>
                    Cerrar sesión
                  </button>
                </form>

                <!-- Eliminar cuenta -->
                <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('¿Seguro que quieres eliminar tu cuenta? Esta acción no se puede deshacer.');" style="margin:0;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="list-item list-group list-item danger" style="background:transparent;border:0;" role="menuitem">
                    <span class="icon" aria-hidden="true"><i class="fas fa-trash-alt"></i></span>
                    Eliminar cuenta
                  </button>
                </form>

              </div>
            </div>
          </div>
        </div>
      </li>

    </ul>
  </div>
</nav>

<!-- JS: forceable toggle + pointer positioning + keyboard/overlay handling -->
<script>
(function(){
  window.__toggleClientProfile = function(evt, btn) {
    try {
      if (typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
        const inst = bootstrap.Dropdown.getOrCreateInstance(btn);
        inst.toggle();
        return;
      }
    } catch (e) {
      console.warn('bootstrap toggle failed, using manual fallback', e);
    }

    const li = btn.closest('.profile-bubble');
    if (!li) return;
    const menu = li.querySelector('.dropdown-menu');
    if (!menu) return;

    const isOpen = menu.classList.contains('show');
    if (isOpen) { closeMenu(menu, btn); }
    else {
      document.querySelectorAll('.profile-bubble .dropdown-menu.show').forEach(function(m){
        const t = m.closest('.profile-bubble')?.querySelector('.profile-icon-btn');
        if (t) closeMenu(m, t);
      });
      openMenu(menu, btn);
    }
  };

  function openMenu(menu, btn) {
    menu.classList.add('show');
    menu.style.display = 'block';
    btn.setAttribute('aria-expanded', 'true');
    menu.style.zIndex = 4000;
    setTimeout(function(){ positionBubblePointer(btn.id || 'clientProfileBtn'); }, 30);
    const first = menu.querySelector('[role="menuitem"], a, button, input');
    if (first) first.focus();
  }

  function closeMenu(menu, btn) {
    menu.classList.remove('show');
    menu.style.display = '';
    btn.setAttribute('aria-expanded', 'false');
  }

  function positionBubblePointer(toggleId) {
    var btn = document.getElementById(toggleId);
    if (!btn) return;
    var parent = btn.closest('.profile-bubble');
    if (!parent) return;
    var pointer = parent.querySelector('.bubble-pointer');
    var menu = parent.querySelector('.dropdown-menu');
    if (!pointer || !menu) return;

    var btnRect = btn.getBoundingClientRect();
    var menuRect = menu.getBoundingClientRect();
    var btnCenterX = btnRect.left + btnRect.width / 2;
    var pointerHalf = pointer.offsetWidth / 2;
    var left = btnCenterX - menuRect.left - pointerHalf;
    var minLeft = 8;
    var maxLeft = Math.max((menu.offsetWidth - pointer.offsetWidth - 8), minLeft);
    if (left < minLeft) left = minLeft;
    if (left > maxLeft) left = maxLeft;
    pointer.style.left = left + 'px';
    pointer.style.right = 'auto';
  }

  document.addEventListener('click', function(e){
    document.querySelectorAll('.profile-bubble .dropdown-menu.show').forEach(function(menu){
      const li = menu.closest('.profile-bubble');
      if (!li) return;
      if (!li.contains(e.target)) {
        const btn = li.querySelector('.profile-icon-btn');
        if (btn) closeMenu(menu, btn);
      }
    });
  }, true);

  document.addEventListener('keydown', function(e){
    if (e.key === 'Escape') {
      document.querySelectorAll('.profile-bubble .dropdown-menu.show').forEach(function(menu){
        const li = menu.closest('.profile-bubble');
        if (!li) return;
        const btn = li.querySelector('.profile-icon-btn');
        if (btn) closeMenu(menu, btn);
      });
    }
  });

  document.addEventListener('shown.bs.dropdown', function(e){ setTimeout(function(){ positionBubblePointer(e.target.id || 'clientProfileBtn'); }, 30); });
  window.addEventListener('resize', function(){ const open = document.querySelector('.profile-bubble .dropdown-menu.show'); if (open) positionBubblePointer('clientProfileBtn'); });
})();
</script>