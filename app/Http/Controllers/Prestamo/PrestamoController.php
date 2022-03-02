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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Usuario $usuario)
    {
        $rules = [
           // 'usuario_id' => 'required',
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
     public function show(Usuario $usuario, $param)
    {   
        $prestamo = $usuario ->with('libros')-> whereHas('libros')->get()->find($param);
        return $this ->showAll($prestamo);

    }
 
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request)
    {
        


    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
   /*  public function destroy(Prestamo $prestamo)
    {
        //
    } */
}
