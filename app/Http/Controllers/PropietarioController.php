<?php

namespace App\Http\Controllers;

use App\Models\Propiedade;
use App\Models\Propietario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropietarioController extends Controller
{
    public function index()
    {
        return view('admin.propietario.index');
    }

    public function propiedadesPropietario($id)
    {
        $propiedades = Propiedade::where('propietario', $id)->get();
        $propietario = Propietario::findOrfail($id);
        return view('admin.propiedades.index', [
            'propiedades' => $propiedades,
            'propietario' => $propietario,
            'esDetalle' => true
        ]);
    }

    public function create()
    {
        return view('admin.propietario.form');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'surnames' => 'required|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'ci' => 'nullable|string|max:9|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'address' => 'nullable|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'email' => 'required|email|max:255|regex:/^[\w\.-]+@[\w\.-]+\.\w+$/',
            'phone' => 'required|string|min:8|max:10|regex:/^\d+$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Propietario::create($request->all());

        return redirect()->route('adm.propietarios.index')->with('success', 'Propietario creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $propietario = Propietario::findOrFail($id);
        return view('admin.propietario.form', ['propietario' => $propietario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'surnames' => 'required|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'ci' => 'nullable|string|max:9|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'address' => 'nullable|string|max:100|regex:/^[A-Za-zÑñáéíóúÁÉÍÓÚ ]+$/',
            'email' => 'required|email|max:255|regex:/^[\w\.-]+@[\w\.-]+\.\w+$/',
            'phone' => 'required|string|min:8|max:10|regex:/^\d+$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $propietario = Propietario::findOrFail($id);
        $propietario->update($request->all());

        return redirect()->route('adm.propietarios.index')->with('success', 'Propietario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Propietario $propietario)
    {
        $propietario->delete();
        return redirect()->route('adm.propietarios.index')->with('success', 'Propietario eliminado exitosamente.');
    }

    public function ajax_propietarios()
    {
        $data = Propietario::all();
        return datatables()
            ->of($data)
            ->addColumn('action', 'admin.propietario.botones')
            ->rawColumns(['action'])
            ->toJson();
    }
}
