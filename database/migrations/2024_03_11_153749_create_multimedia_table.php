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
        Schema::create('multimedia', function (Blueprint $table) {
            $table->id('pkMultimedia')->autoIncrement();
            $table->text('nombreMultimedia');
            $table->unsignedBigInteger('fkCategoria');
            $table->smallInteger('estatusMultimedia');

            $table->foreign('fkCategoria')->references('pkCategoria')->on('categoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multimedia');
    }
};
