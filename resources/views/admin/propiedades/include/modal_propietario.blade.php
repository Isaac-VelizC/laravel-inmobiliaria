<div class="modal fade" id="modalAgregarPropietario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel4">Registrar Propietario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="card-body" action="{{ route('adm.propietarios.store') }}" method="POST"
                    id="frmAgregarPropietario">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="pro_name" name="pro_name"
                                    class="@error('pro_name') is-invalid @enderror form-control" placeholder="Juan"
                                    value="{{ old('pro_name') }}" />
                                <label for="pro_name">Nombre propietario</label>
                                <div id="error-pro_name" class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="pro_surnames" name="pro_surnames"
                                    class="@error('pro_surnames') is-invalid @enderror form-control" placeholder="Perez"
                                    value="{{ old('pro_surnames') }}" />
                                <label for="pro_surnames">Apellido</label>
                                <div id="error-pro_surnames" class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input type="email" id="pro_email" name="pro_email"
                                    class="@error('pro_email') is-invalid @enderror form-control"
                                    placeholder="juan@gmail.com" value="{{ old('pro_email') }}" />
                                <label for="pro_email">Correo</label>
                                <div id="error-pro_email" class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="pro_phone" name="pro_phone"
                                    class="@error('pro_phone') is-invalid @enderror form-control"
                                    placeholder="7777777" value="{{ old('pro_phone') }}" />
                                <label for="pro_phone">Telefono</label>
                                <div id="error-pro_phone" class="invalid-feedback"></div>
                            </div>
                        </div>

                    </div>
                    <div class="pt-4">
                        <button type="button" onclick="agregarPropietario()"
                            class="btn btn-primary me-sm-3 me-1">Enviar</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function agregarPropietario() {
        // Recopila los datos de los campos sueltos
        var data = {
            name: $('#pro_name').val(),
            surnames: $('#pro_surnames').val(),
            email: $('#pro_email').val(),
            phone: $('#pro_phone').val(),
            address: $('#pro_address').val()
        };
        
        // Enviar los datos utilizando AJAX
        $.ajax({
            type: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            url: '{{ route('adm.propiedades.propietario.store') }}', // La URL de la ruta en Laravel
            contentType: 'application/json',
            data: JSON.stringify(data),
            
            success: function(response) {
                var $combobox = $('#id_propietario');
                var $option = $('<option></option>')
                    .attr('value', response.ultID)
                    .text(response.ultNombre);
                // Agregar la opción al combobox
                $combobox.append($option);
                // Seleccionar la opción recién agregada
                $combobox.val(response.ultID);
                // Aquí puedes agregar cualquier acción adicional en caso de éxito
                $('#modalAgregarPropietario').modal('hide');
            },
            error: function(error) {
                //alert('Hubo un error al enviar los datos');
                $('#frmAgregarPropietario input').removeClass('is-invalid');
                if (error.status === 422) {
                    var errors = error.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        var campoId = 'pro_' + key;
                        $('#' + campoId).addClass('is-invalid');
                        $('#error-' + campoId).text(value[0]); // Ajusta el ID del mensaje de error
                    });
                }
            }
        });
    }
    function abrirPropietario(event) {
        event.preventDefault();
        $('#modalAgregarPropietario').modal('show');
    }

</script>