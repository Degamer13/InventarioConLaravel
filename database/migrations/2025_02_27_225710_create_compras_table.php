<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('proveedor_id')->constrained('proveedores');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->string('unidad_medida');
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('compras');
    }
};
