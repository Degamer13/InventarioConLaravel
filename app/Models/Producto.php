<?php

// app/Models/Producto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
     protected $table = 'productos'; // Nombre correcto de la tabla
      protected $fillable = ['nombre', 'ubicacion', 'categoria_id', 'marca', 'precio_unitario', 'precio_caja', 'unidad_de_medida', 'cantidad_por_unidad', 'cantidad', 'proveedor_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function proveedor()
{
    return $this->belongsTo(Proveedor::class, 'proveedor_id');
}
   
  
}
