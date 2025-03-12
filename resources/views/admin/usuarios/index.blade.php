@extends('layouts.app')

@section('content')

<section class="table-components">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <x-title-wrapper title="Usuarios" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Usuarios', 'url' => null]
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
                                <h6 class="mb-10">Lista de Usuarios</h6>
                            </div>
                            <div class="right g-4">
                                <a href="{{ route('adm.roles.index') }}"
                                    class="main-btn secondary-btn-light rounded-full btn-hover">Roles y Permisos</a>
                                <a href="{{ route('adm.usuarios.create') }}"
                                    class="main-btn primary-btn-light rounded-full btn-hover">Nuevo Usuario</a>
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table id="tableUsuarios" class="display table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>#</h6>
                                        </th>
                                        <th>
                                            <h6>Nombre Completo</h6>
                                        </th>
                                        <th>
                                            <h6>Email</h6>
                                        </th>
                                        <th>
                                            <h6>Phone</h6>
                                        </th>
                                        <th>
                                            <h6>Rol</h6>
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
        $('#tableUsuarios').DataTable({
            ajax: "{{ route('adm.usuarios.ajax') }}",
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
                { data: "name", name: "name", render: function(data) {
                    return `<p>${data}</p>`;
                }},
                { data: "email", name: "email", render: function(data) {
                    return `<p><a href="mailto:${data}">${data}</a></p>`;
                }},
                { data: "phone", name: "phone", className: "text-center", render: function(data) {
                    return `<p>${data}</p>`;
                }},
                { data: "rol", name: "rol", className: "text-center", render: function(data) {
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