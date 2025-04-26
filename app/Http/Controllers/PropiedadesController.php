<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Propiedade;
use App\Models\TipoPropiedad;
use App\Models\Visita;
use Illuminate\Http\Request;

class PropiedadesController extends Controller
{
    public function index(Request $request)
    {
        $tipos = TipoPropiedad::all();
        $ciudades = $this->ciudadesBolivia();
        $propiedades = Propiedade::with(['tipoPropiedad'])->where('status', 'Disponible')
            ->latest()
            ->paginate(10);
        return view('web.propiedades', compact('propiedades', 'tipos', 'ciudades'));
    }

    private function ciudadesBolivia()
    {
        return [
            "La Paz" => "La Paz",
            "Chuquisaca" => "Sucre",
            "Cochabamba" => "Cochabamba",
            "Santa Cruz" => "Santa Cruz de la Sierra",
            "Oruro" => "Oruro",
            "Potosí" => "Potosí",
            "Tarija" => "Tarija",
            "Pando" => "Cobija",
            "Beni" => "Trinidad"
        ];
    }

    public function buscar(Request $request)
    {
        // Obtener los parámetros de búsqueda
        $query = $request->input('query');
        $tipo_id = $request->input('tipo_id');
        $ciudad = $request->input('ciudad');

        // Construir la consulta
        $propiedades = Propiedade::query();

        if ($query) {
            $propiedades->where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%");
        }

        if ($tipo_id) {
            $propiedades->where('tipo_propiedad', $tipo_id);
        }

        if ($ciudad) {
            $propiedades->where('city', $ciudad);
        }

        // Obtener las propiedades filtradas
        $propiedades = $propiedades->paginate(10); // Cambia el número según lo que necesites

        // Obtener tipos y ciudades para el formulario
        $tipos = TipoPropiedad::all(); // Asegúrate de tener este modelo
        $ciudades = $this->ciudadesBolivia();

        return view('web.propiedades', compact('propiedades', 'tipos', 'ciudades', 'query'));
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
