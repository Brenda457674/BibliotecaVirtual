<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Libros - Biblioteca Virtual</title>

    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>

<body>

@include('partials.nav', ['navActual' => 'libros'])


<main class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1>📚 Libros</h1>

            <p class="text-muted">
                Administración de libros de la biblioteca
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('inicio') }}"
               class="btn btn-outline-secondary">
                ← Inicio
            </a>

            <a href="{{ route('libros.create') }}"
               class="btn btn-primary">
                + Nuevo libro
            </a>

        </div>

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Portada</th>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Autor</th>
                            <th>Editor</th>
                            <th>Traductor</th>
                            <th>Género</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                    @forelse($libros as $libro)

                        <tr>

                            <td>
                                {{ $libro->ID_libro }}
                            </td>

                            <td>

                                @if($libro->archivo)

                                    <img
                                        src="{{ asset($libro->archivo) }}"
                                        width="60"
                                        height="80"
                                        style="object-fit: cover;"
                                        alt="Portada"
                                    >

                                @else

                                    <span class="text-muted">
                                        Sin portada
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $libro->Titulo }}
                            </td>

                            <td>
                                {{ $libro->Tipo ?? '—' }}
                            </td>

                            <td>
                                {{ $libro->autor
                                    ? $libro->autor->Nombre . ' ' . $libro->autor->Apellidos
                                    : 'Sin autor'
                                }}
                            </td>

                            <td>
                                {{ $libro->editor
                                    ? $libro->editor->Nombre . ' ' . $libro->editor->Apellidos
                                    : 'Sin editor'
                                }}
                            </td>

                            <td>
                                {{ $libro->traductor
                                    ? $libro->traductor->Nombre . ' ' . $libro->traductor->Apellidos
                                    : 'Sin traductor'
                                }}
                            </td>

                            <td>
                                {{ $libro->genero ?? '—' }}
                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route('libros.show', ['libro' => $libro->ID_libro]) }}"
                                        class="btn btn-sm btn-info text-white"
                                    >
                                        Ver
                                    </a>

                                    <a
                                        href="{{ route('libros.edit', ['libro' => $libro->ID_libro]) }}"
                                        class="btn btn-sm btn-warning"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('libros.destroy', ['libro' => $libro->ID_libro]) }}"
                                        method="POST"
                                        style="display:inline;"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Eliminar este libro?')"
                                        >
                                            Eliminar
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center py-5">

                                <h4>
                                    No hay libros registrados
                                </h4>

                                <p class="text-muted">
                                    Todavía no se ha registrado ningún libro.
                                </p>

                                <a
                                    href="{{ route('libros.create') }}"
                                    class="btn btn-primary"
                                >
                                    Registrar primer libro
                                </a>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</main>


<footer class="bg-dark text-white text-center py-4 mt-5">

    <p class="mb-1">
        📚 Biblioteca Virtual
    </p>

    <small>
        Instituto Tecnológico de Coracora
    </small>

</footer>

</body>

</html>

