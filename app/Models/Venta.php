<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\Precio;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'total_dolares', // Total en dólares
        'total_bolivares', // Total en bolívares
    ];

    /**
     * Relación con Cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relación con productos a través de la tabla pivote.
     */
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_venta')
                    ->withPivot('cantidad', 'total') // Usamos pivot para los datos adicionales
                    ->withTimestamps();
    }

    /**
     * Método para calcular el total en bolívares y en dólares.
     */
    public function calcularTotal()
    {
        $totalBs = 0;
        foreach ($this->productos as $producto) {
            $totalBs += $producto->pivot->total;
        }

        // Obtener el precio actual del dólar
        $precioDolar = Precio::latest()->first()->precio;

        // Calcular el total en dólares
        $totalUsd = $totalBs / $precioDolar;

        // Asignar los totales
        $this->total_bolivares = $totalBs;
        $this->total_dolares = $totalUsd;

        // Guardar los totales calculados
        $this->save();
    }
}
