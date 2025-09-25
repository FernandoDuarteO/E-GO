@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1>Pedidos</h1>
</div>

<div class="content-section">
    <div class="card">
        <div class="card-header">
            <h3>Lista de Pedidos</h3>
        </div>
        <div class="card-body">
            <div class="order-filters">
                <button class="filter-btn active">Todos</button>
                <button class="filter-btn">Pendientes</button>
                <button class="filter-btn">En Proceso</button>
                <button class="filter-btn">Completados</button>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente</th>
                        <th>Productos</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#P001</td>
                        <td>Cliente Ejemplo</td>
                        <td>3 productos</td>
                        <td>$300</td>
                        <td><span class="status-pending">Pendiente</span></td>
                        <td>
                            <button class="btn-edit">Procesar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
