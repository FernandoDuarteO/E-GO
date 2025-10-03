@extends('layouts.app')

@section('content')
<style>

</style>
<div class="create-wrapper">
    <div class="create-card mx-auto">
        <div class="create-title">Crear Perfil de Emprendedor</div>
        @if ($errors->any())
            <div class="alert alert-danger mb-4 text-start">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('entrepreneurs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('entrepreneurs.form', ['entrepreneur' => null])
            <button type="submit" class="create-btn">Crear Perfil</button>
        </form>
    </div>
</div>
@endsection
