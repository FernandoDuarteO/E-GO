@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="ego-card d-flex flex-row" style="max-width:800px; width:100%;">
            <!-- Lado izquierdo: imagen/logo -->
            <div class="ego-side col-5 p-5">
                <img src="{{ asset('assets/images/E-GO_LOGO.png') }}" alt="Logo" style="width:120px;">
                <div class="ego-subtitle">¡Emprende ahora!</div>
            </div>
            <!-- Lado derecho: formulario -->
            <div class="col-7 px-5 py-4 d-flex flex-column justify-content-center">
                <h4 class="fw-bold mb-3">Datos del emprendimiento</h4>
                <form method="POST" action="{{ route('register.entrepreneur') }}">
                    @csrf
                    <input type="text" class="form-control ego-form-input mb-2" name="business_name" placeholder="Nombre del emprendimiento" value="{{ old('business_name') }}" required>
                    <div class="row">
                        <div class="col">
                            <select class="form-control ego-form-input mb-2" name="department" required>
                                <option value="">Departamento</option>
                                <option value="Amazonas">Amazonas</option>
                                <option value="Áncash">Áncash</option>
                                <!-- Agrega más departamentos aquí -->
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control ego-form-input mb-2" name="years_experience" placeholder="Años de trayectoria" value="{{ old('years_experience') }}">
                        </div>
                    </div>
                    <textarea class="form-control ego-form-input mb-2" name="description" placeholder="Descripción" required>{{ old('description') }}</textarea>
                    <input type="text" class="form-control ego-form-input mb-3" name="business_type" placeholder="Tipo de emprendimiento" value="{{ old('business_type') }}" required>
                    <button type="submit" class="btn ego-btn-main w-100">Crear cuenta</button>
                    <a href="{{ route('register') }}" class="btn btn-link w-100 mt-2">Atrás</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
