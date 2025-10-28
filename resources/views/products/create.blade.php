@extends('layouts.app')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Crear nuevo producto</h2>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Pase explícito de variables al partial: products es null en create --}}
                @include('products.form', [
                    'btnText' => 'Guardar',
                    'products' => null,
                    'categories' => $categories ?? []
                ])
            </form>
        </div>
    </div>
</div>
@endsection