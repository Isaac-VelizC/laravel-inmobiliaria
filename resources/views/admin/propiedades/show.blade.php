@extends('layouts.app')

@section('content')
<section class="card-components">
    <div class="container-fluid">
        <x-title-wrapper title="Detalles de la propiedad" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Propiedades', 'url' => route('adm.index.propiedades')],
            ['label' => $propiedad->name, 'url' => null]
        ]" />

        @if (session('error'))
        <x-alert type="danger" title="danger" heading="Error" message="{{ session('error') }}" />
        @endif
        <div class="d-flex align-content-center justify-content-end flex-wrap gap-3 my-4">
            <button type="button" onclick="abrirModalDeletePropiedad()" class=" main-btn danger-btn-light btn-hover">Eliminar</button>
            <a href="{{ route('adm.servicios.agregar', $propiedad->id ) }}" class=" main-btn info-btn-light btn-hover">Servicio</a>
            <a href="{{ route('adm.subir.imagenes', $propiedad->id ) }}" class="main-btn success-btn-light btn-hover">Imagenes</a>
            <a href="{{ route('adm.propiedades.editar', $propiedad->id) }}" id="submitBtn" class="main-btn primary-btn-light btn-hover">Editar</a>
        </div>

        <div class="cards-styles">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="card-style mb-30">
                        <h5 class="card-tile mb-4">Detalles de la Propiedad</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nombre de la propiedad:</strong> {{ $propiedad->name }}</li>
                            <li class="list-group-item"><strong>Propietario:</strong> {{ $propiedad->propiet->name . ' ' . $propiedad->propiet->surnames }}</li>
                            <li class="list-group-item"><strong>Teléfono:</strong> {{ $propiedad->propiet->phone }}</li>
                            <li class="list-group-item"><strong>Dirección:</strong> {{ $propiedad->address }}</li>
                            <li class="list-group-item"><strong>Ciudad:</strong> {{ $propiedad->city }}</li>
                            <li class="list-group-item"><strong>Tipo de Propiedad:</strong> {{ $propiedad->tipoPropiedad->name }}</li>
                            <li class="list-group-item"><strong>Tipo de Venta:</strong> {{ $propiedad->tipoTraspaso->name }}</li>
                            <li class="list-group-item"><strong>Superficie Construida:</strong> {{$propiedad->superficie_construida }} m²</li>
                            <li class="list-group-item"><strong>Superficie Terreno:</strong> {{$propiedad->superficie_terreno }} m²</li>
                            <li class="list-group-item"><strong>Publicidad:</strong> {{ $propiedad->state_advertising }}</li>
                            <li class="list-group-item"><strong>Precio:</strong> {{ $propiedad->price . ' ' . $propiedad->coin }}</li>
                            <li class="list-group-item"><strong>Estado:</strong> {{ $propiedad->status }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class=" card-style mb-4">
                        <div class="d-flex justify-content-between align-content-center mb-4">
                            <h5 class="mb-0">Información de la propiedad existente </h5>
                            <a class="main-btn primary-btn-outline rounded-full" href="{{ $shareLinks['facebook'] }}" target="_blank" data-network="facebook">
                                <span>Facebook</span>
                            </a>
                        </div>
                        <div>
                        <p class="d-flex flex-wrap">
                            <span class="mdi mdi-home-city-outline">{{ " Ambientes: ".$propiedad->num_rooms }}</span>
                            <span class="mdi mdi-toilet">{{ " Baños: ".$propiedad->num_bathrooms }}</span>
                            <span class="mdi mdi-garage-open-variant">{{ " Garaje: ".$propiedad->num_garages }}</span>
                            <span class="mdi mdi-countertop">{{ " Cocina: ".$propiedad->num_kitchens }}</span>
                            <span class="mdi mdi-bed-king-outline">{{ " Dormitorio: ".$propiedad->num_bedrooms }}</span>
                            <span class="mdi mdi-sofa-outline">{{ " Sala: ".$propiedad->num_hall }}</span>
                        </p>  
                        <div class="mt-2 mb-4">
                            <p>{{ $propiedad->description }}</p>
                        </div>
                        <h4 class="mb-4">Imagenes</h4>
                        <div class="row">
                            @if (count($propiedad->imagenes) > 0)
                                @foreach ($propiedad->imagenes as $imagen)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img class="card-img-top"
                                            src="{{ asset('storage/' . $imagen->path)  }}" alt="{{$imagen->id  }}"
                                            height={{ 70 }} style="object-fit: cover;">
                                        <div>
                                            <p>{{ $imagen->type }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center my-5">
                                    <h4>No hay Imagenes de la Propiedad</h4>
                                </div>
                            @endif
                        </div>
                        @if (count($imagen360) > 0)
                            <div id="panorama" style="width: 100%; height: 400px;"></div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    var scenes = {
        @foreach ($imagen360 as $imagen)
            "scene_{{ $imagen->id }}": {
                "type": "equirectangular",
                "panorama": "{{ asset('storage/'.$imagen->path) }}",
                "autoLoad": true,
                "hotSpots": [
                    @foreach ($imagen->hotspots as $hotspot)
                        {
                            "pitch": {{ $hotspot->pitch }},
                            "yaw": {{ $hotspot->yaw }},
                            "type": "scene",
                            "text": "{{ $hotspot->nombre }}",
                            "sceneId": "scene_{{ $hotspot->targetScene }}",
                            "cssClass": "custom-hotspot"
                        },
                    @endforeach
                ]
            },
        @endforeach
    };

    // Inicializa el visor con la primera imagen
    var viewer = pannellum.viewer('panorama', {
        default: {
            firstScene: "scene_{{ $imagen360->first()->id ?? '' }}"
        },
        scenes: scenes
    });

    function abrirModalDeletePropiedad() {
        $('#modalDeletePropiedad').modal('show');
    }
</script>

<!-- Modal Eliminar propiedad -->
<div class="modal fade" id="modalDeletePropiedad" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel4">Eliminar Propiedad {{ $propiedad->name }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('adm.propiedades.destroy', $propiedad->id )}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Estas seguro de que quiere eliminar la propiedad</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="main-btn secondary-btn-outline" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="main-btn danger-btn-outline" data-bs-dismiss="modal">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection