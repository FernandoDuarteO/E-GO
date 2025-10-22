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
                    <h3 class="fw-bold mb-0">Crear cuenta</h3>
                    <div class="mb-3" style="font-size: 0.95rem;">
                        ¿Ya tienes una cuenta?
                        <a href="{{ route('login') }}" class="ego-form-link">Inicia sesión</a>
                    </div>
                </div>
                <div class="ego-btn-group mb-2">
                    <button type="button" class="ego-btn-radio active">Cliente</button>
                    <button type="button" class="ego-btn-radio">Emprendedor</button>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <input type="text" class="form-control ego-form-input" name="name" placeholder="Nombre completo" value="{{ old('name') }}" required autofocus>
                    <input type="email" class="form-control ego-form-input" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
                    <input type="password" class="form-control ego-form-input" name="password" placeholder="Contraseña" required>
                    <input type="password" class="form-control ego-form-input" name="password_confirmation" placeholder="Confirmar contraseña" required>

                    <button type="submit" class="btn ego-btn-main w-100">Registrarme</button>
                    <a href="{{ route('auth.redirect') }}" class="btn ego-btn-facebook w-100 mb-2">
                        <i class="bi bi-facebook me-2"></i> Registrarme con Facebook
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
