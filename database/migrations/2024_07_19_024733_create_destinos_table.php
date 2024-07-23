<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    public function up()
    {
        Schema::create('destinos', function (Blueprint $table) {
            $table->id('id_destino');
            $table->unsignedBigInteger('id_pais');
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();

            $table->foreign('id_pais')->references('id_pais')->on('paises')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinos');
    }
}