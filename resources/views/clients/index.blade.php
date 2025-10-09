@extends('layouts.app')

@section('content')

<div class="minimal-profile-wrapper">
    <div class="minimal-profile-card mx-auto">
        @if($client)
            @if($client->media_file)
                <img src="{{ asset('storage/'.$client->media_file) }}" alt="Foto de perfil" class="minimal-profile-avatar">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($client->name) }}&size=160" alt="Foto de perfil" class="minimal-profile-avatar">
            @endif
            <div class="profile-badges mb-3">
                <span class="badge bg-primary" style="font-size:1.07rem; letter-spacing:1px;">Cliente</span>
            </div>
            <div class="minimal-profile-name">{{ $client->name }}</div>
            <div class="minimal-profile-email">{{ $client->email }}</div>
            <div class="minimal-profile-actions mb-3">
                <a href="{{ route('clients.show', $client->id) }}" class="btn">
                    <i class="bi bi-person-badge"></i> Ver perfil completo
                </a>
                <a href="{{ route('clients.edit', $client->id) }}" class="btn">
                    <i class="bi bi-pencil-square"></i> Editar perfil
                </a>
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar el perfil?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">
                        <i class="bi bi-trash"></i> Eliminar perfil
                    </button>
                </form>
            </div>
        @else
            <div class="minimal-profile-name">Todavía no tienes perfil</div>
            <div class="minimal-profile-actions">
                <a href="{{ route('clients.create') }}" class="btn btn-success" style="border-radius: 18px; font-size: 1.18rem; padding: 15px 38px;">
                    <i class="bi bi-person-plus"></i> Crear perfil de cliente
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
