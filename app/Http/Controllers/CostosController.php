<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CostosController extends Controller
{
    private $estructuraCostos = [];

    public function index()
    {
        // Retorna la vista principal del módulo de costos
        return view('costos.index');
    }

    public function getEstructura(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->estructuraCostos,
            'total' => collect($this->estructuraCostos)->sum('costo')
        ]);
    }

    public function guardarEstructura(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'costo' => 'required|numeric|min:0'
        ]);

        $item = [
            'id' => uniqid(),
            'nombre' => $request->nombre,
            'costo' => $request->costo,
            'created_at' => now()
        ];

        $this->estructuraCostos[] = $item;

        return response()->json([
            'success' => true,
            'message' => 'Item agregado correctamente',
            'data' => $item
        ]);
    }

    public function eliminarItem($id): JsonResponse
    {
        $this->estructuraCostos = array_filter($this->estructuraCostos, function($item) use ($id) {
            return $item['id'] !== $id;
        });

        return response()->json([
            'success' => true,
            'message' => 'Item eliminado correctamente'
        ]);
    }

    public function calcularCostoUnitario(Request $request): JsonResponse
    {
        $total = collect($this->estructuraCostos)->sum('costo');
        $costoUnitario = $total / 100; // Asumiendo 100 unidades

        return response()->json([
            'success' => true,
            'costo_unitario' => round($costoUnitario, 2),
            'total_costos' => $total
        ]);
    }

    public function getPronostico(): JsonResponse
    {
        $pronostico = [
            ['mes' => 'Enero', 'ventas' => 1200],
            ['mes' => 'Febrero', 'ventas' => 1500],
            ['mes' => 'Marzo', 'ventas' => 1700]
        ];

        return response()->json([
            'success' => true,
            'data' => $pronostico
        ]);
    }

    public function analizarRentabilidad(Request $request): JsonResponse
    {
        $ingresos = 4400; // Suma del pronóstico
        $costos = collect($this->estructuraCostos)->sum('costo');
        $ganancia = $ingresos - $costos;
        $competitividad = $ganancia > 1000 ? 'Alta' : 'Moderada';

        return response()->json([
            'success' => true,
            'ingresos' => $ingresos,
            'costos' => $costos,
            'ganancia' => $ganancia,
            'competitividad' => $competitividad
        ]);
    }
}
