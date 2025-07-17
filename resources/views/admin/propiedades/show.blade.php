@extends('layouts.app')

@section('title', $propiedad->name)


@section('og_title', $propiedad->name)
@section('og_description', $message)
@php
$og_img = asset('imgs/casaprime_realthy.webp');
if($portadaPublic){
$og_img = $portadaPublic->path;
}
@endphp
@section('og_image', $og_img)
@section('og_url', $urlPublic)

@section('content')
<style>
    /* Mostrar los botones con texto por defecto */
    .social-buttons .btn-text {
        display: inline-block;
    }

    /* Ocultar los textos en pantallas pequeñas */
    @media screen and (max-width: 768px) {
        .social-buttons .btn-text {
            display: none;
            /* Oculta el texto */
        }

        .social-buttons a i {
            font-size: 24px;
            /* Tamaño de los iconos */
        }
    }
</style>
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
            @can('Borrar Propiedad')
            <button type="button" onclick="abrirModalDeletePropiedad()"
                class=" main-btn danger-btn-light btn-hover">Eliminar</button>
            @endcan
            <a href="{{ route('adm.servicios.agregar', $propiedad->id ) }}"
                class=" main-btn info-btn-light btn-hover">Servicio</a>
            <a href="{{ route('adm.subir.imagenes', $propiedad->id ) }}"
                class="main-btn success-btn-light btn-hover">Imagenes</a>
            @can('Editar Propiedad')
            <a href="{{ route('adm.propiedades.editar', $propiedad->id) }}" id="submitBtn"
                class="main-btn primary-btn-light btn-hover">Editar</a>
            @endcan
        </div>

        <div class="cards-styles">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="card-style mb-30">
                        <h5 class="card-tile mb-4">Detalles de la Propiedad</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nombre de la propiedad:</strong> {{ $propiedad->name }}
                            </li>
                            <li class="list-group-item"><strong>Propietario:</strong> {{ $propiedad->propiet->name . ' '
                                . $propiedad->propiet->surnames }}</li>
                            <li class="list-group-item"><strong>Teléfono:</strong> {{ $propiedad->propiet->phone }}</li>
                            <li class="list-group-item"><strong>Dirección:</strong> {{ $propiedad->address }}</li>
                            <li class="list-group-item"><strong>Ciudad:</strong> {{ $propiedad->city }}</li>
                            <li class="list-group-item"><strong>Tipo de Propiedad:</strong> {{
                                $propiedad->tipoPropiedad->name }}</li>
                            <li class="list-group-item"><strong>Tipo de Venta:</strong> {{
                                $propiedad->tipoTraspaso->name }}</li>
                            <li class="list-group-item"><strong>Superficie Construida:</strong>
                                {{$propiedad->superficie_construida }} m²</li>
                            <li class="list-group-item"><strong>Superficie Terreno:</strong>
                                {{$propiedad->superficie_terreno }} m²</li>
                            <li class="list-group-item"><strong>Publicidad:</strong> {{ $propiedad->state_advertising }}
                            </li>
                            <li class="list-group-item"><strong>Precio:</strong> {{ $propiedad->price . ' ' .
                                $propiedad->coin }}</li>
                            <li class="list-group-item"><strong>Estado:</strong> {{ $propiedad->status }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class=" card-style mb-4">
                        <div class="d-flex justify-content-between align-content-center mb-4">
                            <h5 class="mb-0">Información de la propiedad existente </h5>
                            <div class="social-buttons">
                                <a class="main-btn primary-btn-outline rounded-full"
                                    href="{{ $shareLinks['facebook'] }}" target="_blank" data-network="facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                    </svg>
                                    <span class="btn-text">Facebook</span> <!-- Text for larger screens -->
                                </a>
                                <a class="main-btn info-btn-outline rounded-full"
                                    href="https://api.whatsapp.com/send?text={{ urlencode($message . ' ' . $urlPublic) }}"
                                    target="_blank" rel="noopener">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-whatsapp" viewBox="0 0 16 16">
                                        <path
                                            d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                    </svg>
                                    <span class="btn-text">WhatsApp</span> <!-- Text for larger screens -->
                                </a>
                            </div>
                        </div>
                        <div>
                            <p class="d-flex flex-wrap">
                                <span class="mdi mdi-home-city-outline">{{ " Ambientes: ".$propiedad->num_rooms
                                    }}</span>
                                <span class="mdi mdi-toilet">{{ " Baños: ".$propiedad->num_bathrooms }}</span>
                                <span class="mdi mdi-garage-open-variant">{{ " Garaje: ".$propiedad->num_garages
                                    }}</span>
                                <span class="mdi mdi-countertop">{{ " Cocina: ".$propiedad->num_kitchens }}</span>
                                <span class="mdi mdi-bed-king-outline">{{ " Dormitorio: ".$propiedad->num_bedrooms
                                    }}</span>
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
                                        <img class="card-img-top" src="{{ asset('storage/' . $imagen->path)  }}"
                                            alt="{{$imagen->id  }}" height={{ 70 }} style="object-fit: cover;">
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
                    <button type="button" class="main-btn secondary-btn-outline"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="main-btn danger-btn-outline" data-bs-dismiss="modal">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection