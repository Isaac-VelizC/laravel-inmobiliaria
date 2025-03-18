<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\CitaGroup;
use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Models\Propiedade;
use App\Models\Respuesta;
use App\Models\RespuestasSeleccionada;
use App\Models\Resultado;
use App\Models\UserCitaGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    public function storeCita($id)
    {
        try {
            $cita = CitaGroup::findOrFail($id);
            $idUser = Auth::id();
            // Verificar 1: Cita existente en la misma propiedad (pendiente)
            $citaExistenteMismaPropiedad = UserCitaGroup::where('usuario', $idUser)
                ->where('propiedad', $cita->propiedad)
                ->whereHas('groupCita', function ($query) {
                    $query->where('date', '>=', now()->toDateString());
                })
                ->exists();
            // Verificar 2: Cita existente en el mismo horario (cualquier propiedad)
            $citaExistenteMismoHorario = UserCitaGroup::where('usuario', $idUser)
                ->whereHas('groupCita', function ($query) use ($cita) {
                    $query->where('date', $cita->date)
                        ->where('time', $cita->time);
                })
                ->exists();

            if ($citaExistenteMismaPropiedad) {
                return redirect()->back()->with('error', 'Ya tienes una cita pendiente en esta propiedad');
            }

            if ($citaExistenteMismoHorario) {
                return redirect()->back()->with('error', 'Ya tienes una cita programada para este mismo horario');
            }

            UserCitaGroup::create([
                'group' => $id,
                'propiedad' => $cita->propiedad,
                'usuario' => $idUser
            ]);

            return redirect()->route('propiedades.detalle', $cita->propiedad)
                ->with('success', 'Cita Registrada Exitosamente');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al registrar la cita');
        }
    }

    public function index($id)
    {
        $idUser = Auth::id();
        $citas = CitaGroup::with('hacienda')->where('propiedad', $id)->latest()->get();
        $misCitas = UserCitaGroup::with(['propiedadCita', 'groupCita'])->where('usuario', $idUser)->latest()->get();
        $propiedad = Propiedade::findOrFail($id);
        return view('web.citas', [
            'citas' => $citas,
            'propiedad' => $propiedad,
            'misCitas' => $misCitas
        ]);
    }

    public function encuesta($citaId, $propId)
    {
        $estadEncuesta = false;
        $user = Auth::user();
        $propiedad = Propiedade::findOrFail($propId);
        $cita = CitaGroup::findOrFail($citaId);
        $encuesta = Encuesta::latest('created_at')->with('preguntas')->first();
        if (!$encuesta) {
            return redirect()->back()->with('error', 'No hay encuestas disponibles.');
        }

        // Usar el modelo correcto para respuestas del usuario (ej: Resultado)
        $datos = Resultado::where('user_id', $user->id)
            ->where('cita_id', $citaId)
            ->first();

        $preguntas = collect(); // Inicializar como colección vacía

        if ($datos) {
            $estadEncuesta = true;
        } else {
            // Cargar preguntas con respuestas usando relaciones
            $preguntas = Pregunta::where('encuesta_id', $encuesta->id)
                ->with('respuestas')
                ->get();
        }

        return view('web.citas_encuesta', compact('cita', 'propiedad', 'encuesta', 'preguntas', 'estadEncuesta'));
    }


    public function storeRespuestas(Request $request)
    {
        $request->validate([
            'cita_id' => 'required|exists:cita_groups,id',
            'encuesta_id' => 'required|exists:encuestas,id',
            'propiedad' => 'required|exists:propiedades,id',
            'respuestas' => 'required|array'
        ]);

        try {
            DB::beginTransaction();
            $user = Auth::user();
            foreach ($request->respuestas as $preguntaId => $respuestaId) {
                Resultado::create([
                    'user_id' => $user->id,
                    'cita_id' => $request->cita_id,
                    'encuesta_id' => $request->encuesta_id,
                    'pregunta_id' => $preguntaId,
                    'respuesta_id' => $respuestaId,
                ]);
            }

            DB::commit();
            return redirect()->route('usuario.citas.encuesta', [$request->cita_id, $request->propiedad])->with('success', 'Encuesta guardada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function index_admin()
    {
        $citas = Cita::with(['propiedad', 'user'])->latest()->get();
        return view('admin::citas.index', ['citas' => $citas]);
    }

    public function admin_cita_encuesta(Request $request)
    {
        $prop = $request->idProp;
        $propiedad = Propiedades::findOrFail($prop);
        $cita = $request->idCita;
        $respuestas = Respuesta::join('preguntas', 'respuestas.respuesta_id', '=', 'preguntas.id')
            ->join('encuestas', 'preguntas.encuesta_id', '=', 'encuestas.id')
            ->where('respuestas.cita_id', $cita)
            ->get();

        $respuestas2 = "";
        if ($respuestas->count() > 0) {
            foreach ($respuestas as $respuesta) {
                $respuestas2 .= '<h5>' . $respuesta->nombre . " '" . $propiedad->nombre . "'</h5>";
                $respuestas2 .= $respuesta->pregunta . "<br>";
            }
        }
        return view('admin::citas.ajax.cita_encuesta', ['respuestas' => $respuestas2]);
    }


    public function index_admin_user($id)
    {
        $citas = Cita::getCitasByUsuario($id);
        $user = User::find($id);
        $titulo = "Usuario: " . $user->name;
        return view('admin::citas.index', ['citas' => $citas, 'id' => $id, 'titulo' => $titulo]);
    }

    public function servicios()
    {
        $user = auth()->user();
        $servicios = Servicio::with(['usuario.client', 'tipoServicio'])->where('id_usuario', $user->id)->get();
        return view('web.home.servicios', ['user' => $user, 'servicios' => $servicios]);
    }

    public function serviciosPorPropiedad($id)
    {
        $propiedad = Propiedades::findOrFail($id);
        $tipoServicio = ServiciosTipo::all();
        $user = auth()->user();
        $servicios = Servicio::with(['usuario.client', 'tipoServicio'])->where('id_usuario', $user->id)->where('id_propiedad', $id)->latest()->get();
        return view('web.home.servicios', ['user' => $user, 'servicios' => $servicios, 'tipoServicio' => $tipoServicio, 'propiedad' => $propiedad]);
    }

    public function detalleServicioCliente($id)
    {
        $servicio = Servicio::with(['tipoServicio', 'imagenes', 'propiedad'])->findOrFail($id);
        return view('web.home.servicio_detalle', ['servicio' => $servicio]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario_id' => 'required|integer',
            'id_propiedad' => 'required|integer',
            'fecha_de_cita' => 'required|date|after_or_equal:today',
            'hora_de_cita' => 'required|date_format:H:i'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Obtener la fecha actual y agregar un día
        $fechaActual = Carbon::now();
        $fechaLimite = $fechaActual->addDay()->startOfDay(); // Asegura que sea a partir de mañana

        // Verificar si la fecha_de_cita es al menos un día después de la fecha actual
        if (Carbon::parse($request->fecha_de_cita)->isBefore($fechaLimite)) {
            return redirect()->back()->with('error', 'La fecha de la cita debe ser al menos un día después de hoy.');
        }

        // Verificar si ya existe una cita para la misma fecha y hora
        $existeCita = Cita::where('fecha_de_cita', $request->fecha_de_cita)

            ->where('usuario_id', $request->usuario_id)
            ->exists();

        // Si existe una cita, retornar con un error
        if ($existeCita) {
            return redirect()->back()->with('error', 'Ya existe una cita para esta fecha y hora. Intenta con otra.');
        }

        Cita::create($request->all());
        return redirect()->route('propiedades.detalle', $request->id_propiedad)
            ->with('success', 'Cita guardada exitosamente.');
    }

    public function edit($id)
    {
        $cita = Cita::with(['propiedad', 'user.client'])->findOrFail($id);
        return view('admin::citas.edit', ['cita' => $cita, 'id' => $id]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_usuario' => 'sometimes|integer',
            'id_propiedad' => 'sometimes|integer',
            'fecha_de_cita' => 'sometimes|date',
            'hora_de_cita' => 'sometimes',
            'anotaciones' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cita = Cita::findOrFail($request->id);
        $cita->update($request->all());

        return redirect()->route('citas.index', $request->id)->with('success', 'Servicio actualizado exitosamente.');
    }

    public function update_admin(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fecha_de_cita' => 'sometimes|date',
            'hora_de_cita' => 'sometimes',
            'anotaciones' => 'nullable|string',
            'estado' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cita = Cita::findOrFail($id);
        $cita->update($request->all());

        return redirect()->route('adm.citas.edit', $request->id)->with('success', 'Cita actualizada exitosamente.');
    }

    private function generateTimes($anio, $mes, $dia)
    {
        $times = [];
        $startTimes = ['08:00', '14:00'];
        $endTimes = ['11:30', '18:00'];

        // Convertimos la fecha correctamente
        $fecha_original = sprintf('%04d-%02d-%02d', $anio, $mes, $dia);
        $date = new DateTime($fecha_original);
        $sFecha = $date->format('Y-m-d');

        foreach ($startTimes as $index => $startTime) {
            $start = new DateTime($startTime);
            $end = new DateTime($endTimes[$index]);

            while ($start <= $end) {
                $sHora = $start->format('H:i');
                // Validamos que no haya cita en esta hora
                $control = Cita::controlHora($sFecha, $sHora);
                // Validamos que no sea una hora pasada si es el día actual
                $horaActual = new DateTime();
                $horaCita = new DateTime($sHora);
                $control2 = true;
                /*if ($anio == date('Y') && $mes == date('m') && (int)$dia == (int)date('d')) {
                    if ($horaCita <= $horaActual) {
                        $control2 = false;
                    }
                }*/
                // Solo agregamos si no hay cita y la hora es válida
                if (empty($control) && $control2) {
                    $times[] = $sHora;
                }

                // Avanzamos 45 minutos
                $start->modify('+45 minutes');
            }
        }
        return $times;
    }

    private function ultimosMeses($n = 5, $txt = false, $adel = false)
    {
        // Obtener la fecha actual
        $fechaActual = new DateTime();
        // Crear un array para almacenar los meses
        $meses = [];
        // Iterar 5 veces hacia atrás
        for ($i = 0; $i < $n; $i++) {
            // Formatear la fecha como "AAAA-MM" y agregarla al array
            $meses[] = $mesesAux = $fechaActual->format('Y-m');
            //
            list($Anio, $Mes) = explode('-', $mesesAux);
            $mesesTxt[$mesesAux] = $Anio . '/' . $this->nombreMes($Mes);
            // Restar un mes a la fecha actual
            if ($adel) {
                $fechaActual->modify('+1 month');
            } else {
                $fechaActual->modify('-1 month');
            }
        }
        if ($txt) {
            if ($adel) {
                return $mesesTxt;
            }
            return array_reverse($mesesTxt);
        }
        return array_reverse($meses);
    }

    private function nombreMes($numeroMes)
    {
        // Array asociativo con los nombres de los meses
        $meses = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        ];

        // Verificar si el número de mes es válido y existe en el array
        if (isset($meses[$numeroMes])) {
            return $meses[$numeroMes];
        } else {
            return "Mes inválido";
        }
    }
}
