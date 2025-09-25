@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1>Ventas</h1>
</div>

<div class="content-section">
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-value">$12,500</div>
            <div class="stat-label">Ventas Totales</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">45</div>
            <div class="stat-label">Ventas Hoy</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">$275</div>
            <div class="stat-label">Promedio por Venta</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Historial de Ventas</h3>
        </div>
        <div class="card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#001</td>
                        <td>Cliente Ejemplo</td>
                        <td>$500</td>
                        <td>2024-01-15</td>
                        <td><span class="status-completed">Completada</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
