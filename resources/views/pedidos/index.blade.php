@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/modules/pedidos.css') }}">
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="mb-0">
                    <i class="bi bi-clipboard-data me-2"></i>Panel de Pedidos
                </h1>
                <p class="mb-0 mt-2 opacity-75">Gestión y seguimiento de todos los pedidos del sistema</p>
            </div>
            <div class="col-md-6 text-md-end">
                <button class="btn btn-light me-2">
                    <i class="bi bi-download me-1"></i> Exportar
                </button>
                <button class="btn btn-light">
                    <i class="bi bi-plus-circle me-1"></i> Nuevo Pedido
                </button>
            </div>
        </div>
    </div>
</div>

<div class="content-section">
    <div class="container">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-value text-primary">24</div>
                    <div class="stats-label">Pedidos Pendientes</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-value text-info">18</div>
                    <div class="stats-label">En Proceso</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-value text-success">156</div>
                    <div class="stats-label">Completados</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-value text-warning">$5,240</div>
                    <div class="stats-label">Ingresos del Mes</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-md-flex justify-content-between align-items-center">
                <h3 class="mb-2 mb-md-0">
                    <i class="bi bi-list-ul me-2"></i>Lista de Pedidos
                </h3>
                <div class="d-flex flex-column flex-md-row gap-2">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" class="form-control" placeholder="Buscar pedidos...">
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-filter me-1"></i> Filtrar
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Más recientes</a></li>
                            <li><a class="dropdown-item" href="#">Más antiguos</a></li>
                            <li><a class="dropdown-item" href="#">Mayor valor</a></li>
                            <li><a class="dropdown-item" href="#">Menor valor</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Order Filters -->
                <div class="order-filters mb-4">
                    <button class="btn btn-outline-primary active" data-filter="all">Todos</button>
                    <button class="btn btn-outline-warning" data-filter="pending">Pendientes</button>
                    <button class="btn btn-outline-info" data-filter="processing">En Proceso</button>
                    <button class="btn btn-outline-success" data-filter="completed">Completados</button>
                    <button class="btn btn-outline-danger" data-filter="cancelled">Cancelados</button>
                </div>

                <!-- Orders Table -->
                <div class="table-responsive">
                    <table class="table data-table table-hover">
                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Cliente</th>
                                <th>Productos</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-status="pending">
                                <td data-label="ID Pedido">#P001</td>
                                <td data-label="Cliente">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Cliente Ejemplo</div>
                                            <small class="text-muted">cliente@ejemplo.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Productos">
                                    <span class="badge bg-light text-dark">3 productos</span>
                                    <button class="btn btn-sm btn-outline-secondary ms-1 view-products" data-bs-toggle="tooltip" title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                                <td data-label="Total">$300.00</td>
                                <td data-label="Fecha">15/05/2023</td>
                                <td data-label="Estado">
                                    <span class="status-badge status-pending">Pendiente</span>
                                </td>
                                <td data-label="Acciones" class="action-buttons text-center">
                                    <button class="btn btn-sm btn-primary process-order" data-bs-toggle="tooltip" title="Procesar pedido">
                                        <i class="bi bi-play-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary view-details" data-bs-toggle="tooltip" title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger cancel-order" data-bs-toggle="tooltip" title="Cancelar pedido">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr data-status="processing">
                                <td data-label="ID Pedido">#P002</td>
                                <td data-label="Cliente">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">María González</div>
                                            <small class="text-muted">maria@empresa.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Productos">
                                    <span class="badge bg-light text-dark">5 productos</span>
                                    <button class="btn btn-sm btn-outline-secondary ms-1 view-products" data-bs-toggle="tooltip" title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                                <td data-label="Total">$450.50</td>
                                <td data-label="Fecha">14/05/2023</td>
                                <td data-label="Estado">
                                    <span class="status-badge status-processing">En Proceso</span>
                                </td>
                                <td data-label="Acciones" class="action-buttons text-center">
                                    <button class="btn btn-sm btn-success complete-order" data-bs-toggle="tooltip" title="Completar pedido">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary view-details" data-bs-toggle="tooltip" title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger cancel-order" data-bs-toggle="tooltip" title="Cancelar pedido">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr data-status="completed">
                                <td data-label="ID Pedido">#P003</td>
                                <td data-label="Cliente">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Carlos Rodríguez</div>
                                            <small class="text-muted">carlos@tienda.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Productos">
                                    <span class="badge bg-light text-dark">2 productos</span>
                                    <button class="btn btn-sm btn-outline-secondary ms-1 view-products" data-bs-toggle="tooltip" title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                                <td data-label="Total">$120.75</td>
                                <td data-label="Fecha">13/05/2023</td>
                                <td data-label="Estado">
                                    <span class="status-badge status-completed">Completado</span>
                                </td>
                                <td data-label="Acciones" class="action-buttons text-center">
                                    <button class="btn btn-sm btn-outline-secondary view-details" data-bs-toggle="tooltip" title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary reopen-order" data-bs-toggle="tooltip" title="Reabrir pedido">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal para detalles del pedido -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del Pedido #P001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Información del Cliente</h6>
                        <p><strong>Nombre:</strong> Cliente Ejemplo<br>
                        <strong>Email:</strong> cliente@ejemplo.com<br>
                        <strong>Teléfono:</strong> +1 234 567 8900</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Información del Pedido</h6>
                        <p><strong>Fecha:</strong> 15/05/2023<br>
                        <strong>Total:</strong> $300.00<br>
                        <strong>Estado:</strong> <span class="status-badge status-pending">Pendiente</span></p>
                    </div>
                </div>

                <h6 class="mt-4">Productos</h6>
                <div class="order-details">
                    <div class="product-item">
                        <div>
                            <strong>Producto A</strong><br>
                            <small class="text-muted">Cantidad: 1</small>
                        </div>
                        <div>$100.00</div>
                    </div>
                    <div class="product-item">
                        <div>
                            <strong>Producto B</strong><br>
                            <small class="text-muted">Cantidad: 2</small>
                        </div>
                        <div>$200.00</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Imprimir</button>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2c3e50;
        --success-color: #2ecc71;
        --warning-color: #f39c12;
        --danger-color: #e74c3c;
        --light-gray: #f8f9fa;
    }

    .page-header {
        background: linear-gradient(135deg, #977AFF, #5A4999);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 1.5rem;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .card-header {
        background-color: white;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1.25rem 1.5rem;
        border-radius: 10px 10px 0 0 !important;
    }

    .order-filters .btn {
        border-radius: 20px;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        transition: all 0.3s;
    }

    .order-filters .btn.active {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
    }

    .table-responsive {
        border-radius: 0 0 10px 10px;
        overflow: hidden;
    }

    .data-table {
        width: 100%;
        margin-bottom: 0;
    }

    .data-table thead th {
        background-color: var(--secondary-color);
        color: white;
        border: none;
        padding: 1rem;
        font-weight: 600;
    }

    .data-table tbody tr {
        transition: background-color 0.2s;
    }

    .data-table tbody tr:hover {
        background-color: rgba(52, 152, 219, 0.05);
    }

    .data-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-color: rgba(0,0,0,0.05);
    }

    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .status-pending {
        background-color: rgba(243, 156, 18, 0.15);
        color: var(--warning-color);
    }

    .status-processing {
        background-color: rgba(52, 152, 219, 0.15);
        color: var(--primary-color);
    }

    .status-completed {
        background-color: rgba(46, 204, 113, 0.15);
        color: var(--success-color);
    }

    .status-cancelled {
        background-color: rgba(231, 76, 60, 0.15);
        color: var(--danger-color);
    }

    .action-buttons .btn {
        border-radius: 6px;
        margin-right: 0.25rem;
        transition: all 0.2s;
    }

    .stats-card {
        text-align: center;
        padding: 1.5rem;
    }

    .stats-card .stats-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stats-card .stats-label {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .search-box {
        position: relative;
    }

    .search-box .form-control {
        padding-left: 2.5rem;
        border-radius: 20px;
    }

    .search-box .bi-search {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }

    .order-details {
        background-color: var(--light-gray);
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 1rem;
    }

    .product-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .product-item:last-child {
        border-bottom: none;
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 1.75rem;
        }

        .data-table thead {
            display: none;
        }

        .data-table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }

        .data-table tbody td {
            display: block;
            text-align: right;
            padding: 0.75rem;
            border: none;
        }

        .data-table tbody td::before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
        }

        .action-buttons {
            text-align: center !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar tooltips de Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Filtrado de pedidos
        const filterButtons = document.querySelectorAll('.order-filters .btn');
        const orderRows = document.querySelectorAll('.data-table tbody tr');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remover clase active de todos los botones
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Agregar clase active al botón clickeado
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                orderRows.forEach(row => {
                    if (filter === 'all') {
                        row.style.display = '';
                    } else {
                        if (row.getAttribute('data-status') === filter) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            });
        });

        // Modal para detalles del pedido
        const viewDetailsButtons = document.querySelectorAll('.view-details');
        const orderDetailsModal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));

        viewDetailsButtons.forEach(button => {
            button.addEventListener('click', function() {
                orderDetailsModal.show();
            });
        });

        // Simulación de acciones
        document.querySelectorAll('.process-order').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('¿Estás seguro de que quieres procesar este pedido?')) {
                    alert('Pedido procesado correctamente');
                }
            });
        });

        document.querySelectorAll('.complete-order').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('¿Marcar este pedido como completado?')) {
                    alert('Pedido completado correctamente');
                }
            });
        });

        document.querySelectorAll('.cancel-order').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('¿Estás seguro de que quieres cancelar este pedido?')) {
                    alert('Pedido cancelado correctamente');
                }
            });
        });

        document.querySelectorAll('.view-products').forEach(button => {
            button.addEventListener('click', function() {
                alert('Aquí se mostrarían los detalles de los productos del pedido');
            });
        });
    });
</script>
@endsection
