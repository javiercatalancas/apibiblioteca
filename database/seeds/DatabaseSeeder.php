<?php

use App\Libro;
use App\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuarioSeeder::class);
        $this->call(LibroSeeder::class);
       // $this->call(PrestamoSeeder::class);


       // Hay que configurar el seed de libro_usuario con attach
    for ($i=0; $i<20; $i++){
        $libro = Libro::all()->random()->id;
        $usuario = Usuario::all()->random();
        $usuario->libros()->attach($libro);
    }
       
       
    }
}
