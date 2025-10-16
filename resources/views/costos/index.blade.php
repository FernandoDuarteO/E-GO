@extends('layouts.app')

<head>
    <!-- Bootstrap primero -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tu CSS después -->
    <link rel="stylesheet" href="{{ asset('css/costos.css') }}">

    @stack('styles')
</head>
@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold">Panel de Gestión de Costos</h2>

    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item me-2">
            <button class="nav-link active rounded-pill px-3" id="pills-estructura-tab" data-bs-toggle="pill" data-bs-target="#pills-estructura" type="button">Estructura de Costos</button>
        </li>
        <li class="nav-item me-2">
            <button class="nav-link rounded-pill px-3" id="pills-costo-tab" data-bs-toggle="pill" data-bs-target="#pills-costo" type="button">Costo Unitario</button>
        </li>
        <li class="nav-item me-2">
            <button class="nav-link rounded-pill px-3" id="pills-pronostico-tab" data-bs-toggle="pill" data-bs-target="#pills-pronostico" type="button">Pronóstico</button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill px-3" id="pills-rentabilidad-tab" data-bs-toggle="pill" data-bs-target="#pills-rentabilidad" type="button">Rentabilidad</button>
        </li>
    </ul>

    <div class="tab-content">

        {{-- ESTRUCTURA DE COSTOS --}}
        <div class="tab-pane fade show active" id="pills-estructura">
            <div class="card shadow-sm rounded-3 p-3">
                <h5 class="fw-semibold">Elaboración de estructura de costos</h5>

                <div class="row g-2 mt-2 align-items-center">
                    <div class="col-md-5">
                        <input type="text" id="nombreProducto" class="form-control" placeholder="Nombre del producto o insumo">
                    </div>
                    <div class="col-md-4">
                        <input type="number" id="costoProducto" class="form-control" placeholder="Costo ($)">
                    </div>
                    <div class="col-md-3">
                        <button class="btn custom-purple-btn btn-sm w-100" id="agregarProducto">Agregar</button>
                    </div>
                </div>

                <table class="table table-hover align-middle mt-3 rounded-3 shadow-sm" id="tablaEstructura">
                    <thead class="table-dark">
                        <tr>
                            <th>Concepto</th>
                            <th>Costo ($)</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <div class="text-end mt-2">
                    <strong>Total: $<span id="totalEstructura">0</span></strong>
                </div>
            </div>
        </div>

        {{-- COSTO UNITARIO --}}
        <div class="tab-pane fade" id="pills-costo">
            <div class="card shadow-sm rounded-3 p-3">
                <div class="d-flex justify-content-between align-items-start">
                    <h5 class="fw-semibold">Cálculo del costo unitario de producción</h5>
                    <button class="btn custom-purple-btn px-3" id="btnCosto">Calcular Costo Unitario</button>
                </div>
                <p class="mt-2" id="resultadoCosto"></p>
            </div>
        </div>

        {{-- PRONÓSTICO --}}
        <div class="tab-pane fade" id="pills-pronostico">
            <div class="card shadow-sm rounded-3 p-3">
                <div class="d-flex justify-content-between align-items-start">
                    <h5 class="fw-semibold">Simulación de pronósticos de ventas</h5>
                    <button class="btn custom-purple-btn px-3" id="btnPronostico">Simular Pronóstico</button>
                </div>

                <div class="row mt-4" id="panelPronostico"></div>
            </div>
        </div>

        {{-- RENTABILIDAD --}}
        <div class="tab-pane fade" id="pills-rentabilidad">
            <div class="card shadow-sm rounded-3 p-3">
                <div class="d-flex justify-content-between align-items-start">
                    <h5 class="fw-semibold">Análisis de rentabilidad y competitividad</h5>
                    <button class="btn custom-purple-btn px-3" id="btnRentabilidad">Analizar Rentabilidad</button>
                </div>
                <div class="mt-2" id="resultadoRentabilidad"></div>
            </div>
        </div>
    </div>
</div>


<script>
    let estructura = [];
    let pronostico = [];

    document.getElementById('agregarProducto').addEventListener('click', () => {
        const nombre = document.getElementById('nombreProducto').value.trim();
        const costo = parseFloat(document.getElementById('costoProducto').value);
        if (!nombre || isNaN(costo) || costo <= 0) return alert('Ingresa un nombre y costo válido');
        estructura.push({ nombre, costo });
        actualizarTablaEstructura();
        document.getElementById('nombreProducto').value = '';
        document.getElementById('costoProducto').value = '';
    });

    function actualizarTablaEstructura() {
        const tbody = document.querySelector('#tablaEstructura tbody');
        tbody.innerHTML = estructura.map((item, index) => `
            <tr>
                <td>${item.nombre}</td>
                <td>$${item.costo.toFixed(2)}</td>
                <td><button class="btn btn-sm btn-danger" onclick="eliminarProducto(${index})">Eliminar</button></td>
            </tr>
        `).join('');
        const total = estructura.reduce((sum, i) => sum + i.costo, 0);
        document.getElementById('totalEstructura').innerText = total.toFixed(2);
    }

    function eliminarProducto(index) {
        estructura.splice(index, 1);
        actualizarTablaEstructura();
    }

    document.getElementById('btnCosto').addEventListener('click', () => {
        if (!estructura.length) return alert('Agrega productos primero');
        const total = estructura.reduce((a, b) => a + b.costo, 0);
        document.getElementById('resultadoCosto').innerText = `Costo unitario: $${(total / 100).toFixed(2)}`;
    });

    document.getElementById('btnPronostico').addEventListener('click', () => {
        pronostico = [
            { mes: 'Enero', ventas: 1200 },
            { mes: 'Febrero', ventas: 1500 },
            { mes: 'Marzo', ventas: 1700 }
        ];

        const panel = document.getElementById('panelPronostico');
        panel.innerHTML = pronostico.map(p => {
            const ganancia = (p.ventas * 0.25).toFixed(0); // 25% de ganancia estimada
            return `
                <div class="col-md-4 mb-3">
                    <div class="card forecast-card shadow-sm rounded-3 p-3 border-start border-4 border-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-1">${p.mes}</h6>
                                <p class="text-muted small mb-1">Ventas proyectadas</p>
                                <span class="fw-semibold">$${p.ventas}</span>
                            </div>
                            <div class="progress-circle" style="--progress: ${25 * 3.6}deg;">
                                25%
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-success fw-semibold">+${ganancia} ganancias aprox.</p>
                    </div>
                </div>`;
        }).join('');
    });

    document.getElementById('btnRentabilidad').addEventListener('click', () => {
        if (!estructura.length || !pronostico.length) return alert('Genera estructura y pronóstico primero');
        const ingresos = pronostico.reduce((a, b) => a + b.ventas, 0);
        const costos = estructura.reduce((a, b) => a + b.costo, 0);
        const ganancia = ingresos - costos;
        const competitividad = ganancia > 1000 ? 'Alta' : 'Moderada';

        document.getElementById('resultadoRentabilidad').innerHTML = `
            <p><strong>Ingresos:</strong> $${ingresos}</p>
            <p><strong>Costos:</strong> $${costos}</p>
            <p><strong>Ganancia:</strong> $${ganancia}</p>
            <p><strong>Competitividad:</strong> ${competitividad}</p>
        `;
    });
</script>
@endsection
