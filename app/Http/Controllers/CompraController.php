<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Precio;

class CompraController extends Controller
{
    function __construct()
    {
          // Permisos para Compras
    $this->middleware('permission:compra-list|compra-create|compra-edit|compra-delete|total-compra', ['only' => ['index', 'store']]);
    $this->middleware('permission:compra-show', ['only' => ['show']]);
    $this->middleware('permission:compra-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:compra-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:compra-delete', ['only' => ['destroy']]);
     $this->middleware('permission:total-compra', ['only' => ['totalesCompras']]);
    }

public function index(Request $request)
{
    // Obtener el término de búsqueda
    $search = $request->input('search');

    // Cargar las compras con relaciones y aplicar la búsqueda, con paginación de 5 registros por página
    $compras = Compra::with(['producto', 'proveedor', 'categoria'])
        ->whereHas('producto', function($query) use ($search) {
            $query->where('nombre', 'like', "%{$search}%");
        })
        ->orWhereHas('proveedor', function($query) use ($search) {
            $query->where('nombre', 'like', "%{$search}%");
        })
        ->orWhereHas('categoria', function($query) use ($search) {
            $query->where('nombre', 'like', "%{$search}%");
        })
        ->orWhere('created_at', 'like', "%{$search}%")
        ->paginate(5);  // Paginación de 5 registros por página

    // Retornar la vista con las compras y el término de búsqueda
    return view('compras.index', compact('compras', 'search'));
}


    // Mostrar el formulario para crear una nueva compra
    public function create()
    {
        // Obtener todos los productos, proveedores y categorías
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        $categorias = Categoria::all();

        // Retornar la vista con los productos, proveedores y categorías
        return view('compras.create', compact('productos', 'proveedores', 'categorias'));
    }

    // Guardar una nueva compra
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'categoria_id' => 'required|exists:categorias,id',
            'unidad_medida' => 'required|string|max:255',
            'cantidad' => 'required|numeric|min:1',
            'precio' => 'required|numeric|min:0',
           
        ]);

        // Crear la compra en la base de datos
        Compra::create($request->all());

        // Redirigir a la lista de compras con un mensaje de éxito
        return redirect()->route('compras.index')->with('success', 'Compra registrada correctamente.');
    }

public function totalesCompras(Request $request) 
{
    // Validar las fechas del formulario o establecer valores predeterminados
    $fechaInicio = $request->input('fecha_inicio', now()->startOfMonth()->toDateString());
    $fechaFin = $request->input('fecha_fin', now()->endOfMonth()->toDateString());

    // Ajustar la fecha final para incluir todo el día
    $fechaFin = date('Y-m-d 23:59:59', strtotime($fechaFin));

    // Consultar el total en dólares en el rango de fechas
    $totalDolares = Compra::whereBetween('created_at', [$fechaInicio, $fechaFin])->sum('precio') ?? 0;

    // Obtener la última tasa de cambio de la tabla dolares (modelo Precio)
    $ultimaTasa = Precio::latest('created_at')->value('precio') ?? 0;

    // Calcular el total en bolívares usando la tasa de cambio
    $totalBolivares = $ultimaTasa > 0 ? $totalDolares * $ultimaTasa : 0;

    return view('totales.compras', compact('totalDolares', 'totalBolivares', 'fechaInicio', 'fechaFin'));
}

    // Mostrar el formulario para editar una compra existente
    public function edit(Compra $compra)
    {
        // Obtener todos los productos, proveedores y categorías
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        $categorias = Categoria::all();

        // Retornar la vista de edición con la compra y las opciones de productos, proveedores y categorías
        return view('compras.edit', compact('compra', 'productos', 'proveedores', 'categorias'));
    }

    // Actualizar una compra existente
    public function update(Request $request, Compra $compra)
    {
        // Validar los datos del formulario
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'categoria_id' => 'required|exists:categorias,id',
            'unidad_medida' => 'required|string|max:255',
            'cantidad' => 'required|numeric|min:1',
            'precio' => 'required|numeric|min:0',
            
        ]);

        // Actualizar la compra con los datos del formulario
        $compra->update($request->all());

        // Redirigir a la lista de compras con un mensaje de éxito
        return redirect()->route('compras.index')->with('success', 'Compra actualizada correctamente.');
    }

    // Eliminar una compra
    public function destroy(Compra $compra)
    {
        // Eliminar la compra de la base de datos
        $compra->delete();

        // Redirigir a la lista de compras con un mensaje de éxito
        return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente.');
    }
}
