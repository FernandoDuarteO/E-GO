@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/modules/ventas.css') }}">

<div class="container-fluid py-4">
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1><i class="fas fa-shopping-cart me-2"></i>Ventas</h1>
                <p class="lead mb-0">Sistema de gestión de ventas</p>
            </div>
            <a href="{{ route('ventas.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus-circle me-2"></i>Nueva Venta
            </a>
        </div>
    </div>

    <div class="content-section">
        <!-- Estadísticas -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="stat-card">
                    <div class="stat-value">$12,500</div>
                    <div class="stat-label">Ventas Totales</div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stat-card">
                    <div class="stat-value">45</div>
                    <div class="stat-label">Ventas Hoy</div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stat-card">
                    <div class="stat-value">$275</div>
                    <div class="stat-label">Promedio por Venta</div>
                </div>
            </div>
        </div>

        <!-- Historial de Ventas -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-history me-2"></i>Historial de Ventas</h3>
                <div class="d-flex gap-2">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="Buscar venta..." id="searchSales">
                    </div>
                    <a href="{{ route('ventas.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>Nueva Venta
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID Venta</th>
                                <th>Cliente</th>
                                <th>Producto</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="salesTableBody">
                            <tr>
                                <td>#001</td>
                                <td>Juan Pérez</td>
                                <td>Laptop Dell XPS 13</td>
                                <td>$1,250.00</td>
                                <td>2024-01-15</td>
                                <td><span class="status-completed">Completada</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary btn-action" data-bs-toggle="tooltip" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning btn-action" data-bs-toggle="tooltip" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger btn-action" data-bs-toggle="tooltip" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#002</td>
                                <td>María García</td>
                                <td>iPhone 14 Pro</td>
                                <td>$999.00</td>
                                <td>2024-01-14</td>
                                <td><span class="status-completed">Completada</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary btn-action" data-bs-toggle="tooltip" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning btn-action" data-bs-toggle="tooltip" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger btn-action" data-bs-toggle="tooltip" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#003</td>
                                <td>Carlos López</td>
                                <td>Samsung Galaxy S23</td>
                                <td>$849.99</td>
                                <td>2024-01-13</td>
                                <td><span class="status-pending">Pendiente</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary btn-action" data-bs-toggle="tooltip" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning btn-action" data-bs-toggle="tooltip" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger btn-action" data-bs-toggle="tooltip" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#004</td>
                                <td>Ana Rodríguez</td>
                                <td>MacBook Pro 16"</td>
                                <td>$2,399.00</td>
                                <td>2024-01-12</td>
                                <td><span class="status-cancelled">Cancelada</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary btn-action" data-bs-toggle="tooltip" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning btn-action" data-bs-toggle="tooltip" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger btn-action" data-bs-toggle="tooltip" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Ejemplo de ventas para simulación
    const salesData = [
        { id: '#001', customer: 'Juan Pérez', product: 'Laptop Dell XPS 13', total: 1250.00, date: '2024-01-15', status: 'completed' },
        { id: '#002', customer: 'María García', product: 'iPhone 14 Pro', total: 999.00, date: '2024-01-14', status: 'completed' },
        { id: '#003', customer: 'Carlos López', product: 'Samsung Galaxy S23', total: 849.99, date: '2024-01-13', status: 'pending' },
        { id: '#004', customer: 'Ana Rodríguez', product: 'MacBook Pro 16"', total: 2399.00, date: '2024-01-12', status: 'cancelled' }
    ];

    // Inicializar tooltips de Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Búsqueda en tiempo real
        document.getElementById('searchSales').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const tableBody = document.getElementById('salesTableBody');
            const rows = tableBody.getElementsByTagName('tr');
            
            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;
                
                for (let j = 0; j < cells.length - 1; j++) { // Excluir la columna de acciones
                    const cellText = cells[j].textContent.toLowerCase();
                    if (cellText.includes(searchTerm)) {
                        found = true;
                        break;
                    }
                }
                
                row.style.display = found ? '' : 'none';
            }
        });
    }, false);
</script>
@endsection