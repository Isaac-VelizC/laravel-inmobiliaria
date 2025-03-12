@extends('layouts.client.app')

@section('content')

<!-- Pannellum CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css">
<!-- Pannellum JS -->
<script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>

<!--/ Intro Single star /-->
<section class="intro-single">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8">
        <div class="title-single-box">
          <h1 class="title-single">{{ $propiedad->name }}</h1>
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

<!--/ Property Single Star /-->
<section class="property-single nav-arrow-b">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div id="property-single-carousel" class="owl-carousel owl-arrow gallery-property">
          @foreach ($imagenes as $item)
          <div class="carousel-item-b">
            <img src="{{ $item->path ? asset('storage/'. $item->path)  : 'assets/img/slide-2.jpg'}}"
              alt="{{$item->path}}">
          </div>
          @endforeach
        </div>
        <div class="row justify-content-between">
          <div class="col-md-5 col-lg-4">
            <div class="property-price d-flex justify-content-center foo">
              <div class="card-header-c d-flex">
                <div class="card-box-ico">
                  <span class="ion-money">{{ $propiedad->coin }}</span>
                </div>
                <div class="card-title-c align-self-center">
                  <h5 class="title-c">{{ $propiedad->price }}</h5>
                </div>
              </div>
            </div>
            <div class="property-summary">
              <div class="row">
                <div class="col-sm-12">
                  <div class="title-box-d section-t4">
                    <h3 class="title-d">Resumen rápido</h3>
                  </div>
                </div>
              </div>
              <div class="summary-list">
                <ul class="list">
                  <li class="d-flex justify-content-between">
                    <strong>Propiedad:</strong>
                    <span>{{ $propiedad->id }}</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Ubicación:</strong>
                    <span>{{ $propiedad->city.', '.$propiedad->address }}</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Tipo de Propiedad:</strong>
                    <span>{{ $propiedad->tipoPropiedad->name }}</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Estado:</strong>
                    <span>{{ $propiedad->status }}</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Area:</strong>
                    <span>{{ $propiedad->constructed_area }}m
                      <sup>2</sup>
                    </span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Dormitorios:</strong>
                    <span>{{ $propiedad->num_bedrooms }}</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Baños:</strong>
                    <span>{{ $propiedad->num_bathrooms }}</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Cocinas:</strong>
                    <span>{{ $propiedad->num_kitchens }}</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Salas:</strong>
                    <span>{{ $propiedad->num_hall }}</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Garages:</strong>
                    <span>{{ $propiedad->num_garages }}</span>
                  </li>
                </ul>
              </div>
            </div>
            <a href="{{ route('usuario.citas.index', $propiedad->id) }}" class="d-flex justify-content-end">
              <span class="my_btn">Solicitar cita</span>
            </a>
          </div>
          <div class="col-md-7 col-lg-7 section-md-t3">
            <div class="row">
              <div class="col-sm-12">
                <div class="title-box-d">
                  <h3 class="title-d">Descripción de la propiedad</h3>
                </div>
              </div>
            </div>
            <div class="property-description">
              <p class="description color-text-a">
                {{ $propiedad->description }}
              </p>
            </div>
            <!--div class="row section-t3">
              <div class="col-sm-12">
                <div class="title-box-d">
                  <h3 class="title-d">Comodidades</h3>
                </div>
              </div>
            </!--div>
            <div-- class="amenities-list color-text-a">
              <ul class="list-a no-margin">
                <li>Balcony</li>
                <li>Outdoor Kitchen</li>
                <li>Cable Tv</li>
                <li>Deck</li>
                <li>Tennis Courts</li>
                <li>Internet</li>
                <li>Parking</li>
                <li>Sun Room</li>
                <li>Concrete Flooring</li>
              </ul>
            </div-->
          </div>
        </div>
      </div>
      <div class="col-md-10 offset-md-1">
        <ul class="nav nav-pills-a nav-pills mb-3 section-t3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-video-tab" data-toggle="pill" href="#pills-video" role="tab"
              aria-controls="pills-video" aria-selected="true">360°</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-plans-tab" data-toggle="pill" href="#pills-plans" role="tab"
              aria-controls="pills-plans" aria-selected="false">Video</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-map-tab" data-toggle="pill" href="#pills-map" role="tab"
              aria-controls="pills-map" aria-selected="false">Ubicación</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
            <div>
              @foreach ($imagen360 as $imagen)
              <img src="{{ asset('storage/'. $imagen->path) }}" alt="Imagen 360" width="100" height="50"
                onclick="changeScene({{ $imagen->id }})" class="cursor-pointer">
              @endforeach
            </div>
            <div id="panorama" style="width: 100%; height: 500px;"></div>
          </div>
          <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
            <iframe src="https://player.vimeo.com/video/73221098" width="100%" height="460" frameborder="0"
              webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          </div>
          <div class="tab-pane fade" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab">
            <iframe
              src="https://www.google.com/maps?q={{ $propiedad->latitude }},{{ $propiedad->longitude }}&hl=es;z=15&output=embed"
              width="100%" height="460" frameborder="0" style="border:0" allowfullscreen zoom={{15}}></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Property Single End /-->

<script>
  var scenes = {
      @foreach ($imagen360 as $imagen)
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
          firstScene: "scene_{{ $imagen360->first()->id ?? '' }}"
      },
      scenes: scenes
  });

  // Cambia la escena al hacer clic en una imagen
  function changeScene(id) {
      var sceneId = "scene_" + id;
      if (scenes[sceneId]) {
          viewer.loadScene(sceneId);
      } else {
          console.error("Escena no encontrada:", sceneId);
      }
  }
</script>

@endsection