<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use App\Models\Respuesta;
use App\Models\Resultado;
use App\Models\User;
use App\Models\Visita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EncuestaController extends Controller
{
    public function obtenerDatosGrafico()
    {
        $clientesPorMes = [];
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        foreach ($meses as $index => $mes) {
            $fechaInicio = Carbon::now()->subMonths($index)->startOfMonth();
            $fechaFin = Carbon::now()->subMonths($index)->endOfMonth();

            $clientes = User::where('rol', 'Cliente')
                ->whereBetween('created_at', [$fechaInicio, $fechaFin])
                ->count();

            $clientesPorMes[] = $clientes;
        }

        return response()->json([
            'etiquetas' => $meses,
            'datos' => $clientesPorMes
        ]);
    }

    // En tu controlador
    public function obtenerTopPropiedades()
    {
        $topPropiedades = Visita::with('propiedad')
            ->select('propiedad_id', DB::raw('COUNT(*) as total'))
            ->groupBy('propiedad_id')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $etiquetas = $topPropiedades->map(function ($item) {
            return $item->propiedad->name; // O 'titulo' si realmente se llama así
        });

        $datos = $topPropiedades->pluck('total');

        return response()->json([
            'etiquetas' => $etiquetas,
            'datos' => $datos
        ]);
    }

    public function admin_cita_encuesta_graficas($id)
    {
        $resultados = Resultado::with(['pregunta', 'respuestaSelect'])
            ->where('cita_id', $id)
            ->get();

        $respuestas = Respuesta::all()->pluck('question');

        $frecuencias = [];
        foreach ($respuestas as $respuesta) {
            $frecuencias[$respuesta] = $resultados->filter(function ($resultado) use ($respuesta) {
                return $resultado->respuestaSelect->question === $respuesta;
            })->count();
        }

        return [
            'etiquetas' => $respuestas,
            'datos' => array_values($frecuencias),
        ];
    }
}
