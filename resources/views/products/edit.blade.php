@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Editar producto</h2>
    <div class="card p-4 shadow" style="border-radius: 16px;">
        <div class="row align-items-center">
            <!-- Imagen actual a la izquierda -->
            <div class="col-md-5 text-center mb-4 mb-md-0">
                @if($products->media_file)
                    <img src="{{ asset('storage/' . $products->media_file) }}"
                         alt="Foto actual"
                         style="width: 100%; max-width: 260px; aspect-ratio: 1/1; object-fit: cover; border-radius: 16px; box-shadow: 0 4px 24px rgba(80,80,150,0.10);">
                @else
                    <img src="https://via.placeholder.com/260?text=Sin+Imagen"
                         alt="Sin foto"
                         style="width: 100%; max-width: 260px; aspect-ratio: 1/1; object-fit: cover; border-radius: 16px;">
                @endif
            </div>
            <!-- Formulario de edición a la derecha -->
            <div class="col-md-7">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $products->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Cantidad</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $products->quantity) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $products->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $products->price) }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="media_file" class="form-label">Nueva foto </label>
                        <input type="file" name="media_file" id="media_file" class="form-control" accept="image/*">
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection