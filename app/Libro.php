<?php

namespace App;
use App\Usuario;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = [
        'titulo', 'descripcion'
    ];

// HACER RELACIÓN CON USUARIO
    public function usuarios(){
       return $this->belongsToMany(Usuario::class);
    }
}
