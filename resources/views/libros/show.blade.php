
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ $libro->Titulo }}</title>

    <link rel="stylesheet"
          href="{{ asset('bootstrap.min.css') }}">

    <link rel="stylesheet"
          href="{{ asset('app.css') }}">

</head>

<body>

@include('partials.nav', ['navActual' => 'libros'])

<div class="container py-5">

    <div class="mb-4">

        <h1>📖 Información del libro</h1>

    </div>


    <div class="card shadow">

        <div class="row g-0">

            <div class="col-md-4 text-center p-4">

                @if($libro->archivo)

                    <img
                        src="{{ asset($libro->archivo) }}"
                        alt="{{ $libro->Titulo }}"
                        class="img-fluid rounded shadow"
                        style="max-height: 450px; object-fit: cover;"
                    >

                @else

                    <div
                        class="bg-light rounded d-flex align-items-center justify-content-center"
                        style="height: 350px;"
                    >

                        <span style="font-size: 100px;">
                            📖
                        </span>

                    </div>

                @endif

            </div>


            <div class="col-md-8">

                <div class="card-body p-4">

                    <h2 class="mb-4">
                        {{ $libro->Titulo }}
                    </h2>


                    <div class="mb-3">

                        <strong>Tipo:</strong>

                        {{ $libro->Tipo ?? 'No especificado' }}

                    </div>


                    <div class="mb-3">

                        <strong>Género:</strong>

                        {{ $libro->genero ?? 'No especificado' }}

                    </div>


                    <div class="mb-3">

                        <strong>Autor:</strong>

                        @if($libro->autor)

                            {{ $libro->autor->Nombre }}
                            {{ $libro->autor->Apellidos }}

                        @else

                            Sin autor

                        @endif

                    </div>


                    <div class="mb-3">

                        <strong>Editor:</strong>

                        @if($libro->editor)

                            {{ $libro->editor->Nombre }}
                            {{ $libro->editor->Apellidos }}

                            @if($libro->editor->nombre_editorial)

                                - {{ $libro->editor->nombre_editorial }}

                            @endif

                        @else

                            Sin editor

                        @endif

                    </div>


                    <div class="mb-4">

                        <strong>Traductor:</strong>

                        @if($libro->traductor)

                            {{ $libro->traductor->Nombre }}
                            {{ $libro->traductor->Apellidos }}

                        @else

                            Sin traductor

                        @endif

                    </div>


                    <div class="d-flex gap-2">

                        <a
                            href="{{ route('libros.edit', ['libro' => $libro->ID_libro]) }}"
                            class="btn btn-warning"
                        >
                            ✏️ Editar
                        </a>


                        <form
                            action="{{ route('libros.destroy', ['libro' => $libro->ID_libro]) }}"
                            method="POST"
                            onsubmit="return confirm('¿Seguro que deseas eliminar este libro?')"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger"
                            >
                                🗑️ Eliminar
                            </button>

                        </form>


                        <a
                            href="{{ route('libros.index') }}"
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

