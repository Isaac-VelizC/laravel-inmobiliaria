@extends('layouts.app')

@section('content')

<section class="tab-components">
    <div class="container-fluid">
        <x-title-wrapper title="Propietarios" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Lista', 'url' => route('adm.propietarios.index')],
            ['label' => isset($propietario) ? 'Editar' : 'Nuevo', 'url' => null]
        ]" />

        @if (session('error'))
        <x-alert type="danger" title="danger" heading="Error" message="{{ session('error') }}" />
        @endif

        <div class="form-elements-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card-style mb-30">
                        <form action="{{ isset($propietario) ? route('adm.propietarios.update', $propietario->id) : route('adm.propietarios.store') }}" method="POST">
                            @csrf
                            @if(isset($propietario))
                                @method('PUT')
                            @endif
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="name" name="name"
                                            class="@error('name') is-invalid @enderror form-control"
                                            placeholder="Juan"
                                            value="{{ old('name', $propietario->name ?? '') }}" />
                                        @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <label for="name">Nombre propietario</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="surnames" name="surnames"
                                            class="@error('surnames') is-invalid @enderror form-control"
                                            placeholder="Perez"
                                            value="{{ old('surnames', $propietario->surnames ?? '') }}" />
                                        @error('surnames')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <label for="surnames">Apellido</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="email" id="email" name="email"
                                            class="@error('email') is-invalid @enderror form-control"
                                            placeholder="juan@gmail.com"
                                            value="{{ old('email', $propietario->email ?? '') }}" />
                                        @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <label for="email">Correo</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" id="phone" name="phone"
                                            class="@error('phone') is-invalid @enderror form-control"
                                            placeholder="7777777"
                                            value="{{ old('phone', $propietario->phone ?? '') }}" />
                                        @error('phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <label for="phone">Teléfono</label>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 d-flex flex-row justify-content-end gap-2">
                                <a href="{{ route('adm.propietarios.index') }}" class="main-btn secondary-btn-outline btn-hover">Cancelar</a>
                                <button type="submit" class="main-btn primary-btn btn-hover">
                                    {{ isset($propietario) ? 'Actualizar' : 'Crear' }}
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
