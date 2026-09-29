<?php

namespace App\Http\Controllers;

use App\Models\Editor;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function index()
    {
        $editores = Editor::all();

        return view('editores.index', compact('editores'));
    }

    public function create()
    {
        return view('editores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'nullable|string|max:50',
            'Apellidos' => 'nullable|string|max:50',
            'nombre_editorial' => 'nullable|string|max:70',
            'pais' => 'nullable|string|max:100',
            'archivo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $rutaImagen = null;

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');

            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();

            $archivo->move(
                public_path('uploads/editores'),
                $nombreArchivo
            );

            $rutaImagen = 'uploads/editores/' . $nombreArchivo;
        }

        Editor::create([
            'Nombre' => $request->filled('Nombre') ? $request->Nombre : null,
            'Apellidos' => $request->filled('Apellidos') ? $request->Apellidos : null,
            'nombre_editorial' => $request->filled('nombre_editorial') ? $request->nombre_editorial : null,
            'pais' => $request->filled('pais') ? $request->pais : null,
            'archivo' => $rutaImagen,
        ]);

        return redirect()
            ->route('editores.index')
            ->with('success', 'Editor creado correctamente.');
    }

    public function show(Editor $editore)
    {
        return view('editores.show', compact('editore'));
    }

    public function edit(Editor $editore)
    {
        return view('editores.edit', compact('editore'));
    }

    public function update(Request $request, Editor $editore)
    {
        $request->validate([
            'Nombre' => 'nullable|string|max:50',
            'Apellidos' => 'nullable|string|max:50',
            'nombre_editorial' => 'nullable|string|max:70',
            'pais' => 'nullable|string|max:100',
            'archivo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $rutaImagen = $editore->archivo;

        if ($request->hasFile('archivo')) {

            $archivo = $request->file('archivo');

            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();

            $archivo->move(
                public_path('uploads/editores'),
                $nombreArchivo
            );

            $rutaImagen = 'uploads/editores/' . $nombreArchivo;
        }

        $editore->update([
            'Nombre' => $request->filled('Nombre') ? $request->Nombre : null,
            'Apellidos' => $request->filled('Apellidos') ? $request->Apellidos : null,
            'nombre_editorial' => $request->filled('nombre_editorial') ? $request->nombre_editorial : null,
            'pais' => $request->filled('pais') ? $request->pais : null,
            'archivo' => $rutaImagen,
        ]);

        return redirect()
            ->route('editores.index')
            ->with('success', 'Editor actualizado correctamente.');
    }

    public function destroy(Editor $editore)
    {
        $editore->delete();

        return redirect()
            ->route('editores.index')
            ->with('success', 'Editor eliminado correctamente.');
    }
}
