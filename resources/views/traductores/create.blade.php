<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nuevo Traductor</title>

    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">

</head>

<body>

@include('partials.nav', ['navActual' => 'traductores'])

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3 class="mb-0">
                🌎 Registrar nuevo traductor
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
                action="{{ route('traductores.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="Nombre"
                            class="form-control"
                            value="{{ old('Nombre') }}"
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
                            value="{{ old('Apellidos') }}"
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
                            value="{{ old('idioma_nativo') }}"
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
                            value="{{ old('idiomas_traduccion') }}"
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Número de certificaciones
                        </label>

                        <input
                            type="number"
                            name="certificaciones"
                            class="form-control"
                            value="{{ old('certificaciones') }}"
                            min="0"
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Foto / imagen
                        </label>

                        <input
                            type="file"
                            name="archivo"
                            class="form-control"
                            accept="image/*"
                        >

                    </div>

                </div>


                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        💾 Guardar traductor
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
