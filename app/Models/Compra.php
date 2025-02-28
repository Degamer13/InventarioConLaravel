<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'proveedor_id',
        'categoria_id',
        'producto_id',  // Aquí añadimos la relación con Producto
        'unidad_medida',
        'cantidad',
        'precio',
        
    ];

    /**
     * Relación uno a muchos inversa con Producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    /**
     * Relación uno a muchos inversa con Proveedor.
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');  // Especificamos la clave foránea
    }

    /**
     * Relación uno a muchos inversa con Categoria.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');  // Especificamos la clave foránea
    }
}
