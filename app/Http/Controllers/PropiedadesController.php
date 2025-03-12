<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Propiedade;
use App\Models\Visita;
use Illuminate\Http\Request;

class PropiedadesController extends Controller
{
    public function index(Request $request)
    {
        $propiedades = Propiedade::with(['tipoPropiedad'])
        ->latest()
        ->paginate(10);
        return view('web.propiedades', compact('propiedades'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $imagenes = Image::where('propiedad', $id)->where('type', '<>', '360')->get();
        $imagenCasa = Image::where('propiedad', $id)->where('type', 'casa_fuera')->first();
        $imagen360 = Image::with('hotspots')->where('propiedad', $id)->where('type', '=', '360')->get();
        $propiedad = Propiedade::with('tipoPropiedad')->findOrFail($id);
        //Contar visitas
        $ip = $request->ip();
        $title = $propiedad->nombre;
        $price = number_format($propiedad->precio, 2);
        $message = "🏡 ¡Mira esta propiedad en venta! {$title} por \${$price}. Más detalles aquí: ";
        $portadaPublic = Image::where('type', 'casa_fuera')->where('propiedad', $id)->first();
        // Registrar visita
        Visita::registrarVisita($id, $ip);
        return view('web.detalles', [
            'propiedad' => $propiedad,
            'imagenes' => $imagenes,
            'imagen360' => $imagen360,
            'imagenCasa' => $imagenCasa,
            'message' => $message,
            'portadaPublic' => $portadaPublic
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
