<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('pkUsuario')->autoIncrement();
            $table->string('nombreUsuario', 100);
            $table->string('correo', 100);
            $table->string('contraseña', 100);
            $table->unsignedBigInteger('fkTipoUsuario');
            $table->smallInteger('estatusUsuario');
            $table->text('token');

            $table->foreign("fkTipoUsuario")->references("pkTipoUsuario")->on("tipoUsuario");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
