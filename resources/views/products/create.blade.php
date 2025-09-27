@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Crear nuevo producto</h2>
    <div class="card p-4 shadow" style="border-radius: 16px; max-width: 700px; margin:auto;">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Cantidad</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Precio</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
            </div>
            <div class="mb-4">
                <label for="media_file" class="form-label">Foto</label>
                <input type="file" name="media_file" id="media_file" class="form-control" accept="image/*">
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary" style="background: #7766C6; border-color: #7766C6;">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection