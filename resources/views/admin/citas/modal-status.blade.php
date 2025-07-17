<div class="modal fade" id="modalStatusCita" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title">Cambiar estado de la Cita</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="statusForm" method="POST" action="{{ route('adm.citas.group.status', ':citaId') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-4">
                                <select name="status" id="statusSelect" class="form-select" required>
                                    <option value="" selected disabled>Seleccionar estado</option>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="confirmada">Confirmada</option>
                                    @role('Admin')
                                    <option value="cancelada">Cancelada</option>
                                    @endrole
                                    <option value="concretada">Concretada</option>
                                </select>
                                <label for="statusSelect">Estado actual</label>
                            </div>
                        </div>

                        <!-- Sección para comentarios/observaciones -->
                        <div class="col-12 mt-3">
                            <div class="form-floating">
                                <textarea class="form-control" id="observaciones" name="observaciones"
                                    placeholder="Agregar comentarios" style="height: 100px"></textarea>
                                <label for="observaciones">Comentarios (opcional)</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                        Actualizar Estado
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const urlStatusUpdate = "{{ route('adm.citas.group.status', ['id' => ':id']) }}";

    function abrirStatus(citaId, currentStatus) {
    const form = document.getElementById('statusForm');
    const statusSelect = document.getElementById('statusSelect');

    // Reemplaza ':id' por el ID real
    form.action = urlStatusUpdate.replace(':id', citaId);

    // Establece la selección
    statusSelect.value = currentStatus || "";

    // Muestra el modal
    new bootstrap.Modal(document.getElementById('modalStatusCita')).show();
}

</script>