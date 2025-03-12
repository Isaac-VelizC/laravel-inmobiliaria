@extends('layouts.app')
@section('title', 'Propiedades - Agregar')

@section('content')
<link rel="stylesheet" href="{{ asset('/assets/lib/leaflet/dist/leaflet.css')}}" />
<script src="{{ asset('/assets/lib/leaflet/dist/leaflet.js')}}"></script>
<script>
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    function agregarInmueble() {
            const propiedadId = $('#propiedadID').val();
            var data = {
                name: $('#name').val(),
                address: $('#address').val(),
                city: $('#city').val(),
                tipo_propiedad: $('#tipo_propiedad').val(),
                tipo_traspaso: $('#tipo_traspaso').val(),
                num_rooms: $('#num_rooms').val(),
                num_bedrooms: $('#num_bedrooms').val(),
                num_hall: $('#num_hall').val(),
                num_bathrooms: $('#num_bathrooms').val(),
                num_kitchens: $('#num_kitchens').val(),
                num_garages: $('#num_garages').val(),
                constructed_area: $('#constructed_area').val(),
                ground_surface: $('#ground_surface').val(),
                description: $('#description').val(),
                price: $('#price').val(),
                coin: $('#coin').val(),
                status: $('#status').val(),
                date: $('#date').val(),
                end_date: $('#end_date').val(),
                propietario: $('#propietario').val(),
                latitude: $('#latitude').val(),
                longitude: $('#longitude').val(),
                bank_financing: $('#bank_financing').val(),
                state_advertising: $('#state_advertising').val()
            };
            $.ajax({
                type: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                url: propiedadId ? `/admin/propiedades/editar_existente/${propiedadId}` : '{{ route('adm.propiedades.agregar_nuevo') }}',
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function(response) {
                    alert('Datos enviados con éxito');
                    window.location.href = propiedadId 
                    ? `/admin/propiedades/propietario/show/${propiedadId}`
                    : '{{ route('adm.subir.imagenes') }}/'+response.UltID;
                },
                error: function(error9) {
                    alert('Hubo un error al enviar los datos' );
                    console.error(error9);
                    $('#frmAgregarInmueble input').removeClass('is-invalid');
                    $('#frmAgregarInmueble2 input').removeClass('is-invalid');
                    $('#frmAgregarInmueble3 input').removeClass('is-invalid');
                    if (error9.status === 422) {
                        var errors = error9.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#error-' + key).text(value[0]);
                        });
                    }
                }
            });
        }
        function redireccionar(url) {
            window.location.href = url;
        }
</script>


