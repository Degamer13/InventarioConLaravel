<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    function __construct () {
         // Permisos para Clientes
    $this->middleware('permission:cliente-list|cliente-create|cliente-edit|cliente-delete', ['only' => ['index', 'store']]);
    $this->middleware('permission:cliente-show', ['only' => ['show']]);
    $this->middleware('permission:cliente-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:cliente-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:cliente-delete', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $clientes = Cliente::when($search, function ($query, $search) {
                return $query->where('cedula', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'cedula' => 'required|unique:clientes,cedula',
            'email' => 'required|email',
            'telefono' => 'required'
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente agregado correctamente.');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required',
            'cedula' => 'required',
            'email' => 'required|email',
            'telefono' => 'required'
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
