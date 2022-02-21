<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Libro;
use App\Usuario;
use App\Prestamo;
use Faker\Generator as Faker;

$factory->define(Prestamo::class, function (Faker $faker) {
    return [
        /* 'id_usuario' => $factory ->create(App\Usuario::class)->id,
        'id_libro' => $factory ->create(App\Libro::class)->id */
        'id_usuario' => Usuario::all()->random()->id,
        'id_libro' => Libro::all()->random()->id
    ];
});