<section class="tab-components">
    <div class="container-fluid">
        <x-title-wrapper title="Formulario Propiedad" :breadcrumbs="[
            ['label' => 'Panel', 'url' => route('home')],
            ['label' => 'Propiedades', 'url' => route('adm.index.propiedades')],
            ['label' => isset($propiedad) ? 'Editar' : 'agregar', 'url' => null]
        ]" />

        @if (session('error'))
        <x-alert type="danger" title="danger" heading="Error" message="{{ session('error') }}" />
        @endif

        <div class="d-flex justify-content-end mb-3">
            <button type="button" onclick="agregarInmueble();" id="submitBtn" class="main-btn primary-btn btn-hover">{{
                !$propiedad ? 'Publicar' : 'Actualizar'}}</button>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card-style mb-30">
                    <h6 class="mb-25">Información de la {{ !$propiedad ? 'nueva Propiedad ' : 'propiedad existente' }}
                    </h6>
                    <form id="frmAgregarInmueble">
                        <input type="hidden" id="propiedadID" name="propiedad_id" value="{{$propiedad->id ?? null }}">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class=" form-control" id="name" placeholder="Nombre de la propiedad"
                                name="name" value="{{ old('name', $propiedad->name ?? '') }}">
                            <div class="invalid-feedback" id="error-name"></div>
                            <label for="name">Nombre de la propiedad</label>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select id="city" name="city" class="select2 form-select" data-placeholder="Ciudad">
                                        @foreach($ciudades as $ciudad)
                                        <option value="{{ $ciudad['nombre'] }}" {{ ($propiedad ? $propiedad->city :
                                            old('city')) == $ciudad['nombre'] ? 'selected' : ($ciudad['nombre'] ==
                                            'Potosí' ? 'selected' : '') }}>
                                            {{ $ciudad['nombre'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <label for="city">Ciudad</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Dirección" value="{{ old('address', $propiedad->address ?? '') }}">
                                    <div class="invalid-feedback" id="error-address"></div>
                                    <label for="address">Dirección</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <button type="button" onclick="abrirMapa()" class="btn btn-primary">Abrir Mapa</button>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <input type="text" class="form-control" id="latitude" placeholder="Latitud"
                                        name="latitude" disabled
                                        value="{{ old('latitude', $propiedad->latitude ?? '') }}">
                                    <div class="invalid-feedback" id="error-latitude"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <input type="text" class="form-control" id="longitude" placeholder="Longitud"
                                        name="longitude" disabled
                                        value="{{ old('longitude', $propiedad->longitude ?? '') }}">
                                    <div class="invalid-feedback" id="error-longitude"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col tooltip-container">
                                <span class="tooltip-text">Nº de Garajes</span>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text" id="basic-addon42"><span
                                            class="mdi mdi-garage-open-variant"></span></span>
                                    <input type="number" name="num_garages" id="num_garages" min="0" placeholder="0"
                                        class="form-control"
                                        value="{{ old('num_garages', $propiedad->num_garages ?? '') }}">
                                    <div class="invalid-feedback" id="error-num_garages"></div>
                                </div>
                            </div>
                            <div class="col tooltip-container">
                                <span class="tooltip-text">Nº de Baños</span>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text" id="basic-addon45"><span
                                            class="mdi mdi-toilet"></span></span>
                                    <input type="number" name="num_bathrooms" id="num_bathrooms" min="0" placeholder="0"
                                        class="form-control"
                                        value="{{ old('num_bathrooms', $propiedad->num_bathrooms ?? '') }}">
                                    <div class="invalid-feedback" id="error-num_bathrooms"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col tooltip-container">
                                <span class="tooltip-text">Nº de Dormitorios</span>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text" id="basic-addon43"><span
                                            class="mdi mdi-bed-empty"></span></span>
                                    <input type="number" name="num_bedrooms" id="num_bedrooms" min="0" placeholder="0"
                                        class="form-control"
                                        value="{{ old('num_bedrooms', $propiedad->num_bedrooms ?? '') }}">
                                    <div class="invalid-feedback" id="error-num_bedrooms"></div>
                                </div>
                            </div>
                            <div class="col tooltip-container">
                                <span class="tooltip-text">Nº de Salas</span>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text" id="basic-addon44"><span
                                            class="mdi mdi-sofa-single"></span></span>
                                    <input type="number" name="num_hall" id="num_hall" min="0" placeholder="0"
                                        class="form-control" value="{{ old('num_hall', $propiedad->num_hall ?? '') }}">
                                    <div class="invalid-feedback" id="error-num_hall"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col tooltip-container">
                                <span class="tooltip-text">Nº de Ambientes</span>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text" id="basic-addon41"><span
                                            class="mdi mdi-home-city-outline"></span></span>
                                    <input type="number" name="num_rooms" id="num_rooms" min="0" placeholder="0"
                                        class="form-control"
                                        value="{{ old('num_rooms', $propiedad->num_rooms ?? '') }}">
                                    <div class="invalid-feedback" id="error-num_rooms"></div>
                                </div>
                            </div>
                            <div class="col tooltip-container">
                                <span class="tooltip-text">Nº de Cocinas</span>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text" id="basic-addon46"><span
                                            class="mdi mdi-chef-hat"></span></span>
                                    <input type="number" name="num_kitchens" id="num_kitchens" class="form-control"
                                        min="0" placeholder="0"
                                        value="{{ old('num_kitchens', $propiedad->num_kitchens ?? '') }}">
                                    <div class="invalid-feedback" id="error-num_kitchens"></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <textarea class="form-control p-2 pt-1" id="description" name="description"
                                placeholder="Descripción corta de la propiedad"
                                rows="6">{{ old('escription', $propiedad->description ?? '') }}</textarea>
                            <div class="invalid-feedback" id="error-description"></div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Second column -->

            <!-- Second column -->
            <div class="col-12 col-lg-4">
                <div class="card-style mb-30">
                    <h6 class="mb-25">Precio</h6>
                    <form id="frmAgregarInmueble2">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" id="price" placeholder="Precio" name="price"
                                min="0" value="{{ old('price', $propiedad->price ?? '0') }}">
                            <div class="invalid-feedback" id="error-price"></div>
                            <label for="price">Precio</label>
                        </div>
                        <!-- Discounted Price -->
                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select" id="coin" name="coin">
                                <option value="USD" {{ ($propiedad ? $propiedad->coin : old('coin')) == 'USD' ?
                                    'selected' : '' }}>Dolar</option>
                                <option value="Bs" {{ ($propiedad ? $propiedad->coin : old('coin')) == 'Bs' ? 'selected'
                                    : '' }}>Bolivianos</option>
                            </select>
                            <label for="coin">Moneda</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <div class="invalid-feedback" id="error-bank_financing"></div>
                            <select class="form-select" id="bank_financing" name="bank_financing">
                                <option value="No" {{ ($propiedad ? $propiedad->bank_financing : old('bank_financing'))
                                    == 'No' ? 'selected' : '' }}>No</option>
                                <option value="Si" {{ ($propiedad ? $propiedad->bank_financing : old('bank_financing'))
                                    == 'Si' ? 'selected' : '' }}>Sí</option>
                            </select>
                            <label for="bank_financing">Financiamiento Bancario</label>
                        </div>
                        <div class="border-top pt-3"></div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" min="0" id="constructed_area"
                                placeholder="Superifica Terreno" name="constructed_area"
                                value="{{ old('constructed_area', $propiedad->constructed_area ?? '') }}">
                            <div class="invalid-feedback" id="error-constructed_area"></div>
                            <label for="constructed_area">Superificie Terreno m²</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" min="0" id="ground_surface"
                                placeholder="Superifica Construida" name="ground_surface"
                                value="{{ old('ground_surface', $propiedad->ground_surface ?? '') }}">
                            <div class="invalid-feedback" id="error-ground_surface"></div>
                            <label for="ground_surface">Superificie Construida m²</label>
                        </div>
                    </form>
                </div>

                <div class="card-style mb-30">
                    <h6 class="mb-25">Organizar</h6>
                    <form id="frmAgregarInmueble3">
                        <div class="mb-4 col ecommerce-select2-dropdown d-flex justify-content-between">
                            <div class="form-floating form-floating-outline w-100 me-3">
                                <select id="propietario" name="propietario" class="select2 form-select">
                                    @foreach($propietarios as $p)
                                    <option value="{{ $p->id }}" {{ ($propiedad ? $propiedad->propietario :
                                        old('propietario')) == $p->id ? 'selected' : '' }}>
                                        {{ $p->name }} {{ $p->surnames }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="propietario">Propietario</label>
                            </div>
                            <div>
                                <button onclick="abrirPropietario(event)"
                                    class="btn btn-outline-primary btn-icon btn-lg h-px-50">
                                    <i class="mdi mdi-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-4 col ecommerce-select2-dropdown d-flex justify-content-between">
                            <div class="form-floating form-floating-outline w-100 me-3">
                                <select id="tipo_propiedad" name="tipo_propiedad" class="select2 form-select">
                                    @foreach($tipopropiedad as $t)
                                    <option value="{{ $t->id }}" {{ ($propiedad ? $propiedad->tipo_propiedad :
                                        old('tipo_propiedad')) == $t->id ? 'selected' : '' }}>
                                        {{ $t->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="tipo_propiedad">Tipo de Propiedad</label>
                            </div>
                            <div>
                                <button onclick="abrirTipo(event)"
                                    class="btn btn-outline-primary btn-icon btn-lg h-px-50">
                                    <i class="mdi mdi-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4 col ecommerce-select2-dropdown d-flex justify-content-between">
                            <div class="form-floating form-floating-outline w-100 me-3">
                                <select id="tipo_traspaso" name="tipo_traspaso" class="select2 form-select">
                                    @foreach($ventastipo as $t)
                                    <option value="{{ $t->id }}" {{ ($propiedad ? $propiedad->tipo_traspaso :
                                        old('tipo_traspaso')) == $t->id ? 'selected' : '' }}>
                                        {{ $t->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="tipo_traspaso">Tipo de venta</label>
                            </div>
                            <div>
                                <button onclick="abrirVentaTipo(event)"
                                    class="btn btn-outline-primary btn-icon btn-lg h-px-50">
                                    <i class="mdi mdi-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="date" class="form-control" id="date" placeholder="Fecha Inicio" name="date"
                                value="{{ old('date', $propiedad->date ?? date(" Y-m-d")) }}" min="{{ date(" Y-m-d")
                                }}">
                            <div class="invalid-feedback" id="error-date"></div>
                            <label for="date">Fecha Inicio</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="date" class="form-control" id="end_date" placeholder="Fecha Final"
                                name="end_date" min="{{ date(" Y-m-d") }}"
                                value="{{ old('end_date', $propiedad->end_date ?? '') }}">
                            <div class="invalid-feedback" id="error-end_date"></div>
                            <label for="end_date">Fecha Final</label>
                        </div>
                        <div class="mb-4 col ecommerce-select2-dropdown">
                            <div class="form-floating form-floating-outline">
                                <select id="state_advertising" name="state_advertising" class="select2 form-select">
                                    <option value="no" {{ ($propiedad ? $propiedad->state_advertising :
                                        old('state_advertising')) == 'no' ? 'selected' : '' }}>No</option>
                                    <option value="publicitado" {{ ($propiedad ? $propiedad->state_advertising :
                                        old('state_advertising')) == 'publicitado' ? 'selected' : '' }}>Publicitado
                                    </option>
                                </select>
                                <label for="state_advertising">Con Publicidad</label>
                            </div>
                        </div>
                        <div class="mb-4 col ecommerce-select2-dropdown">
                            <div class="form-floating form-floating-outline">
                                <select id="status" name="status" class="select2 form-select"
                                    data-placeholder="Select Status">
                                    <option value="Disponible" {{ ($propiedad ? $propiedad->status : old('status')) ==
                                        'Disponible' ? 'selected' : '' }}>Disponible</option>
                                    <option value="Vendido" {{ ($propiedad ? $propiedad->status : old('status')) ==
                                        'Vendido' ? 'selected' : '' }}>Vendido</option>
                                    <option value="Alquilado" {{ ($propiedad ? $propiedad->status : old('status')) ==
                                        'Alquilado' ? 'selected' : '' }}>Alquilado</option>
                                </select>
                                <label for="status">Estado</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Second column -->
        </div>
    </div>
</section>

@include('admin.propiedades.include.modal_propietario')
@include('admin.propiedades.include.modal_tipo_propiedad')
@include('admin.propiedades.include.modal_tipo_traspaso')
@include('admin.propiedades.include.modal_mapa')
@endsection