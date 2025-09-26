@extends('layouts.app')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 text-gray-800">Good Morning Jason!</h1>
                <p class="text-muted">Dashboard</p>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <!-- Total Sales -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Ventas totales
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$2346</div>
                        <div class="text-muted small">Sales</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Direct Sales -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Direct Sales
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$2346</div>
                        <div class="text-muted small">Increased by 5%</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Net Income -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Net Income
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$18,230</div>
                        <div class="text-muted small">Last 30 days</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-wallet fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customers -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Customers
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">1,248</div>
                        <div class="text-muted small">Active users</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <!-- Net Income Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Net Income</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <!-- Simple Chart Placeholder -->
                    <div class="text-center py-5">
                        <div class="d-flex justify-content-between align-items-end mb-3" style="height: 200px;">
                            <div class="bar" style="height: 80%; background: #4e73df; width: 12%;"></div>
                            <div class="bar" style="height: 65%; background: #4e73df; width: 12%;"></div>
                            <div class="bar" style="height: 90%; background: #4e73df; width: 12%;"></div>
                            <div class="bar" style="height: 75%; background: #4e73df; width: 12%;"></div>
                            <div class="bar" style="height: 60%; background: #4e73df; width: 12%;"></div>
                            <div class="bar" style="height: 95%; background: #4e73df; width: 12%;"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Jan</span>
                            <span class="text-muted small">Feb</span>
                            <span class="text-muted small">Mar</span>
                            <span class="text-muted small">Apr</span>
                            <span class="text-muted small">May</span>
                            <span class="text-muted small">Jun</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earning by Location -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earning by Location</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie">
                    <!-- Simple Pie Chart Placeholder -->
                    <div class="text-center">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="position-relative" style="width: 120px; height: 120px;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 rounded-circle"
                                     style="background: conic-gradient(#4e73df 0% 40%, #1cc88a 40% 70%, #36b9cc 70% 100%);"></div>
                            </div>
                        </div>
                        <div class="mt-4 small">
                            <span class="me-3"><i class="fas fa-circle text-primary"></i> India 40%</span>
                            <span class="me-3"><i class="fas fa-circle text-success"></i> UK 30%</span>
                            <span><i class="fas fa-circle text-info"></i> USA 30%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('productos.index') }}" class="btn btn-outline-primary btn-lg w-100 py-3">
                            <i class="fas fa-box fa-2x mb-2"></i><br>
                            Productos
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('ventas.index') }}" class="btn btn-outline-success btn-lg w-100 py-3">
                            <i class="fas fa-chart-line fa-2x mb-2"></i><br>
                            Ventas
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('pedidos.index') }}" class="btn btn-outline-info btn-lg w-100 py-3">
                            <i class="fas fa-clipboard-list fa-2x mb-2"></i><br>
                            Pedidos
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('chat.index') }}" class="btn btn-outline-warning btn-lg w-100 py-3">
                            <i class="fas fa-comments fa-2x mb-2"></i><br>
                            Chat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
