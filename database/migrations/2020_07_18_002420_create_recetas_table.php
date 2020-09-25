<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('categoria_recetas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('categoria');
            $table->timestamps();
        });

        Schema::create('recetas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 100);
            $table->text('ingredientes');
            $table->text('preparacion');
            $table->string('imagen');
            $table->unsignedInteger('usuario_id');
            $table->unsignedInteger('categoria_id');
            $table->foreign('usuario_id')->references('id')->on('users')->comment('El usuario que crea la receta');
            $table->foreign('categoria_id')->references('id')->on('categoria_recetas')->comment('La categoría de la receta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('recetas');
        Schema::dropIfExists('categoria_recetas');
    }
}
