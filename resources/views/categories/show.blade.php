@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Detalle de Categoría</h2>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $categories->type }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Descripción</h6>
                    <p class="card-text">{{ $categories->description ?? 'Sin descripción' }}</p>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary px-4">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
