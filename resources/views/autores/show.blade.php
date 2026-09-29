<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Autor - Biblioteca Virtual</title>

    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>

<body>

@include('partials.nav', ['navActual' => 'autores'])

<div class="container py-5">

    <div class="mb-4">

        <h1>👤 Información del autor</h1>

        <p class="text-muted">
            Detalles del autor registrado
        </p>

    </div>


    <div class="card shadow">

        <div class="card-body p-4">

            <div class="row align-items-center">

                <div class="col-md-4 text-center">

                    @if($autore->archivo)

                        <img
                            src="{{ asset($autore->archivo) }}"
                            class="img-fluid rounded"
                            style="max-width: 250px; max-height: 300px; object-fit: cover;"
                            alt="Autor"
                        >

                    @else

                        <div
                            class="bg-light rounded p-5 text-muted"
                        >
                            👤
                            <br>
                            Sin imagen
                        </div>

                    @endif

                </div>


                <div class="col-md-8">

                    <h2>
                        {{ $autore->Nombre }}
                        {{ $autore->Apellidos }}
                    </h2>

                    <hr>


                    <p>
                        <strong>ID:</strong>
                        {{ $autore->ID_autores }}
                    </p>


                    <p>
                        <strong>Teléfono:</strong>
                        {{ $autore->telefono }}
                    </p>


                    <p>
                        <strong>Correo:</strong>
                        {{ $autore->correo }}
                    </p>


                    <div class="mt-4">

                        <a
                            href="{{ route('autores.edit', ['autore' => $autore->ID_autores]) }}"
                            class="btn btn-warning"
                        >
                            Editar
                        </a>

                        <a
                            href="{{ route('autores.index') }}"
                            class="btn btn-secondary"
                        >
                            Volver
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
