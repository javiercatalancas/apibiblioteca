<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = [
        'titulo', 'descripcion'
    ];


    public function prestamo(){
        $this->belongsTo(Prestamo::class, 'id_libro');
    }
}
