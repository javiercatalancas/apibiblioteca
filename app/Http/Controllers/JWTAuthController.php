<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class JWTAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */


 /**
        * @OA\Post(
        *     path="/api/auth/register",
        *     tags={"JWTAuthenticator"},
        *     summary="Registrar un Usuario desde JWT",
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



    public function register(Request $request)
    {

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6|confirmed',
        ];
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'email.required' => 'El campo correo no tiene el formato adecuado.',
            'password' => 'La contraseña es campo obligatorio',
        ];
        $validatedData = $request->validate($rules, $messages);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = Usuario::create($validatedData);
        return $this->showOne($user,201);

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

      /**
        * @OA\Post(
        *     path="/api/auth/login",
        *     tags={"JWTAuthenticator"},
        *     summary="Logear un Usuario desde JWT",
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
        *     @OA\Response(
        *         response=200,
        *         description="Ruta para hacer Login y crear un nuevo token"
        *     ),
        *
        *@OA\Response(
        *         response="default",
        *         description="Ha ocurrido un error."
        *     )
        * )
        */




    public function login(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
