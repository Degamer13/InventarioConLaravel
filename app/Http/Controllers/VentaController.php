<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Precio;
use Dompdf\Dompdf;
use Dompdf\Options;

class VentaController extends Controller
{
    function __construct()
    {

         // Permisos para Ventas
    $this->middleware('permission:venta-list|venta-create|venta-edit|venta-delete|total-venta', ['only' => ['index', 'store']]);
    $this->middleware('permission:venta-show', ['only' => ['show']]);
    $this->middleware('permission:venta-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:venta-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:venta-delete', ['only' => ['destroy']]);
    $this->middleware('permission:total-venta', ['only' => ['totalesVentas']]);

    }

    // Mostrar todas las ventas con paginación
    public function index(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $ventas = Venta::with(['cliente', 'productos'])
                ->whereHas('cliente', function ($query) use ($search) {
                    $query->where('nombre', 'like', "%$search%");
                })->paginate(5);
        } else {
            $ventas = Venta::with(['cliente', 'productos'])->paginate(5);
        }

        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        $precioDolar = Precio::first();
        return view('ventas.create', compact('clientes', 'productos', 'precioDolar'));
    }
public function store(Request $request)
{
    $productos = $request->input('productos');
    $mensajeError = '';
    $totalDolares = 0;
    $totalBolivares = 0;
    $productosSinStock = []; // Para almacenar los productos sin stock suficiente

    // Verificar disponibilidad de productos
    foreach ($productos as $producto) {
        $productoExistente = Producto::find($producto['producto_id']);
        
        // Verificar si hay suficiente stock
        if ($productoExistente->cantidad < $producto['cantidad']) {
            $productosSinStock[] = $productoExistente->nombre . ' (Solo quedan ' . $productoExistente->cantidad . ' unidades)';
        }
    }

    // Si hay productos sin stock, redirigir con el mensaje de error
    if (count($productosSinStock) > 0) {
        $mensajeError = 'No hay suficiente stock de los siguientes productos: ' . implode(', ', $productosSinStock);
        return redirect()->route('ventas.create')->with('error', $mensajeError);
    }

    // Calcular el total de la venta en dólares y bolívares
    $precioDolar = Precio::first(); // Obtener el precio del dólar
    foreach ($productos as $producto) {
        $productoExistente = Producto::find($producto['producto_id']);
        $totalProductoDolares = $producto['cantidad'] * $productoExistente->precio_unitario;
        $totalDolares += $totalProductoDolares;
        $totalBolivares += $totalProductoDolares * $precioDolar->precio; // Convertir a bolívares
    }

    // Registrar la venta
    $venta = new Venta();
    $venta->cliente_id = $request->input('cliente_id');
    $venta->total_dolares = $totalDolares;
    $venta->total_bolivares = $totalBolivares;
    $venta->save();

    // Asociar productos a la venta (relación muchos a muchos usando la tabla pivote)
    foreach ($productos as $producto) {
        $productoExistente = Producto::find($producto['producto_id']);

        // Registrar en la tabla pivote producto_venta
        $venta->productos()->attach($producto['producto_id'], [
            'cantidad' => $producto['cantidad'],
            'total' => $producto['cantidad'] * $productoExistente->precio_unitario,
        ]);

        // Restar la cantidad de producto del inventario
        $productoExistente->cantidad -= $producto['cantidad'];
        $productoExistente->save();
    }

    return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
}



    public function show($id)
    {
        $venta = Venta::with(['cliente', 'productos'])->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

public function totalesVentas(Request $request) 
{
    // Validar las fechas del formulario o establecer valores predeterminados
    $fechaInicio = $request->input('fecha_inicio', now()->startOfMonth()->toDateString());
    $fechaFin = $request->input('fecha_fin', now()->endOfMonth()->toDateString());

    // Ajustar la fecha final para incluir todo el día
    $fechaFin = date('Y-m-d 23:59:59', strtotime($fechaFin));

    // Consultar las ventas en el rango de fechas, asegurando que devuelvan 0 si no hay ventas
    $totalDolares = Venta::whereBetween('created_at', [$fechaInicio, $fechaFin])->sum('total_dolares') ?? 0;
    $totalBolivares = Venta::whereBetween('created_at', [$fechaInicio, $fechaFin])->sum('total_bolivares') ?? 0;

    return view('totales.index', compact('totalDolares', 'totalBolivares', 'fechaInicio', 'fechaFin'));
}

public function generatePdf($id)
{
    // Obtener la venta por el ID
    $venta = Venta::with('cliente', 'productos')->findOrFail($id);

    // Configuración de Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    // Renderizar la vista a HTML
    $html = view('ventas.pdf', compact('venta'))->render();

    // Cargar el HTML en Dompdf
    $dompdf->loadHtml($html);

    // (Opcional) Definir el tamaño del papel
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar el PDF (esto puede tomar algún tiempo dependiendo del contenido)
    $dompdf->render();

    // Enviar el PDF al navegador
    return $dompdf->stream('venta_'.$venta->id.'.pdf');
}


   public function edit($id)
{
    // Cargar la venta, sus productos, clientes, productos disponibles, y el precio del dólar
    $venta = Venta::with('productos')->findOrFail($id);
    $clientes = Cliente::all();
    $productos = Producto::all();
    $precioDolar = Precio::first(); // Suponemos que el precio está almacenado en una tabla de precios

    // Pasamos todos los datos a la vista
    return view('ventas.edit', compact('venta', 'clientes', 'productos', 'precioDolar'));
}

public function update(Request $request, $id)
{
    // Obtén la venta actual
    $venta = Venta::findOrFail($id);
    
    // Verificar si hay suficiente stock para cada producto
    foreach ($request->productos as $producto) {
        $productoEnInventario = Producto::find($producto['producto_id']);
        
        // Comprobar si hay suficiente cantidad de producto en inventario
        if ($productoEnInventario->cantidad < $producto['cantidad']) {
            return redirect()->route('ventas.edit', $venta->id)
                ->with('error', 'No hay suficiente stock para el producto: ' . $productoEnInventario->nombre);
        }
    }

    // Si pasa la validación, actualiza la venta
    $venta->cliente_id = $request->cliente_id;
    $venta->total_dolares = $request->total_dolares;
    $venta->total_bolivares = $request->total_bolivares;
    $venta->save();

    // Primero, eliminamos los productos previamente asociados a la venta
    $venta->productos()->detach();

    // Actualizar los productos y sus cantidades en la tabla pivote
    foreach ($request->productos as $producto) {
        $venta->productos()->attach($producto['producto_id'], ['cantidad' => $producto['cantidad'], 'total' => $producto['total']]);
        
        // Actualizamos el inventario, restando la cantidad vendida
        $productoEnInventario = Producto::find($producto['producto_id']);
        $productoEnInventario->cantidad -= $producto['cantidad'];
        $productoEnInventario->save();
    }

    return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente');
}



    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);

        // Restablecer el stock de los productos vendidos
        foreach ($venta->productos as $producto) {
            $productoExistente = Producto::find($producto->id);
            $productoExistente->cantidad += $producto->pivot->cantidad;
            $productoExistente->save();
        }

        // Eliminar la venta
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }

    // Obtener el precio actual del dólar en bolívares
    public function obtenerPrecioDolar()
    {
        $precioDolar = Precio::first();
        return response()->json(['precio' => $precioDolar->precio]);
    }
}
