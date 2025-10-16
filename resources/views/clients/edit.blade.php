@extends('layouts.clients')

@section('content')
<div class="edit-wrapper">
    <div class="edit-card mx-auto">
        <div class="edit-title">Editar Perfil de Cliente</div>
        @if($client->media_file)
            <img src="{{ asset('storage/'.$client->media_file) }}" alt="Foto de perfil" class="edit-avatar">
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($client->name) }}&size=120" alt="Foto de perfil" class="edit-avatar">
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('clients.form', ['client' => $client])

            <div style="display: flex; gap: 16px; justify-content: center; margin-top: 24px;">
                <a href="{{ route('clients.index') }}" class="edit-btn">Volver</a>
                <button type="submit" class="edit-btn">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection
