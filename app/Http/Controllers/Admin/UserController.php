<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\Agente;
use App\Models\Oficina;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function ajax_usuarios()
    {
        $users = User::with('persona')->where('rol', '!=', 'Admin')->latest()->get();
        $data = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->persona->name . ' ' . $user->persona->surnames ?? 'Sin nombre',
                'email' => $user->email ?? 'Sin email',
                'phone' => optional($user->persona)->phone ?? 'Sin teléfono',
                'rol' => ucfirst($user->rol),
                'status' => $user->status,
            ];
        });

        return datatables()
            ->of($data)
            ->addColumn('action', 'admin.usuarios.botones')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function index()
    {
        return view('admin.usuarios.index');
    }

    public function create()
    {
        $usuario = null;
        $rols = Role::where('name', '!=', 'Admin')->get();
        $oficinas = Oficina::all();
        return view('admin.usuarios.form', compact('oficinas', 'rols', 'usuario'));
    }

    public function store(UserCreateRequest $request)
    {
        try {
            if ($request->rol === 'Agente' && $request->oficina === null) {
                return redirect()->back()->with('error', 'Debes seleccionar una oficina para el Agente.');
            }
            //DB::transaction(function () use ($request) {
            // Crear usuario
            $user = User::create([
                'name' => $request->email,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'rol' => $request->rol
            ]);

            // Asignar rol con Spatie
            $user->assignRole($request->rol);

            // Si el usuario es Agente, crear su registro en la tabla agentes
            if ($request->rol === 'Agente') {
                Agente::create([
                    'oficina' => $request->oficina,
                    'id_user' => $user->id
                ]);
            }

            // Crear persona asociada al usuario
            Persona::create([
                'name' => $request->name,
                'surnames' => $request->surnames,
                'phone' => $request->phone,
                'address' => $request->address,
                'id_user' => $user->id,
            ]);
            //});

            return redirect()->route('adm.usuarios.index')->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'No se pudo registrar al usuario. ' . $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $usuario = User::with(['persona', 'agente'])->findOrFail($id);
        $rols = Role::where('name', '!=', 'Admin')->get();
        $oficinas = Oficina::all();
        return view('admin.usuarios.form', compact('oficinas', 'rols', 'usuario'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        // Validar que un Agente tenga oficina
        if ($request->rol === 'Agente' && !$request->oficina) {
            return redirect()->back()->with('error', 'Debes seleccionar una oficina para el Agente.');
        }

        // Buscar el usuario y actualizar datos
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->email,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
            'rol' => $request->rol
        ]);

        // Asignar rol con Spatie
        $user->syncRoles([$request->rol]);

        // Si el usuario es Agente, actualizar o crear su registro en la tabla agentes
        if ($request->rol === 'Agente') {
            Agente::updateOrCreate(
                ['id_user' => $id],
                ['oficina' => $request->oficina]
            );
        }

        // Actualizar o crear persona asociada al usuario
        Persona::updateOrCreate(
            ['id_user' => $id],
            [
                'name' => $request->name,
                'surnames' => $request->surnames,
                'phone' => $request->phone,
                'address' => $request->address
            ]
        );

        return redirect()->route('adm.usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function toggleStatus(string $id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return redirect()->back()->with('error', 'No se encontró al usuario');
        }

        // Cambia el estado del usuario
        if ($user->status === 'activo') {
            $user->status = 'inactivo';
            $message = 'El usuario ha sido inactivado';
        } else {
            $user->status = 'activo';
            $message = 'El usuario ha sido activado';
        }

        $user->save(); // Guarda los cambios

        return redirect()->back()->with('success', $message);
    }

    ///ROLES Y PERMISOS
    public function indexRoles()
    {
        $permisos = Permission::all();
        $roles = Role::with('permissions')->get();
        return view('admin.usuarios.roles.index', compact('roles', 'permisos'));
    }

    public function asignarPermisos(Request $request)
    {
        // Obtener todos los roles
        $roles = Role::all();

        foreach ($roles as $role) {
            // Verificar si el rol tiene permisos en la solicitud
            if ($request->has("permisos.{$role->id}")) {
                $permisosIds = $request->input("permisos.{$role->id}", []);

                // Convertir IDs en nombres de permisos
                $permisos = Permission::whereIn('id', $permisosIds)->pluck('name')->toArray();
            } else {
                // Si el rol NO está en la solicitud, se queda sin permisos
                $permisos = [];
            }

            // Sincronizar permisos (elimina los no seleccionados y asigna los nuevos)
            $role->syncPermissions($permisos);
        }
        return redirect()->back()->with('success', 'Permisos actualizados correctamente.');
    }
}
