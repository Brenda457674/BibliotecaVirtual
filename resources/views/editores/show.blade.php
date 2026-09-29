<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $editore->Nombre }} - Editor</title>

    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>

<body>

@include('partials.nav', ['navActual' => 'editores'])


<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-body p-5 text-center">

                    @if ($editore->archivo)

                        <img
                            src="{{ asset($editore->archivo) }}"
                            alt="{{ $editore->Nombre }}"
                            style="
                                width:180px;
                                height:180px;
                                object-fit:cover;
                                border-radius:50%;
                                margin-bottom:25px;
                            "
                        >

                    @else

                        <div
                            class="bg-light d-flex align-items-center justify-content-center mx-auto mb-4"
                            style="
                                width:180px;
                                height:180px;
                                border-radius:50%;
                                font-size:70px;
                            "
                        >
                            🏢
                        </div>

                    @endif


                    <h2>
                        {{ $editore->Nombre }}
                        {{ $editore->Apellidos }}
                    </h2>

                    <p class="text-muted">
                        Editor
                    </p>


                    <hr>


                    <div class="text-start">

                        <p>
                            <strong>Editorial:</strong>

                            {{ $editore->nombre_editorial ?? 'No registrada' }}
                        </p>

                        <p>
                            <strong>País:</strong>

                            {{ $editore->pais ?? 'No registrado' }}
                        </p>

                        <p>
                            <strong>ID:</strong>

                            {{ $editore->ID_editores }}
                        </p>

                    </div>


                    <div class="d-flex justify-content-center gap-2 mt-4">

                        <a
                            href="{{ route('editores.edit', ['editore' => $editore->ID_editores]) }}"
                            class="btn btn-warning"
                        >
                            ✏️ Editar
                        </a>

                        <form
                            action="{{ route('editores.destroy', ['editore' => $editore->ID_editores]) }}"
                            method="POST"
                            onsubmit="return confirm('¿Seguro que deseas eliminar este editor?')"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger"
                            >
                                🗑️ Eliminar
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
