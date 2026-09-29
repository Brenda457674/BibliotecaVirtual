<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Autor - Biblioteca Virtual</title>

    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>

<body>

@include('partials.nav', ['navActual' => 'autores'])

<div class="container py-5">

    <div class="mb-4">

        <h1>✏️ Editar autor</h1>

        <p class="text-muted">
            Modificar información del autor
        </p>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card shadow">

        <div class="card-body p-4">

            <form
                action="{{ route('autores.update', ['autore' => $autore->ID_autores]) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="Nombre"
                            class="form-control"
                            value="{{ old('Nombre', $autore->Nombre) }}"
                            required
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Apellidos
                        </label>

                        <input
                            type="text"
                            name="Apellidos"
                            class="form-control"
                            value="{{ old('Apellidos', $autore->Apellidos) }}"
                            required
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Teléfono
                        </label>

                        <input
                            type="number"
                            name="telefono"
                            class="form-control"
                            value="{{ old('telefono', $autore->telefono) }}"
                            required
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Correo
                        </label>

                        <input
                            type="email"
                            name="correo"
                            class="form-control"
                            value="{{ old('correo', $autore->correo) }}"
                            required
                        >

                    </div>


                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Foto del autor
                        </label>

                        <input
                            type="file"
                            name="archivo"
                            class="form-control"
                            accept="image/*"
                        >

                    </div>


                    @if($autore->archivo)

                        <div class="col-12 mb-4">

                            <p class="mb-2">
                                Imagen actual:
                            </p>

                            <img
                                src="{{ asset($autore->archivo) }}"
                                width="120"
                                height="120"
                                style="object-fit: cover; border-radius: 10px;"
                                alt="Autor"
                            >

                        </div>

                    @endif

                </div>


                <a
                    href="{{ route('autores.index') }}"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-warning"
                >
                    Actualizar autor
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>
