@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="ego-card d-flex flex-row" style="max-width:820px; width:100%;">
            <div class="ego-side col-5 p-5">
                <img src="{{ asset('assets/images/E-GO_LOGO.png') }}" alt="E-GO logo" class="ego-logo">
                <div class="ego-subtitle">¡Emprende ahora!</div>
            </div>
            <div class="col-7 px-5 pt-4 pb-4 d-flex flex-column justify-content-center align-items-center">
                <h4 class="fw-bold mb-4 mt-3 text-center" style="letter-spacing:0.5px;">Datos del emprendimiento</h4>
                @if($errors->any())
                    <div class="alert alert-danger w-100 mb-4">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('register.entrepreneur.post') }}" class="w-100" style="max-width: 340px;">
                    @csrf
                    <div class="mb-3">
                        <label for="business_name" class="form-label mb-1">Nombre del emprendimiento</label>
                        <input id="business_name" type="text" class="form-control ego-form-input" name="business_name" value="{{ old('business_name') }}" required>
                    </div>
                    <div class="row mb-3 gx-g form-row-custom">
                        <div class="col-6">
                            <label for="department" class="form-label mb-1">Departamento</label>
                            <!-- Ahora es un input de texto sin texto dentro del input -->
                            <input id="department" type="text" class="form-control ego-form-input" name="department" value="{{ old('department') }}" required>
                        </div>
                        <div class="col-6">
                            <label for="years_experience" class="form-label mb-1">Años de trayectoria</label>
                            <input id="years_experience" type="number" class="form-control ego-form-input" name="years_experience" value="{{ old('years_experience') }}" required>
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
                    {{-- Campos ocultos para los datos del usuario --}}
                    <input type="hidden" name="name" value="{{ old('name', request('name')) }}">
                    <input type="hidden" name="email" value="{{ old('email', request('email')) }}">
                    <input type="hidden" name="password" value="{{ old('password', request('password')) }}">
                    <input type="hidden" name="password_confirmation" value="{{ old('password_confirmation', request('password_confirmation')) }}">
                    <button type="submit" class="btn ego-btn-main w-100 mb-1">Crear cuenta</button>
                    <a href="{{ route('register') }}" class="ego-btn-back w-100 mt-2 text-center">← Volver</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection