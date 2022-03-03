<?php

namespace App\Http\Controllers\Prestamo;

use App\Libro;
use App\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
    * @OA\Get(
        
    *     path="/api/prestamos",
    *     tags={"préstamos"},
    *     summary="Mostrar un listado de Préstamos",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos los préstamos."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */

    public function index(Libro $libro, Usuario $usuario)
    {
        $prestamo = $usuario ->with('libros')-> whereHas('libros')->get();
        return $this ->showAll($prestamo);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
  /**
    * @OA\Get(
        
    *     path="/api/prestamos/{prestamo}",
    *     tags={"préstamos"},
    *     summary="Mostrar los préstamos de un usuario por su Id",
    *@OA\Parameter(
        *         name="prestamo",
        *         in="path",
        *         description="id del usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="integer"
        *         )
        *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Se muestran los datos de los libros que tiene un usuario dada su id"
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */

     public function show(Libro $libro, Usuario $usuario, $param)
    {   
        $prestamo = $usuario->with('libros')->whereHas('libros')->find($param);
        return $this ->showOne($prestamo);

    }
 
   
}
