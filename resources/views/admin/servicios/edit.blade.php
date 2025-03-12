@extends('layouts.app')

@section('title', ' Servicios- Agregar')

@section('content')

<section class="tab-components">
    <div class="container-fluid">
        <x-title-wrapper title="Editar Servicio" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Servicios', 'url' => route('adm.servicios.index')],
            ['label' => 'Editar Servicio', 'url' => null]
        ]" />

        @if (session('error'))
        <x-alert type="danger" title="danger" heading="Error" message="{{ session('error') }}" />
        @endif

        <div class="form-elements-wrapper">
            <div class=" card-style">
                <form class="card-body" action="{{ route('adm.servicios.agregar_nuevo') }}" method="POST">
                    @csrf
                    <input type="hidden" id="id_propiedad" name="id_propiedad" value="{{ $propiedadID->id }}">
                    <h6 class="mb-3">1. Detalles</h6>
                    <div class="row g-4">
                        <div class="mb-4 col-md-4 ecommerce-select2-dropdown">
                            <div class="form-floating form-floating-outline">
                                <select id="id_user" name="id_user"
                                    class="@error('id_user') is-invalid @enderror select2 form-select"
                                    data-allow-clear="true">
                                    @foreach($usuarios as $u)
                                    <option value="{{ $u->id }}">{{ $u->persona->name.'
                                        '.$u->persona->surnames }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="usuario">Cliente Seleccionar</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <select id="tipo_servicio" name="tipo_servicio"
                                    class="@error('tipo_servicio') is-invalid @enderror select2 form-select"
                                    data-allow-clear="true">
                                    @foreach ($tipoServicio as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <label for="tipo_servicio">Tipo de servicio</label>
                            </div>
                        </div>
                        <div class="col-md-4 select2-primary">
                            <div class="form-floating form-floating-outline">
                                <select id="detail" name="detail[]"
                                    class="@error('detail') is-invalid @enderror select2 form-select" multiple>
                                    <option value="pintura">Pintura</option>
                                    <option value="jardineria">Servicios de jardineria</option>
                                    <option value="alabanileria">Albañileria</option>
                                    <option value="construccion">Trabajos de construccion</option>
                                    <option value="electricidad">Electricidad</option>
                                    <option value="carpinteria">Carpinteria</option>
                                    <option value="volqueta">Volqueta</option>
                                    <option value="cemento">Cemento</option>
                                    <option value="yeso">Yeso</option>
                                </select>
                                <label for="detail">Servicios</label>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="mb-3">2. Trabajador</h6>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="worker" name="worker"
                                    class="@error('worker') is-invalid @enderror form-control" placeholder="Juan"
                                    value="{{ old('worker') }}" />
                                @error('worker')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <label for="worker">Nombre del trabajador</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input type="date" id="date_start" name="date_start"
                                    class="@error('date_start') is-invalid @enderror form-control"
                                    value="{{ old('date_start') ?? date(" Y-m-d")}}" />
                                @error('date_start')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <label for="date_start">Fecha Inicio</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input type="date" id="date_end" name="date_end"
                                    class="@error('date_end') is-invalid @enderror form-control"
                                    value="{{ old('date_end') }}" />
                                @error('date_end')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <label for="date_end">Fecha Fin</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" min="0" id="price" name="price"
                                    class="@error('price') is-invalid @enderror form-control"
                                    value="{{ old('price') }}" />
                                @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <label for="price">Precio</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <select id="status" name="status"
                                    class="@error('status') is-invalid @enderror select2 form-select"
                                    data-allow-clear="true">
                                    <option value="entregado">Entregado</option>
                                    <option value="en_proceso">En proceso</option>
                                    <option value="terminado">Terminado</option>
                                </select>
                                <label for="status">Estado de servicio</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <textarea class="@error('description') is-invalid @enderror form-control"
                                    id="description" name="description" rows={{4}} placeholder="Detalle...">
                                        {{ old('description') }}
                                    </textarea>
                                @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <label for="description">Descripción</label>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Enviar</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection