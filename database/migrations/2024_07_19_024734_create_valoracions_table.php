<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoracionsTable extends Migration
{
    public function up()
    {
        Schema::create('valoraciones', function (Blueprint $table) {
            $table->id('id_valoracion');
            $table->unsignedBigInteger('id_experiencia');
            $table->unsignedBigInteger('id_usuario');
            $table->integer('puntuacion');
            $table->string('comentario_breve', 200)->nullable();

            $table->foreign('id_experiencia')->references('id_experiencia')->on('experiencias')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('valoraciones');
    }
}