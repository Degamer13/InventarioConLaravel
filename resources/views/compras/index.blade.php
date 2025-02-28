@extends('layouts.admin')

@section('content')

    <h3>Compras</h3>

    @can('compra-create')
        <a href="{{ route('compras.create') }}" class="btn btn-primary mb-3">Registrar Compra</a>
    @endcan

    <div class="col-12 col-md-6 mb-3">
        <!-- Formulario de búsqueda -->
        <form method="GET" action="{{ route('compras.index') }}">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request()->input('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-success">Buscar</button>
                </div>
            </div>
        </form>
    </div>


        <!-- Tabla Responsive -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Proveedor</th>
                        <th>Categoría</th>
                        <th>Unidad de Medida</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                        <tr>
                            <td>{{ $compra->producto->nombre }}</td>
                            <td>{{ $compra->proveedor->nombre }}</td>
                            <td>{{ $compra->categoria->nombre }}</td>
                            <td>{{ $compra->unidad_medida }}</td>
                            <td>{{ $compra->cantidad }}</td>
                            <td>${{ number_format($compra->precio, 2) }}</td>
                            <td>{{ $compra->created_at }}</td>
                            <td class="text-center">
                                @can('compra-edit')
                                    <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-primary">Editar</a>
                                @endcan

                                @can('compra-delete')
                                    <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta compra?')">Eliminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {!! $compras->links() !!}
        </div>
 
@endsection
