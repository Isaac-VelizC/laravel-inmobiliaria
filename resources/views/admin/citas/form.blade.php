@extends('layouts.app')

@section('content')

<section class="tab-components">
    <div class="container-fluid">
        <x-title-wrapper title="Citas en Grupo" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Citas en Grupo', 'url' => route('adm.citas.group.index')],
            ['label' => isset($group) ? 'Editar' : 'Nuevo', 'url' => null]
        ]" />

        @if (session('error'))
            <x-alert type="danger" title="Error" heading="Error" message="{{ session('error') }}" />
        @endif

        <div class="form-elements-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card-style mb-30">
                        <div class="card-header mb-30">
                            <h4>{{ isset($group) ? 'Editar información de la' : 'Registrar nueva' }} cita</h4>
                        </div>
                        <form action="{{ isset($group) ? route('adm.citas.group.update', $group->id) : route('adm.citas.group.store') }}" method="POST">
                            @csrf
                            @isset($group)
                                @method('PUT')
                            @endisset
                            <input type="hidden" id="propiedad" name="propiedad" value="{{ $propiedadId }}">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Juan"
                                            value="{{ old('name', $group->name ?? '') }}" />
                                        <label for="name">Nombre de la cita</label>
                                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" id="fecha" name="date" min="{{ date("Y-m-d") }}" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $group->date ?? '') }}" />
                                        <label for="date">Fecha de la cita</label>
                                        @error('date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <select id="time" name="time" class="form-control">
                                            <option value="">Seleccione una hora</option>
                                        </select>
                                        <label for="time">Hora</label>
                                        @if ($group)
                                        <span class="text-warning">Horario: {{ $group->time }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" id="cantidad" name="cantidad" class="form-control @error('cantidad') is-invalid @enderror"
                                            min="1" max="20" value="{{ old('cantidad', $group->cantidad ?? 1) }}" />
                                        <label for="cantidad">Numero de visitantes</label>
                                        @error('cantidad') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-floating form-floating-outline">
                                        <select id="agente" name="agente" class="select2 form-select" data-placeholder="agente" required>
                                            <option value="" disabled selected>Seleccionar un agente</option>
                                            @foreach($agentes as $ag)
                                                <option value="{{ $ag->id }}" {{ old('agente', $group->agente ?? '') == $ag->id ? 'selected' : '' }}>
                                                    {{ $ag->usuario->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="agente">Agente del grupo</label>
                                        @error('agente') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <label for="detail">Detalles de la cita (Opcional)</label>
                                        <textarea id="detail" name="detail" class="form-control @error('detail') is-invalid @enderror" rows="3">
                                            {{ old('detail', $group->detail ?? '') }}
                                        </textarea>
                                        @error('detail') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 d-flex flex-row justify-content-end gap-2">
                                <a href="{{ route('adm.citas.group.index') }}" class="main-btn secondary-btn-outline btn-hover">Cancelar</a>
                                <button type="submit" class="main-btn primary-btn btn-hover">
                                    {{ isset($group) ? 'Actualizar' : 'Crear' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Carga horarios al cambiar la fecha
        $('#fecha').on('change', function () {
            let fecha = $(this).val();

            if (fecha) {
                $.ajax({
                    url: "{{ route('obtenerHorarios') }}",
                    method: "GET",
                    data: { fecha: fecha },
                    success: function (response) {
                        let select = $('#time');
                        select.empty();
                        select.append('<option value="">Seleccione una hora</option>');
                        
                        response.forEach(function (hora) {
                            select.append(`<option value="${hora}">${hora}</option>`);
                        });

                        // Selecciona la hora actual si se está editando
                        if (typeof group !== 'undefined' && group.time) {
                            select.val(group.time);
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Error al cargar horarios');
                    }
                });
            }
        });

        // Carga horarios iniciales si se está editando
        if (typeof group !== 'undefined' && group.date) {
            $('#fecha').trigger('change');
        }
    });
</script>
@endpush
