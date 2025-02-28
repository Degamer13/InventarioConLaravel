<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // Migración para la tabla categorias
public function up()
{
    Schema::create('categorias', function (Blueprint $table) {
        $table->id();
        $table->string('nombre'); // Nombre de la categoría (ej. Bebidas, Comida, etc.)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
