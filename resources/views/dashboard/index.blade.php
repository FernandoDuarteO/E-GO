@extends('layouts.app')

@section('content')
  <!-- NOTA: Si ya incluyes Bootstrap y Font Awesome en tu layout, elimina estas líneas aquí -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

  <main class="content p-3">
    <div class="container-fluid">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="mb-0">Panel de control</h2>
        <small class="text-muted">Resumen mensual</small>
      </div>

      <!-- Cards de estadísticas -->
      <div class="row g-2 mb-3">
        <div class="col-12 col-md-4">
          <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center py-2">
              <div class="me-2 icon-wrap">
                <i class="fa-solid fa-cart-shopping fa-lg"></i>
              </div>
              <div class="flex-fill">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="card-subtitle">Total de ventas</h6>
                    <h3 id="totalSales" class="stat-value">0</h3>
                  </div>
                  <div class="text-end text-success small">
                    <i class="fa-solid fa-arrow-up"></i> 12% <div class="muted">vs mes pasado</div>
                  </div>
                </div>
                <div class="mt-2">
                  <canvas id="sparkSales" height="28"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center py-2">
              <div class="me-2 icon-wrap">
                <i class="fa-solid fa-boxes-stacked fa-lg"></i>
              </div>
              <div class="flex-fill">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="card-subtitle">Productos en stock</h6>
                    <h3 id="totalStock" class="stat-value">0</h3>
                  </div>
                  <div class="text-end text-warning small">
                    <i class="fa-solid fa-warehouse"></i> Gestión
                  </div>
                </div>
                <div class="mt-2">
                  <canvas id="sparkStock" height="28"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center py-2">
              <div class="me-2 icon-wrap">
                <i class="fa-solid fa-dollar-sign fa-lg"></i>
              </div>
              <div class="flex-fill">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h6 class="card-subtitle">Total de ganancias</h6>
                    <h3 id="totalEarnings" class="stat-value">0</h3>
                  </div>
                  <div class="text-end text-info small">
                    <i class="fa-solid fa-chart-line"></i> Tendencia
                  </div>
                </div>
                <div class="mt-2">
                  <canvas id="sparkEarnings" height="28"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- /row stats -->

      <!-- Row: Gráficas y productos más vendidos -->
      <div class="row g-2">
        <div class="col-12 col-lg-8">
          <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center py-2">
              <h6 class="mb-0">Ventas y ganancias por mes</h6>
              <div class="btn-group btn-group-sm" role="group" aria-label="periodo">
                <button class="btn btn-outline-secondary active" data-range="6">Últimos 6</button>
                <button class="btn btn-outline-secondary" data-range="12">Últimos 12</button>
              </div>
            </div>
            <div class="card-body p-3">
              <canvas id="monthlyChart" height="90"></canvas>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-4">
          <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center py-2">
              <h6 class="mb-0">Productos más vendidos</h6>
              <small class="text-muted">Top 5</small>
            </div>
            <div class="card-body p-2">
              <ul class="list-unstyled mb-0" id="topProductsList">
                <!-- Items generados por JS -->
              </ul>
            </div>
            <div class="card-footer text-end py-2">
              <a href="{{ route('products.index') }}" class="small">Ver catálogo completo</a>
            </div>
          </div>
        </div>
      </div> <!-- /row charts -->

    </div>
  </main>

  <!-- Scripts: coloca Chart.js y bootstrap en tu layout o aquí -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
