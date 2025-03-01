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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ubicacion'); // Ubicación del producto en el almacén
            $table->foreignId('categoria_id')->constrained('categorias'); // Relación con la tabla categorias
            $table->string('marca');
            $table->decimal('precio_unitario', 10, 2); // Precio por unidad
            $table->decimal('precio_caja', 10, 2)->nullable(); // Precio por caja (opcional)
            $table->string('unidad_de_medida'); // Ejemplo: 'unidad', 'paquete', 'kilo', 'caja'
            $table->integer('cantidad_por_unidad'); // Cuántas unidades hay en una caja, paquete, etc.
            $table->integer('cantidad'); // Cantidad disponible en inventario
            $table->string('codigo_barras')->nullable();
            //$table->foreignId('proveedor_id')->constrained('proveedores')->onDelete('cascade'); // Relación correcta con proveedores
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
