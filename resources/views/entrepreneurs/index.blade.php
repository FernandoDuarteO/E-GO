@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-4">Emprendedores</h1>
        <a href="{{ route('entrepreneurs.create') }}" class="btn btn-primary mb-3">Agregar Emprendedor</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Contacto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entrepreneurs as $entrepreneur)
                    <tr>
                        <td>{{ $entrepreneur->name }}</td>
                        <td>{{ $entrepreneur->description }}</td>
                        <td>{{ $entrepreneur->contact }}</td>
                        <td>
                            <a href="{{ route('entrepreneurs.edit', $entrepreneur->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('entrepreneurs.destroy', $entrepreneur->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este emprendedor?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $entrepreneurs->links() }}
    </div>
@endsection
