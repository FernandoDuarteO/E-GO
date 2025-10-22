@extends('layouts.app')

<head>
    <!-- Bootstrap primero -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tu CSS después -->
    <link rel="stylesheet" href="{{ asset('css/costos.css') }}">

    @stack('styles')
    
    <style>
        :root {
            --primary-color: #6f42c1;
            --primary-light: #8c68d1;
            --secondary-color: #20c997;
            --warning-color: #fd7e14;
            --danger-color: #dc3545;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        .main-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 10px;
        }
        
        .main-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }
        
        .nav-pills .nav-link {
            color: #495057;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        
        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            box-shadow: 0 4px 8px rgba(111, 66, 193, 0.3);
            border: none;
        }
        
        .nav-pills .nav-link:hover:not(.active) {
            background-color: rgba(111, 66, 193, 0.1);
            color: var(--primary-color);
            border: 1px solid rgba(111, 66, 193, 0.2);
        }
        
        .card {
            border: none;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }
        
        .custom-purple-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .custom-purple-btn:hover {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(111, 66, 193, 0.3);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(111, 66, 193, 0.05);
        }
        
        /* Título de la tabla en blanco */
        .table-dark {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light)) !important;
            color: white !important;
        }
        
        .progress-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: conic-gradient(var(--secondary-color) var(--progress), #e9ecef 0deg);
            position: relative;
            font-weight: bold;
            color: #333;
        }
        
        .progress-circle::before {
            content: '';
            position: absolute;
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 50%;
        }
        
        .progress-circle span {
            position: relative;
            z-index: 1;
        }
        
        .forecast-card {
            transition: all 0.3s ease;
        }
        
        .forecast-card:hover {
            transform: translateY(-5px);
        }
        
        .chart-container {
            height: 300px;
            margin-top: 20px;
        }
        
        .summary-card {
            border-left: 4px solid var(--primary-color);
            background-color: white;
        }
        
        .cost-breakdown {
            margin-top: 20px;
        }
        
        .cost-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        
        .cost-item:last-child {
            border-bottom: none;
        }
        
        .delete-btn {
            background: none;
            border: none;
            color: var(--danger-color);
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .delete-btn:hover {
            color: #b02a37;
        }
        
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }
        
        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
        }
        
        .badge-percentage {
            background-color: var(--secondary-color);
            color: white;
            font-size: 0.75rem;
        }
        
        @media (max-width: 768px) {
            .nav-pills .nav-link {
                margin-bottom: 5px;
            }
        }
    </style>
