<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Editores - Biblioteca Virtual</title>

    <link
        rel="stylesheet"
        href="{{ asset('bootstrap.min.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('app.css') }}"
    >

</head>


<body>


<!-- NAVBAR -->

@include('partials.nav', ['navActual' => 'editores'])



<!-- CONTENIDO -->

<div class="container py-5">


    <!-- ENCABEZADO -->

    <div
        class="d-flex justify-content-between align-items-center mb-4"
    >

        <div>

            <h1 class="fw-bold">
                🏢 Editores
            </h1>

            <p class="text-muted mb-0">
                Administración de editores de la Biblioteca Virtual
            </p>

        </div>


        <div class="d-flex gap-2">

            <a href="{{ route('inicio') }}"
               class="btn btn-outline-secondary">
                ← Inicio
            </a>

            <a
                href="{{ route('editores.create') }}"
                class="btn btn-primary"
            >
                ➕ Nuevo editor
            </a>

        </div>

    </div>



    <!-- MENSAJE -->

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif



    <!-- TABLA -->

    <div class="card shadow border-0">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">
                📋 Lista de editores
            </h5>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table
                    class="table table-hover align-middle mb-0"
                >

                    <thead class="table-dark">

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Imagen
                            </th>

                            <th>
                                Nombre
                            </th>

                            <th>
                                Apellidos
                            </th>

                            <th>
                                Editorial
                            </th>

                            <th>
                                País
                            </th>

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    @forelse($editores as $editor)

                        <tr>


                            <!-- ID -->

                            <td>

                                <span class="badge bg-secondary">

                                    {{ $editor->ID_editores }}

                                </span>

                            </td>



                            <!-- IMAGEN -->

                            <td>

                                @if($editor->archivo)

                                    <img
                                        src="{{ asset($editor->archivo) }}"
                                        alt="{{ $editor->Nombre }}"
                                        width="65"
                                        height="65"
                                        style="
                                            object-fit: cover;
                                            border-radius: 10px;
                                        "
                                    >

                                @else

                                    <div
                                        class="bg-light d-flex align-items-center justify-content-center"
                                        style="
                                            width:65px;
                                            height:65px;
                                            border-radius:10px;
                                            font-size:28px;
                                        "
                                    >
                                        🏢
                                    </div>

                                @endif

                            </td>



                            <!-- NOMBRE -->

                            <td>

                                <strong>
                                    {{ $editor->Nombre }}
                                </strong>

                            </td>



                            <!-- APELLIDOS -->

                            <td>

                                {{ $editor->Apellidos }}

                            </td>



                            <!-- EDITORIAL -->

                            <td>

                                {{ $editor->nombre_editorial ?? '—' }}

                            </td>



                            <!-- PAÍS -->

                            <td>

                                {{ $editor->pais ?? '—' }}

                            </td>



                            <!-- ACCIONES -->

                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-1">


                                    <!-- VER -->

                                    <a
                                        href="{{ route('editores.show', ['editore' => $editor->ID_editores]) }}"
                                        class="btn btn-sm btn-info text-white"
                                        title="Ver editor"
                                    >
                                        👁️
                                    </a>



                                    <!-- EDITAR -->

                                    <a
                                        href="{{ route('editores.edit', ['editore' => $editor->ID_editores]) }}"
                                        class="btn btn-sm btn-warning"
                                        title="Editar editor"
                                    >
                                        ✏️
                                    </a>



                                    <!-- ELIMINAR -->

                                    <form
                                        action="{{ route('editores.destroy', ['editore' => $editor->ID_editores]) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="Eliminar editor"
                                            onclick="return confirm('¿Seguro que deseas eliminar este editor?')"
                                        >
                                            🗑️
                                        </button>

                                    </form>


                                </div>

                            </td>


                        </tr>


                    @empty


                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5"
                            >

                                <div class="mb-3">

                                    <span
                                        style="font-size:60px;"
                                    >
                                        🏢
                                    </span>

                                </div>

                                <h4>
                                    No hay editores registrados
                                </h4>

                                <p class="text-muted">
                                    Todavía no se ha registrado ningún editor.
                                </p>

                                <a
                                    href="{{ route('editores.create') }}"
                                    class="btn btn-primary"
                                >
                                    ➕ Registrar primer editor
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



<!-- BOOTSTRAP JS -->

<script src="{{ asset('bootstrap.bundle.min.js') }}"></script>


</body>

</html>
