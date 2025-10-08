@extends('layouts.app')

@section('content')
<div class="profile-wrapper">
    <div class="profile-card mx-auto">
        <div class="text-center">
            @if($client->media_file)
                <img
                    src="{{ asset('storage/'.$client->media_file) }}"
                    alt="Foto de perfil"
                    class="profile-avatar"
                >
            @else
                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode($client->name) }}&size=180"
                    alt="Foto de perfil"
                    class="profile-avatar"
                >
            @endif

            <div class="profile-name">{{ $client->name }}</div>
            <div class="profile-nationality">{{ $client->nationality }}</div>

            <div class="profile-badges mb-3">
                <span class="badge bg-primary">{{ $client->sex }}</span>
                <span class="badge bg-secondary">{{ $client->age }} años</span>
            </div>
        </div>
        <hr>
        <ul class="list-group list-group-flush profile-info-list">
            <li class="list-group-item"><strong>Cédula:</strong> {{ $client->identification_card }}</li>
            <li class="list-group-item"><strong>Teléfono:</strong> {{ $client->telephone }}</li>
            <li class="list-group-item"><strong>Email:</strong> <a href="mailto:{{ $client->email }}">{{ $client->email }}</a></li>
            <li class="list-group-item"><strong>País:</strong> {{ $client->country }}</li>
            <li class="list-group-item"><strong>Municipio:</strong> {{ $client->municipality }}</li>
            <li class="list-group-item"><strong>Departamento:</strong> {{ $client->department }}</li>
        </ul>
        <div class="text-center">
            <a href="{{ route('clients.index') }}" class="profile-back-btn">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
@endsection
