@extends('layouts.admin')

@section('content')

    <h3>Proveedores</h3>
    
    @can('proveedor-create')
        <a href="{{ route('proveedores.create') }}" class="btn btn-primary mb-3">Registrar Proveedor</a>
    @endcan

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="col-12 col-md-6 mb-3">
        <!-- Buscador por cédula -->
        <form method="GET" action="{{ route('proveedores.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar por cédula..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">Buscar</button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cédula / Rif</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->id }}</td>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->cedula }}</td>
                        <td>{{ $proveedor->email }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td class="text-center">
                            @can('proveedor-show')
                                <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-info">Visualizar</a>
                            @endcan

                            @can('proveedor-edit')
                                <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-primary">Editar</a>
                            @endcan

                            @can('proveedor-delete')
                                <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">Eliminar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {!! $proveedores->render() !!}

@endsection
