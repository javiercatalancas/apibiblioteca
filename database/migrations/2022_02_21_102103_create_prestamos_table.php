<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libro_usuario', function (Blueprint $table) {
            $table->increments('id_prestamo');
            $table->integer('usuario_id')->unsigned();
            $table->integer('libro_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('id_usuario')
                    ->references('id')
                    ->on('usuarios');
            $table->foreign('id_libro')
                  ->references('id')
                  ->on('libros');  

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}
