@extends('layouts.app')

@section('content')

<section class="table-components">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <x-title-wrapper title="{{$cita->name}}" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Grupo de citas', 'url' => route('adm.citas.group.index')],
            ['label' => $cita->name, 'url' => null]
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
                <div class="col-lg-12 mb-30">
                    <div class="title d-flex flex-wrap justify-content-between align-items-center mb-30">
                        <div class="left">
                            <h6 class="mb-10">Información de la cita</h6>
                        </div>
                        <div class="right g-4">
                            <a href="#" class="main-btn danger-btn-light rounded-full btn-hover">Borrar</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-5">
                            <div class="card-style mb-30">
                                <h5 class="card-tile mb-4">Detalles de la cita</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Nombre:</strong> {{ $cita->name }}</li>
                                    <li class="list-group-item"><strong>Fecha:</strong> {{ $cita->date }}</li>
                                    <li class="list-group-item"><strong>Hora:</strong> {{ $cita->time }}</li>
                                    <li class="list-group-item"><strong>Agente:</strong> {{ $agente }}</li>
                                    <li class="list-group-item"><strong>Propiedad:</strong> {{ $cita->hacienda->name }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="card-style mb-4">
                                <div class="d-flex justify-content-between align-content-center mb-4">
                                    <h5 class="mb-0">Usuarios Registrados</h5>
                                </div>
                                @if (count($users) > 0)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Email</th>
                                                <th>Teléfono</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $item)
                                                <tr>
                                                    <td>{{ $item->usuarioCita->persona->name .' '. $item->usuarioCita->persona->surnames }}</td>
                                                    <td>{{ $item->usuarioCita->email }}</td>
                                                    <td>{{ $item->usuarioCita->persona->phone }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="text-center">
                                        <h5>No hay usuarios registrados aún</h5>
                                    </div>
                                @endif
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