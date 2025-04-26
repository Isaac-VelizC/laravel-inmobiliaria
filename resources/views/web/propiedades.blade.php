@extends('layouts.client.app')

@section('title', 'Propiedades')

@section('content')

<style>
  /* Estilos para el formulario de búsqueda */
  .grid-option {
    background-color: #f8f9fa;
    /* Color de fondo */
    padding: 20px;
    /* Espaciado interno */
    border-radius: 8px;
    /* Bordes redondeados */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    /* Sombra */
    margin-bottom: 30px;
    /* Espaciado inferior */
  }

  .grid-option .form-group {
    margin-bottom: 15px;
    /* Espaciado entre los campos */
  }

  .grid-option .form-control,
  .grid-option .form-select {
    border-radius: 5px;
    /* Bordes redondeados */
    border: 1px solid #ced4da;
    /* Borde */
    padding: 10px;
    /* Espaciado interno */
  }

  .grid-option .form-control:focus,
  .grid-option .form-select:focus {
    border-color: #007bff;
    /* Color del borde al enfocar */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    /* Sombra al enfocar */
  }

  .grid-option .th-btn {
    background-color: #007bff;
    /* Color de fondo del botón */
    color: white;
    /* Color del texto del botón */
    border: none;
    /* Sin borde */
    border-radius: 5px;
    /* Bordes redondeados */
    padding: 10px 20px;
    /* Espaciado interno */
    transition: background-color 0.3s;
    /* Transición suave */
  }

  .grid-option .th-btn:hover {
    background-color: #0056b3;
    /* Color de fondo al pasar el mouse */
  }

  /* Responsividad */
  @media (max-width: 768px) {
    .grid-option {
      padding: 15px;
      /* Menos espaciado en pantallas pequeñas */
    }

    .grid-option .form-control,
    .grid-option .form-select {
      font-size: 14px;
      /* Tamaño de fuente más pequeño */
    }

    .grid-option .th-btn {
      width: 100%;
      /* Botón ocupa todo el ancho en pantallas pequeñas */
    }
  }
</style>

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
          <form action="{{ route('propiedades.buscar') }}" method="GET" id="searchForm">
            @csrf
            <div class="form-group">
              <input class="form-control" type="text" id="query" name="query" placeholder="Texto a buscar"
                value="{{ $query ?? '' }}">
            </div>
            <select class="form-select" name="tipo_id">
              <option value="" selected>Tipo de Propiedad</option>
              @foreach ($tipos as $tipo)
              <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
              @endforeach
            </select>
            <select class="form-select" name="ciudad">
              <option value="" selected>Ciudad</option>
              @foreach ($ciudades as $ciudad)
              <option value="{{ $ciudad }}">{{ $ciudad }}</option>
              @endforeach
            </select>
            <button class="th-btn" type="submit"><i class="bi bi-search"></i> Buscar</button>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      @php
      use App\Models\Image;
      @endphp
      @if (count($propiedades) > 0)
      @foreach ($propiedades as $item)
      @php
      $img = Image::where('propiedad', $item->id)->where('type', 'casa_fuera')->first();
      @endphp
      <div class="col-md-4">
        <div class="card-box-a card-shadow">
          <div class="img-box-a" style="height: 400px;">
            <img src="{{ $img ? asset('storage/'. $img->path) : 'assets/img/property-1.jpg' }}" alt="{{ $item->name }}"
              class="img-a img-fluid" style="height: 400px;">
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
      @else
      <div class="col-md-12 text-center">
        <h2>No se encontraron propiedades</h2>
      </div>
      @endif
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