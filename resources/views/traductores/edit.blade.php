<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Traductor</title>

    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">

</head>

<body>

@include('partials.nav', ['navActual' => 'traductores'])

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header bg-warning">

            <h3 class="mb-0">
                ✏️ Editar traductor
            </h3>

        </div>


        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('traductores.update', ['traductore' => $traductore->ID_traductores]) }}"
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
                            value="{{ old('Nombre', $traductore->Nombre) }}"
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
                            value="{{ old('Apellidos', $traductore->Apellidos) }}"
                            required
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Idioma nativo
                        </label>

                        <input
                            type="text"
                            name="idioma_nativo"
                            class="form-control"
                            value="{{ old('idioma_nativo', $traductore->idioma_nativo) }}"
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Idiomas de traducción
                        </label>

                        <input
                            type="text"
                            name="idiomas_traduccion"
                            class="form-control"
                            value="{{ old('idiomas_traduccion', $traductore->idiomas_traduccion) }}"
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Certificaciones
                        </label>

                        <input
                            type="number"
                            name="certificaciones"
                            class="form-control"
                            value="{{ old('certificaciones', $traductore->certificaciones) }}"
                            min="0"
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nueva imagen
                        </label>

                        <input
                            type="file"
                            name="archivo"
                            class="form-control"
                            accept="image/*"
                        >

                    </div>


                    @if($traductore->archivo)

                        <div class="col-12 mb-3">

                            <label class="form-label">
                                Imagen actual
                            </label>

                            <br>

                            <img
                                src="{{ asset($traductore->archivo) }}"
                                width="150"
                                style="border-radius:10px;"
                            >

                        </div>

                    @endif

                </div>


                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-warning"
                    >
                        💾 Actualizar traductor
                    </button>


                    <a
                        href="{{ route('traductores.index') }}"
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
