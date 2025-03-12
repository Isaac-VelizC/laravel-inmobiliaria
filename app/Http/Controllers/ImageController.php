<?php

namespace App\Http\Controllers;

use App\Models\Hotspot;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|string|max:255',
            'imagenes.*' => 'required|mimes:webp,png,jpg,jpeg',
            'id_propiedad_img' => 'required|integer|exists:propiedades,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            // Procesar las imágenes si existen
            if ($request->hasFile('imagenes')) {
                $imagenes = $request->file('imagenes');
                $tipo = $request->tipo;
                $idPropiedad = $request->id_propiedad_img;

                // Guardar todas las imágenes en un solo paso
                foreach ($imagenes as $imagen) {
                    $rutaImagen = $imagen->store('imagenes', 'public');
                    // Guarda la ruta de la imagen en la base de datos
                    Image::create([
                        'type' => $tipo,
                        'path' => $rutaImagen,
                        'propiedad' => $idPropiedad,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Imágenes creadas correctamente.');
        } catch (\Throwable $th) {
            // Log::error('Error al subir imágenes: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al subir las imágenes.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function destroy($id)
    {
        $imagen = Image::findOrFail($id);
        $rutaImagen = storage_path('app/public/' . $imagen->path);

        // Elimina el archivo físico si existe
        if (File::exists($rutaImagen)) {
            File::delete($rutaImagen);
        }

        // Elimina el registro de la base de datos
        $imagen->delete();

        return redirect()->back()->with('success', 'Imagen eliminada correctamente.');
    }

    public function storeHotspot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_hotspot' => 'required|string|max:30|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ0-9 ]+$/',
            'targetScene' => 'required|integer|exists:images,id',
            'sceneId' => 'required|integer|exists:images,id',
            'propiedad_id' => 'required|integer|exists:propiedades,id', // Corrección de "exist" a "exists"
            'pitch' => 'required|numeric', // Se asegura que sea un número
            'yaw' => 'required|numeric', // Se asegura que sea un número
        ]);
        // Manejo de errores de validación
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            // Crear el hotspot utilizando los datos validados
            $hots = Hotspot::create($validator->validated());
            $hots->nombre = $request->nombre_hotspot;
            $hots->save();
            return back()->with('success', 'Hotspot guardado correctamente.');
        } catch (\Throwable $th) {
            // Log::error('Error al guardar el hotspot: ' . $th->getMessage());
            return back()->with('error', 'Ocurrió un error al guardar el hotspot.');
        }
    }
}
