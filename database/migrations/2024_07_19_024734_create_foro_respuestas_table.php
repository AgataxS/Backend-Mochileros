<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('foro_respuestas', function (Blueprint $table) {
            $table->id('id_foro_respuesta');
            $table->unsignedBigInteger('id_foro_tema');
            $table->unsignedBigInteger('id_usuario');
            $table->text('contenido');
            $table->timestamp('fecha')->useCurrent();

            $table->foreign('id_foro_tema')->references('id_foro_tema')->on('foro_temas')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('foro_respuestas');
    }
}