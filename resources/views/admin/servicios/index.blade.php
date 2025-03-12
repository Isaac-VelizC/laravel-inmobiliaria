@extends('layouts.app')

@section('content')

<section class="table-components">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <x-title-wrapper title="Lista de servicios" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Servicios', 'url' => null]
        ]" />

        <!-- ========== title-wrapper end ========== -->

        @if (session('success'))
        <x-alert type="success" title="Success" heading="Éxito" message="{{ session('success') }}" />
        @endif
        @if (session('error'))
        <x-alert type="danger" title="danger" heading="Error" message="{{ session('error') }}" />
        @endif

        <!-- ========== tables-wrapper start ========== -->
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap justify-content-between align-items-center mb-30">
                            <div class="left">
                                <h6 class="mb-10">Lista de Citas</h6>
                            </div>
                            <!--div-- class="right">
                                <a href="#"
                                    class="main-btn primary-btn-light rounded-full btn-hover">Registrar Cita</a>
                            </!--div-->
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table id="tableServicios" class="display table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>Num</h6>
                                        </th>
                                        <th>
                                            <h6>Cliente</h6>
                                        </th>
                                        <th>
                                            <h6>Tipo de Servicio</h6>
                                        </th>
                                        <th>
                                            <h6>Fecha</h6>
                                        </th>
                                        <th>
                                            <h6>Estado</h6>
                                        </th>
                                        <th>
                                            <h6>Acciones</h6>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end table -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== tables-wrapper end ========== -->
    </div>
    <!-- end container -->
</section>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tableServicios').DataTable({
            ajax: "{{ route('adm.servicios.group.ajax') }}",
            columns: [
                {
                    data: null, // No se basa en datos del servidor
                    className: "text-center",
                    orderable: false, // No se puede ordenar
                    searchable: false, // No se puede buscar
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Inicia desde 1
                    }
                },
                { data: "client", name: "client", render: function(data) {
                    return `<p>${data}</p>`;
                }},
                { data: "tipo_servicio", name: "tipo_servicio", className: "text-center", render: function(data) {
                    return `<p>${data}</p>`;
                }},
                { data: "date", name: "date", className: "text-center", render: function(data) {
                    return `<p>${data}</p>`;
                }},
                { data: "status", name: "status", render: function(data) {
                    let statusClass = data === 'activo' ? 'active-btn' : 'close-btn';
                    return `<span class="status-btn ${statusClass}">${data}</span>`;
                }},
                { data: "action", name: "action", orderable: false, searchable: false }
            ],
            language: {
                url: "/assets/dashboard/DataTables/spanish.json"
            }
        });
        setTimeout(function() {
                $('.alert-box').fadeOut('slow');
            }, 3000);
    });

</script>
@endpush