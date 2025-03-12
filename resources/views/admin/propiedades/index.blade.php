@extends('layouts.app')

@section('content')
@php
use App\Models\Visita;
@endphp
<section class="card-components">
    <div class="container-fluid">
        @if ($propietario)
        <x-title-wrapper title="{{ 'Propiedades de ' . $propietario->name . ' ' . $propietario->surnames }}"
            :breadcrumbs="[
                    ['label' => 'Panel', 'url' => route('home')],
                    ['label' => 'Propiedades', 'url' => null]
                ]" />
        @else
        <x-title-wrapper title="Propiedades" :breadcrumbs="[
                    ['label' => 'Panel', 'url' => route('home')],
                    ['label' => 'Propiedades', 'url' => null]
                ]" />
        @endif

        @if (session('success'))
        <x-alert type="success" title="Success" heading="Éxito" message="{{ session('success') }}" />
        @endif
        @if (session('error'))
        <x-alert type="danger" title="danger" heading="Error" message="{{ session('error') }}" />
        @endif

        <div class="cards-styles">
            <div class="row">
                @if (count($propiedades) > 0)
                @foreach ($propiedades as $propiedad)
                @php
                $visita = Visita::obtenerTotalVisitas($propiedad->id);
                @endphp
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="card-style-1 mb-30">
                        <div class="card-meta">
                            <p class="text-sm text-medium">
                                Propietario : {{ $propiedad->propiet->name . ' '. $propiedad->propiet->surnames }}
                            </p>
                        </div>
                        <div class="card-image">
                            @if($propiedad->imagenes)
                            @foreach($propiedad->imagenes as $imagen)
                            @if($imagen->type == 'casa_fuera')
                            <img class="card-img-top" src="{{ asset('storage/' . $imagen->path) }}"
                                alt="{{ $propiedad->name }}" style="height: 200px; object-fit: cover; width: 100%;" />
                            @endif
                            @endforeach
                            @else
                            <img class="card-img-top" src="{{ asset('assets/img/property-2.jpg') }}"
                                alt="Imagen por defecto" style="height: 200px; object-fit: cover; width: 100%;" />
                            @endif
                        </div>

                        <div class="card-content">
                            <h4><a href="{{ route('adm.propiedades.show', $propiedad->id )}}">{{ $propiedad->name }}</a></h4>
                            <p>Dirección: {{ $propiedad->address }}</p>
                            <p>Precio: {{ $propiedad->price." ".$propiedad->coin }}</p>
                            <p><span class="mdi mdi-home-city-outline"></span> {{ "Hab: ".$propiedad->num_rooms }} -
                                <span class="mdi mdi-toilet"></span> {{"Baños: ".$propiedad->num_bathrooms }} -
                                <span class="mdi mdi-garage-open-variant"></span> {{"Garaje: ".$propiedad->num_garages
                                }}
                            </p>
                            <br>
                            <div class="mt-2 gap-1">
                                <a href="{{ route('adm.propiedades.show', $propiedad->id )}}"
                                    class=" main-btn info-btn-outline">Detalles</a>
                                <a href="{{ route('adm.propiedades.citas', $propiedad->id) }}"
                                    class=" main-btn primary-btn-outline">Citas</a>
                                <a href="" class=" main-btn warning-btn-outline">
                                    <span class="mdi mdi-eye-outline me-2"></span>{{ $visita }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="text-center my-5">
                    <h4>No hay Propiedades {{ $propietario ? 'de '. $propietario->name .' '. $propietario->surnames :
                        'registrados' }}</h4>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        setTimeout(function() {
                $('.alert-box').fadeOut('slow');
            }, 3000);
    });
</script>
@endpush