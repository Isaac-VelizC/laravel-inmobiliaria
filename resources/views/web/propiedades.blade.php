@extends('layouts.client.app')

@section('content')

<!--/ Intro Single star /-->
<section class="intro-single">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8">
        <div class="title-single-box">
          <h1 class="title-single">Nuestras increíbles propiedades</h1>
          <span class="color-text-a">Propiedades</span>
        </div>
      </div>
      <div class="col-md-12 col-lg-4">
        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ url('/') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Propiedades
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>
<!--/ Intro Single End /-->

<!--/ Property Grid Star /-->
<section class="property-grid grid">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="grid-option">
          <form>
            <select class="custom-select">
              <option selected>All</option>
              <option value="1">New to Old</option>
              <option value="2">For Rent</option>
              <option value="3">For Sale</option>
            </select>
          </form>
        </div>
      </div>
      @php
      use App\Models\Image;
      @endphp
      @foreach ($propiedades as $item)
      @php
      $img = Image::where('propiedad', $item->id)->where('type', 'casa_fuera')->first();
      @endphp
      <div class="col-md-4">
        <div class="card-box-a card-shadow">
          <div class="img-box-a" style="height: 400px;">
            <img src="{{ $img ? asset('storage/'. $img->path) : 'assets/img/property-1.jpg' }}" alt="{{ $item->name }}" class="img-a img-fluid" style="height: 400px;">
          </div>
          <div class="card-overlay">
            <div class="card-overlay-a-content">
              <div class="card-header-a">
                <span class="color-b">{{ $item->tipoPropiedad->name }}</span>
                <h2 class="card-title-a">
                  <a href="{{ route('propiedades.detalle', $item->id) }}">{{ $item->name }}
                    <br /> en {{ $item->city }}</a>
                </h2>
              </div>
              <div class="card-body-a">
                <div class="price-box d-flex">
                  <span class="price-a">{{ $item->coin }} {{ $item->price }}</span>
                </div>
                <a href="{{ route('propiedades.detalle', $item->id) }}" class="link-a">Ver mas detalles
                  <span class="ion-ios-arrow-forward"></span>
                </a>
              </div>
              <div class="card-footer-a">
                <ul class="card-info d-flex justify-content-around">
                  <li>
                    <h4 class="card-info-title">Area</h4>
                    <span>{{ $item->constructed_area }}m
                      <sup>2</sup>
                    </span>
                  </li>
                  <li>
                    <h4 class="card-info-title">Dorm</h4>
                    <span>{{ $item->num_bedrooms }}</span>
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
    <div class="row">
      <div class="col-sm-12">
        <nav class="pagination-a">
          {!! $propiedades->links() !!}
        </nav>
      </div>
    </div>
  </div>
  </div>
</section>
<!--/ Property Grid End /-->
@endsection