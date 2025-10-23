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
                <h4 class="fw-bold mb-4">Datos del emprendimiento</h4>
                <form method="POST" action="{{ route('register.entrepreneur') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="business_name" class="form-label mb-1">Nombre del emprendimiento</label>
                        <input id="business_name" type="text" class="form-control ego-form-input" name="business_name" value="{{ old('business_name') }}" required>
                    </div>
                    <div class="row mb-3 gx-2 gy-2">
                        <div class="col-12 col-md-7">
                            <label for="department" class="form-label mb-1">Departamento</label>
                            <select id="department" class="form-control ego-form-input" name="department" required>
                                <option value="">Departamento</option>
                                <option value="Esteli" @if(old('department')=='Esteli') selected @endif>Esteli</option>
                                <option value="Managua" @if(old('department')=='Managua') selected @endif>Managua</option>
                                <!-- Agrega más departamentos aquí -->
                            </select>
                        </div>
                        <div class="col-12 col-md-5">
                            <label for="years_experience" class="form-label mb-1">Años de trayectoria</label>
                            <input id="years_experience" type="number" class="form-control ego-form-input" name="years_experience" value="{{ old('years_experience') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label mb-1">Descripción</label>
                        <textarea id="description" class="form-control ego-form-input" name="description" required>{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="business_type" class="form-label mb-1">Tipo de emprendimiento</label>
                        <input id="business_type" type="text" class="form-control ego-form-input" name="business_type" value="{{ old('business_type') }}" required>
                    </div>
                    <button type="submit" class="btn ego-btn-main w-100">Crear cuenta</button>
                    <a href="{{ route('register') }}" class="btn btn-link w-100 mt-2">Atrás</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
