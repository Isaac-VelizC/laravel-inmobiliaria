<div class="modal fade" id="modalAgregarVentaTipo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Agregar Tipo de Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="card-body" action="#" method="POST" id="frmAgregarVentaTipo">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="vetipo_name" name="vetipo_name" class="@error('vetipo_name') is-invalid @enderror form-control" placeholder="Terreno" value="{{ old('vetipo_name') }}" required/>
                                <label for="vetipo_name">Tipo de traspaso</label>
                                <div id="error-vetipo_name" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="vetipo_detail" name="vetipo_detail" class="@error('vetipo_detail') is-invalid @enderror form-control" placeholder="Detalle" value="{{ old('vetipo_detail') }}" />
                                <label for="vetipo_detail">Detalle</label>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4">
                        <button type="button" onclick="agregarVentaTipo()" class="btn btn-primary me-sm-3 me-1">Enviar</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function agregarVentaTipo() {
        // Recopila los datos de los campos sueltos
        var data = {
            name: $('#vetipo_name').val(),
            detail: $('#vetipo_detail').val()
        };
        // Enviar los datos utilizando AJAX
        $.ajax({
            type: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            url: '{{ route('adm.propiedades.ventatipo.store') }}',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                alert('Tipo de venta '+response.ultVName+' agregado correctamente');
                console.log(response);
                //
                var $combobox = $('#tipo_traspaso');
                var $option = $('<option></option>')
                    .attr('value', response.ultID)
                    .text(response.ultVName);
                //Agregar la opción al combobox
                $combobox.append($option);

                // Seleccionar la opción recién agregada
                $combobox.val(response.ultID);
                // Aquí puedes agregar cualquier acción adicional en caso de éxito
                $('#modalAgregarVentaTipo').modal('hide');
            },
            error: function(error) {
                alert('Hubo un error al enviar los datos');
                console.error(error);
                $('#frmAgregarVentaTipo input').removeClass('is-invalid');
                if (error.status === 422) {
                    var errors = error.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#vetipo_' + key).addClass('is-invalid');
                        $('#error-' + key).text(value[0]);
                    });
                }
            }
        });
    }
    //Propietarios
    function abrirVentaTipo(event) {
        event.preventDefault();
        $('#modalAgregarVentaTipo').modal('show');
    }
</script>
