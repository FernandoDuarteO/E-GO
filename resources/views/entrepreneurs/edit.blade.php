@extends('layouts.app')

@section('content')
<div class="edit-wrapper">
    <div class="edit-card mx-auto">
        <div class="edit-title">Editar Perfil de Emprendedor</div>
        @if($entrepreneur->media_file)
            <img src="{{ asset('storage/'.$entrepreneur->media_file) }}" alt="Foto de perfil" class="edit-avatar">
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($entrepreneur->name) }}&size=120" alt="Foto de perfil" class="edit-avatar">
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('entrepreneurs.update', $entrepreneur->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('entrepreneurs.form', ['entrepreneur' => $entrepreneur])
            <button type="submit" class="edit-btn">Guardar cambios</button>
        </form>
    </div>
</div>
@endsection
