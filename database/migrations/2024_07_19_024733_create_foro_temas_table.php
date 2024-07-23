<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumTopicsTable extends Migration
{
    public function up()
    {
        Schema::create('foro_temas', function (Blueprint $table) {
            $table->id('id_foro_tema');
            $table->unsignedBigInteger('id_usuario');
            $table->string('titulo', 200);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->enum('estado', ['abierto', 'cerrado'])->default('abierto');

            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('foro_temas');
    }
}