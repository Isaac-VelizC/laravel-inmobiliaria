<?php

namespace App\Http\Controllers;

use App\Exports\CitasExport;
use App\Models\Agente;
use App\Models\CitaGroup;
use App\Models\Propiedade;
use App\Models\Servicio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countPropiedades = Propiedade::count();
        $countUsers = User::where('rol', '!=', 'Admin')->count();
        $countServicios = Servicio::where('status', '!=', 'terminado')->count();
        $countCitas = CitaGroup::where('status', 'pendiente')->count();
        return view('home', compact('countPropiedades', 'countUsers', 'countServicios', 'countCitas'));
    }

    /**
     * Reportes de citas
     */
    public function indexReportesPage()
    {
        $propiedades = Propiedade::all();
        $agentes = Agente::with('usuario.persona')->get();
        return view('admin.reports.index', compact('propiedades', 'agentes'));
    }

    public function generarReporte(Request $request)
    {
        $query = CitaGroup::with([
            'hacienda' => function ($q) {
                $q->select('id', 'name');
            },
            'guia.usuario' => function ($q) {
                $q->select('id', 'name');
            }
        ])
            ->when($request->report_month, function ($q, $month) {
                return $q->whereYear('date', Carbon::parse($month)->year)
                    ->whereMonth('date', Carbon::parse($month)->month);
            })
            ->when($request->date_from, function ($q, $date) {
                return $q->where('date', '>=', $date);
            })
            ->when($request->date_to, function ($q, $date) {
                return $q->where('date', '<=', $date);
            })
            ->when($request->propiedad, function ($q, $propiedad) {
                return $q->where('propiedad', $propiedad);
            })
            ->when($request->agente_report, function ($q, $agente) {
                return $q->where('agente', $agente);
            })
            ->when($request->status, function ($q, $status) {
                return $q->where('status', $status);
            })
            ->orderBy('date', 'desc')
            ->orderBy('time', 'asc');

        $citas = $query->paginate(20);

        return view('admin.reports.index', [
            'citas' => $citas,
            'filtros' => $request->all(),
            'propiedades' => Propiedade::all(),
            'agentes' => Agente::with('usuario.persona')->get(),
        ]);
    }

    public function exportExcel(Request $request)
    {
        // Pasa todos los filtros a la clase de exportación
        return Excel::download(new CitasExport($request->all()), 'reporte_citas.xlsx');
    }
}
