@extends('layouts.app')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container py-5">
    <h2 class="fw-bold mb-4">Editar producto</h2>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <form action="{{ route('products.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Incluimos el partial del formulario actualizado.
                     Le pasamos $products (el producto a editar) y $categories para el select. --}}
                @include('products.form', [
                    'products' => $products,
                    'categories' => $categories ?? [],
                    'btnText' => 'Actualizar'
                ])
            </form>
        </div>
    </div>
</div>
@endsection