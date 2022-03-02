<?php

namespace App\Http\Controllers\UsuarioPrestamo;

use App\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioPrestamoController extends Controller
{






    
    public function store(Request $request, Usuario $usuario)
    {
        $rules = [
          //  'usuario_id' => 'required',
            'libro_id' => 'required'
        ];

        $messages = [
           // 'usuario_id.required' => 'introduce una id de usuario válida',
            'libro_id.required' => 'Introduce una id de libro válida'
        ];
        $validatedData = $request->validate($rules, $messages);
        dd($usuario ->libros()->attach($validatedData));

        $usuario ->libros()->attach($validatedData);
        return $this->showOne($usuario,201);
    }
}
