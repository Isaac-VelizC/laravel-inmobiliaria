@extends('layouts.app')

@section('content')
<section class="section">
  <div class="container-fluid">
    <div class="title-wrapper pt-30">
      <div class="row align-items-center g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
          <div class="card-style">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left">
                <span>Usuarios</span>
                <div class="d-flex align-items-end mt-2">
                  <h3 class="mb-0 me-2">{{$countUsers}}</h3>
                  <small>Total Usuarios</small>
                </div>
              </div>
              <span class="avatar">
                <span class="avatar-initial primary-btn-light rounded px-2">
                  <i class="mdi mdi-account-outline mdi-24px"></i>
                </span>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card-style">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left">
                <span>Propiedades</span>
                <div class="d-flex align-items-end mt-2">
                  <h3 class="mb-0 me-2">{{$countPropiedades}}</h3>
                  <small>Total Propiedades</small>
                </div>
              </div>
              <span class="avatar">
                <span class="avatar-initial px-2 secondary-btn-light rounded">
                  <i class="mdi mdi-home-modern mdi-24px"></i>
                </span>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card-style">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left">
                <span>Citas</span>
                <div class="d-flex align-items-end mt-2">
                  <h3 class="mb-0 me-2">{{$countCitas}}</h3>
                  <small>Total Citas</small>
                </div>
              </div>
              <span class="avatar">
                <span class="avatar-initial px-2 danger-btn-light rounded">
                  <i class="mdi mdi-account-clock mdi-24px"></i>
                </span>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card-style">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left">
                <span>Serviciso</span>
                <div class="d-flex align-items-end mt-2">
                  <h3 class="mb-0 me-2">{{$countServicios}}</h3>
                  <small>Total Pendientes</small>
                </div>
              </div>
              <span class="avatar">
                <span class="avatar-initial px-2 warning-btn-light rounded">
                  <i class="mdi mdi-hammer-wrench mdi-24px"></i>
                </span>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class=" card-style">
        Contenido de Graficos
      </div>
    </div>
  </div>
</section>
@endsection