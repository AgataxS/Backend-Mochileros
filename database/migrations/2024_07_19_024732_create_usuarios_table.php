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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->unsignedBigInteger('id_rol');
            $table->string('nombre', 100);
            $table->string('apellido', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('contraseña', 100);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('genero', 20)->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->text('biografia')->nullable();
            $table->string('foto_perfil', 200)->nullable();
            $table->timestamps();
            $table->foreign('id_rol')->references('id_rol')->on('roles')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
