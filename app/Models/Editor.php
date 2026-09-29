<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    protected $table = 'editores';

    protected $primaryKey = 'ID_editores';

    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Apellidos',
        'nombre_editorial',
        'pais',
        'archivo',
    ];

    public function libros()
    {
        return $this->hasMany(
            Libro::class,
            'ID_editor',
            'ID_editores'
        );
    }
}
