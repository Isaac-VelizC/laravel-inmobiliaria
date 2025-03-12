<div class=" d-flex gap-2">
  <div><a class="tooltip-container" href="{{ route('adm.usuarios.edit', $id) }}">
      <span class="tooltip-text">Editar</span>
      <i class="mdi mdi-pencil-outline me-2"></i></a>
  </div>
  <div>
    <form action="{{ route('users.toggle.status', $id) }}" method="POST">
      @csrf
      @method('POST')
      <button type="submit" class="{{ $status === 'activo' ? 'btn-inactivar' : 'btn-activar' }}">
        <i class="mdi mdi-trash-can-outline"></i>
        {{ $status === 'activo' ? 'Inactivar' : 'Activar' }}
      </button>
    </form>
  </div>
</div>