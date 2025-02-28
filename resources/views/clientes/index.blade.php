@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')
@section('content')
    <div class="container">  
    <h3>Clientes</h3>
    
    @can('cliente-create')
        <a href="{{ route('clientes.create') }}" class="btn btn-primary mb-3">Registrar Cliente</a>
    @endcan

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="col-12 col-md-6 mb-3">
        <!-- Buscador -->
        <form method="GET" action="{{ route('clientes.index') }}" class="mb-3">
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
                    <th>Cédula</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th width="280px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->cedula }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td class="text-center">
                            @can('cliente-show')
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info">Visualizar</a>
                            @endcan

                            @can('cliente-edit')
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
                            @endcan

                            @can('cliente-delete')
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">Eliminar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {!! $clientes->render() !!}
</div>
@endsection
