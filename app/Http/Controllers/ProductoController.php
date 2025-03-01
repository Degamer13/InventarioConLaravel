<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Dompdf\Options;

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

    // Buscar productos por nombre o código de barras
    $productos = Producto::with('categoria', 'proveedor')
        ->when($search, function ($query, $search) {
            return $query->where('nombre', 'like', '%' . $search . '%')
                         ->orWhere('codigo_barras', 'like', '%' . $search . '%'); // Agregar búsqueda por código de barras
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

    // Generar el código de barras
$codigo = 'PROD-' . Str::random(8);  // Generar un código único para el producto
$generator = new BarcodeGeneratorPNG();
$codigoBarras = $generator->getBarcode($codigo, $generator::TYPE_CODE_128);
$codigoBarrasPath = 'barcodes/' . $codigo . '.png';

// Guardar el código de barras en el almacenamiento público
Storage::disk('public')->put($codigoBarrasPath, $codigoBarras);

// Crear el producto con la ruta del código de barras
Producto::create([
    'nombre' => $request->input('nombre'),
    'ubicacion' => $request->input('ubicacion'),
    'categoria_id' => $request->input('categoria_id'),
    'marca' => $request->input('marca'),
    'precio_unitario' => $request->input('precio_unitario'),
    'precio_caja' => $request->input('precio_caja'),
    'unidad_de_medida' => $request->input('unidad_de_medida'),
    'cantidad_por_unidad' => $request->input('cantidad_por_unidad'),
    'cantidad' => $request->input('cantidad'),
    'proveedor_id' => $request->input('proveedor_id'),
    'codigo_barras' => $codigoBarrasPath,  // Guardar la ruta del código de barras
]);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }
    public function generarPdf($id)
    {
        // Obtener el producto por ID
        $producto = Producto::findOrFail($id);
    
        // Crear una instancia del generador de código de barras
        $generator = new BarcodeGeneratorPNG();
        
        // Generar el código de barras en formato PNG (se necesita el código de barras del producto)
        $barcode = $generator->getBarcode($producto->codigo_barras, BarcodeGeneratorPNG::TYPE_CODE_128);
        
        // Convertir el código de barras a base64 para incrustarlo en una vista
        $barcodeDataUrl = 'data:image/png;base64,' . base64_encode($barcode);
    
        // Crear la vista para el PDF (pasamos la URL de los datos de la imagen)
        $pdfView = view('productos.pdf', compact('producto', 'barcodeDataUrl'))->render();
    
        // Crear el PDF usando DomPDF (lo que ya habíamos configurado)
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($pdfView);
        $dompdf->render();
    
        // Descargar el PDF generado
        return $dompdf->stream('codigo_de_barras_' . $producto->id . '.pdf');
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
