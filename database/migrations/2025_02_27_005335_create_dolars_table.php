<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla 'precios'.
     */
    public function up(): void
    {
        Schema::create('dolares', function (Blueprint $table) {
            $table->id();
            $table->decimal('dolar', 10, 2); // Campo para el valor del dólar
            $table->decimal('precio', 10, 2); // Campo para el precio
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('dolares');
    }
};
