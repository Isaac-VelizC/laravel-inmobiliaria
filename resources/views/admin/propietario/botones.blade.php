<div class=" d-flex gap-2">
  <div><a class="tooltip-container" href="{{ route('adm.propietarios.edit', $id) }}">
      <span class="tooltip-text">Editar</span>
      <i class="mdi mdi-pencil-outline me-2"></i></a>
  </div>
  <div><a class="tooltip-container" href="{{ route('adm.propiedades.usuario', $id) }}">
      <span class="tooltip-text">Ver Propiedades</span>
      <i class="mdi mdi-home-city-outline me-2"></i></a>
  </div>
  <div><a class="tooltip-container" href="{{ route('adm.propietarios.edit', $id) }}">
      <span class="tooltip-text">Borrar</span>
      <i class="mdi mdi-trash-can-outline me-2"></i></a>
  </div>
</div>