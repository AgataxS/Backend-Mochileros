<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id('id_comentario');
            $table->unsignedBigInteger('id_experiencia');
            $table->unsignedBigInteger('id_usuario');
            $table->text('contenido');
            $table->timestamp('fecha')->useCurrent();

            $table->foreign('id_experiencia')->references('id_experiencia')->on('experiencias')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}