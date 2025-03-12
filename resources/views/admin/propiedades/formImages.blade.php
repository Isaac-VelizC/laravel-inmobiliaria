@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css">
<script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
<style>
    #panorama {
        width: 100%;
        height: 400px;
    }

    .thumbnail-container {
        display: flex;
        overflow-x: auto;
        margin-top: 10px;
    }

    .thumbnail {
        width: 100px;
        cursor: pointer;
        margin: 5px;
    }

    .image-select-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .image-option {
        cursor: pointer;
        border: 2px solid transparent;
        padding: 5px;
        border-radius: 5px;
        text-align: center;
    }

    .image-option img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }

    .image-option.selected {
        border-color: blue;
    }

    .custom-hotspot {
        width: 20px;
        height: 20px;
        background-color: black;
        border-radius: 50%;
        border: 3px solid white;
    }

    .property-slider-img {
        width: 100%;
        height: 550px;
        /* Ajusta según lo que necesites */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .property-slider-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Cubre el div sin deformarse */
        object-position: center;
        /* Centra la imagen dentro del contenedor */
    }

    /* Miniaturas */
    .property-thumb-slider .swiper-slide {
        width: 100%;
        height: 140px;
        /* Altura fija de miniaturas */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .property-thumb-slider .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        cursor: pointer;
        border-radius: 5px;
        transition: transform 0.3s ease-in-out;
    }
</style>

<section class="card-components">
    <div class="container-fluid">
        <x-title-wrapper title="Administrar Imagenes" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Propiedades', 'url' => route('adm.index.propiedades')],
            ['label' => $propiedad->name, 'url' => route('adm.propiedades.show', $propiedad->id)],
            ['label' => 'Imagenes', 'url' => null]
        ]" />

        @if (session('success'))
        <x-alert type="success" title="Success" heading="Éxito" message="{{ session('success') }}" />
        @endif
        @if (session('error'))
        <x-alert type="danger" title="danger" heading="Error" message="{{ session('error') }}" />
        @endif
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
            <h4 class="mt-3 mb-4 mb-lg-0">Subir Imágenes de la propiedad de {{ $propietario->name }} {{ $propietario->surnames }}</h4>
            <div class="d-flex align-content-center justify-content-end gap-3">
                <a href="{{ route('adm.propiedades.show', $propiedad->id) }}" class="main-btn danger-btn-outline">Volver</a>
                <a href="{{ route('adm.propiedades.show', $propiedad->id) }}" class="main-btn primary-btn">Finalizar</a>
            </div>
        </div>
        
        <div class="accordion mb-4" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Subir Imágenes
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('adm.propiedades.imagenes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_propiedad_img" value="{{ $propiedad->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Seleccionar Tipo de Imagen</label>
                                    <select id="tipo" name="tipo" class="form-select">
                                        <option value="casa_fuera">Propiedad</option>
                                        <option value="360">Imagenes 360</option>
                                        <option value="dormitorio">Dormitorio</option>
                                        <option value="sala">Sala</option>
                                        <option value="baños">Baños</option>
                                        <option value="cocina">Cocinas</option>
                                        <option value="garaje">Garaje</option>
                                        <option value="ambiente">Ambiente</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Subir Imágenes</label>
                                    <input class="form-control" type="file" id="imagenes" name="imagenes[]" multiple>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="main-btn primary-btn">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <strong>Imágenes</strong>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            @if (count($imagenes) > 0)
                                @foreach ($imagenes as $imagen)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset('/storage/'.$imagen->path) }}" alt="Imagen" height={{ 150 }} width={{ 60 }}>
                                        <div class="card-body d-flex justify-content-between">
                                            <h5 class="card-title">{{ $imagen->type }}</h5>
                                            <form action="{{ route('adm.propiedades.imagenes.destroy', $imagen->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="main-btn danger-btn-outline" onclick="return confirm('¿Eliminar imagen?')">Eliminar</button>
                                            </form>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="cards-styles mb-4">
            <div class="row">
                <h5 class="card-title">Imágenes 360: Registrar el Recorrido de la Propieda
                    <strong>{{$propiedad->nombre}}</strong>
                </h5>
                <p class="text-warning">Por favor, selecciona una imagen para registrar el hotspot. Luego, navega por la
                    imagen hasta el punto donde deseas crear el hotspot y haz clic en ese lugar.</p>
            </div>
                <div>
                    <!-- Miniaturas de imágenes -->
                    @foreach ($imagenes360 as $image360)
                    <img src="{{ asset('storage/'.$image360->path) }}" class="thumbnail"
                        alt="Imagen 360" width="100" onclick="changeScene({{ $image360->id }})">
                    @endforeach
                    <!-- Visor de imágenes 360° -->
                    <div id="panorama"></div>
                    <!-- Formulario para hotspots -->
                    <br>
                    <h3 class="text-title-personable">Crear Hotspot</h3>
                    <form method="POST" action="{{ route('guardar.hotspot') }}">
                        @csrf
                        <input type="hidden" name="propiedad_id" value="{{ $propiedad->id }}">
                        <div class="col-12">
                            <label for="nombre_hotspot" class="form-label">Nombre del Hotspot</label>
                            <input type="text" name="nombre_hotspot" id="nombre_hotspot" class="form-control">
                            @error('nombre_hotspot')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label">Seleccionar imagen destino del Hotspot:</label>
                            <div class="image-select-container">
                                @foreach ($imagenes360 as $imageSelect)
                                <div class="image-option" onclick="selectImage(this, '{{ $imageSelect->id }}')">
                                    <img src="{{ asset('storage/'.$imageSelect->path) }}"
                                        alt="{{ $imageSelect->tipo }}">
                                    <p>{{ $imageSelect->tipo }}</p>
                                </div>
                                @endforeach
                            </div>
                            <input type="hidden" id="targetScene" name="targetScene">
                            @error('targetScene')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" id="sceneId" name="sceneId" value="{{ $imagenes360->first()->id ?? '' }}">
                        <input type="hidden" id="pitch" name="pitch">
                        <input type="hidden" id="yaw" name="yaw">
                        <div class="mt-3">
                            <button type="submit" class="main-btn secondary-btn btn-hover">Guardar Hotspot</button>
                        </div>
                    </form>
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


<script>
    var scenes = {
        @foreach ($imagenes360 as $imagen)
        "scene_{{ $imagen->id }}": {
                "type": "equirectangular",
                "panorama": "{{ asset('storage/'. $imagen->path) }}",
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
            firstScene: "scene_{{ $imagenes360->first()->id ?? '' }}"
        },
        scenes: scenes
    });

    // Cambia la escena al hacer clic en una imagen
    function changeScene(id) {
        var sceneId = "scene_" + id;
        if (scenes[sceneId]) {
            viewer.loadScene(sceneId);
            document.getElementById('sceneId').value = id;
        } else {
            console.error("Escena no encontrada:", sceneId);
        }
    }

    // Captura la posición del clic en la imagen 360
    document.getElementById('panorama').addEventListener('click', function(event) {
        var coords = viewer.mouseEventToCoords(event);
        document.getElementById('pitch').value = coords[0];
        document.getElementById('yaw').value = coords[1];
    });

</script>

<script>
    function selectImage(element, imageId) {
        document.querySelectorAll('.image-option').forEach(img => img.classList.remove('selected'));
        element.classList.add('selected');
        document.getElementById('targetScene').value = imageId;
    }
</script>
@endpush