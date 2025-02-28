<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
function __construct()
{

     // Permisos para Productos
    $this->middleware('permission:producto-list|producto-create|producto-edit|producto-delete', ['only' => ['index', 'store']]);
    $this->middleware('permission:producto-show', ['only' => ['show']]);
    $this->middleware('permission:producto-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:producto-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:producto-delete', ['only' => ['destroy']]);
}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $productos = Producto::with('categoria', 'proveedor')
            ->when($search, function ($query, $search) {
                return $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('productos.create', compact('categorias', 'proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'categoria_id' => 'required',
            'marca' => 'required|string|max:255',
            'precio_unitario' => 'required|numeric',
            'precio_caja' => 'required|numeric',
            'unidad_de_medida' => 'required|string|max:255',
            'cantidad_por_unidad' => 'required|integer',
            'cantidad' => 'required|integer',
            'proveedor_id' => 'required',
        ]);

        Producto::create($request->only([
            'nombre', 'ubicacion', 'categoria_id', 'marca', 
            'precio_unitario', 'precio_caja', 'unidad_de_medida', 
            'cantidad_por_unidad', 'cantidad', 'proveedor_id'
        ]));

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'categoria_id' => 'required',
            'marca' => 'required|string|max:255',
            'precio_unitario' => 'required|numeric',
            'precio_caja' => 'required|numeric',
            'unidad_de_medida' => 'required|string|max:255',
            'cantidad_por_unidad' => 'required|integer',
            'cantidad' => 'required|integer',
            'proveedor_id' => 'required',
        ]);

        $producto->update($request->only([
            'nombre', 'ubicacion', 'categoria_id', 'marca', 
            'precio_unitario', 'precio_caja', 'unidad_de_medida', 
            'cantidad_por_unidad', 'cantidad', 'proveedor_id'
        ]));

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente');
    }
}
