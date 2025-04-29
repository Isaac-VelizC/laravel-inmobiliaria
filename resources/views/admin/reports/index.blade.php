@extends('layouts.app')

@section('title', 'Reporte de Citas')

@section('content')

<section class="tab-components">
    <div class="container-fluid">
        <x-title-wrapper title="Reportes de Citas" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Reportes', 'url' => '/']
        ]" />

        @if (session('error'))
        <x-alert type="danger" title="Error" heading="Error" message="{{ session('error') }}" />
        @endif

        <div class="form-elements-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card-style mb-30">
                        <form action="{{ route('adm.reportes.citas.generar') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <!-- NUEVOS CAMPOS PARA REPORTES -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="month" id="report_month" name="report_month" class="form-control">
                                        <label for="report_month">Mes del reporte</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <select id="report_propiedad" name="propiedad" class="form-select">
                                            <option value="">Todas las propiedades</option>
                                            @foreach($propiedades as $propiedad)
                                            <option value="{{ $propiedad->id }}">
                                                {{ $propiedad->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="report_propiedad">Filtrar por propiedad</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <select id="report_agente" name="agente_report" class="form-select">
                                            <option value="">Todos los agentes</option>
                                            @foreach($agentes as $agente)
                                            <option value="{{ $agente->id }}">
                                                {{ $agente->usuario->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="report_agente">Filtrar por agente</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <select id="report_status" name="status" class="form-select">
                                            <option value="">Todos los estados</option>
                                            <option value="pendiente">Pendiente</option>
                                            <option value="confirmada">Confirmada</option>
                                            <option value="cancelada">Cancelada</option>
                                            <option value="completada">Completada</option>
                                        </select>
                                        <label for="report_status">Estado de cita</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" id="report_date_from" name="date_from" class="form-control">
                                        <label for="report_date_from">Desde</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" id="report_date_to" name="date_to" class="form-control">
                                        <label for="report_date_to">Hasta</label>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 d-flex flex-row justify-content-end gap-2">
                                <button type="submit" id="generateReportBtn" class="main-btn info-btn btn-hover">
                                    <i class="mdi mdi-chart-bar me-2"></i> Generar Reporte
                                </button>
                                <button type="reset" class="main-btn secondary-btn-outline btn-hover">Cancelar</button>
                            </div>
                        </form>
                        <!-- Resultados del Reporte -->
                        @isset($citas)
                        <div class="mt-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>Resultados del Reporte</h4>
                                <span class="badge bg-primary">
                                    Total: {{ $citas->total() }} citas
                                </span>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre Cita</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Propiedad</th>
                                            <th>Agente</th>
                                            <th>Visitantes</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($citas as $cita)
                                        <tr>
                                            <td>{{ $loop->iteration + (($citas->currentPage() - 1) * $citas->perPage())
                                                }}</td>
                                            <td>{{ $cita->name }}</td>
                                            <td>{{ $cita->date }}</td>
                                            <td>{{ \Carbon\Carbon::parse($cita->time)->format('h:i A') }}</td>
                                            <td>{{ $cita->hacienda->name ?? 'N/A' }}</td>
                                            <td>{{ $cita->guia->usuario->name ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $cita->cantidad }}</td>
                                            <td class="text-center">
                                                @php
                                                $badgeClass = [
                                                'pendiente' => 'bg-warning',
                                                'confirmada' => 'bg-success',
                                                'cancelada' => 'bg-danger',
                                                'concretada' => 'bg-primary'
                                                ][$cita->status] ?? 'bg-secondary';
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">
                                                    {{ ucfirst($cita->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No se encontraron citas con los filtros
                                                seleccionados</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Paginación -->
                            @if($citas->hasPages())
                            <div class="mt-4">
                                {{ $citas->appends($filtros)->links() }}
                            </div>
                            @endif
                        </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('scripts')
<script>
    // Script para manejar el formulario de reportes
document.addEventListener('DOMContentLoaded', function() {
    // Formatear fechas para mostrarlas en los inputs
    const formatDateInput = (date) => {
        return date ? new Date(date).toISOString().split('T')[0] : '';
    };

    // Preservar los filtros al recargar la página
    @isset($filtros)
        const filtros = @json($filtros);
        Object.entries(filtros).forEach(([key, value]) => {
            const element = document.querySelector(`[name="${key}"]`);
            if(element) element.value = key.includes('date') ? formatDateInput(value) : value;
        });
    @endisset

    // Validación básica de fechas
    document.querySelector('form').addEventListener('submit', function(e) {
        const dateFrom = document.getElementById('report_date_from').value;
        const dateTo = document.getElementById('report_date_to').value;
        
        if(dateFrom && dateTo && dateFrom > dateTo) {
            e.preventDefault();
            alert('La fecha "Desde" no puede ser mayor a la fecha "Hasta"');
        }
    });
});
</script>
@endpush