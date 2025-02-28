@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')

@section('content')
    <div class="container">  

    <h3>Productos</h3>
    
    @can('producto-create')
        <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Registrar Producto</a>
    @endcan

    <!-- Buscador -->
    <div class="col-12 col-md-6 mb-3">
        <form method="GET" action="{{ route('productos.index') }}">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Buscar productos..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">Buscar</button>
            </div>
        </form>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Categoría</th>
                    <th>Marca</th>
                    <th>Precio Unitario</th>
                    <th>Precio Caja</th>
                    <th>Unidad de Medida</th>
                    <th>Cantidad por Unidad</th>
                    <th>Cantidad</th>
                    <th>Proveedor</th>
                    <th width="280px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->ubicacion }}</td>
                        <td>{{ $producto->categoria->nombre }}</td>
                        <td>{{ $producto->marca }}</td>
                        <td>${{ $producto->precio_unitario }}</td>
                        <td>${{ $producto->precio_caja }}</td>
                        <td>{{ $producto->unidad_de_medida }}</td>
                        <td>{{ $producto->cantidad_por_unidad }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td>{{ $producto->proveedor->nombre }}</td>
                        <td class="text-center">
                            @can('producto-show')
                                <a class="btn btn-info" href="{{ route('productos.show', $producto->id) }}">Visualizar</a>
                            @endcan
                            
                            @can('producto-edit')
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>
                            @endcan

                            @can('producto-delete')
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {!! $productos->render() !!}
</div>
@endsection
