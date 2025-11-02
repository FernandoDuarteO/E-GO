<meta name="viewport" content="width=device-width, initial-scale=1.0">

@php
use Illuminate\Support\Facades\Storage;
@endphp

<style>
/* ====== Igual diseño aprobado, con icono más grande y pointer posicionado por JS ====== */

/* SEARCH */
.search-container .form-control {
  border-radius: 999px;
  padding-left: 1rem;
  padding-right: 1rem;
  box-shadow: 0 6px 20px rgba(99,102,241,0.06);
}

/* NAVBAR PROFILE ICON: aumentado */
.navbar .profile-icon-btn {
  width: 64px;               /* antes 48 -> ahora 64 */
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
.navbar .profile-icon-btn svg { width: 36px; height: 36px; display:block; }

/* trazos morado por defecto */
.navbar .profile-icon-btn svg * {
  stroke: #6c5bd8;
  stroke-width: 1.9;
  fill: none;
  transition: stroke .12s ease;
}

/* hover: SOLO stroke pasa a amarillo (sin fondo) */
.navbar .profile-icon-btn:hover,
.navbar .profile-icon-btn:focus {
  transform: translateY(-1px);
  background: transparent !important;
  box-shadow: none !important;
}
.navbar .profile-icon-btn:hover svg * {
  stroke: #F6B200;
}

/* PROFILE BUBBLE */
.profile-bubble { position: relative; }
.profile-bubble .dropdown-menu {
  background: transparent;
  border: none;
  padding: 0;
  min-width: 240px;
  right: 8px;
}

/* outer card (purple background) */
.profile-bubble .bubble-card {
  background: #efe8ff;
  border-radius: 14px;
  overflow: visible;
  padding-bottom: 6px;
  box-shadow: 0 12px 30px rgba(16,24,40,0.08);
  position: relative;
}

/* pointer: left será fijado por JS para centrar exactamente */
.profile-bubble .bubble-pointer {
  position: absolute;
  top: -12px;
  left: 20px; /* valor inicial; JS sobreescribe */
  width: 18px;
  height: 18px;
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
  padding:10px 12px 12px 12px;
  border-top-left-radius:14px;
  border-top-right-radius:14px;
}

/* avatar */
.profile-bubble .bubble-header img.avatar {
  width:42px;
  height:42px;
  object-fit:cover;
  border-radius:50%;
  border:2px solid rgba(0,0,0,0.06);
  display:block;
}

/* user text */
.profile-bubble .user-name { font-weight:700; font-size:14px; color:#0b0b0b; line-height:1.05; }
.profile-bubble .user-email { font-size:11px; color:#6c757d; margin-top:2px; }

/* inner white card */
.profile-bubble .bubble-inner {
  background:#fff;
  margin:10px;
  border-radius:10px;
  overflow:hidden;
  border: 1px solid rgba(0,0,0,0.03);
}

/* menu list compact */
.profile-bubble .menu-list .list-item {
  display:flex;
  align-items:center;
  gap:12px;
  padding:10px 14px;
  font-size:14px;
  color:#0b0b0b;
  text-decoration:none;
}
.profile-bubble .menu-list .list-item .icon {
  width:22px;
  height:22px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  flex:0 0 22px;
}

/* icon stroke */
.profile-bubble .menu-list .list-item svg * {
  stroke: #6c5bd8;
  stroke-width: 1.6;
  fill: none;
  transition: stroke .12s ease, fill .12s ease;
}

/* hover on menu item -> light purple bg */
.profile-bubble .menu-list .list-item:hover {
  background:#fbf8ff;
  text-decoration:none;
}

/* divider */
.profile-bubble .bubble-inner .divider {
  height:1px;
  background: rgba(108,117,125,0.12);
  margin:6px 0;
}

/* danger item */
.profile-bubble .menu-list .list-item.danger { color:#c92b2b; }
.profile-bubble .menu-list .list-item.danger svg * { stroke: #c92b2b; }

/* responsive: smaller widths */
@media (max-width:576px) {
  .profile-bubble .dropdown-menu { min-width:200px; right:0; }
}
</style>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow-sm">
  <!-- sidebar toggle -->
  <button class="btn btn-link d-md-none rounded-circle me-3" data-bs-target="#sidebarMenu">
    <i class="fas fa-bars"></i>
  </button>

  <!-- search -->
  <form class="d-none d-sm-inline-block form-inline ms-auto me-0 my-2 my-md-0 search-container">
    <div class="input-group" style="max-width:640px;">
      <input type="text" class="form-control border-0 small rounded-pill px-4" placeholder="Search..." aria-label="Search">
    </div>
  </form>

  <!-- right: profile icon + bubble -->
  <ul class="navbar-nav ms-auto align-items-center">
    <li class="nav-item dropdown profile-bubble">
      @php
        $user = Auth::user();

        // obtener entrepreneur relacionado
        $entrepreneur = null;
        if ($user) {
            if (method_exists($user, 'entrepreneur')) {
                try { $entrepreneur = $user->entrepreneur; } catch (\Throwable $_) { $entrepreneur = null; }
            }
            if (!$entrepreneur) {
                try { $entrepreneur = \App\Models\Entrepreneur::where('user_id', $user->id)->first(); } catch (\Throwable $_) { $entrepreneur = null; }
            }
        }

        // iniciales fallback
        $initials = 'U';
        if ($user && !empty($user->name)) {
            $parts = preg_split('/\s+/', trim($user->name));
            $initials = count($parts) >= 2 ? mb_strtoupper(mb_substr($parts[0],0,1) . mb_substr($parts[1],0,1)) : mb_strtoupper(mb_substr($parts[0],0,1));
        }

        // resolver avatarUrl desde entrepreneur->media_file
        $avatarUrl = null;
        if ($entrepreneur && !empty($entrepreneur->media_file)) {
            $media = $entrepreneur->media_file;
            if (preg_match('/^https?:\\/\\//i', $media)) {
                $avatarUrl = $media;
            } else {
                try { $maybe = Storage::url($media); if ($maybe) $avatarUrl = $maybe; } catch (\Throwable $_) {}
                if (empty($avatarUrl) && strpos($media,'public/')===0) {
                    $m2 = preg_replace('/^public\\//','',$media);
                    try { $avatarUrl = Storage::url($m2); } catch (\Throwable $_) {}
                }
                if (empty($avatarUrl)) $avatarUrl = asset('storage/' . ltrim($media, '/'));
                if (empty($avatarUrl)) $avatarUrl = asset($media);
            }
            if (!empty($avatarUrl) && !preg_match('/[?&]t=\\d+$/', $avatarUrl)) {
                $avatarUrl .= (strpos($avatarUrl,'?')===false ? '?' : '&') . 't=' . time();
            }
        }

        // svg fallback (data-uri) con iniciales
        $svgFallback = 'data:image/svg+xml;utf8,' . rawurlencode(
            '<svg xmlns="http://www.w3.org/2000/svg" width="128" height="128">' .
            '<rect rx="64" width="100%" height="100%" fill="#efe8ff"/>' .
            '<text x="50%" y="50%" dy="0.35em" font-family="Arial, Helvetica, sans-serif" text-anchor="middle" font-size="48" fill="#5b3dd9">'
            . ($initials ?: 'U') . '</text></svg>'
        );
      @endphp

      <!-- NAVBAR ICON (más grande) -->
      <a class="nav-link profile-icon-btn" href="#" id="profileBubbleBtn" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <!-- icono persona simple y limpio -->
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" role="img">
          <circle cx="12" cy="8" r="2.8" />
          <path d="M4 20c0-3.866 3.582-7 8-7s8 3.134 8 7" />
        </svg>
      </a>

      <!-- DROPDOWN: burbuja -->
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileBubbleBtn">
        <div class="bubble-card">
          <div class="bubble-pointer" aria-hidden="true"></div>

          <div class="bubble-header">
            @if(!empty($avatarUrl))
              <img class="avatar" src="{{ $avatarUrl }}" alt="avatar" onerror="this.onerror=null;this.src='{{ $svgFallback }}';">
            @else
              <div class="avatar" style="width:42px;height:42px;border-radius:50%;background:#efe8ff;display:inline-flex;align-items:center;justify-content:center;font-weight:700;color:#5b3dd9;">
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

              <!-- Perfil -->
              <a href="{{ route('profile_combined.show') }}" class="list-item list-group-item">
                <span class="icon" aria-hidden="true">
                  <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img">
                    <circle cx="12" cy="8" r="2.6" />
                    <path d="M6 20c0-3.3 2.9-6 6-6s6 2.7 6 6" />
                  </svg>
                </span>
                Tu perfil
              </a>

              <!-- Tus chats -->
              <a href="{{ route('chats.index') ?? '#' }}" class="list-item list-group-item">
                <span class="icon" aria-hidden="true">
                  <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                  </svg>
                </span>
                Tus chats
              </a>

              <div class="divider"></div>

              <!-- Cerrar sesión -->
              <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="list-item list-group-item" style="background:transparent;border:0;">
                  <span class="icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img">
                      <path d="M16 17l5-5-5-5" />
                      <path d="M21 12H9" />
                    </svg>
                  </span>
                  Cerrar sesión
                </button>
              </form>

              <!-- Eliminar cuenta -->
              <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('¿Seguro que quieres eliminar tu cuenta? Esta acción no se puede deshacer.');" style="margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="list-item list-group-item danger" style="background:transparent;border:0;">
                  <span class="icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img">
                      <path d="M3 6h18" stroke="#c92b2b" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M8 6v14a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V6" stroke="#c92b2b" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M10 11v6M14 11v6" stroke="#c92b2b" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </span>
                  Eliminar cuenta
                </button>
              </form>

            </div>
          </div>
        </div>
      </div>

    </li>
  </ul>
</nav>

<!-- Script: posiciona la punta (bubble-pointer) centrada bajo el icono cuando se muestra el dropdown -->
<script>
  (function() {
    function positionBubblePointer(dropdownToggleId = 'profileBubbleBtn') {
      var btn = document.getElementById(dropdownToggleId);
      if (!btn) return;
      var parent = btn.closest('.profile-bubble');
      if (!parent) return;
      var pointer = parent.querySelector('.bubble-pointer');
      var menu = parent.querySelector('.dropdown-menu');
      if (!pointer || !menu) return;

      // Force reading layout after popper; use getBoundingClientRect
      var btnRect = btn.getBoundingClientRect();
      var menuRect = menu.getBoundingClientRect();

      // center X of button (visible center)
      var btnCenterX = btnRect.left + btnRect.width / 2;

      // pointer half width
      var pointerHalf = pointer.offsetWidth / 2;

      // compute desired left relative to menu's left
      var left = btnCenterX - menuRect.left - pointerHalf;

      // If menu uses transform by Popper, menuRect.left will account for it.
      // Clamp pointer inside menu with small padding
      var minLeft = 10;
      var maxLeft = Math.max( (menu.offsetWidth - pointer.offsetWidth - 10), minLeft );

      if (left < minLeft) left = minLeft;
      if (left > maxLeft) left = maxLeft;

      // Apply left in px, clear right to avoid conflicts
      pointer.style.left = left + 'px';
      pointer.style.right = 'auto';
      // Optional vertical tweak if needed:
      // pointer.style.top = '-12px';
    }

    // reposition when dropdown is shown (Bootstrap event)
    document.addEventListener('shown.bs.dropdown', function(e) {
      // only handle our profile bubble
      var parent = e.target && e.target.closest && e.target.closest('.profile-bubble') ? e.target.closest('.profile-bubble') : null;
      if (!parent) return;
      // delay slightly to ensure popper finished layout
      setTimeout(function() {
        positionBubblePointer(e.target.id || 'profileBubbleBtn');
      }, 60); // increased timeout to 60ms to be robust
    });

    // reposition on window resize if open
    window.addEventListener('resize', function() {
      var openDropdown = document.querySelector('.profile-bubble .dropdown-menu.show');
      if (openDropdown) {
        positionBubblePointer('profileBubbleBtn');
      }
    });

    // If dropdown is open on load, position pointer
    document.addEventListener('DOMContentLoaded', function() {
      var openDropdown = document.querySelector('.profile-bubble .dropdown-menu.show');
      if (openDropdown) {
        setTimeout(function(){ positionBubblePointer('profileBubbleBtn'); }, 60);
      }
    });
  })();
</script>

<!-- Bootstrap JS (omit if already included in your layout) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>