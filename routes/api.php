<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::apiResource('usuarios', 'Usuario\UsuarioController' );
Route::apiResource('libros', 'Libro\LibroController');
Route::apiResource('prestamos', 'Prestamo\PrestamoController');
//Route::apiResource('usuarios.prestamos', 'UsuarioPrestamo\UsuarioPrestamoController');
Route::apiResource('usuarios.libros', 'UsuarioLibro\UsuarioLibroController', ['only'=> ['store', 'destroy']]);


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'JWTAuthController@register');
    Route::post('login', 'JWTAuthController@login');
    Route::post('logout', 'JWTAuthController@logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::get('profile', 'JWTAuthController@profile');

});



