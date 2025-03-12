@extends('layouts.app')

@section('content')

<section class="table-components">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <x-title-wrapper title="Cita en Grupo" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Propiedad', 'url' => route('adm.propiedades.show', $id)],
            ['label' => 'Citas', 'url' => null]
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
                                <h6 class="mb-10">{{ $titulo }}, citas</h6>
                            </div>
                            <div class="right">
                                <a href="{{ route('adm.citas.group.create', $id) }}"
                                    class="main-btn primary-btn-light rounded-full btn-hover">Registrar Cita</a>
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table id="tableUsuarios" class="display table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>Nombre</h6>
                                        </th>
                                        <th>
                                            <h6>Fecha</h6>
                                        </th>
                                        <th>
                                            <h6>Cupo</h6>
                                        </th>
                                        <th>
                                            <h6>Usuarios</h6>
                                        </th>
                                        <th>
                                            <h6>Agente</h6>
                                        </th>
                                        <th>
                                            <h6>Propiedad</h6>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== tables-wrapper end ========== -->
    </div>
</section>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tableUsuarios').DataTable({
            ajax: "{{ route('adm.citas.group.ajax') }}",
            columns: [
                { data: "name", name: "name", render: function(data) {
                    return `<p>${data}</p>`;
                }},
                { data: "date", name: "date", render: function(data) {
                    return `<p>${data}</p>`;
                }},
                { data: "cantidad", name: "cantidad", className: "text-center", render: function(data) {
                    return `<p>${data}</p>`;
                }},
                { data: "registrados", name: "registrados", className: "text-center", render: function(data) {
                    return `<p>${data}</p>`;
                }},
                { data: "agente", name: "agente", className: "text-center", render: function(data) {
                    return `<p>${data}</p>`;
                }},
                { data: "propiedad", name: "propiedad", className: "text-center", render: function(data) {
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