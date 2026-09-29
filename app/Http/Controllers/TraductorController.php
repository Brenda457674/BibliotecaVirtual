<?php

namespace App\Http\Controllers;

use App\Models\Traductor;
use Illuminate\Http\Request;

class TraductorController extends Controller
{
    public function index()
    {
        $traductores = Traductor::all();

        return view('traductores.index', compact('traductores'));
    }


    public function create()
    {
        return view('traductores.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|max:50',
            'Apellidos' => 'required|max:50',
            'idioma_nativo' => 'nullable|max:30',
            'idiomas_traduccion' => 'nullable|max:50',
            'certificaciones' => 'nullable|integer',
            'archivo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $rutaArchivo = null;


        if ($request->hasFile('archivo')) {

            $archivo = $request->file('archivo');

            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();

            $archivo->move(
                public_path('uploads/traductores'),
                $nombreArchivo
            );

            $rutaArchivo = 'uploads/traductores/' . $nombreArchivo;
        }


        Traductor::create([
            'Nombre' => $request->Nombre,
            'Apellidos' => $request->Apellidos,
            'idioma_nativo' => $request->filled('idioma_nativo') ? $request->idioma_nativo : null,
            'idiomas_traduccion' => $request->filled('idiomas_traduccion') ? $request->idiomas_traduccion : null,
            'certificaciones' => $request->filled('certificaciones') ? $request->certificaciones : null,
            'archivo' => $rutaArchivo,
        ]);


        return redirect()
            ->route('traductores.index')
            ->with('success', 'Traductor registrado correctamente.');
    }


    public function show(Traductor $traductore)
    {
        return view('traductores.show', compact('traductore'));
    }


    public function edit(Traductor $traductore)
    {
        return view('traductores.edit', compact('traductore'));
    }


    public function update(Request $request, Traductor $traductore)
    {
        $request->validate([
            'Nombre' => 'required|max:50',
            'Apellidos' => 'required|max:50',
            'idioma_nativo' => 'nullable|max:30',
            'idiomas_traduccion' => 'nullable|max:50',
            'certificaciones' => 'nullable|integer',
            'archivo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $rutaArchivo = $traductore->archivo;


        if ($request->hasFile('archivo')) {

            $archivo = $request->file('archivo');

            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();

            $archivo->move(
                public_path('uploads/traductores'),
                $nombreArchivo
            );

            $rutaArchivo = 'uploads/traductores/' . $nombreArchivo;
        }


        $traductore->update([
            'Nombre' => $request->Nombre,
            'Apellidos' => $request->Apellidos,
            'idioma_nativo' => $request->filled('idioma_nativo') ? $request->idioma_nativo : null,
            'idiomas_traduccion' => $request->filled('idiomas_traduccion') ? $request->idiomas_traduccion : null,
            'certificaciones' => $request->filled('certificaciones') ? $request->certificaciones : null,
            'archivo' => $rutaArchivo,
        ]);


        return redirect()
            ->route('traductores.index')
            ->with('success', 'Traductor actualizado correctamente.');
    }


    public function destroy(Traductor $traductore)
    {
        $traductore->delete();

        return redirect()
            ->route('traductores.index')
            ->with('success', 'Traductor eliminado correctamente.');
    }
}
