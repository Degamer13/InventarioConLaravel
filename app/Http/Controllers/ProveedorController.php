<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    function __construct()
    {
          // Permisos para Proveedores
    $this->middleware('permission:proveedor-list|proveedor-create|proveedor-edit|proveedor-delete', ['only' => ['index', 'store']]);
    $this->middleware('permission:proveedor-show', ['only' => ['show']]);
    $this->middleware('permission:proveedor-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:proveedor-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:proveedor-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $proveedores = Proveedor::when($search, function ($query, $search) {
                return $query->where('cedula', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'cedula' => 'required|unique:proveedores,cedula',
            'email' => 'required|email',
            'telefono' => 'required'
        ]);

        Proveedor::create($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor agregado correctamente.');
    }

    public function show($id)
    {
        // Encuentra el proveedor por su ID
        $proveedor = Proveedor::findOrFail($id);

        // Retorna la vista 'proveedores.show' pasando el proveedor
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit($id)
    {
        // Encuentra el proveedor por su ID
        $proveedor = Proveedor::findOrFail($id);

        // Retorna la vista 'proveedores.edit' pasando el proveedor
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
{
    // Encuentra el proveedor por ID
    $proveedor = Proveedor::findOrFail($id);

    // Valida los datos
    $request->validate([
        'nombre' => 'required',
        'cedula' => 'required',
        'email' => 'required|email',
        'telefono' => 'required'
    ]);

    // Actualiza los datos
    $proveedor->update($request->all());

    // Redirige a la lista de proveedores con un mensaje de éxito
    return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
}
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }
}
