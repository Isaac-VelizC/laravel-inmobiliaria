@extends('layouts.client.app')

@section('content')
@php
use App\Models\Image;
@endphp

<!--/ Carousel Star /-->
<div class="intro intro-carousel">
  <div id="carousel" class="owl-carousel owl-theme">
    @foreach ($propiedades as $propiedadCarousel)
    @if ($propiedadCarousel->imagenes->isNotEmpty())
    @php
    $imagen = $propiedadCarousel->imagenes->first();
    @endphp
    @endif
    <div class="carousel-item-a intro-item bg-image"
      style="background-image: url({{ $imagen ? asset('storage/' . $imagen->path) : 'assets/img/slide-1.jpg'}}); object-fit: cover;">
      <div class="overlay overlay-a"></div>
      <div class="intro-content display-table">
        <div class="table-cell">
          <div class="container">
            <div class="row">
              <div class="col-lg-8">
                <div class="intro-body">
                  <!--p-- class="intro-title-top">Doral, Florida
                    <br> 78345
                  </!--p-->
                  <h1 class="intro-title mb-4">
                    <span class="color-b">{{ $propiedadCarousel->name }} </span> Propiedade en
                    <br> {{$propiedadCarousel->city}}
                  </h1>
                  <div style="background-color: rgba(128, 128, 128, 0.5); border-radius: 15px;">
                    <div class="card-body">
                      <p class="card-text text-white">
                        {{ "Ambientes: " . $propiedadCarousel->num_rooms }} -
                        {{ "Baños: " . $propiedadCarousel->num_bathrooms }} -
                        {{ "Garaje: " . $propiedadCarousel->num_garages }} -
                        {{ "Cocina: " . $propiedadCarousel->num_kitchens }} -
                        {{ "Dormitorio: " . $propiedadCarousel->num_bedrooms }} -
                        {{ "Sala: " . $propiedadCarousel->num_hall }}
                      </p>
                    </div>
                  </div>
                  <p class="intro-subtitle intro-price">
                    <a href="{{ route('propiedades.detalle', $propiedadCarousel->id) }}">
                      <span class="price-a">
                        {{ $propiedadCarousel->price .' '. $propiedadCarousel->coin}}
                      </span>
                    </a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
<!--/ Carousel end /-->


<!--/ Property Star /-->
<section class="section-property section-t8">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="title-wrap d-flex justify-content-between">
          <div class="title-box">
            <h2 class="title-a">Últimas propiedades</h2>
          </div>
          <div class="title-link">
            <a href="{{ route('home.propiedades') }}">Toda la propiedad
              <span class="ion-ios-arrow-forward"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div id="property-carousel" class="owl-carousel owl-theme">

      @foreach ($propiedades as $item)
      @php
      $imagen = Image::where('propiedad', $item->id)->where('type', 'casa_fuera')->first();
      @endphp
      <div class="carousel-item-b">
        <div class="card-box-a card-shadow">
          <div class="img-box-a" style="height: 400px;">
            <img src="{{ $imagen ? asset('storage/'. $imagen->path ) : 'assets/img/property-6.jpg'}}"
              alt="Imagen{{ $item->id }}" class="img-a img-fluid" style="height: 400px">
          </div>
          <div class="card-overlay">
            <div class="card-overlay-a-content">
              <div class="card-header-a">
                <h2 class="card-title-a">
                  <a href="property-single.html">{{ $item->city }}
                    <br /> {{ $item->name }}</a>
                </h2>
              </div>
              <div class="card-body-a">
                <div class="price-box d-flex">
                  <span class="price-a">precio | {{ $item->price . ' ' . $item->coin }}</span>
                </div>
                <a href="{{ route('propiedades.detalle', $item->id) }}" class="link-a">Haga clic aquí para ver
                  <span class="ion-ios-arrow-forward"></span>
                </a>
              </div>
              <div class="card-footer-a">
                <ul class="card-info d-flex justify-content-around">
                  <li>
                    <h4 class="card-info-title">Area</h4>
                    <span>{{ $item->ground_surface }}m
                      <sup>2</sup>
                    </span>
                  </li>
                  <li>
                    <h4 class="card-info-title">Hab.</h4>
                    <span>{{ $item->num_rooms }}</span>
                  </li>
                  <li>
                    <h4 class="card-info-title">Baños</h4>
                    <span>{{ $item->num_bathrooms }}</span>
                  </li>
                  <li>
                    <h4 class="card-info-title">Garajes</h4>
                    <span>{{ $item->num_garages }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!--/ Property End /-->

<!--/ Services Star /-->
<section class="section-services section-t8">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="title-wrap d-flex justify-content-between">
          <div class="title-box">
            <h2 class="title-a">Nuestros servicios</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card-box-c foo">
          <div class="card-header-c d-flex">
            <div class="card-box-ico">
              <span class="fa fa-gamepad"></span>
            </div>
            <div class="card-title-c align-self-center">
              <h2 class="title-b">Experiencia</h2>
            </div>
          </div>
          <div class="card-body-c">
            <p class="content-c">
              Más de 10 años ayudando a nuestros clientes a encontrar su hogar ideal.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-box-c foo">
          <div class="card-header-c d-flex">
            <div class="card-box-ico">
              <span class="fa fa-usd"></span>
            </div>
            <div class="card-title-c align-self-center">
              <h2 class="title-b">Servicios Completos</h2>
            </div>
          </div>
          <div class="card-body-c">
            <p class="content-c">
              Ofrecemos un servicio integral para la compra, venta y gestión de propiedades.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-box-c foo">
          <div class="card-header-c d-flex">
            <div class="card-box-ico">
              <span class="fa fa-home"></span>
            </div>
            <div class="card-title-c align-self-center">
              <h2 class="title-b">Confianza</h2>
            </div>
          </div>
          <div class="card-body-c">
            <p class="content-c">
              Construimos relaciones duraderas basadas en la confianza y la transparencia.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Services End /-->

@endsection