<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
     protected $table = 'proveedores'; // Nombre correcto de la tabla


    protected $fillable = ['nombre','cedula', 'email', 'telefono'];

   
}
