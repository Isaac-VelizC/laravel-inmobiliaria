@extends('layouts.app')

@section('content')

<section class="table-components">
    <div class="container-fluid">
        <x-title-wrapper title="Roles y Permisos" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Usuarios', 'url' => route('adm.usuarios.index')],
            ['label' => 'Roles y Permisos', 'url' => null]
        ]" />

        @if (session('success'))
        <x-alert type="success" title="Éxito" message="{{ session('success') }}" heading="Mensaje" />
        @endif
        @if (session('error'))
        <x-alert type="danger" title="Error" message="{{ session('error') }}" />
        @endif

        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="table-responsive">
                            <div class="card-body">
                                <form action="{{ route('roles.asignar.permisos') }}" method="POST">
                                    @csrf
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Permisos</th>
                                                @foreach ($roles as $role)
                                                <th class="text-center">{{ $role->name }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permisos as $permiso)
                                            <tr>
                                                <td>{{ $permiso->name }}</td>
                                                @foreach ($roles as $role)
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-check-input permiso-checkbox"
                                                        name="permisos[{{ $role->id }}][]" value="{{ $permiso->id }}" {{
                                                        $role->hasPermissionTo($permiso->name) ? 'checked' : '' }}>
                                                </td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection