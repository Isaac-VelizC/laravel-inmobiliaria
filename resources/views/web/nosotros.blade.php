@extends('layouts.client.app')

@section('title', 'Sobre nosotros')

@section('content')
<!--/ Intro Single star /-->
<section class="intro-single">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8">
        <div class="title-single-box">
          <h1 class="title-single">Sobre Soluciones Inmobiliarias</h1>
        </div>
      </div>
      <div class="col-md-12 col-lg-4">
        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ url('/') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Nosotros
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>
<!--/ Intro Single End /-->

<!--/ About Star /-->
<section class="section-about">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="about-img-box">
          <img src="{{ asset('assets/img/slide-about-1.jpg')}}" alt="" class="img-fluid">
        </div>
        <div class="sinse-box">
          <h3 class="sinse-title">Soluciones Inmobiliarias
            <span></span>
            <p>Tu aliado en bienes raíces</p>
        </div>
      </div>
      <div class="col-md-12 section-t8">
        <div class="row">
          <div class="col-md-6 col-lg-5">
            <img src="{{ asset('assets/img/about-2.jpg')}}" alt="" class="img-fluid">
          </div>
          <div class="col-lg-2  d-none d-lg-block">
            <div class="title-vertical d-flex justify-content-start">
              <span>Agencia Inmobiliaria</span>
            </div>
          </div>
          <div class="col-md-6 col-lg-5 section-md-t3">
            <div class="title-box-d">
              <h3 class="title-d">Compromiso,
                <span class="color-d">confianza</span> y
                <br> profesionalismo.
              </h3>
            </div>
            <p class="color-text-a">
              En Soluciones Inmobiliarias nos dedicamos a brindar asesoría integral para la compra, venta y alquiler de
              propiedades, acompañando a nuestros clientes en cada paso del proceso. Nos hemos consolidado
              como una empresa innovadora y confiable, enfocada en ofrecer un servicio transparente y personalizado.
            </p>
            <p class="color-text-a">
              Nuestro equipo de expertos utiliza herramientas tecnológicas y estrategias de marketing modernas para
              lograr que cada propiedad alcance su máximo potencial en el mercado. Nos caracteriza la honestidad, el
              trato humano y la pasión por ayudar a las personas a encontrar el hogar o la inversión ideal.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ About End /-->
@endsection