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
        Schema::create('puntaje', function (Blueprint $table) {
            $table->id('pkPuntaje')->autoIncrement();
            $table->integer('cantidadPuntos');
            $table->unsignedBigInteger('fkCategoria');
            $table->unsignedBigInteger('fkUsuario');

            $table->foreign('fkCategoria')->references('pkCategoria')->on('categoria');

            $table->foreign('fkUsuario')->references('pkUsuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puntaje');
    }
};
