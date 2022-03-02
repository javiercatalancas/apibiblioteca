<?php

namespace App;
use App\Usuario;

use App\Transformers\LibroTransformer;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    public $transformer = LibroTransformer::class;
    protected $fillable = [
        'titulo', 'descripcion'
    ];

// HACER RELACIÓN CON USUARIO
    public function usuarios(){
       return $this->belongsToMany(Usuario::class);
    }
}
