<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Autor;
use App\Models\Editor;
use App\Models\Traductor;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Mostrar todos los libros.
     */
    public function index()
    {
        $libros = Libro::with([
            'autor',
            'editor',
            'traductor'
        ])->get();

        return view('libros.index', compact('libros'));
    }

    /**
     * Mostrar formulario para crear libro.
     */
    public function create()
    {
        $autores = Autor::orderBy('Nombre')->get();

        $editores = Editor::orderBy('Nombre')->get();

        $traductores = Traductor::orderBy('Nombre')->get();

        return view('libros.create', compact(
            'autores',
            'editores',
            'traductores'
        ));
    }

    /**
     * Guardar libro.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Titulo' => 'required|string|max:45',
            'Tipo' => 'nullable|string|max:45',
            'ID_autor' => 'nullable|exists:autores,ID_autores',
            'ID_editor' => 'nullable|exists:editores,ID_editores',
            'ID_traductor' => 'nullable|exists:traductores,ID_traductores',
            'genero' => 'nullable|string|max:50',
            'archivo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $rutaArchivo = null;

        if ($request->hasFile('archivo')) {

            $archivo = $request->file('archivo');

            $nombreArchivo = time() . '_' .
                $archivo->getClientOriginalName();

            $archivo->move(
                public_path('uploads/libros'),
                $nombreArchivo
            );

            $rutaArchivo = 'uploads/libros/' . $nombreArchivo;
        }

        Libro::create([
            'Titulo' => $request->Titulo,
            'Tipo' => $request->filled('Tipo') ? $request->Tipo : null,
            'ID_autor' => $request->filled('ID_autor') ? $request->ID_autor : null,
            'ID_editor' => $request->filled('ID_editor') ? $request->ID_editor : null,
            'ID_traductor' => $request->filled('ID_traductor') ? $request->ID_traductor : null,
            'genero' => $request->filled('genero') ? $request->genero : null,
            'archivo' => $rutaArchivo,
        ]);

        return redirect()
            ->route('libros.index')
            ->with('success', 'Libro registrado correctamente.');
    }

    /**
     * Mostrar un libro.
     */
    public function show(Libro $libro)
    {
        $libro->load([
            'autor',
            'editor',
            'traductor'
        ]);

        return view('libros.show', compact('libro'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Libro $libro)
    {
        $autores = Autor::orderBy('Nombre')->get();

        $editores = Editor::orderBy('Nombre')->get();

        $traductores = Traductor::orderBy('Nombre')->get();

        return view('libros.edit', compact(
            'libro',
            'autores',
            'editores',
            'traductores'
        ));
    }

    /**
     * Actualizar libro.
     */
    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'Titulo' => 'required|string|max:45',
            'Tipo' => 'nullable|string|max:45',
            'ID_autor' => 'nullable|exists:autores,ID_autores',
            'ID_editor' => 'nullable|exists:editores,ID_editores',
            'ID_traductor' => 'nullable|exists:traductores,ID_traductores',
            'genero' => 'nullable|string|max:50',
            'archivo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $rutaArchivo = $libro->archivo;

        if ($request->hasFile('archivo')) {

            // Eliminar imagen anterior
            if (
                $libro->archivo &&
                file_exists(public_path($libro->archivo))
            ) {
                unlink(public_path($libro->archivo));
            }

            $archivo = $request->file('archivo');

            $nombreArchivo = time() . '_' .
                $archivo->getClientOriginalName();

            $archivo->move(
                public_path('uploads/libros'),
                $nombreArchivo
            );

            $rutaArchivo = 'uploads/libros/' . $nombreArchivo;
        }

        $libro->update([
            'Titulo' => $request->Titulo,
            'Tipo' => $request->filled('Tipo') ? $request->Tipo : null,
            'ID_autor' => $request->filled('ID_autor') ? $request->ID_autor : null,
            'ID_editor' => $request->filled('ID_editor') ? $request->ID_editor : null,
            'ID_traductor' => $request->filled('ID_traductor') ? $request->ID_traductor : null,
            'genero' => $request->filled('genero') ? $request->genero : null,
            'archivo' => $rutaArchivo,
        ]);

        return redirect()
            ->route('libros.index')
            ->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Eliminar libro.
     */
    public function destroy(Libro $libro)
    {
        if (
            $libro->archivo &&
            file_exists(public_path($libro->archivo))
        ) {
            unlink(public_path($libro->archivo));
        }

        $libro->delete();

        return redirect()
            ->route('libros.index')
            ->with('success', 'Libro eliminado correctamente.');
    }
}
