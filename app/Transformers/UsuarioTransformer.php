<?php

namespace App\Transformers;

use App\Usuario;
use League\Fractal\TransformerAbstract;

class UsuarioTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Usuario $usuario)
    {
        return [
            'identificador' => (int)$usuario->id,
            'nombre' => (string)$usuario->name,
            'correo' => (string)$usuario->email,
            'fechaCreacion' => (string)$usuario->created_at,
            'fechaActualizacion' => (string)$usuario->updated_at,
            'libros'=>$usuario->libros,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('usuarios.show', $usuario->id),
                ],
                [
                    'rel' => 'self',
                    'metodo' => 'POST',
                    'href' => route('usuarios.store'),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'name',
            'correo' => 'email',
            'contraseña' => 'password',
            'fechaCreacion' => 'created_at',
            'contraseña_confirmation' => 'password_confirmation',
            'fechaActualizacion' => 'updated_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identificador',
            'name' => 'nombre',
            'email' => 'correo',
            'password' => 'contraseña',
            'password_confirmation' => 'contraseña_confirmation',
            'created_at' => 'fechaCreacion',
            'updated_at' => 'fechaActualizacion',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

}
