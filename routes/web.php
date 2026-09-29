<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LibroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\TraductorController;


use App\Models\Libro;

Route::get('/', function () {
    $libros = Libro::with(['autor', 'editor', 'traductor'])->get();

    return view('inicio', compact('libros'));
})->name('inicio');


Route::resource('libros', LibroController::class);

Route::resource('autores', AutorController::class);

Route::resource('editores', EditorController::class);

Route::resource('traductores', TraductorController::class);
