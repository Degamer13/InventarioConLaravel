@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')

@section('content')
    <div class="container">  

    <h3>Precio del Dolar</h3>

    @can('dolar-create')
        <a href="{{ route('precios.create') }}" class="btn btn-primary mb-3">Nuevo Precio</a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dólar</th>
                    <th>Precio</th>
                    <th width="280px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($precios as $precio)
                    <tr>
                        <td>{{ $precio->id }}</td>
                        <td>${{ $precio->dolar }}</td>
                        <td>{{ $precio->precio }}Bs</td>
                        <td class="text-center">
                            @can('dolar-edit')
                                <a href="{{ route('precios.edit', $precio->id) }}" class="btn btn-primary">Editar</a>
                            @endcan
                            
                            @can('dolar-delete')
                                <form action="{{ route('precios.destroy', $precio->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este precio?')">Eliminar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

