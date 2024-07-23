<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('roles', function (Blueprint $table) {
        $table->id('id_rol');
        $table->string('nombre_rol', 50);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('roles');
}
};
