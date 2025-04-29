@extends('layouts.app')

@section('title', 'Panel de control')

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
                <span>Servicios</span>
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
      <div class="row">
        <div class="col-lg-6">
          <div class="card-style">
            <canvas id="myChart" width="400" height="200"></canvas>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card-style">
            <canvas id="propiedadesChart" width="400" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  (async () => {
      const respuestaRaw = await fetch('{{ route('grafico_clientes_datos') }}');
      const respuesta = await respuestaRaw.json();

      const ctx = document.getElementById('myChart').getContext('2d');
      const myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: respuesta.etiquetas,
              datasets: [{
                  label: 'Clientes por Mes',
                  data: respuesta.datos,
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgba(255, 99, 132, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
  })();
  
  // Gráfico de propiedades más visitadas
  (async () => {
      const respuestaPropiedades = await fetch('{{ route('grafico.top.propiedades') }}');
      const datosPropiedades = await respuestaPropiedades.json();

      new Chart(document.getElementById('propiedadesChart').getContext('2d'), {
          type: 'bar',
          data: {
              labels: datosPropiedades.etiquetas,
              datasets: [{
                  label: 'Propiedades con mas Visitas',
                  data: datosPropiedades.datos,
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              indexAxis: 'y', // Barras horizontales
              scales: {
                  y: { beginAtZero: true },
                  x: { ticks: { precision: 0 } }
              }
          }
      });
  })();
</script>
@endpush