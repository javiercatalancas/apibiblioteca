<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Libro;
use App\Usuario;
use App\Prestamo;
use Faker\Generator as Faker;


// hay que hacerlo en el seeder con Attach y rand
$factory->define(Prestamo::class, function (Faker $faker) {
    return [
        'id_usuario' => Usuario::all()->random()->id,
        'id_libro' => Libro::all()->random()->id
    ];
});
