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
    public function index(Libro $libro, Usuario $usuario)
    {
        $prestamo = $usuario ->with('libros')-> whereHas('libros')->get();
        return $this ->showAll($prestamo);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    /* public function edit(Prestamo $prestamo)
    {
        //
    }
 */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
   /*  public function update(Request $request, Prestamo $prestamo)
    {
        //
    } */

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
