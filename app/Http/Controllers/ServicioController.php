<?php

namespace App\Http\Controllers;

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
        $items = Servicio::with(['usuario.persona', 'tipoServicio'])->get();
        // Transformar los datos de los servicios
        $data = $items->map(function ($item) {
            return [
                'id' => $item->id,
                'client' => $item->usuario->persona->name . ' ' . $item->usuario->persona->surnames,
                'tipo_servicio' => $item->tipoServicio->name,
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
        $tipoServicio = ServiciosTipo::all();
        $servicios = Servicio::with(['usuario.persona', 'tipoServicio'])->where('id_propiedad', $id)->get();
        return view('admin.servicios.form', ['usuarios' => $usuarios, 'tipoServicio' => $tipoServicio, 'propiedadID' => $item, 'servicios' => $servicios]);
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
            $detail = implode('|', $request->detail);
            $data = $validator->validated();
            $data['detail'] = $detail;
            Servicio::create($data);
            //$propiedad = Propiedades::findOrFail($request->id_propiedad);
    
            return back()->with('success', 'Servicio guardado exitosamente.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrio un error, vuelve a intentarlo '. $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $servicio = Servicio::with(['usuario.persona', 'imagenes', 'tipoServicio'])->find($id);
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
