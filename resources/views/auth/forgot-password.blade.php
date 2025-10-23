@extends('layouts.guest')

@section('content')
<style>
/* Estilos locales para el formulario de recuperar contraseña */
.forgot-backdrop {
  position: fixed;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1050; /* sobre todo */
  pointer-events: none; /* fondo interactuable por detrás si quieres */
}
.forgot-card {
  pointer-events: auto;
  width: 92%;
  max-width: 920px;
  border-radius: 18px;
  overflow: hidden;
  display: flex;
  box-shadow: 0 8px 30px rgba(18, 18, 32, 0.32);
  background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(250,250,252,0.98));
  backdrop-filter: blur(6px);
}

/* columna izquierda (logo) */
.forgot-left {
  flex: 1 1 40%;
  min-height: 320px;
  background: linear-gradient(135deg, #e6ddff 0%, #cdb6ff 100%);
  color: #2b2143;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 36px;
  text-align: center;
}

/* columna derecha (form) */
.forgot-right {
  flex: 1 1 60%;
  padding: 34px 40px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

/* Logo */
.forgot-logo {
  width: 110px;
  height: auto;
  margin-bottom: 12px;
}

/* Títulos y texto */
.forgot-title {
  font-size: 1.6rem;
  font-weight: 700;
  margin-bottom: 6px;
  color: #221a3a;
}
.forgot-sub {
  color: #3a3350;
  opacity: .85;
  font-size: 0.95rem;
  margin-bottom: 20px;
}

/* Form elements */
.forgot-form label {
  display: block;
  font-size: 0.95rem;
  color: #444;
  margin-bottom: 6px;
}
.forgot-form input[type="email"] {
  width: 100%;
  padding: 12px 14px;
  border-radius: 10px;
  border: 1px solid rgba(34,34,34,0.12);
  background: #fff;
  box-shadow: inset 0 1px 0 rgba(255,255,255,0.6);
  font-size: 0.95rem;
  outline: none;
  transition: box-shadow .12s ease, border-color .12s ease;
}
.forgot-form input[type="email"]:focus {
  border-color: rgba(119,86,255,0.95);
  box-shadow: 0 6px 20px rgba(119,86,255,0.08);
}

/* Botón principal */
.forgot-btn {
  margin-top: 18px;
  padding: 10px 16px;
  border-radius: 12px;
  background: linear-gradient(90deg,#6b4cff,#9f7bff);
  color: #fff;
  font-weight: 600;
  border: none;
  cursor: pointer;
  transition: transform .06s ease, box-shadow .08s ease;
  box-shadow: 0 6px 20px rgba(107,76,255,0.18);
}
.forgot-btn:active { transform: translateY(1px); }
.forgot-btn:disabled {
  opacity: .6;
  cursor: not-allowed;
  box-shadow: none;
}

/* Link pequeño */
.forgot-link {
  margin-top: 12px;
  font-size: 0.92rem;
  color: #6b4cff;
  text-decoration: none;
}

/* Mensajes de estado/errors */
.alert-status {
  margin-bottom: 12px;
  padding: 10px 12px;
  border-radius: 8px;
  background: #f3f7ff;
  color: #2a2a4a;
  border: 1px solid rgba(107,76,255,0.08);
  font-size: 0.95rem;
}

/* Responsive */
@media (max-width: 820px) {
  .forgot-card { flex-direction: column; border-radius: 14px; }
  .forgot-left { padding: 28px; min-height: 140px; }
  .forgot-right { padding: 20px; }
  .forgot-title { font-size: 1.3rem; }
}
</style>

<div class="forgot-backdrop" role="dialog" aria-labelledby="forgot-title" aria-modal="true">
  <div class="forgot-card" role="document">
    <div class="forgot-left" aria-hidden="true">
      <img src="{{ asset('assets/images/E-GO_LOGO.png') }}" alt="E-GO" class="forgot-logo">
      <div style="font-weight:700;font-size:1.1rem;margin-top:8px">E‑GO</div>
      <div style="margin-top:10px;color:rgba(34,34,34,0.85)">¡Emprende ahora!</div>
    </div>

    <div class="forgot-right">
      <h2 id="forgot-title" class="forgot-title">¿Olvidaste tu contraseña?</h2>
      <p class="forgot-sub">No hay problema. Indícanos tu correo y te enviaremos un enlace para restablecerla.</p>

      <!-- Estado de sesión -->
      @if (session('status'))
        <div class="alert-status" role="status">{{ session('status') }}</div>
      @endif

      <!-- Errores -->
      @if ($errors->any())
        <div class="alert-status" style="background:#fff0f0;color:#6d1b1b;border-color:rgba(255,80,80,0.06)">
          <ul style="margin:0;padding-left:18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="forgot-form" method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        <div>
          <label for="email">Correo electrónico</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>

        <button type="submit" class="forgot-btn">Enviar enlace de restablecimiento</button>

        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:12px;">
          <a href="{{ route('login') }}" class="forgot-link">Volver a iniciar sesión</a>
          <a href="{{ route('register') }}" class="forgot-link">Crear cuenta</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection