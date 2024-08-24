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
        Schema::create('opciones', function (Blueprint $table) {
            $table->id('pkOpciones')->autoIncrement();
            $table->string('nombreOpcion', 100);
            $table->unsignedBigInteger('fkMultimedia');
            $table->string('estatusOpcion', 50);

            $table->foreign('fkMultimedia')->references('pkMultimedia')->on('multimedia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opciones');
    }
};