</head>

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 main-title">
        <i class="fas fa-chart-line me-2"></i>Panel de Gestión de Costos
    </h2>

    <ul class="nav nav-pills mb-4 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item me-2">
            <button class="nav-link active rounded-pill px-3" id="pills-estructura-tab" data-bs-toggle="pill" data-bs-target="#pills-estructura" type="button">
                <i class="fas fa-layer-group me-1"></i> Estructura de Costos
            </button>
        </li>
        <li class="nav-item me-2">
            <button class="nav-link rounded-pill px-3" id="pills-costo-tab" data-bs-toggle="pill" data-bs-target="#pills-costo" type="button">
                <i class="fas fa-calculator me-1"></i> Costo Unitario
            </button>
        </li>
        <li class="nav-item me-2">
            <button class="nav-link rounded-pill px-3" id="pills-pronostico-tab" data-bs-toggle="pill" data-bs-target="#pills-pronostico" type="button">
                <i class="fas fa-chart-bar me-1"></i> Pronóstico
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill px-3" id="pills-rentabilidad-tab" data-bs-toggle="pill" data-bs-target="#pills-rentabilidad" type="button">
                <i class="fas fa-trophy me-1"></i> Rentabilidad
            </button>
        </li>
    </ul>

    <div class="tab-content">
        {{-- ESTRUCTURA DE COSTOS --}}
        <div class="tab-pane fade show active" id="pills-estructura">
            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-layer-group me-2"></i>Estructura de Costos</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-2 mb-4 align-items-center">
                        <div class="col-md-5">
                            <input type="text" id="nombreProducto" class="form-control" placeholder="Nombre del producto o insumo">
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="costoProducto" class="form-control" placeholder="Costo">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn custom-purple-btn w-100" id="agregarProducto">
                                <i class="fas fa-plus me-1"></i> Agregar
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle rounded-3" id="tablaEstructura">
                            <thead class="table-dark">
                                <tr>
                                    <th>Concepto</th>
                                    <th>Costo ($)</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="estructuraBody">
                                <!-- Los elementos se agregarán dinámicamente aquí -->
                            </tbody>
                        </table>
                    </div>

                    <div id="emptyEstructura" class="empty-state" style="display: none;">
                        <i class="fas fa-inbox"></i>
                        <p>No hay elementos en la estructura de costos. Agrega algunos para comenzar.</p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 p-3 summary-card rounded">
                        <div>
                            <h6 class="mb-0">Resumen de Costos</h6>
                            <small class="text-muted">Total de todos los conceptos</small>
                        </div>
                        <div class="text-end">
                            <strong class="fs-5">$<span id="totalEstructura">0</span></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- COSTO UNITARIO --}}
        <div class="tab-pane fade" id="pills-costo">
            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-calculator me-2"></i>Cálculo del Costo Unitario</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="unidadesProducidas" class="form-label">Unidades Producidas</label>
                                <input type="number" class="form-control" id="unidadesProducidas" placeholder="Ej: 100" value="100">
                            </div>
                            <button class="btn custom-purple-btn px-4" id="btnCosto">
                                <i class="fas fa-calculator me-1"></i> Calcular Costo Unitario
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div id="resultadoCosto" class="p-3 bg-light rounded">
                                <p class="text-center text-muted mb-0">Ingresa los datos y haz clic en calcular</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="cost-breakdown mt-4" id="costBreakdown">
                        <!-- El desglose de costos se mostrará aquí -->
                    </div>
                </div>
            </div>
        </div>

        {{-- PRONÓSTICO --}}
        <div class="tab-pane fade" id="pills-pronostico">
            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-chart-bar me-2"></i>Simulación de Pronósticos de Ventas</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="pronosticoMeses" class="form-label">Período de Pronóstico (meses)</label>
                            <input type="number" class="form-control" id="pronosticoMeses" min="1" max="12" value="6">
                        </div>
                        <div class="col-md-4">
                            <label for="tasaCrecimiento" class="form-label">Tasa de Crecimiento Mensual (%)</label>
                            <input type="number" class="form-control" id="tasaCrecimiento" min="0" max="100" value="10">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button class="btn custom-purple-btn w-100" id="btnPronostico">
                                <i class="fas fa-chart-line me-1"></i> Simular Pronóstico
                            </button>
                        </div>
                    </div>

                    <div class="row mt-4" id="panelPronostico">
                        <!-- Los pronósticos se mostrarán aquí -->
                    </div>
                    
                    <div class="chart-container mt-4" id="chartContainer">
                        <!-- El gráfico se mostrará aquí -->
                    </div>
                </div>
            </div>
        </div>

        {{-- RENTABILIDAD --}}
        <div class="tab-pane fade" id="pills-rentabilidad">
            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-trophy me-2"></i>Análisis de Rentabilidad y Competitividad</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="precioVenta" class="form-label">Precio de Venta Unitario ($)</label>
                            <input type="number" class="form-control" id="precioVenta" placeholder="Ej: 25.00" value="25.00">
                        </div>
                        <div class="col-md-4">
                            <label for="unidadesVendidas" class="form-label">Unidades Vendidas Estimadas</label>
                            <input type="number" class="form-control" id="unidadesVendidas" placeholder="Ej: 500" value="500">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button class="btn custom-purple-btn w-100" id="btnRentabilidad">
                                <i class="fas fa-chart-pie me-1"></i> Analizar Rentabilidad
                            </button>
                        </div>
                    </div>

                    <div class="mt-4" id="resultadoRentabilidad">
                        <p class="text-center text-muted">Ingresa los datos y haz clic en analizar</p>
                    </div>
                    
                    <div class="row mt-4" id="rentabilidadCards">
                        <!-- Las tarjetas de rentabilidad se mostrarán aquí -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js para gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let estructura = [];
    let pronostico = [];
    let chart = null;

    // Inicialización con productos por defecto
    document.addEventListener('DOMContentLoaded', function() {
        // Agregar 3 productos por defecto para probar funcionalidades
        estructura = [
            { nombre: "Materiales de producción", costo: 1500 },
            { nombre: "Mano de obra", costo: 800 },
            { nombre: "Gastos generales", costo: 300 }
        ];
        
        actualizarVistaEstructura();
        
        // Event listeners
        document.getElementById('agregarProducto').addEventListener('click', agregarProducto);
        document.getElementById('btnCosto').addEventListener('click', calcularCostoUnitario);
        document.getElementById('btnPronostico').addEventListener('click', simularPronostico);
        document.getElementById('btnRentabilidad').addEventListener('click', analizarRentabilidad);
        
        // Permitir agregar con Enter
        document.getElementById('nombreProducto').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') agregarProducto();
        });
        document.getElementById('costoProducto').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') agregarProducto();
        });
    });

    function agregarProducto() {
        const nombre = document.getElementById('nombreProducto').value.trim();
        const costo = parseFloat(document.getElementById('costoProducto').value);
        
        if (!nombre || isNaN(costo) || costo <= 0) {
            alert('Por favor, ingresa un nombre y costo válido');
            return;
        }
        
        estructura.push({ nombre, costo });
        actualizarVistaEstructura();
        
        // Limpiar campos
        document.getElementById('nombreProducto').value = '';
        document.getElementById('costoProducto').value = '';
        document.getElementById('nombreProducto').focus();
    }

    function eliminarProducto(index) {
        estructura.splice(index, 1);
        actualizarVistaEstructura();
    }

    function actualizarVistaEstructura() {
        const tbody = document.getElementById('estructuraBody');
        const emptyState = document.getElementById('emptyEstructura');
        
        if (estructura.length === 0) {
            tbody.innerHTML = '';
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
            tbody.innerHTML = estructura.map((item, index) => `
                <tr>
                    <td>${item.nombre}</td>
                    <td>$${item.costo.toFixed(2)}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-danger" onclick="eliminarProducto(${index})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }
        
        const total = estructura.reduce((sum, item) => sum + item.costo, 0);
        document.getElementById('totalEstructura').innerText = total.toFixed(2);
    }

    function calcularCostoUnitario() {
        if (estructura.length === 0) {
            alert('Agrega productos a la estructura de costos primero');
            return;
        }
        
        const unidades = parseInt(document.getElementById('unidadesProducidas').value) || 100;
        const totalCostos = estructura.reduce((sum, item) => sum + item.costo, 0);
        const costoUnitario = totalCostos / unidades;
        
        document.getElementById('resultadoCosto').innerHTML = `
            <h5 class="text-primary">Costo Unitario: $${costoUnitario.toFixed(2)}</h5>
            <p class="mb-0">Basado en ${unidades} unidades producidas</p>
        `;
        
        // Mostrar desglose de costos
        mostrarDesgloseCostos(totalCostos, unidades);
    }

    function mostrarDesgloseCostos(totalCostos, unidades) {
        const breakdown = document.getElementById('costBreakdown');
        const costoUnitario = totalCostos / unidades;
        
        let html = `
            <h6 class="mb-3">Desglose de Costos</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="cost-item">
                        <span>Total de Costos:</span>
                        <span class="fw-bold">$${totalCostos.toFixed(2)}</span>
                    </div>
                    <div class="cost-item">
                        <span>Unidades Producidas:</span>
                        <span class="fw-bold">${unidades}</span>
                    </div>
                    <div class="cost-item">
                        <span>Costo Unitario:</span>
                        <span class="fw-bold text-primary">$${costoUnitario.toFixed(2)}</span>
                    </div>
                </div>
                <div class="col-md-6">
        `;
        
        estructura.forEach(item => {
            const porcentaje = ((item.costo / totalCostos) * 100).toFixed(1);
            html += `
                <div class="cost-item">
                    <span>${item.nombre}:</span>
                    <span>$${item.costo.toFixed(2)} <span class="badge badge-percentage">${porcentaje}%</span></span>
                </div>
            `;
        });
        
        html += `</div></div>`;
        breakdown.innerHTML = html;
    }

    function simularPronostico() {
        const meses = parseInt(document.getElementById('pronosticoMeses').value) || 6;
        const tasaCrecimiento = parseInt(document.getElementById('tasaCrecimiento').value) || 10;
        
        // Generar pronósticos con diferentes porcentajes de crecimiento
        const mesesNombres = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                             'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        
        pronostico = [];
        let ventaBase = 1000;
        
        for (let i = 0; i < meses; i++) {
            // Variar el porcentaje de crecimiento ligeramente para hacerlo más realista
            const crecimientoVariado = tasaCrecimiento + (Math.random() * 5 - 2.5);
            const ventas = i === 0 ? ventaBase : Math.round(pronostico[i-1].ventas * (1 + crecimientoVariado/100));
            
            pronostico.push({
                mes: mesesNombres[i % 12],
                ventas: ventas,
                crecimiento: i === 0 ? 0 : crecimientoVariado
            });
        }
        
        mostrarPronosticos();
        crearGraficoPronostico();
    }

    function mostrarPronosticos() {
        const panel = document.getElementById('panelPronostico');
        
        if (pronostico.length === 0) {
            panel.innerHTML = '<p class="text-center text-muted">No hay datos de pronóstico disponibles</p>';
            return;
        }
        
        panel.innerHTML = pronostico.map(p => {
            // Calcular diferentes porcentajes de ganancia para cada mes
            const porcentajeGanancia = 20 + (Math.random() * 15); // Entre 20% y 35%
            const ganancia = (p.ventas * (porcentajeGanancia/100)).toFixed(0);
            const crecimiento = p.crecimiento > 0 ? `+${p.crecimiento.toFixed(1)}%` : '0%';
            
            return `
                <div class="col-md-4 mb-3">
                    <div class="card forecast-card shadow-sm rounded-3 p-3 border-start border-4 border-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-1">${p.mes}</h6>
                                <p class="text-muted small mb-1">Ventas proyectadas</p>
                                <span class="fw-semibold">$${p.ventas.toLocaleString()}</span>
                                <div class="mt-1">
                                    <small class="text-success">
                                        <i class="fas fa-arrow-up me-1"></i>${crecimiento}
                                    </small>
                                </div>
                            </div>
                            <div class="progress-circle" style="--progress: ${porcentajeGanancia * 3.6}deg;">
                                <span>${porcentajeGanancia.toFixed(0)}%</span>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-success fw-semibold">
                            <i class="fas fa-dollar-sign me-1"></i>+${ganancia} ganancias
                        </p>
                    </div>
                </div>`;
        }).join('');
    }

    function crearGraficoPronostico() {
        const container = document.getElementById('chartContainer');
        
        // Destruir gráfico anterior si existe
        if (chart) {
            chart.destroy();
        }
        
        // Crear canvas para el gráfico
        container.innerHTML = '<canvas id="pronosticoChart"></canvas>';
        const ctx = document.getElementById('pronosticoChart').getContext('2d');
        
        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: pronostico.map(p => p.mes),
                datasets: [{
                    label: 'Ventas Proyectadas',
                    data: pronostico.map(p => p.ventas),
                    borderColor: '#6f42c1',
                    backgroundColor: 'rgba(111, 66, 193, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Pronóstico de Ventas Mensuales'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }

    function analizarRentabilidad() {
        if (estructura.length === 0) {
            alert('Agrega productos a la estructura de costos primero');
            return;
        }
        
        const precioVenta = parseFloat(document.getElementById('precioVenta').value);
        const unidadesVendidas = parseInt(document.getElementById('unidadesVendidas').value);
        
        if (!precioVenta || !unidadesVendidas) {
            alert('Por favor, ingresa el precio de venta y las unidades vendidas estimadas');
            return;
        }
        
        const costosTotales = estructura.reduce((sum, item) => sum + item.costo, 0);
        const ingresosTotales = precioVenta * unidadesVendidas;
        const ganancia = ingresosTotales - costosTotales;
        const margenGanancia = (ganancia / ingresosTotales) * 100;
        
        // Determinar nivel de competitividad
        let competitividad = '';
        let competitividadColor = '';
        
        if (margenGanancia > 30) {
            competitividad = 'Alta';
            competitividadColor = 'success';
        } else if (margenGanancia > 15) {
            competitividad = 'Moderada';
            competitividadColor = 'warning';
        } else {
            competitividad = 'Baja';
            competitividadColor = 'danger';
        }
        
        document.getElementById('resultadoRentabilidad').innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <h6 class="mb-3">Resumen Financiero</h6>
                        <div class="cost-item">
                            <span>Ingresos Totales:</span>
                            <span class="fw-bold text-success">$${ingresosTotales.toLocaleString()}</span>
                        </div>
                        <div class="cost-item">
                            <span>Costos Totales:</span>
                            <span class="fw-bold text-danger">$${costosTotales.toLocaleString()}</span>
                        </div>
                        <div class="cost-item">
                            <span>Ganancia Neta:</span>
                            <span class="fw-bold ${ganancia >= 0 ? 'text-success' : 'text-danger'}">
                                $${ganancia.toLocaleString()}
                            </span>
                        </div>
                        <div class="cost-item">
                            <span>Margen de Ganancia:</span>
                            <span class="fw-bold ${margenGanancia >= 0 ? 'text-success' : 'text-danger'}">
                                ${margenGanancia.toFixed(1)}%
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <h6 class="mb-3">Análisis de Competitividad</h6>
                        <div class="d-flex align-items-center mb-2">
                            <span class="me-2">Nivel:</span>
                            <span class="badge bg-${competitividadColor}">${competitividad}</span>
                        </div>
                        <p class="small mb-0">
                            ${obtenerRecomendacion(competitividad, margenGanancia)}
                        </p>
                    </div>
                </div>
            </div>
        `;
        
        mostrarTarjetasRentabilidad(margenGanancia, ganancia, costosTotales, ingresosTotales);
    }

    function obtenerRecomendacion(competitividad, margen) {
        if (competitividad === 'Alta') {
            return "Excelente rentabilidad. Considera expandir tu producción o explorar nuevos mercados.";
        } else if (competitividad === 'Moderada') {
            return "Rentabilidad aceptable. Evalúa oportunidades para reducir costos o aumentar precios.";
        } else {
            return "Rentabilidad baja. Revisa tu estructura de costos y considera estrategias para aumentar el valor percibido.";
        }
    }

    function mostrarTarjetasRentabilidad(margen, ganancia, costos, ingresos) {
        const container = document.getElementById('rentabilidadCards');
        
        container.innerHTML = `
            <div class="col-md-3 mb-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="text-primary mb-2">
                            <i class="fas fa-percentage fa-2x"></i>
                        </div>
                        <h5 class="card-title">${margen.toFixed(1)}%</h5>
                        <p class="card-text small">Margen de Ganancia</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="text-success mb-2">
                            <i class="fas fa-dollar-sign fa-2x"></i>
                        </div>
                        <h5 class="card-title">$${ganancia.toLocaleString()}</h5>
                        <p class="card-text small">Ganancia Neta</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="text-info mb-2">
                            <i class="fas fa-balance-scale fa-2x"></i>
                        </div>
                        <h5 class="card-title">${(ingresos/costos).toFixed(2)}</h5>
                        <p class="card-text small">Relación Ingresos/Costos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="text-warning mb-2">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                        <h5 class="card-title">${(ganancia > 0 ? 'Positiva' : 'Negativa')}</h5>
                        <p class="card-text small">Tendencia</p>
                    </div>
                </div>
            </div>
        `;
    }
</script>
@endsection