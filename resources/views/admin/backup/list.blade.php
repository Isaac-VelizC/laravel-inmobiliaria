@extends('layouts.app')

@section('title', 'Copias de Seguridad')

@section('content')

<section class="table-components">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <x-title-wrapper title="Copias de seguridad" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'copias de seguridad', 'url' => null]
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
                                <h6 class="mb-10">Lista de copias de seguridad</h6>
                            </div>
                                <form action="{{ route('backup.run') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info mb-3">Ejecutar Backup</button>
                                </form>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table id="datatableUsers" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>Archivo</th>
                                        <th>Tamaño</th>
                                        <th>Última modificación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($backups as $backup)
                                    <tr>
                                        <td>{{ basename($backup['path']) }}</td>
                                        <td>{{ number_format($backup['size'] / 1048576, 2) }} MB</td>
                                        <td>{{ date('Y-m-d H:i:s', $backup['last_modified']) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('backup.delete', basename($backup['path'])) }}"
                                                class="btn btn-sm btn-icon btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            <a href="{{ route('backup.download', basename($backup['path'])) }}"
                                                class="btn btn-sm btn-icon btn-success">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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