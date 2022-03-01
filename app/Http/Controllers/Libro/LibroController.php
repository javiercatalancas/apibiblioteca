<?php

namespace App\Http\Controllers\Libro;

use App\Libro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Transformers\LibroTransformer;

class LibroController extends Controller
{


    public function __construct()
	{
		$this->middleware('transform.input:' . LibroTransformer::class)->only(['store', 'update']);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


      /**
    * @OA\Get(
        
    *     path="/api/libros",
    *     tags={"libros"},
    *     summary="Mostrar un listado de libros",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos los usuarios."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */



    public function index()
    {
        return $this->showAll(Libro::all());

    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



       /**
        * @OA\Post(
        *     path="/api/libros",
        *     tags={"libros"},
        *     summary="Añadir un Libro",
        *     @OA\Response(
        *         response=200,
        *         description="Con esta ruta se crea un nuevo libro"
        *     ),
        *     @OA\Response(
        *         response="default",
        *         description="Ha ocurrido un error."
        *     )
        * )
        */


    public function store(Request $request)
    {
        $rules = [
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ];
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'titulo.required' => 'El campo :attribute no tiene el formato adecuado o está vacío.',
            'descripcion.required' => 'El campo :attribute no tiene el formato adecuado o está vacío.',
        ];
        $validatedData = $request->validate($rules, $messages);
        $libro = Libro::create($validatedData);
        return $this->showOne($libro,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        return $this->showOne($libro);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        $rules = [
            'titulo' => 'min:5|max:255',
            'descripcion' => 'min:5|max:255',
            
        ];
        $validatedData = $request->validate($rules);

        $libro->fill($validatedData);

        if(!$libro->isDirty()){
            return response()->json(['error'=>['code' => 422, 'message' => 'please specify at least one different value' ]], 422);
        }
        $libro->save();
        return $this->showOne($libro);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return $this->showOne($libro);
    }
}
