@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1>Productos</h1>
</div>

<div class="content-section">
    <div class="card">
        <div class="card-header">
            <h3>Lista de Productos</h3>
            <button class="btn-primary">Nuevo Producto</button>
        </div>
        <div class="card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Producto Ejemplo</td>
                        <td>$100</td>
                        <td>50</td>
                        <td>
                            <button class="btn-edit">Editar</button>
                            <button class="btn-delete">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
