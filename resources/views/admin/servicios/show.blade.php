@extends('layouts.app')

@section('title', 'Servicio - Detalles')

@section('content')

<section class="table-components">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <x-title-wrapper title="Lista de servicios" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Servicios', 'url' => null],
            ['label' => 'Show', 'url' => null]
        ]" />

        <!-- ========== title-wrapper end ========== -->

        @if (session('success'))
        <x-alert type="success" title="Success" heading="Éxito" message="{{ session('success') }}" />
        @endif
        @if (session('error'))
        <x-alert type="danger" title="danger" heading="Error" message="{{ session('error') }}" />
        @endif

        <!-- ========== tables-wrapper start ========== -->
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3">Detalles de la propiedad <strong>{{
                                    $servicio->propiedad->name}}</strong> </h4>
                            <p>Cliente <strong>{{ $servicio->usuario->persona->name .' '.
                                    $servicio->usuario->persona->surnames}}</strong>
                            </p>
                        </div>
                        <div class="d-flex align-content-center flex-wrap gap-3">
                            <a href="{{ route('adm.servicios.agregar', $servicio->propiedad->id) }}"
                                class=" main-btn secondary-btn-outline">Volver</a>
                            <a href="{{ route('adm.servicios.editar', $servicio->id) }}" id="submitBtn"
                                class=" main-btn primary-btn">Editar</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-5">
                            <div class="card-style mb-4">
                                <h5 class="title mb-3">Detalles del servicio</h5>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Tipo de Servicio:</strong> {{
                                            $servicio->detail }}</li>
                                        <li class="list-group-item"><strong>Dirección:</strong> {{
                                            $servicio->propiedad->address }}</li>
                                        <li class="list-group-item"><strong>Detalles:</strong> {{ $servicio->detail }}
                                        </li>
                                        <li class="list-group-item"><strong>Nombre del trabajador:</strong> {{
                                            $servicio->worker }}
                                        </li>
                                        <li class="list-group-item"><strong>Fecha inicio:</strong> {{
                                            $servicio->date_start }}</li>
                                        <li class="list-group-item"><strong>Fecha fin:</strong> {{$servicio->date_end }}
                                        </li>
                                        <li class="list-group-item"><strong>Precio:</strong> {{$servicio->price }}</li>
                                        <li class="list-group-item"><strong>Estado:</strong> {{ $servicio->status }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="card-style mb-4">
                                <h5 class="title mb-3">Información de la servicio existente </h5>
                                <div>
                                    <div class="my-2">
                                        <p>{{ $servicio->description }}</p>
                                    </div>
                                    <h4 class="title mb-3">Imagenes de Prueba</h4>
                                    @if(session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    <form action="{{ route('adm.servicios.agregar_imagen') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_servicio" value="{{ $servicio->id }}">

                                        <label class="form-label">Subir Imágenes</label>
                                        <input class="form-control" type="file" id="imagenes" name="imagenes[]"
                                            multiple>
                                        <div class="mt-3 text-center">
                                            <button type="submit" class="main-btn primary-btn-outline">Guardar</button>
                                        </div>
                                    </form>
                                    <br>
                                    <div class="row">
                                        @foreach ($servicio->imagenes as $imagen)
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <img class="card-img-top" src="{{ asset('storage/' . $imagen->path) }}"
                                                    alt="{{ $imagen->id }}" height="70" style="object-fit: cover;">
                                                <div>
                                                    <a href="{{ route('adm.servicios.delete_imagen', $imagen->id) }}" class="text-danger p-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                            <path
                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== tables-wrapper end ========== -->
    </div>
</section>

@endsection