<?php

namespace App\Http\Controllers\UsuarioLibro;

use App\Libro;
use App\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioLibroController extends Controller
{
    


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


      /**
    * @OA\Post(
        
    *     path="/api/usuarios/{usuario}/libros",
    *     tags={"préstamos"},
    *     summary="Crear un nuevo préstamo",
    *@OA\Parameter(
        *         name="libro_id",
        *         in="query",
        *         description="id del libro",
        *         required=true,
        *         @OA\Schema(
        *             type="integer"
        *         )
        *     ),
         *@OA\Parameter(
        *         name="usuario",
        *         in="path",
        *         description="usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="integer"
        *         )
        *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Dada la id de usuario pasada en la ruta y la id del libro por post, creamos un nuevo préstamo"
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */

    public function store(Request $request, Usuario $usuario)
    {
        $rules = [
            'libro_id' => 'required|integer'
        ];

        $messages = [
            'libro_id.required' => 'Introduce una id de libro válida',
            'integer' => 'Introduce un número entero'
        ];
        $validatedData = $request->validate($rules, $messages);
        $usuario ->libros()->syncWithoutDetaching($validatedData);
        return $this->showOne($usuario,201);
    }

    /**
    * @OA\Delete(
    * 
    *     path="/api/usuarios/{usuario}/libros/{libros}",
    *     tags={"préstamos"},
    *     summary="Eliminar un préstamo",
    *@OA\Parameter(
        *         name="libros",
        *         in="path",
        *         description="id del libro",
        *         required=true,
        *         @OA\Schema(
        *             type="integer"
        *         )
        *     ),
         *@OA\Parameter(
        *         name="usuario",
        *         in="path",
        *         description="id del usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="integer"
        *         )
        *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Dada la id de usuario pasada en la ruta y la id del libro eliminamos un préstamo existente"
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */


    public function destroy(Usuario $usuario, Libro $libro)
    {
        if( !$usuario->libros()->find($libro->id)){
            return $this->errorResponse('Este usuario no tiene ese libro',404);
        }
        // detach es como el delete pero para la tabla pivote
        $usuario->libros()->detach($libro->id);
        $prestamos = $usuario-> with('libros')->wherehas('libros')->find($usuario->id);
        return $this->showOne($prestamos);
    
    }

}
