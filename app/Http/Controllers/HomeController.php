<?php

namespace App\Http\Controllers;

use App\Models\CitaGroup;
use App\Models\Propiedade;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;

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
        $countServicios = Servicio::where('status', 'pendiente')->count();
        $countCitas = CitaGroup::where('status', 'pendiente')->count();
        return view('home', compact('countPropiedades', 'countUsers', 'countServicios', 'countCitas'));
    }
}
