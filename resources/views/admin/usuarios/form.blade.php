@extends('layouts.app')

@section('content')

<section class="tab-components">
    <div class="container-fluid">
        <x-title-wrapper title="Usuarios" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Usuarios', 'url' => route('adm.usuarios.index')],
            ['label' => isset($usuario) ? 'Editar' : 'Nuevo', 'url' => null]
        ]" />

        @if (session('error'))
            <x-alert type="danger" title="Error" heading="Error" message="{{ session('error') }}" />
        @endif

        <div class="form-elements-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card-style mb-30">
                        <div class="card-header mb-30">
                            <h4>{{ isset($usuario) ? 'Editar información del' : 'Registrar nuevo' }} usuario</h4>
                        </div>
                        <form action="{{ isset($usuario) ? route('adm.usuarios.update', $usuario->id) : route('adm.usuarios.store') }}" method="POST">
                            @csrf
                            @isset($usuario)
                                @method('PUT')
                            @endisset
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Juan"
                                            value="{{ old('name', $usuario->persona->name ?? '') }}" />
                                        <label for="name">Nombre del Usuario</label>
                                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="surnames" name="surnames" class="form-control @error('surnames') is-invalid @enderror"
                                            placeholder="Perez" value="{{ old('surnames', $usuario->persona->surnames ?? '') }}" />
                                        <label for="surnames">Apellidos</label>
                                        @error('surnames') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="********" />
                                        <label for="password">Contraseña</label>
                                        @if ($usuario)
                                            <span class="text-warning">Solo Ingresar la contraseña si es necesario</span>
                                        @endif
                                        @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="7777777" value="{{ old('phone', $usuario->persona->phone ?? '') }}" />
                                        <label for="phone">Teléfono</label>
                                        @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror"
                                            placeholder="Dirección" value="{{ old('address', $usuario->persona->address ?? '') }}" />
                                        <label for="address">Dirección</label>
                                        @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            placeholder="juan@gmail.com" value="{{ old('email', $usuario->email ?? '') }}" />
                                        <label for="email">Correo</label>
                                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <select id="rol" name="rol" class="select2 form-select" data-placeholder="Rol" required>
                                            @foreach($rols as $rol)
                                                <option value="{{ $rol->name }}" {{ old('rol', $usuario->rol ?? '') == $rol->name ? 'selected' : '' }}>
                                                    {{ $rol->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="rol">Rol del usuario</label>
                                        @error('rol') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div id="oficina-container" class="col-md-6 col-lg-4 {{ old('rol', $usuario->rol ?? '') === 'Agente' ? '' : 'd-none' }}">
                                    <div class="form-floating form-floating-outline">
                                        <select id="oficina" name="oficina" class="select2 form-select" data-placeholder="Oficina" {{ old('rol', $usuario->rol ?? '') === 'Agente' ? 'required' : '' }}>
                                            <option value="" selected>Seleccionar Oficina</option>
                                            @foreach($oficinas as $office)
                                                <option value="{{ $office->id }}" {{ old('oficina', $usuario->agente->id ?? '') == $office->id ? 'selected' : '' }}>
                                                    {{ $office->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="oficina">Oficina</label>
                                        @error('oficina') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 d-flex flex-row justify-content-end gap-2">
                                <a href="{{ route('adm.usuarios.index') }}" class="main-btn secondary-btn-outline btn-hover">Cancelar</a>
                                <button type="submit" class="main-btn primary-btn btn-hover">
                                    {{ isset($usuario) ? 'Actualizar' : 'Crear' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#rol').on('change', function() {
            if ($(this).val() === 'Agente') {
                $('#oficina-container').removeClass('d-none').find('select').attr('required', true);
            } else {
                $('#oficina-container').addClass('d-none').find('select').removeAttr('required');
            }
        });
    });
</script>
@endpush