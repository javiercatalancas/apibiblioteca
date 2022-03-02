<?php

namespace App\Http\Controllers\Usuario;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Transformers\UsuarioTransformer;

/**
* @OA\Info(title="API Biblioteca", version="pre-Alpha")
*
* @OA\Server(url="http://localhost:8000")
*/

class UsuarioController extends Controller
{
    public function __construct()
	{
		$this->middleware('transform.input:' . UsuarioTransformer::class)->only(['store', 'update']);
	}

 /**
    * @OA\Get(
        
    *     path="/api/usuarios",
    *     tags={"usuarios"},
    *     summary="Mostrar un listado de Usuarios",
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


  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Usuario::all());
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


       /**
        * @OA\Post(
        *     path="/api/usuarios",
        *     tags={"usuarios"},
        *     summary="Añadir un Usuario",
        *@OA\Parameter(
        *         name="name",
        *         in="query",
        *         description="Nombre",
        *         required=true,
        *         @OA\Schema(
        *             type="string"
        *         )
        *     ),
        *@OA\Parameter(
        *         name="email",
        *         in="query",
        *         description="Email del usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="string"
        *         )
        *     ),
        *@OA\Parameter(
        *         name="password",
        *         in="query",
        *         description="Contraseña del usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="string"
        *         )
        *     ),
         *@OA\Parameter(
        *         name="password_confirmation",
        *         in="query",
        *         description="Confirmar contraseña del usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="string"
        *         )
        *     ),
        *     @OA\Response(
        *         response=200,
        *         description="Con esta ruta se crea un nuevo usuario"
        *     ),
        *
        *@OA\Response(
        *         response="default",
        *         description="Ha ocurrido un error."
        *     )
        * )
        */

    public function store(Request $request)
    {
       
        {   
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:usuarios,email',
                'password' => 'required|min:6|confirmed',
            ];
            $messages = [
                'required' => 'El campo :attribute es obligatorio.',
                'email.required' => 'El campo correo no tiene el formato adecuado.',
                'email.email' => 'El campo correo no tiene el formato adecuado.',
                'password' => 'La contraseña es campo obligatorio',
            ];
            $validatedData = $request->validate($rules, $messages);
            $validatedData['password'] = bcrypt($validatedData['password']);
            $usuario = Usuario::create($validatedData);
            return $this->showOne($usuario,201);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\usuario  $usuario
     * @return \Illuminate\Http\Response
     */


       /**
        * @OA\Get(
        *     path="/api/usuarios/{usuarios}",
        *     tags={"usuarios"},
        *     summary="Mostrar un usuario",
        *@OA\Parameter(
        *         name="usuarios",
        *         in="path",
        *         description="Id del usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="integer"
        *         )
        *     ),
        *     @OA\Response(
        *         response=200,
        *         description="Mostrar el usuario con la id pasada por la ruta"
        *     ),
        *     @OA\Response(
        *         response="default",
        *         description="Ha ocurrido un error."
        *     )
        * )
        */


    public function show(Usuario $usuario)
    {
        return $this->showOne($usuario);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\usuario  $usuario
     * @return \Illuminate\Http\Response
     */

      /**
        * @OA\Put(
        *     path="/api/usuarios/{usuarios}",
        *     tags={"usuarios"},
        *     summary="Modificar usuario",
        *@OA\Parameter(
        *         name="usuarios",
        *         in="path",
        *         description="Id del usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="integer"
        *         )
        *     ),
        *@OA\Parameter(
        *         name="name",
        *         in="query",
        *         description="Nombre",
        *         required=true,
        *         @OA\Schema(
        *             type="string"
        *         )
        *     ),
        *@OA\Parameter(
        *         name="email",
        *         in="query",
        *         description="Email del usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="string"
        *         )
        *     ),
        *@OA\Parameter(
        *         name="password",
        *         in="path",
        *         description="Contraseña del usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="string"
        *         )
        *     ),
        *@OA\Parameter(
        *         name="usuarios",
        *         in="path",
        *         description="Id del usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="integer"
        *         )
        *     ),
        *     @OA\Response(
        *         response=200,
        *         description="Actualiza un usuario"
        *     ),
        *     @OA\Response(
        *         response="default",
        *         description="Ha ocurrido un error."
        *     )
        * )
        */



    public function update(Request $request, Usuario $usuario)
    {
        $rules = [
            'name' => 'min:5|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'min:6', 
        ];
        $validatedData = $request->validate($rules);

        if ($request->filled('password')){
            $validatedData['password'] = bcrypt($request->input('password'));
        }

        $usuario->fill($validatedData);

        if(!$usuario->isDirty()){
            return response()->json(['error'=>['code' => 422, 'message' => 'please specify at least one different value' ]], 422);
        }
        $usuario->save();
        return $this->showOne($usuario);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\usuario  $usuario
     * @return \Illuminate\Http\Response
     */


     /**
        * @OA\Delete(
        *     path="/api/usuarios/{usuarios}",
        *     tags={"usuarios"},
        *     summary="Borrar usuario",
        *@OA\Parameter(
        *         name="usuarios",
        *         in="path",
        *         description="Id del usuario",
        *         required=true,
        *         @OA\Schema(
        *             type="integer"
        *         )
        *     ),
        *     @OA\Response(
        *         response=200,
        *         description="Borra un usuario con la id por parámetro"
        *     ),
        *     @OA\Response(
        *         response="default",
        *         description="Ha ocurrido un error."
        *     )
        * )
        */

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return $this->showOne($usuario);
    }
}
