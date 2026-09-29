<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agregar libro</title>

    <link rel="stylesheet"
          href="{{ asset('bootstrap.min.css') }}">

    <link rel="stylesheet"
          href="{{ asset('app.css') }}">
</head>

<body>

@include('partials.nav', ['navActual' => 'libros'])

<div class="container py-5">

    <div class="mb-4">

        <h1>📚 Agregar libro</h1>

        <p class="text-muted">
            Registrar un nuevo libro en la biblioteca
        </p>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Hay algunos errores:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card shadow">

        <div class="card-body p-4">

            <form action="{{ route('libros.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Título *
                        </label>

                        <input
                            type="text"
                            name="Titulo"
                            class="form-control"
                            value="{{ old('Titulo') }}"
                            maxlength="45"
                            required
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tipo
                        </label>

                        <input
                            type="text"
                            name="Tipo"
                            class="form-control"
                            value="{{ old('Tipo') }}"
                            maxlength="45"
                            placeholder="Novela, cuento, académico..."
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Autor
                        </label>

                        <select
                            name="ID_autor"
                            class="form-select"
                        >

                            <option value="">
                                -- Seleccionar autor --
                            </option>

                            @foreach($autores as $autor)

                                <option
                                    value="{{ $autor->ID_autores }}"
                                    {{ old('ID_autor') == $autor->ID_autores ? 'selected' : '' }}
                                >
                                    {{ $autor->Nombre }}
                                    {{ $autor->Apellidos }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Editor
                        </label>

                        <select
                            name="ID_editor"
                            class="form-select"
                        >

                            <option value="">
                                -- Seleccionar editor --
                            </option>

                            @foreach($editores as $editor)

                                <option
                                    value="{{ $editor->ID_editores }}"
                                    {{ old('ID_editor') == $editor->ID_editores ? 'selected' : '' }}
                                >
                                    {{ $editor->Nombre }}
                                    {{ $editor->Apellidos }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Traductor
                        </label>

                        <select
                            name="ID_traductor"
                            class="form-select"
                        >

                            <option value="">
                                -- Seleccionar traductor --
                            </option>

                            @foreach($traductores as $traductor)

                                <option
                                    value="{{ $traductor->ID_traductores }}"
                                    {{ old('ID_traductor') == $traductor->ID_traductores ? 'selected' : '' }}
                                >
                                    {{ $traductor->Nombre }}
                                    {{ $traductor->Apellidos }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Género
                        </label>

                        <input
                            type="text"
                            name="genero"
                            class="form-control"
                            value="{{ old('genero') }}"
                            maxlength="50"
                            placeholder="Literatura, ciencia, historia..."
                        >

                    </div>


                    <div class="col-12 mb-4">

                        <label class="form-label">
                            Portada del libro
                        </label>

                        <input
                            type="file"
                            name="archivo"
                            class="form-control"
                            accept="image/*"
                        >

                        <small class="text-muted">
                            JPG, JPEG, PNG o WEBP. Máximo 5 MB.
                        </small>

                    </div>

                </div>


                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        💾 Guardar libro
                    </button>

                    <a
                        href="{{ route('libros.index') }}"
                        class="btn btn-secondary"
                    >
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>

