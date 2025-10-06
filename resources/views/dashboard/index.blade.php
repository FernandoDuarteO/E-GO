@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="mb-4">
    <h2 class="fw-bold">Hola!, {{ Auth::user()->name ?? 'Usuario' }}</h2>
    <p class="text-muted">Dashboard</p>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <!-- Total Sales -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm h-100 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted text-uppercase small mb-2">Ventas Totales</h6>
                    <h4 class="fw-bold mb-0">$2346</h4>
                    <small class="text-muted">Sales</small>
                </div>
                <div class="icon-circle bg-primary text-white">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Direct Sales -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm h-100 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted text-uppercase small mb-2">Direct Sales</h6>
                    <h4 class="fw-bold mb-0">$2346</h4>
                    <small class="text-muted">Increased by 5%</small>
                </div>
                <div class="icon-circle bg-success text-white">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Net Income -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm h-100 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted text-uppercase small mb-2">Net Income</h6>
                    <h4 class="fw-bold mb-0">$18,230</h4>
                    <small class="text-muted">Last 30 days</small>
                </div>
                <div class="icon-circle bg-info text-white">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Customers -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm h-100 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted text-uppercase small mb-2">Customers</h6>
                    <h4 class="fw-bold mb-0">1,248</h4>
                    <small class="text-muted">Active users</small>
                </div>
                <div class="icon-circle bg-warning text-white">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <!-- Net Income Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold text-muted mb-3">Net Income</h6>
                <canvas id="netIncomeChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Earning by Location -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold text-muted mb-3">Earning by Location</h6>
                <canvas id="locationChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold text-muted mb-3">Quick Actions</h6>
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('ventas.index') }}" class="btn btn-outline-success btn-lg w-100 py-3">
                            <i class="fas fa-chart-line fa-2x mb-2"></i><br>Ventas
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('pedidos.index') }}" class="btn btn-outline-info btn-lg w-100 py-3">
                            <i class="fas fa-clipboard-list fa-2x mb-2"></i><br>Pedidos
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('chats.index') }}" class="btn btn-outline-warning btn-lg w-100 py-3">
                            <i class="fas fa-comments fa-2x mb-2"></i><br>Chat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
