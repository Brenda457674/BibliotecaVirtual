<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Autores - Biblioteca Virtual</title>

    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>

<body>

@include('partials.nav', ['navActual' => 'autores'])

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1>👤 Autores</h1>

            <p class="text-muted">
                Administración de autores de la biblioteca
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('inicio') }}"
               class="btn btn-outline-secondary">
                ← Inicio
            </a>

            <a href="{{ route('autores.create') }}"
               class="btn btn-primary">
                + Nuevo autor
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
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                    @forelse($autores as $autor)

                        <tr>

                            <td>
                                {{ $autor->ID_autores }}
                            </td>

                            <td>

                                @if($autor->archivo)

                                    <img
                                        src="{{ asset($autor->archivo) }}"
                                        width="60"
                                        height="60"
                                        style="object-fit: cover; border-radius: 8px;"
                                        alt="Autor"
                                    >

                                @else

                                    <span class="text-muted">
                                        Sin imagen
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $autor->Nombre }}
                            </td>

                            <td>
                                {{ $autor->Apellidos }}
                            </td>

                            <td>
                                {{ $autor->telefono }}
                            </td>

                            <td>
                                {{ $autor->correo }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('autores.show', ['autore' => $autor->ID_autores]) }}"
                                    class="btn btn-sm btn-info"
                                >
                                    Ver
                                </a>

                                <a
                                    href="{{ route('autores.edit', ['autore' => $autor->ID_autores]) }}"
                                    class="btn btn-sm btn-warning"
                                >
                                    Editar
                                </a>

                                <form
                                    action="{{ route('autores.destroy', ['autore' => $autor->ID_autores]) }}"
                                    method="POST"
                                    style="display:inline;"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Eliminar este autor?')"
                                    >
                                        Eliminar
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-4">

                                <h4>No hay autores registrados</h4>

                                <a
                                    href="{{ route('autores.create') }}"
                                    class="btn btn-primary"
                                >
                                    Registrar primer autor
                                </a>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>
