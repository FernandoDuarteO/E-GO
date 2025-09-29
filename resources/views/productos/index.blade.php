@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Productos</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Producto
    </a>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('assets/images/producto 2.webp') }}" class="card-img-top" alt="Producto">
            <div class="card-body">
                <h5 class="card-title mb-1">Aretes</h5>
                <p class="mb-1 fw-bold">C$50.00</p>
                <span class="badge bg-danger">Agotado</span>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('productos.edit', 1) }}" class="btn btn-sm btn-outline-warning">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{ route('productos.show', 1) }}" class="btn btn-sm btn-outline-info">
                    <i class="fas fa-eye"></i>
                </a>
                <button class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
