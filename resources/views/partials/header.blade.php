<meta name="viewport" content="width=device-width, initial-scale=1.0">

@php
use Illuminate\Support\Facades\Storage;
@endphp

<style>
/* ====== Estilos finales para panel bonito (como tu segunda imagen) ====== */

/* aseguramos que por defecto el dropdown original no esté visible */
.profile-bubble .dropdown-menu { display: none; }

/* ===========================
   ICONO (forzar apariencia)
   ===========================
   El problema que mostrabas venía de que los elementos <circle>/<path> del SVG
   no tenían stroke/fill definidos y el navegador pintaba relleno negro.
   Aquí forzamos stroke y fill correctos con alta especificidad para restaurar
   el icono morado y su hover amarillo.
*/
.navbar .profile-icon-btn { color: #6c5bd8; } /* ayuda si usamos currentColor */
.navbar .profile-icon-btn svg,
.navbar .profile-icon-btn svg * {
  stroke: #6c5bd8 !important;
  fill: none !important;
  stroke-width: 1.8 !important;
  transition: stroke .12s ease, transform .12s ease;
}
.navbar .profile-icon-btn:hover svg,
.navbar .profile-icon-btn:focus svg,
.navbar .profile-icon-btn:active svg {
  transform: translateY(-1px);
}
.navbar .profile-icon-btn:hover svg * {
  stroke: #F6B200 !important;
}

/* NAVBAR PROFILE ICON (size & layout) */
.navbar .profile-icon-btn {
  width: 56px;
  height: 56px;
  padding: 6px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 12px;
  background: transparent;
  border: 0;
  cursor: pointer;
  transition: transform .12s ease;
}
.navbar .profile-icon-btn svg { width: 28px; height: 28px; display:block; }

/* ===========================
   PANEL (portal) estilos
   =========================== */

/* cuando el menú es "portalizado" se le añade la clase .bubble-portal */
/* estilos del contenedor montado en body */
.dropdown-menu.bubble-portal {
  display: block; /* será controlado por el script */
  position: absolute;
  z-index: 999999;
  left: 0;
  top: 0;
  min-width: 260px;
  max-width: 340px;
  pointer-events: auto;
  will-change: top, left;
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}

/* tarjeta exterior lila */
.dropdown-menu.bubble-portal .bubble-card {
  background: #efe6ff; /* tono lila suave */
  border-radius: 14px;
  padding: 12px;
  box-shadow: 0 12px 30px rgba(16,24,40,0.08);
  overflow: visible;
  position: relative;
}

/* pequeña punta (rotated square) */
.dropdown-menu.bubble-portal .bubble-pointer {
  position: absolute;
  top: -9px;
  left: 24px; /* JS reajusta */
  width: 18px;
  height: 18px;
  background: #efe6ff;
  transform: rotate(45deg);
  border-radius: 2px;
  box-shadow: -1px -1px 0 rgba(0,0,0,0.02);
}

/* header: iniciales + texto */
.dropdown-menu.bubble-portal .bubble-header {
  display:flex;
  align-items:center;
  gap:12px;
  padding: 4px 6px 8px 6px;
}

/* pequeño badge de iniciales a la izquierda (FM) */
.dropdown-menu.bubble-portal .initials-badge {
  width:36px;
  height:36px;
  border-radius:50%;
  background: #f5ecff;
  color:#5b38d9;
  font-weight:700;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  flex:0 0 36px;
  font-size:13px;
  box-shadow: 0 2px 8px rgba(90,63,250,0.04);
  border: 2px solid rgba(255,255,255,0.85);
}

/* texto del usuario: nombre negrita, email pequeño */
.dropdown-menu.bubble-portal .user-text {
  display:flex;
  flex-direction:column;
  justify-content:center;
}
.dropdown-menu.bubble-portal .user-text .user-name {
  font-weight:800;
  color:#0b0b0b;
  font-size:14px;
  line-height:1.04;
  margin-bottom:2px;
}
.dropdown-menu.bubble-portal .user-text .user-email {
  font-size:12px;
  color:#6c757d;
}

/* inner white card: donde van los items */
.dropdown-menu.bubble-portal .bubble-inner {
  background: #fff;
  border-radius: 10px;
  margin-top:8px;
  overflow:hidden;
  border: 1px solid rgba(16,24,40,0.04);
  box-shadow: 0 2px 8px rgba(16,24,40,0.03);
}

/* lista de items */
.dropdown-menu.bubble-portal .menu-list { list-style:none; margin:0; padding:0; }
.dropdown-menu.bubble-portal .menu-item {
  display:flex;
  align-items:center;
  gap:12px;
  padding:12px 14px;
  color:#0b0b0b;
  text-decoration:none;
  font-size:14px;
  background: transparent;
  border-bottom: 1px solid rgba(16,24,40,0.04);
}
.dropdown-menu.bubble-portal .menu-item:last-child { border-bottom: none; }

/* iconos */
.dropdown-menu.bubble-portal .menu-item .icon {
  width:22px; height:22px; display:inline-flex; align-items:center; justify-content:center;
}
.dropdown-menu.bubble-portal .menu-item svg * {
  stroke: #6c5bd8;
  stroke-width: 1.6;
  fill: none;
  transition: stroke .12s ease;
}

/* hover */
.dropdown-menu.bubble-portal .menu-item:hover { background:#fbf8ff; text-decoration:none; }

/* danger (eliminar) */
.dropdown-menu.bubble-portal .menu-item.danger { color:#c92b2b; }
.dropdown-menu.bubble-portal .menu-item.danger svg * { stroke:#c92b2b; }

/* ajustes para cuando no se portaliza (por si no se mueve) */
.profile-bubble .bubble-card { display:block; }
.profile-bubble .bubble-header img.avatar { width:40px; height:40px; border-radius:50%; object-fit:cover; }

/* responsive */
@media (max-width:420px) {
  .dropdown-menu.bubble-portal { min-width:calc(100% - 24px); left:12px !important; right:12px !important; }
}
</style>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow-sm">
  <!-- sidebar toggle -->
  <button class="btn btn-link d-md-none rounded-circle me-3" data-bs-target="#sidebarMenu" type="button">
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
            '<rect rx="64" width="100%" height="100%" fill="#efe6ff"/>' .
            '<text x="50%" y="50%" dy="0.35em" font-family="Arial, Helvetica, sans-serif" text-anchor="middle" font-size="48" fill="#5b3dd9">'
            . ($initials ?: 'U') . '</text></svg>'
        );
      @endphp

      <!-- Toggle button -->
      <button class="nav-link profile-icon-btn" type="button" id="profileBubbleBtn" aria-expanded="false" aria-label="Abrir menú de usuario">
        <!-- SVG: forzamos stroke/fill en CSS; aquí dejamos shapes sin fill -->
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" role="img" width="30" height="30">
          <!-- aro exterior -->
          <circle cx="12" cy="12" r="10.25" stroke-linecap="round" stroke-linejoin="round" />
          <!-- cabeza -->
          <circle cx="12" cy="8.2" r="2.4" />
          <!-- torso -->
          <path d="M6.5 18c0-3.15 3.05-5.5 5.5-5.5s5.5 2.35 5.5 5.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </button>

      <!-- ORIGINAL dropdown content (kept) - our script will portal to body -->
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileBubbleBtn" role="menu">
        <div class="bubble-card">
          <div class="bubble-pointer" aria-hidden="true"></div>

          <div class="bubble-header">
            @if(!empty($avatarUrl))
              <img class="avatar" src="{{ $avatarUrl }}" alt="avatar" onerror="this.onerror=null;this.src='{{ $svgFallback }}';" style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid rgba(255,255,255,0.85);">
            @else
              <div class="initials-badge">
                {{ $initials ?: 'U' }}
              </div>
            @endif

            <div class="user-text">
              <div class="user-name">{{ $user->name ?? 'Usuario' }}</div>
              @if(!empty($user->email))
                <div class="user-email">{{ $user->email }}</div>
              @endif
            </div>
          </div>

          <div class="bubble-inner">
            <ul class="menu-list" role="menu" aria-labelledby="profileBubbleBtn">
              <li>
                <a href="{{ route('profile_combined.show') }}" class="menu-item" role="menuitem">
                  <span class="icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img">
                      <circle cx="12" cy="8" r="2.6" />
                      <path d="M6 20c0-3.3 2.9-6 6-6s6 2.7 6 6" />
                    </svg>
                  </span>
                  Tu perfil
                </a>
              </li>

              <li>
                <a href="{{ route('chats.index') ?? '#' }}" class="menu-item" role="menuitem">
                  <span class="icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img">
                      <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                    </svg>
                  </span>
                  Tus chats
                </a>
              </li>

              <li>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                  @csrf
                  <button type="submit" class="menu-item" role="menuitem" style="width:100%;text-align:left;background:transparent;border:0;">
                    <span class="icon" aria-hidden="true">
                      <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img">
                        <path d="M16 17l5-5-5-5" />
                        <path d="M21 12H9" />
                      </svg>
                    </span>
                    Cerrar sesión
                  </button>
                </form>
              </li>

              <li>
                <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('¿Seguro que quieres eliminar tu cuenta? Esta acción no se puede deshacer.');" style="margin:0;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="menu-item danger" role="menuitem" style="width:100%;text-align:left;background:transparent;border:0;">
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
              </li>
            </ul>
          </div>
        </div>
      </div>

    </li>
  </ul>
</nav>

<!-- Portal + posicionamiento + evento (forzado para que siempre funcione y mantenga apariencia) -->
<script>
(function(){
  var active = null;

  function openMenu(btn, menu) {
    if (!btn || !menu) return;
    if (active && active.menu !== menu) closeActive();

    var origParent = menu.parentNode;
    var nextSibling = menu.nextSibling;

    // save previous inline styles
    var prev = {
      display: menu.style.display || '',
      position: menu.style.position || '',
      top: menu.style.top || '',
      left: menu.style.left || '',
      zIndex: menu.style.zIndex || '',
      visibility: menu.style.visibility || '',
      transform: menu.style.transform || ''
    };

    // append to body
    document.body.appendChild(menu);
    menu.classList.add('bubble-portal'); // marker to apply styles

    // prepare for measurement
    menu.style.position = 'absolute';
    menu.style.visibility = 'hidden';
    menu.style.display = 'block';
    menu.style.zIndex = 999999;

    // measure
    var btnRect = btn.getBoundingClientRect();
    var menuRect = menu.getBoundingClientRect();

    // horizontally center under button
    var btnCenterX = btnRect.left + btnRect.width / 2;
    var left = btnCenterX - menuRect.width / 2;
    var pad = 8;
    if (left < pad) left = pad;
    var maxLeft = window.innerWidth - menuRect.width - pad;
    if (left > maxLeft) left = Math.max(maxLeft, pad);

    // vertical position: below button
    var top = btnRect.bottom + window.scrollY + 8;

    menu.style.left = left + 'px';
    menu.style.top = top + 'px';
    menu.style.visibility = 'visible';
    menu.classList.add('show');

    // pointer positioning
    var pointer = menu.querySelector('.bubble-pointer');
    if (pointer) {
      var menuRect2 = menu.getBoundingClientRect();
      var pointerHalf = pointer.offsetWidth / 2;
      var ptrLeft = (btnRect.left + btnRect.width/2) - menuRect2.left - pointerHalf;
      var minLeft = 10;
      var maxPtr = Math.max(menu.offsetWidth - pointer.offsetWidth - 10, minLeft);
      if (ptrLeft < minLeft) ptrLeft = minLeft;
      if (ptrLeft > maxPtr) ptrLeft = maxPtr;
      pointer.style.left = ptrLeft + 'px';
      pointer.style.right = 'auto';
    }

    active = { btn: btn, menu: menu, origParent: origParent, nextSibling: nextSibling, prev: prev };
    btn.setAttribute('aria-expanded', 'true');

    // add handlers to close
    setTimeout(function(){
      document.addEventListener('click', onDocClick);
      document.addEventListener('keydown', onKeyDown);
    }, 0);
  }

  function closeActive() {
    if (!active) return;
    var menu = active.menu;
    var btn = active.btn;

    menu.classList.remove('show');
    menu.classList.remove('bubble-portal');

    // restore inline styles
    menu.style.display = active.prev.display;
    menu.style.position = active.prev.position;
    menu.style.top = active.prev.top;
    menu.style.left = active.prev.left;
    menu.style.zIndex = active.prev.zIndex;
    menu.style.visibility = active.prev.visibility;
    menu.style.transform = active.prev.transform;

    // restore DOM position
    if (active.nextSibling && active.nextSibling.parentNode) {
      active.origParent.insertBefore(menu, active.nextSibling);
    } else {
      active.origParent.appendChild(menu);
    }

    if (btn) btn.setAttribute('aria-expanded', 'false');

    document.removeEventListener('click', onDocClick);
    document.removeEventListener('keydown', onKeyDown);
    active = null;
  }

  function onDocClick(e) {
    if (!active) return;
    if (active.btn.contains(e.target) || active.menu.contains(e.target)) return;
    closeActive();
  }

  function onKeyDown(e) {
    if (!active) return;
    if (e.key === 'Escape' || e.key === 'Esc') closeActive();
  }

  function toggleMenu(e) {
    var btn = e.currentTarget;
    var li = btn.closest('.profile-bubble');
    if (!li) return;
    var menu = li.querySelector('.dropdown-menu');
    if (!menu) return;
    if (active && active.menu === menu) closeActive(); else openMenu(btn, menu);
  }

  document.addEventListener('DOMContentLoaded', function(){
    var btn = document.getElementById('profileBubbleBtn');
    if (!btn) return;

    // prevent default on click anchors etc.
    btn.addEventListener('click', function(e){ e.preventDefault(); });

    btn.addEventListener('click', toggleMenu);

    // Reposition on resize: close and reopen quickly to recalc
    window.addEventListener('resize', function(){
      if (active) {
        var cur = active;
        var btnEl = cur.btn, menuEl = cur.menu;
        closeActive();
        setTimeout(function(){ openMenu(btnEl, menuEl); }, 80);
      }
    });

    // close on scroll to avoid floating in wrong place
    window.addEventListener('scroll', function(){
      if (active) closeActive();
    });
  });
})();
</script>

<!-- Si tu layout ya incluye bootstrap via Vite, puedes eliminar la siguiente línea. No es necesaria para que esto funcione. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>