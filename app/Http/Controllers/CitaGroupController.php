<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Agente;
use App\Models\CitaGroup;
use App\Models\Propiedade;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CitaGroupController extends Controller
{
    public function index()
    {
        return view('admin.citas.index');
    }

    public function ajax_citas_group()
    {
        $citas = CitaGroup::with(['guia.usuario', 'hacienda', 'userCitas'])->latest()->get();

        $data = $citas->map(function ($cita) {
            return [
                'id' => $cita->id,
                'name' => $cita->name,
                'date' => $cita->date . ' ' . $cita->time,
                'cantidad' => $cita->cantidad,
                'agente' => $cita->guia?->usuario?->name ?? 'Sin asignar',
                'propiedad' => $cita->hacienda?->name ?? 'No disponible',
                'registrados' => $cita->userCitas->count(), // Método más eficiente para contar
                'status' => $cita->status,
            ];
        });

        return datatables()
            ->of($data)
            ->addColumn('action', 'admin.citas.botones')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        $group = null;
        $agentes = Agente::with('usuario')->where('status', 'activo')->get();
        $propiedades = Propiedade::where('status', 'Disponible')->get();
        return view('admin.citas.form', compact('agentes', 'propiedades', 'group'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'date' => 'required|date|after_or_equal:today', // Fecha debe ser hoy o futura
            'time' => 'required|date_format:H:i', // Formato de hora válido
            'cantidad' => 'required|integer|min:1|max:20',
            'agente' => 'required|integer|exists:agentes,id',
            'propiedad' => 'required|integer|exists:propiedades,id',
            'detail' => 'nullable|string|max:200'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validar si la fecha es hoy y la hora ya pasó
        if ($request->date == now()->toDateString() && $request->time < now()->format('H:i')) {
            return redirect()->back()->with('error', 'La hora debe ser futura si la cita es hoy.');
        }

        // Verificar si el agente ya tiene una cita en estado "disponible" en esa fecha y hora
        $citaExistente = CitaGroup::where('agente', $request->agente)
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->where('status', 'disponible') // Filtrar solo por citas disponibles
            ->exists();

        if ($citaExistente) {
            return redirect()->back()->with('error', 'El agente ya tiene una cita disponible en esta fecha y hora.');
        }

        try {
            CitaGroup::create($request->all());
            return redirect()->route('adm.citas.group.index')->with('success', 'Cita registrada con éxito.');
        } catch (\Throwable $th) {
            //dd($th->getMessage());
            return redirect()->back()->with('error', 'Error al registrar la cita.');
        }
    }

    public function edit($id)
    {
        $group = CitaGroup::findOrFail($id);
        $agentes = Agente::with('usuario')->where('status', 'activo')->get();
        $propiedades = Propiedade::where('status', 'Disponible')->get();
        return view('admin.citas.form', compact('agentes', 'propiedades', 'group'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'nullable|date_format:H:i',
            'cantidad' => 'required|integer|min:1|max:20',
            'agente' => 'required|integer|exists:agentes,id',
            'propiedad' => 'required|integer|exists:propiedades,id',
            'detail' => 'nullable|string|max:200'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Buscar la cita antes de actualizar
        $cita = CitaGroup::findOrFail($id);

        // Determinar fecha y hora a usar
        $fechaCita = $request->date ?? $cita->date;
        $horaCita = $request->time ?? $cita->time;

        // Convertir fecha y hora a objetos DateTime
        $fechaHoy = now()->toDateString();
        $horaActual = new DateTime(now()->format('H:i'));
        $horaCitaObj = new DateTime($horaCita);

        // Validar si la fecha es hoy y la hora ya pasó
        if ($fechaCita == $fechaHoy && $horaCitaObj < $horaActual) {
            return redirect()->back()->with('error', 'La hora debe ser futura si la cita es hoy.');
        }

        // Verificar si el agente ya tiene una cita en estado "disponible" en esa fecha y hora
        $citaExistente = CitaGroup::where('agente', $request->agente)
            ->where('date', $fechaCita)
            ->where('time', $horaCita)
            ->where('status', 'disponible')
            ->where('id', '!=', $id) // Evitar que compare con la misma cita
            ->exists();

        if ($citaExistente) {
            return redirect()->back()->with('error', 'El agente ya tiene una cita disponible en esta fecha y hora.');
        }

        try {
            // Actualizar solo los campos permitidos
            $cita->update([
                'name' => $request->name,
                'date' => $fechaCita,
                'time' => $horaCita,
                'cantidad' => $request->cantidad,
                'agente' => $request->agente,
                'propiedad' => $request->propiedad,
                'detail' => $request->detail,
            ]);

            return redirect()->route('adm.citas.group.index')->with('success', 'Cita actualizada con éxito.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al actualizar la cita: ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        $cita = CitaGroup::with(['guia.usuario.persona', 'hacienda', 'userCitas'])->findOrFail($id);
        $agente = $cita->guia->usuario->persona->name .' '.$cita->guia->usuario->persona->surnames;
        $users = $cita->userCitas();
        return view('admin.citas.show', compact('cita', 'agente'));
    }

    public function obtenerHorarios(Request $request)
    {
        // Validar que la fecha sea válida
        $request->validate([
            'fecha' => 'required|date_format:Y-m-d',
        ]);

        // Extraer año, mes y día
        list($anio, $mes, $dia) = explode('-', $request->fecha);
        $anio = (int) $anio;
        $mes = (int) $mes;
        $dia = (int) $dia;

        // Obtener horarios disponibles
        $horarios = Helper::generateTimes($anio, $mes, $dia);

        // Verificar si hay horarios disponibles
        if (empty($horarios)) {
            return response()->json(['error' => 'No hay horarios disponibles'], 404);
        }

        return response()->json($horarios);
    }
}
