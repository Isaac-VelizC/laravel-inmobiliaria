<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Soluciones Inmobiliarias - Encuesta</title>
    <meta name="description"
        content="Encuentra las mejores propiedades en venta y alquiler en [Ciudad] con Soluciones Inmobiliarias. Somos expertos en el mercado inmobiliario, te asesoramos para comprar, vender o alquilar tu casa o departamento.">
    <meta name="keywords"
        content="inmobiliaria, casas en venta, departamentos en alquiler, [Ciudad], bienes raíces, comprar casa, vender inmueble">
    <meta name="robots" content="index, follow">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{ asset('assets/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{ asset('assets/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Main Stylesheet File -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Estilos generales del cuerpo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Estilos para la sección contenedora */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para los encabezados */
        h5 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #007bff;
            font-weight: 600;
        }

        /* Estilos para las etiquetas de las preguntas */
        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        /* Estilos para las opciones de respuesta */
        .form-check {
            margin-bottom: 10px;
        }

        /* Estilos para el botón de enviar */
        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Estilos para el mensaje de error */
        .invalid-feedback {
            color: red;
            font-size: 0.9rem;
            display: none;
        }

        .needs-validation .form-check-input:invalid~.invalid-feedback {
            display: block;
        }
    </style>
</head>

<body>
    <section class="container py-8">
        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(!$estadEncuesta)
                <form method="POST" action="{{ route('usuario.citas.encuesta_respuesta') }}" class="needs-validation">
                    @csrf
                    <input type="hidden" name="cita_id" value="{{ $cita->id }}">
                    <input type="hidden" name="encuesta_id" value="{{ $encuesta->id }}">
                    <input type="hidden" name="propiedad" value="{{ $propiedad->id }}">

                    <h5 class="mb-3">{{ $encuesta->name }} para la propiedad {{ $propiedad->name }}</h5>

                    @foreach ($encuesta->preguntas as $pregunta)
                    <div class="mb-3">
                        <label class="form-label">{{ $pregunta->question }}</label>
                        <div class="ms-3">
                            <!-- Agrega margen izquierdo para mejor alineación -->
                            @foreach ($pregunta->respuestas as $respuesta)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="respuestas[{{ $pregunta->id }}]"
                                    id="respuesta_{{ $pregunta->id }}_{{ $respuesta->id }}" value="{{ $respuesta->id }}"
                                    required>
                                <label class="form-check-label"
                                    for="respuesta_{{ $pregunta->id }}_{{ $respuesta->id }}">
                                    {{ $respuesta->question }}
                                </label>
                            </div>
                            @endforeach
                            <div class="invalid-feedback">Debes seleccionar una opción</div>
                        </div>
                    </div>
                    @endforeach
                    <button class="btn btn-b" type="submit">Enviar</button>
                </form>
                @else
                <div class="text-center py-5">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>
                        <h4 class="alert-heading">¡Encuesta completada!</h4>
                        <hr>
                        <div class="mb-3">
                            <p class="mb-1">Propiedad evaluada: <strong>{{ $propiedad->name }}</strong></p>
                            <p class="mb-1">
                                Visita realizada el:
                                <span class="text-muted">
                                    {{ \Carbon\Carbon::parse($cita->date)->isoFormat('D [de] MMMM [de] YYYY') }}
                                    a las {{ \Carbon\Carbon::parse($cita->time)->format('H:i') }}
                                </span>
                            </p>
                        </div>
                        <button type="button" class="btn btn-success" onclick="window.close();"
                            aria-label="Cerrar ventana">
                            <i class="fa fa-times-circle me-2"></i>Cerrar ventana
                        </button>
                    </div>

                    <div class="mt-4 text-muted small">
                        <i class="fa fa-info-circle"></i> Gracias por ayudarnos a mejorar nuestro servicio
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</body>

</html>