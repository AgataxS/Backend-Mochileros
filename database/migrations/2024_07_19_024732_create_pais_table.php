<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->id('id_pais');
            $table->string('nombre_pais', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('paises');
    }
}