<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Traductor - Biblioteca Virtual</title>

    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">

</head>

<body>

@include('partials.nav', ['navActual' => 'traductores'])

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h3 class="mb-0">
                🌎 Información del traductor
            </h3>

        </div>


        <div class="card-body">

            <div class="row">


                <div class="col-md-4 text-center mb-4">

                    @if($traductore->archivo)

                        <img
                            src="{{ asset($traductore->archivo) }}"
                            class="img-fluid rounded"
                            style="max-height:300px; object-fit:cover;"
                        >

                    @else

                        <div
                            class="bg-light rounded d-flex align-items-center justify-content-center"
                            style="height:300px;"
                        >

                            <span class="text-muted">
                                Sin imagen
                            </span>

                        </div>

                    @endif

                </div>


                <div class="col-md-8">

                    <h2>
                        {{ $traductore->Nombre }}
                        {{ $traductore->Apellidos }}
                    </h2>


                    <hr>


                    <p>

                        <strong>
                            Idioma nativo:
                        </strong>

                        {{ $traductore->idioma_nativo ?? 'No registrado' }}

                    </p>


                    <p>

                        <strong>
                            Idiomas de traducción:
                        </strong>

                        {{ $traductore->idiomas_traduccion ?? 'No registrado' }}

                    </p>


                    <p>

                        <strong>
                            Certificaciones:
                        </strong>

                        {{ $traductore->certificaciones ?? 0 }}

                    </p>


                    <p>

                        <strong>
                            ID del traductor:
                        </strong>

                        {{ $traductore->ID_traductores }}

                    </p>


                    <div class="mt-4">

                        <a
                            href="{{ route('traductores.edit', ['traductore' => $traductore->ID_traductores]) }}"
                            class="btn btn-warning"
                        >
                            ✏️ Editar
                        </a>


                        <a
                            href="{{ route('traductores.index') }}"
                            class="btn btn-secondary"
                        >
                            ← Volver
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
