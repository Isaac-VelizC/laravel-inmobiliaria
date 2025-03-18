<div class=" d-flex gap-2">
    @can('Editar Citas')
        <div><a href="{{ route('adm.citas.group.edit', $id) }}">
            <i class="mdi mdi-pencil-outline me-2"></i></a>
        </div>
    @endcan
    <div><a href="{{ route('adm.citas.group.show', $id) }}">
        <i class="mdi mdi-eye-outline me-2"></i></a>
    </div>
  </div>