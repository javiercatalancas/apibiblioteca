<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = [
        'titulo', 'descripcion'
    ];

// HACER RELACIOÓN CON USUARIO
    public function usuarios(){
        $this->belongsToMany(Usuario::class);
    }
}
