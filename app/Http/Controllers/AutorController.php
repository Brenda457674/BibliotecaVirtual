<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::all();

        return view('autores.index', compact('autores'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|max:50',
            'Apellidos' => 'required|max:50',
            'telefono' => 'required',
            'correo' => 'required|email|max:30',
            'archivo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $rutaImagen = null;

        if ($request->hasFile('archivo')) {

            $imagen = $request->file('archivo');

            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

            $imagen->move(
                public_path('uploads/autores'),
                $nombreImagen
            );

            $rutaImagen = 'uploads/autores/' . $nombreImagen;
        }

        Autor::create([
            'Nombre' => $request->Nombre,
            'Apellidos' => $request->Apellidos,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'archivo' => $rutaImagen,
        ]);

        return redirect()
            ->route('autores.index')
            ->with('success', 'Autor registrado correctamente.');
    }

    public function show(Autor $autore)
    {
        return view('autores.show', compact('autore'));
    }

    public function edit(Autor $autore)
    {
        return view('autores.edit', compact('autore'));
    }

    public function update(Request $request, Autor $autore)
    {
        $request->validate([
            'Nombre' => 'required|max:50',
            'Apellidos' => 'required|max:50',
            'telefono' => 'required',
            'correo' => 'required|email|max:30',
            'archivo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $rutaImagen = $autore->archivo;

        if ($request->hasFile('archivo')) {

            $imagen = $request->file('archivo');

            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

            $imagen->move(
                public_path('uploads/autores'),
                $nombreImagen
            );

            $rutaImagen = 'uploads/autores/' . $nombreImagen;
        }

        $autore->update([
            'Nombre' => $request->Nombre,
            'Apellidos' => $request->Apellidos,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'archivo' => $rutaImagen,
        ]);

        return redirect()
            ->route('autores.index')
            ->with('success', 'Autor actualizado correctamente.');
    }

    public function destroy(Autor $autore)
    {
        $autore->delete();

        return redirect()
            ->route('autores.index')
            ->with('success', 'Autor eliminado correctamente.');
    }
}
