<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inicio - Biblioteca Virtual</title>

    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>

<body>

@include('partials.nav', ['navActual' => 'inicio'])


{{-- BIENVENIDA --}}

<section class="bg-dark text-white">

    <div class="container py-5">

        <div class="row align-items-center g-4">

            <div class="col-lg-8">

                <span class="badge text-bg-warning mb-3">
                    Instituto Tecnológico de Coracora
                </span>

                <h1 class="display-5 fw-bold mb-3">
                    📚 Biblioteca Virtual
                </h1>

                <p class="lead mb-4" style="max-width: 720px;">
                    Bienvenido al sistema de la Biblioteca Virtual del Instituto
                    Tecnológico de Coracora. Aquí puedes consultar, registrar y
                    administrar los libros de la biblioteca junto con sus autores,
                    editores y traductores.
                </p>

                <div class="d-flex flex-wrap gap-2">

                    <a href="{{ route('libros.index') }}"
                       class="btn btn-light">
                        📖 Libros
                    </a>

                    <a href="{{ route('autores.index') }}"
                       class="btn btn-outline-light">
                        ✍️ Autores
                    </a>

                    <a href="{{ route('editores.index') }}"
                       class="btn btn-outline-light">
                        🏢 Editores
                    </a>

                    <a href="{{ route('traductores.index') }}"
                       class="btn btn-outline-light">
                        🌎 Traductores
                    </a>

                </div>

            </div>

            <div class="col-lg-4 text-center">

                <div class="rounded d-inline-flex align-items-center justify-content-center"
                     style="
                         width: 190px;
                         height: 190px;
                         background: rgba(255,255,255,.12);
                         font-size: 90px;
                     ">
                    📖
                </div>

            </div>

        </div>

    </div>

</section>


{{-- LIBROS DISPONIBLES --}}

<section class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

        <div>
            <h2 class="mb-1">📚 Libros disponibles</h2>

            <p class="text-muted mb-0">
                Algunos de los libros registrados actualmente en la biblioteca.
            </p>
        </div>

        <a href="{{ route('libros.index') }}"
           class="btn btn-primary">
            Ver libros →
        </a>

    </div>


    @if (session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if ($libros->isEmpty())

        <div class="card shadow-sm">

            <div class="card-body text-center py-5">

                <div style="font-size: 60px;">📖</div>

                <h4 class="mt-3">No hay libros registrados</h4>

                <p class="text-muted">
                    Todavía no se ha registrado ningún libro en la biblioteca.
                </p>

                <a href="{{ route('libros.create') }}"
                   class="btn btn-primary">
                    + Registrar primer libro
                </a>

            </div>

        </div>

    @else

        <div class="row g-4">

            @foreach ($libros as $libro)

                <div class="col-sm-6 col-lg-3">

                    <div class="card shadow-sm h-100">

                        @if ($libro->archivo)

                            <img src="{{ asset($libro->archivo) }}"
                                 class="card-img-top"
                                 alt="Portada de {{ $libro->Titulo }}"
                                 style="height: 250px; object-fit: cover;">

                        @else

                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height: 250px; font-size: 60px;">
                                📖
                            </div>

                        @endif

                        <div class="card-body">

                            <span class="badge bg-secondary mb-2">
                                {{ $libro->Tipo ?? 'Libro' }}
                            </span>

                            <h5 class="card-title">
                                {{ $libro->Titulo }}
                            </h5>

                            <p class="small text-muted mb-2">
                                <strong>Autor:</strong>
                                {{ $libro->autor
                                    ? $libro->autor->Nombre . ' ' . $libro->autor->Apellidos
                                    : 'Sin autor' }}
                                <br>

                                <strong>Editor:</strong>
                                {{ $libro->editor
                                    ? $libro->editor->Nombre . ' ' . $libro->editor->Apellidos
                                    : 'Sin editor' }}
                                <br>

                                <strong>Traductor:</strong>
                                {{ $libro->traductor
                                    ? $libro->traductor->Nombre . ' ' . $libro->traductor->Apellidos
                                    : 'Sin traductor' }}
                                <br>

                                <strong>Género:</strong>
                                {{ $libro->genero ?? '—' }}
                            </p>

                        </div>

                        <div class="card-footer bg-white">

                            <a href="{{ route('libros.show', ['libro' => $libro->ID_libro]) }}"
                               class="btn btn-sm btn-outline-primary w-100">
                                Ver detalle
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</section>


<footer class="bg-dark text-white text-center py-4">

    <p class="mb-1">📚 Biblioteca Virtual</p>

    <small style="opacity: .75;">
        Instituto Tecnológico de Coracora
    </small>

</footer>

</body>

</html>



