@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')

@section('content')
    <div class="container">  
    <h2>Ventas</h2>

    @can('venta-create')
        <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Registrar Venta</a>
    @endcan
  
    <div class="col-12 col-md-6 mb-3">
        <!-- Formulario de búsqueda -->
        <form action="{{ route('ventas.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="search" value="{{ request()->query('search') }}" placeholder="Buscar por cliente ">
                <button class="btn btn-success" type="submit">Buscar</button>
            </div>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <!-- Tabla de ventas -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Total en Dólares</th>
                    <th>Total en Bolívares</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->cliente->nombre }}</td>
                        <td>{{ $venta->total_dolares }}</td>
                        <td>{{ $venta->total_bolivares }}</td>
                        <td class="text-center">
                            @can('venta-show')
                                <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info">Visualizar</a>
                            @endcan
                            <a href="{{ route('ventas.pdf', $venta->id) }}" class="btn btn-secondary">Generar PDF</a>

                            
                            @can('venta-edit')
                                <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-primary">Editar</a>
                            @endcan

                            @can('venta-delete')
                                <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Paginación -->
    {{ $ventas->appends(request()->query())->links() }}
</div>


@endsection
