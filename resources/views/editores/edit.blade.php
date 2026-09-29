<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Editor - Biblioteca Virtual</title>

    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>

<body>

@include('partials.nav', ['navActual' => 'editores'])

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">

                    <h4 class="mb-0">
                        ✏️ Editar Editor
                    </h4>

                </div>

                <div class="card-body">

                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form
                        action="{{ route('editores.update', ['editore' => $editore->ID_editores]) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">
                                Nombre
                            </label>

                            <input
                                type="text"
                                name="Nombre"
                                class="form-control"
                                value="{{ old('Nombre', $editore->Nombre) }}"
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Apellidos
                            </label>

                            <input
                                type="text"
                                name="Apellidos"
                                class="form-control"
                                value="{{ old('Apellidos', $editore->Apellidos) }}"
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Nombre de la editorial
                            </label>

                            <input
                                type="text"
                                name="nombre_editorial"
                                class="form-control"
                                value="{{ old('nombre_editorial', $editore->nombre_editorial) }}"
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                País
                            </label>

                            <input
                                type="text"
                                name="pais"
                                class="form-control"
                                value="{{ old('pais', $editore->pais) }}"
                            >

                        </div>

                        @if ($editore->archivo)

                            <div class="mb-3">

                                <label class="form-label">
                                    Imagen actual
                                </label>

                                <br>

                                <img
                                    src="{{ asset($editore->archivo) }}"
                                    alt="Imagen del editor"
                                    style="width:150px;height:150px;object-fit:cover;border-radius:10px;"
                                >

                            </div>

                        @endif

                        <div class="mb-4">

                            <label class="form-label">
                                Cambiar imagen
                            </label>

                            <input
                                type="file"
                                name="archivo"
                                class="form-control"
                                accept="image/*"
                            >

                        </div>

                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('editores.index') }}"
                                class="btn btn-secondary"
                            >
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="btn btn-success"
                            >
                                💾 Guardar cambios
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
