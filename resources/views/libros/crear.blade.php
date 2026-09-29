<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agregar libro</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f1e8;
            margin: 0;
        }

        .contenedor {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 20px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 13px;
            background: #6d4c41;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .volver {
            display: block;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>📚 Agregar nuevo libro</h1>

    <form action="/libros" method="POST" enctype="multipart/form-data">

        @csrf

        <label>Título del libro</label>

        <input
            type="text"
            name="Titulo"
            required
        >


        <label>Autor</label>

        <select name="ID_autor" required>

            <option value="">Seleccione un autor</option>

            @foreach ($autores as $autor)

                <option value="{{ $autor->ID_autores }}">
                    {{ $autor->Nombre }}
                </option>

            @endforeach

        </select>


        <label>Editor</label>

        <select name="ID_editor" required>

            <option value="">Seleccione un editor</option>

            @foreach ($editores as $editor)

                <option value="{{ $editor->ID_editores }}">
                    {{ $editor->Nombre }}
                </option>

            @endforeach

        </select>


        <label>Traductor</label>

        <select name="ID_traductor" required>

            <option value="">Seleccione un traductor</option>

            @foreach ($traductores as $traductor)

                <option value="{{ $traductor->ID_traductores }}">
                    {{ $traductor->Nombre }}
                </option>

            @endforeach

        </select>


        <label>Portada del libro</label>

        <input
            type="file"
            name="imagen"
            accept="image/*"
            required
        >


        <button type="submit">
            💾 Guardar libro
        </button>

    </form>

    <a href="/libros" class="volver">
        ← Volver a la biblioteca
    </a>

</div>

</body>

</html>
