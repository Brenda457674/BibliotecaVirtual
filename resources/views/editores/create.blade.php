<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agregar Editor - Biblioteca Virtual</title>

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
                    <h4 class="mb-0">➕ Agregar Editor</h4>
                </div>

                <div class="card-body">

                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <strong>Revisa los siguientes errores:</strong>

                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>

                    @endif

                    <form
                        action="{{ route('editores.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Nombre
                            </label>

                            <input
                                type="text"
                                name="Nombre"
                                class="form-control"
                                value="{{ old('Nombre') }}"
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
                                value="{{ old('Apellidos') }}"
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
                                value="{{ old('nombre_editorial') }}"
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
                                value="{{ old('pais') }}"
                            >

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Imagen
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
                                class="btn btn-primary"
                            >
                                💾 Guardar Editor
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
