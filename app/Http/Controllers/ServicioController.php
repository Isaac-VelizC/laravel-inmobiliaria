<?php

namespace App\Http\Controllers;

use App\Models\ImagenServicio;
use App\Models\Propiedade;
use App\Models\Servicio;
use App\Models\ServiciosTipo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicioController extends Controller
{
    public function index()
    {
        return view('admin.servicios.index');
    }

    public function ajax_servicios_group()
    {
        $items = Servicio::with(['usuario.persona'])->get();
        // Transformar los datos de los servicios
        $data = $items->map(function ($item) {
            return [
                'id' => $item->id,
                'client' => $item->usuario->persona->name . ' ' . $item->usuario->persona->surnames,
                'tipo_servicio' => $item->detail,
                'date' => $item->date_start,
                'status' => $item->status,
            ];
        });

        return datatables()
            ->of($data)
            ->addColumn('action', 'admin.servicios.botones')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create($id)
    {
        $item = Propiedade::findOrFail($id);
        if (!$item) {
            return redirect()->back()->with('error', 'No existe la propiedad');
        }
        $usuarios = User::with('persona')->where('rol', 'Cliente')->get();
        $servicios = Servicio::with(['usuario.persona'])->where('id_propiedad', $id)->get();
        return view('admin.servicios.form', ['usuarios' => $usuarios, 'propiedadID' => $item, 'servicios' => $servicios]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Servicio::$rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $data = $validator->validated();
            Servicio::create($data);
            return back()->with('success', 'Servicio guardado exitosamente.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrio un error, vuelve a intentarlo ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $servicio = Servicio::with(['usuario.persona', 'imagenes'])->find($id);
        if (!$servicio) {
            return redirect()->back()->with('error', 'No se encontró el servicio');
        }
        return view('admin.servicios.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuarios = User::with('persona')->where('rol', 'Cliente')->get();
        $servicio = Servicio::findOrFail($id);
        return view('admin.servicios.edit', compact('servicio', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(Servicio::$rulesupdate);

        try {
            $servicio = Servicio::findOrFail($id);
            $servicio->update($data);
            return redirect()->route('adm.servicios.show', $id)->with('success', 'Servicio guardado exitosamente.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error, vuelve a intentarlo. Detalle: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /// delete service
    }

    /**
     * Subida de imagenes de prueba para los servicios
     */
    public function store_imagen_servicio(Request $request)
    {
        $request->validate([
            'id_servicio' => 'required|integer|exists:servicios,id',
            'imagenes' => 'required|array',
            'imagenes.*' => 'image|max:2048', // Cada archivo debe ser una imagen y máximo 2MB
        ]);
        try {
            foreach ($request->file('imagenes') as $file) {
                // Guardar imagen en storage/app/public/servicios (puedes cambiar la ruta)
                $path = $file->store('servicios', 'public');
                // Crear registro en la base de datos con la ruta y el id_servicio
                ImagenServicio::create([
                    'path' => $path,
                    'id_servicio' => $request->id_servicio,
                ]);
            }

            return back()->with('success', 'Imágenes guardadas correctamente.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error, vuelve a intentarlo. Detalle: ' . $th->getMessage());
        }
    }
}
