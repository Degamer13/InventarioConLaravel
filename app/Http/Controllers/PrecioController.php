<?php


namespace App\Http\Controllers;

use App\Models\Precio;
use Illuminate\Http\Request;

class PrecioController extends Controller
{

    function __construct()
    {

         $this->middleware('permission:dolar-list|dolar-create|dolar-edit|dolar-delete', ['only' => ['index', 'store']]);
    $this->middleware('permission:dolar-show', ['only' => ['show']]);
    $this->middleware('permission:dolar-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:dolar-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:dolar-delete', ['only' => ['destroy']]);
    }
    /**
     * Muestra una lista de precios.
     */
    public function index()
    {
        $precios = Precio::all();
        return view('precios.index', compact('precios'));
    }

    /**
     * Muestra el formulario para crear un nuevo precio.
     */
    public function create()
    {
        return view('precios.create');
    }

    /**
     * Almacena un nuevo precio en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dolar' => 'required|numeric',
            'precio' => 'required|numeric',
        ]);

        Precio::create($request->all());
        return redirect()->route('precios.index')->with('success', 'Precio creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un precio existente.
     */
    public function edit(Precio $precio)
    {
        return view('precios.edit', compact('precio'));
    }

    /**
     * Actualiza un precio en la base de datos.
     */
    public function update(Request $request, Precio $precio)
    {
        $request->validate([
            'dolar' => 'required|numeric',
            'precio' => 'required|numeric',
        ]);

        $precio->update($request->all());
        return redirect()->route('precios.index')->with('success', 'Precio actualizado correctamente.');
    }

    /**
     * Elimina un precio de la base de datos.
     */
    public function destroy(Precio $precio)
    {
        $precio->delete();
        return redirect()->route('precios.index')->with('success', 'Precio eliminado correctamente.');
    }
}
