@extends('layouts.app')

@section('content')
<div class="profile-wrapper">
    <div class="profile-card mx-auto">
        <div class="text-center">
            @if($entrepreneur->media_file)
                <img
                    src="{{ asset('storage/'.$entrepreneur->media_file) }}"
                    alt="Foto de perfil"
                    class="profile-avatar"
                >
            @else
                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode($entrepreneur->name) }}&size=180"
                    alt="Foto de perfil"
                    class="profile-avatar"
                >
            @endif

            <div class="profile-name">{{ $entrepreneur->name }}</div>
            <div class="profile-nationality">{{ $entrepreneur->nationality }}</div>

            <div class="profile-badges mb-3">
                <span class="badge bg-primary">{{ $entrepreneur->sex }}</span>
                <span class="badge bg-secondary">{{ $entrepreneur->age }} años</span>
            </div>
        </div>
        <hr>
        <ul class="list-group list-group-flush profile-info-list">
            <li class="list-group-item"><strong>Cédula:</strong> {{ $entrepreneur->identification_card }}</li>
            <li class="list-group-item"><strong>Teléfono:</strong> {{ $entrepreneur->telephone }}</li>
            <li class="list-group-item"><strong>Email:</strong> <a href="mailto:{{ $entrepreneur->email }}">{{ $entrepreneur->email }}</a></li>
            <li class="list-group-item"><strong>País:</strong> {{ $entrepreneur->country }}</li>
            <li class="list-group-item"><strong>Municipio:</strong> {{ $entrepreneur->municipality }}</li>
            <li class="list-group-item"><strong>Departamento:</strong> {{ $entrepreneur->department }}</li>
        </ul>
        <div class="text-center">
            <a href="{{ route('entrepreneurs.index') }}" class="profile-back-btn">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
@endsection
