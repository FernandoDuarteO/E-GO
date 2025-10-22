@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="ego-card d-flex flex-row" style="max-width: 900px; width: 100%;">
            <!-- Lado izquierdo: imagen/logo -->
            <div class="ego-side col-5 p-5">
                <img src="{{ asset('assets/images/E-GO_LOGO.png') }}" alt="Logo" style="width:120px;">
                <div class="ego-title mb-2">E-GO</div>
                <div class="ego-subtitle">¡Emprende ahora!</div>
            </div>
            <!-- Lado derecho: formulario -->
            <div class="col-7 px-5 py-4 d-flex flex-column justify-content-center">
                <div class="text-center mb-1">
                    <h3 class="fw-bold mb-0">Inicio de sesión</h3>
                    <div class="mb-3" style="font-size: 0.95rem;">
                        ¿No tienes una cuenta?
                        <a href="{{ route('register') }}" class="ego-form-link">Crear cuenta</a>
                    </div>
                </div>
                <div class="ego-btn-group mb-2">
                    <button type="button" class="ego-btn-radio active" data-role="client">Cliente</button>
                    <button type="button" class="ego-btn-radio" data-role="entrepreneur">Emprendedor</button>
                </div>
                @if(session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Input oculto para el rol -->
                    <input type="hidden" name="role" id="role-input" value="client">

                    <input type="email" class="form-control ego-form-input" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus autocomplete="username">
                    <input type="password" class="form-control ego-form-input" name="password" placeholder="Contraseña" required autocomplete="current-password">

                    <div class="d-flex justify-content-end mb-2">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="ego-form-link" style="font-size: 0.96em;">¿Recuperar contraseña?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn ego-btn-main w-100">Ingresar</button>
                    <a href="{{ route('auth.redirect') }}" class="btn ego-btn-facebook w-100 mb-2" id="fb-login-btn">
                        <i class="bi bi-facebook me-2"></i> Iniciar sesión con Facebook
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Cambia el valor del input oculto al seleccionar Cliente/Emprendedor
    document.querySelectorAll('.ego-btn-radio').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.ego-btn-radio').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('role-input').value = this.getAttribute('data-role');
        });
    });

    // Cambia el href del botón de Facebook antes de redirigir
    document.getElementById('fb-login-btn').addEventListener('click', function(e) {
        e.preventDefault();
        var role = document.getElementById('role-input').value;
        window.location.href = "{{ route('auth.redirect') }}" + "?role=" + role;
    });
</script>
@endsection
