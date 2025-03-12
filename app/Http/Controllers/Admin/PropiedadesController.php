<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CitaGroup;
use App\Models\Hotspot;
use App\Models\Image;
use App\Models\Propiedade;
use App\Models\Propietario;
use App\Models\TipoPropiedad;
use App\Models\TipoTraspaso;
use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PropiedadesController extends Controller
{
    public function index()
    {
        $propiedades = Propiedade::with(['propiet', 'visitas', 'imagenes'])->latest()->get();
        $propietario = null;
        return view('admin.propiedades.index', compact('propiedades', 'propietario'));
    }

    public function create()
    {
        $propiedad = null;
        $propietarios = Propietario::all();
        //$filePath = resource_path('json/ciudades.json');
        //$ciudades = json_decode(File::get($filePath), true);
        // Cargar el archivo ciudades.json desde public/json/
        $filePath = public_path('json/ciudades.json');

        // Verificar si el archivo existe
        if (File::exists($filePath)) {
            $ciudades = json_decode(File::get($filePath), true);
        } else {
            // Manejar el caso en que el archivo no existe
            $ciudades = []; // O cualquier valor por defecto que desees
            // Puedes agregar un mensaje de error o una excepción aquí
            // throw new Exception("El archivo ciudades.json no existe.");
        }
        $tipoPropiedad = TipoPropiedad::all();
        $tipoTraspaso = TipoTraspaso::getTodo();

        return view('admin.propiedades.create', [
            'propiedad' => $propiedad,
            'propietarios' => $propietarios,
            'ciudades' => $ciudades,
            'tipopropiedad' => $tipoPropiedad,
            'ventastipo' => $tipoTraspaso
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:250|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'address' => 'required|string|max:200',
            'city' => 'required|string|max:50',
            'tipo_propiedad' => 'required|string|max:50',
            'tipo_traspaso' => 'nullable|string|max:20',
            'num_rooms' => 'required|integer|min:0|max:1000',
            'num_bedrooms' => 'required|integer|min:0|max:1000',
            'num_hall' => 'required|integer|min:0|max:1000',
            'num_bathrooms' => 'required|integer|min:0|max:1000',
            'num_kitchens' => 'required|integer|min:0|max:1000',
            'num_garages' => 'required|integer|min:0|max:1000',
            'constructed_area' => 'required|numeric|min:0',
            'ground_surface' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:100',
            'coin' => 'required|string|max:6',
            'bank_financing' => 'nullable|string|in:Si,No',
            'status' => 'required|string|max:50',
            'date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:date',
            'propietario' => 'required|integer',
            'latitude' => 'required|string|max:50',
            'longitude' => 'required|string|max:50',
            'state_advertising' => 'required|string|max:50'
        ]);

        // Creación de la nueva propiedad
        $nuevoID = Propiedade::create($validatedData);
        $nuevoID->id_user = Auth::user()->id;
        $nuevoID->save();

        return response()->json([
            'message' => 'Propiedad creada con éxito',
            'UltID' => $nuevoID->id
        ], 201);
    }

    public function show($id)
    {
        $propiedad = Propiedade::with(['propiet', 'imagenes', 'tipoPropiedad', 'tipoTraspaso'])->find($id);
        if (!$propiedad) {
            return redirect()->back()->with('error', 'No se encontró la propiedad');
        }
        $imagen360 = Image::with('hotspots')->where('type', '360')->where('propiedad', $id)->get();
        $visitas = Visita::obtenerTotalVisitas($id);
        $urlPublic = url("/propiedades/detalle/{$propiedad->id}");
        $title = $propiedad->name;
        $price = number_format($propiedad->price, 2);
        $message = "🏡 ¡Mira esta propiedad en venta! {$title} por \${$price}. Más detalles aquí: ";
        $shareLinks = [
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($urlPublic),
        ];

        $portadaPublic = Image::where('type', 'casa_fuera')->where('propiedad', $id)->first();

        return view('admin.propiedades.show', compact('propiedad', 'visitas', 'imagen360', 'shareLinks', 'message', 'portadaPublic', 'urlPublic'));
    }

    public function edit($id)
    {
        $propiedad = Propiedade::findOrFail($id);
        $propietarios = Propietario::all();
        //$filePath = resource_path('json/ciudades.json');
        //$ciudades = json_decode(File::get($filePath), true);
        // Cargar el archivo ciudades.json desde public/json/
        $filePath = public_path('json/ciudades.json');

        // Verificar si el archivo existe
        if (File::exists($filePath)) {
            $ciudades = json_decode(File::get($filePath), true);
        } else {
            // Manejar el caso en que el archivo no existe
            $ciudades = []; // O cualquier valor por defecto que desees
            // Puedes agregar un mensaje de error o una excepción aquí
            // throw new Exception("El archivo ciudades.json no existe.");
        }
        $tipoPropiedad = TipoPropiedad::all();
        $tipoTraspaso = TipoTraspaso::getTodo();

        return view('admin.propiedades.create', [
            'propiedad' => $propiedad,
            'propietarios' => $propietarios,
            'ciudades' => $ciudades,
            'tipopropiedad' => $tipoPropiedad,
            'ventastipo' => $tipoTraspaso
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:250|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'address' => 'required|string|max:200',
            'city' => 'required|string|max:50',
            'tipo_propiedad' => 'required|string|max:50',
            'tipo_traspaso' => 'nullable|string|max:20',
            'num_rooms' => 'required|integer|min:0|max:1000',
            'num_bedrooms' => 'required|integer|min:0|max:1000',
            'num_hall' => 'required|integer|min:0|max:1000',
            'num_bathrooms' => 'required|integer|min:0|max:1000',
            'num_kitchens' => 'required|integer|min:0|max:1000',
            'num_garages' => 'required|integer|min:0|max:1000',
            'constructed_area' => 'required|numeric|min:0',
            'ground_surface' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:100',
            'coin' => 'required|string|max:6',
            'bank_financing' => 'nullable|string|in:Si,No',
            'status' => 'required|string|max:50',
            'date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:date',
            'propietario' => 'required|integer',
            'latitude' => 'required|string|max:50',
            'longitude' => 'required|string|max:50',
            'state_advertising' => 'required|string|max:50'
        ]);
        try {
            // Actualizar la propiedad utilizando el ID proporcionado
            Propiedade::findOrFail($id)->update($validatedData);

            return response()->json([
                'message' => 'Propiedad actualizada con éxito'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Ocurrió un error al actualizar la información'
            ], 500);
        }
    }


    public function destroy(string $id)
    {
        try {
            // Buscar la propiedad y sus relaciones
            $propiedad = Propiedade::with(['imagenes', 'hotspots', 'visitas'])->findOrFail($id);
            Image::where('propiedad', $id)->delete();
            Hotspot::where('propiedad_id', $id)->delete();
            Visita::where('propiedad_id', $id)->delete();
            $propiedad->delete();
            // Redirigir con un mensaje de éxito
            return redirect()->route('adm.index.propiedades')->with('success', 'Propiedad eliminada con éxito');
        } catch (\Exception $e) {
            // Manejar excepciones y redirigir con un mensaje de error
            return back()->with('error', 'Ocurrió un error al eliminar la propiedad: ' . $e->getMessage());
        }
    }

    public function propietario_agregar(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'surnames' => 'required|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'ci' => 'nullable|string|max:9|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'address' => 'nullable|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'email' => 'required|email|max:255|regex:/^[\w\.-]+@[\w\.-]+\.\w+$/',
            'phone' => 'required|string|min:8|max:10|regex:/^\d+$/',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }
        $nuevoPropietario = Propietario::create($validatedData->validated());
        $nuevoData = Propietario::findOrFail($nuevoPropietario->id);
        return response()->json([
            'message' => 'Propietario agregado con éxito',
            'ultID' => $nuevoData->id,
            'ultNombre' => $nuevoData->name . ' ' . $nuevoData->surnames
        ], 201);
    }

    public function tipo_agregar(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'detail' => 'nullable|string|max:300'
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }
        $nuevoPropietario = TipoPropiedad::create($validatedData->validated());
        $nuevoData = TipoPropiedad::findOrFail($nuevoPropietario->id);
        return response()->json([
            'message' => 'Tipo de propiedad agregado con éxito',
            'ultID' => $nuevoData->id,
            'ultName' => $nuevoData->name
        ], 201);
    }

    public function venta_tipo_agregar(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'detail' => 'nullable|string|max:300'
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }
        $nuevoPropietario = TipoTraspaso::create($validatedData->validated());
        $nuevoData = TipoTraspaso::findOrFail($nuevoPropietario->id);
        return response()->json([
            'message' => 'Tipo de venta agregado con éxito',
            'ultID' => $nuevoData->id,
            'ultVName' => $nuevoData->name
        ], 201);
    }

    public function pagina_subir_imagenes($id)
    {
        $propiedad = Propiedade::findOrFail($id);
        $propietario = Propietario::findOrFail($propiedad->propietario);
        $imagenes = Image::where('propiedad', $id)->get();
        $imagenes360 = Image::with('hotspots')->where('propiedad', $id)->where('type', '360')->get();
        $hotspots = Hotspot::all();
        if (empty($propiedad)) {
            return response()->json([
                'message' => 'Propiedad no encontrada',
            ], 404);
        }
        return view('admin.propiedades.formImages', [
            'propiedad' => $propiedad,
            'imagenes' => $imagenes,
            'propietario' => $propietario,
            'imagenes360' => $imagenes360,
            'hotspots' => $hotspots
        ]);
    }

    public function citas($id)
    {
        $citas = CitaGroup::where('propiedad', $id)->get();
        $prodiedad  = Propiedade::findOrFail($id);
        $titulo = "Propiedad: " . $prodiedad->name;
        return view('admin.propiedades.citas.index', ['citas' => $citas, 'id' => $id, 'titulo' => $titulo]);
    }
}
