<?php

namespace App\Http\Controllers;

use App\Models\Propiedade;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        // Obtener todas las propiedades publicitadas
        $propiedades = Propiedade::with('imagenes')->where('state_advertising', 'publicitado')
            ->take(3)
            ->get();
        return view('welcome', [
            'propiedades' => $propiedades
        ]);
    }

    public function pageNosotros() {
        return view('web.nosotros');
    }
}
