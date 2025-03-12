@extends('layouts.client.app')

@section('title', 'Citas')

@section('content')

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
<div class="th-checkout-wrapper space-top space-extra-bottom">
    <div class="container">
        <div class="woocommerce-form-login-toggle">
            <div class="woocommerce-info"><a href="{{ route('propiedades.detalle', $propiedad->id) }}">Propiedad: {{
                    $propiedad->name }}</a></div>
        </div>
        <div class="woocommerce-form-login-toggle">
            <div class="woocommerce-info">Horarios de atencion: 8:00 a 12:00 y 14:00 a 18:00</div>
        </div>
        @if(session('error'))
        <div class="alert alert-danger">
            <strong>Errores:</strong>
            {{ session('error') }}
        </div>
        @endif
        @if(empty($controlpropiedad))
        <div class="row">
            <div class="col-12">
                <form action="{{ route('usuario.citas.agregar_nuevo') }}" id="frmCitas"
                    class="woocommerce-form-login mb-3" method="post">
                    @if(session('success'))
                    <div>
                        {{ session('success') }}
                    </div>
                    @endif
                    @csrf
                    <input type="hidden" id="usuario_id" name="usuario_id" value="{{ auth()->id() }}">
                    <input type="hidden" id="fecha_de_cita" name="fecha_de_cita">

                    <div class="row">
                        <div class="col-md-6">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @else
        <div class="alert alert-warning border-left border-warning shadow-sm p-3 rounded">
            <h5 class="fw-bold">📅 Cita Pendiente</h5>
            <p>
                Tienes una cita pendiente programada para el
                <span class="fw-bold">{{ $ultimaCita->fecha_de_cita }}</span>
                a las
                <span class="fw-bold">{{ $ultimaCita->hora_de_cita }}</span>
                en la propiedad <strong>{{ $ultimaCita->propiedad->nombre }}</strong>.
            </p>
            <p class="mb-0">No podrás realizar otra cita para esta propiedad hasta que la actual se complete.</p>
        </div>

        @endif
        <h4 class="mt-4 pt-lg-2">Tus Citas</h4>
        <form action="#" class="woocommerce-cart-form">
            <table class="cart_table mb-20">
                <thead>
                    <tr>
                        <th class="cart-col-productname">Propiedad</th>
                        <th class="cart-col-price">Fecha</th>
                        <th class="cart-col-quantity">Hora</th>
                        <th class="cart-col-quantity">Estado</th>
                        <th class="cart-col-quantity">Encuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $c)
                    <tr class="cart_item">
                        <td data-title="Name">{{$c->hacienda->name }}</td>
                        <td data-title="Price">
                            <span class="amount">{{ $c->fecha_de_cita }}</span>
                        </td>
                        <td data-title="Quantity">
                            <strong class="product-quantity">{{ $c->hora_de_cita }}</strong>
                        </td>
                        <td data-title="Quantity">
                            <strong class="product-quantity">{{ ucfirst($c->estado) }}</strong>
                        </td>
                        <td data-title="Quantity">
                            @if ($c->estado == "concretada")
                            <button onclick="VerEncuesta({{ $c->id }}, {{ $id }});" class="th-btn"
                                type="button">Encuesta</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script>
    function VerEncuesta(id, idp) {
        // Abre una nueva ventana con la URL especificada
        var url = "{{ route('usuario.citas.encuesta') }}"+"/"+id+"/"+idp;
        var nombre = "Encuesta";
        var caracteristicas = "width=800,height=600";
        window.open(url, nombre, caracteristicas);
    }

</script>
@endsection