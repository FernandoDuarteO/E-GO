@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Categorías</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Categoría
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body px-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->type }}</td>
                            <td>{{ Str::limit($category->description, 60) }}</td>
                            <td class="text-center">
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm mx-1" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm mx-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm mx-1" title="Eliminar" onclick="return confirm('¿Eliminar esta categoría?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No hay categorías registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
