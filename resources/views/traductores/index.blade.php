<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Traductores - Biblioteca Virtual</title>

    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>

<body>

@include('partials.nav', ['navActual' => 'traductores'])

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1>🌎 Traductores</h1>

            <p class="text-muted">
                Administración de traductores de la biblioteca
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('inicio') }}"
               class="btn btn-outline-secondary">
                ← Inicio
            </a>

            <a href="{{ route('traductores.create') }}"
               class="btn btn-primary">
                + Nuevo traductor
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
                            <th>Idioma nativo</th>
                            <th>Idiomas de traducción</th>
                            <th>Certificaciones</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($traductores as $traductor)

                        <tr>

                            <td>
                                {{ $traductor->ID_traductores }}
                            </td>


                            <td>

                                @if($traductor->archivo)

                                    <img
                                        src="{{ asset($traductor->archivo) }}"
                                        width="60"
                                        height="60"
                                        style="object-fit:cover;border-radius:8px;"
                                    >

                                @else

                                    <span class="text-muted">
                                        Sin imagen
                                    </span>

                                @endif

                            </td>


                            <td>
                                {{ $traductor->Nombre }}
                            </td>


                            <td>
                                {{ $traductor->Apellidos }}
                            </td>


                            <td>
                                {{ $traductor->idioma_nativo ?? 'No registrado' }}
                            </td>


                            <td>
                                {{ $traductor->idiomas_traduccion ?? 'No registrado' }}
                            </td>


                            <td>
                                {{ $traductor->certificaciones ?? 0 }}
                            </td>


                            <td>

                                <a
                                    href="{{ route('traductores.show', ['traductore' => $traductor->ID_traductores]) }}"
                                    class="btn btn-sm btn-info"
                                >
                                    Ver
                                </a>


                                <a
                                    href="{{ route('traductores.edit', ['traductore' => $traductor->ID_traductores]) }}"
                                    class="btn btn-sm btn-warning"
                                >
                                    Editar
                                </a>


                                <form
                                    action="{{ route('traductores.destroy', ['traductore' => $traductor->ID_traductores]) }}"
                                    method="POST"
                                    style="display:inline;"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Eliminar este traductor?')"
                                    >
                                        Eliminar
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-4">

                                <h4>No hay traductores registrados</h4>

                                <a
                                    href="{{ route('traductores.create') }}"
                                    class="btn btn-primary"
                                >
                                    Registrar primer traductor
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
