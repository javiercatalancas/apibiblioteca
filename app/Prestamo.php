<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    public function usuario(){
        $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function libro(){
        $this->belongsTo(Libro::class, 'id_libro');
    }
    
}
