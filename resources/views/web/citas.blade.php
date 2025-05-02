@extends('layouts.client.app')

@section('title', 'Citas')

@section('content')
<!--/ Intro Single star /-->
<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">Citas de la {{ $propiedad->name }}</h1>
                    <span class="color-text-a">{{ $propiedad->city. ', '. $propiedad->address }}</span>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.propiedades') }}">Propiedades</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $propiedad->name }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!--/ Intro Single End /-->

<div class="th-checkout-wrapper space-top space-extra-bottom">
    <div class="container">
        <!-- Mensajes de error y éxito -->
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Sección de citas disponibles -->
        <h4>Propiedad: <a href="{{ route('propiedades.detalle', $propiedad->id) }}">{{$propiedad->name }}</a></h4>
        <div class="mb-4">
            <div>Horarios de atención: 8:00 a 12:00 y 14:00 a 18:00</div>
        </div>

        @if ($citas && count($citas) > 0)
        <div class="row my-3">
            @foreach ($citas as $item)
            @php
            $citaLlena = $item->userCitas->count() >= $item->cantidad;
            $fechaPasada = now()->toDateString() > $item->date;
            $usuarioTieneCita = $misCitas->contains('group', $item->id);
            @endphp

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm {{ $fechaPasada ? 'bg-light' : '' }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">
                            <strong>Fecha:</strong> {{ $item->date }}<br>
                            <strong>Hora:</strong> {{ $item->time }}<br>
                            <small>Cupos: {{ $item->cantidad - $item->userCitas->count() }}/{{ $item->cantidad
                                }}</small>
                        </p>

                        @role('Cliente')
                        @if($fechaPasada)
                        <button class="btn btn-secondary btn-sm" disabled>Cita Expirada</button>
                        @elseif($citaLlena)
                        <button class="btn btn-danger btn-sm" disabled>Cupo Lleno</button>
                        @elseif($usuarioTieneCita)
                        <button class="btn btn-success btn-sm" disabled>Ya Registrado</button>
                        @else
                        <a href="{{ route('programar.cita', $item->id) }}" class="btn btn-primary btn-sm">Programar</a>
                        @endif
                        @endrole
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-info" role="alert">
            No hay citas disponibles para programar.
        </div>
        @endif

        <!-- Sección de citas del usuario -->
        <h4 class="mt-4 pt-lg-2">Tus Citas</h4>
        <div class="table-responsive d-none d-md-block">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Propiedad</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Encuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($misCitas as $c)
                    <tr>
                        <td>{{ $c->propiedadCita->name }}</td>
                        <td>{{ $c->groupCita->date }}</td>
                        <td>{{ $c->groupCita->time }}</td>
                        <td>
                            <span class="status status-{{ strtolower($c->groupCita->status) }}">
                                {{ ucfirst($c->groupCita->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($c->groupCita->status == "concretada")
                            <button onclick="VerEncuesta({{ $c->id }}, {{ $propiedad->id }});"
                                class="btn btn-primary btn-sm" type="button">Encuesta</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No tienes citas programadas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Versión móvil de las citas -->
        <div class="d-md-none">
            @forelse($misCitas as $c)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $c->propiedadCita->name }}</h5>
                    <p class="mb-1">
                        <strong>Fecha:</strong> {{ $c->groupCita->date }}<br>
                        <strong>Hora:</strong> {{ $c->groupCita->time }}
                    </p>
                    <p class="mb-1">
                        <strong>Estado:</strong>
                        <span class="status status-{{ strtolower($c->groupCita->status) }}">
                            {{ ucfirst($c->groupCita->status) }}
                        </span>
                    </p>
                    @if ($c->groupCita->status == "concretada")
                    <button onclick="VerEncuesta({{ $c->group }}, {{  $c->propiedadCita->id }});"
                        class="btn btn-primary btn-sm mt-2">Encuesta</button>
                    @endif
                </div>
            </div>
            @empty
            <div class="alert alert-info">No tienes citas programadas</div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .status {
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.9em;
        display: inline-block;
    }

    .status-concretada {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .status-confirmada {
        background: #d4edda;
        color: #152d57;
        border: 1px solid #c3e6cb;
    }

    .status-pendiente {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
    }

    .status-cancelada {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .card-title {
        font-size: 1.1rem;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
<script>
    function VerEncuesta(id, idp) {
        const url = `{{ route('usuario.citas.encuesta') }}/${id}/${idp}`;
        window.open(url, 'Encuesta', 'width=800,height=600,scrollbars=yes');
    }
</script>
@endsection