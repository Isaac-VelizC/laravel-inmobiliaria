<div class="modal fade" id="modalAgregarTipo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Agregar Tipo de Propiedad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="card-body" action="#" method="POST" id="frmAgregarTipoPropiedad">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="tipo_name" name="tipo_name"
                                    class="@error('tipo_name') is-invalid @enderror form-control"
                                    placeholder="Nombre" value="{{ old('tipo_name') }}" />
                                <label for="tipo_name">Tipo de propiedad</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="tipo_detail" name="tipo_detail"
                                    class="@error('tipo_detail') is-invalid @enderror form-control"
                                    placeholder="Detalle" value="{{ old('tipo_detail') }}" />
                                <label for="tipo_detail">Detalle</label>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4">
                        <button type="button" onclick="agregarTipo()"
                            class="btn btn-primary me-sm-3 me-1">Enviar</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function agregarTipo() {
        var data = {
            name: $('#tipo_name').val(),
            detail: $('#tipo_detail').val(),
        };
        $.ajax({
            type: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            url: '{{ route('adm.propiedades.tipo.store') }}',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                //alert('Tipo de propiedad '+response.ultName+' agregado correctamente');
                //console.log(response);
                var $combobox = $('#tipo_propiedad');
                var $option = $('<option></option>')
                    .attr('value', response.ultID)
                    .text(response.ultName);
                // Agregar la opción al combobox
                $combobox.append($option);
                $combobox.val(response.ultID);
                // Aquí puedes agregar cualquier acción adicional en caso de éxito
                $('#modalAgregarTipo').modal('hide');
            },
            error: function(error) {
                alert('Hubo un error al enviar los datos');
                console.error(error);
                $('#frmAgregarTipoPropiedad input').removeClass('is-invalid');
                if (error.status === 422) {
                    var errors = error.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#tipo_' + key).addClass('is-invalid');
                        $('#error-' + key).text(value[0]);
                    });
                }
            }
        });
    }
    //Propietarios
    function abrirTipo(event) {
        event.preventDefault();
        $('#modalAgregarTipo').modal('show');
    }
</script>