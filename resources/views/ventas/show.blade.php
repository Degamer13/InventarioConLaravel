@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')
@section('content')
    <div class="container">  
    <h3>Detalles de la Venta</h3>
    
    <div class="card">
        <div class="card-header">
            Venta #{{ $venta->id }}
        </div>
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
            <p><strong>Total en Dólares:</strong> ${{ number_format($venta->total_dolares, 2) }}</p>
            <p><strong>Total en Bolívares:</strong> Bs. {{ number_format($venta->total_bolivares, 2) }}</p>
            <p><strong>Fecha de Registro:</strong> {{ $venta->created_at->format('d/m/Y H:i:s') }}</p>
            
            <h3>Productos Vendidos:</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->pivot->cantidad }}</td>
                            <td>$ {{ number_format($producto->pivot->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <a href="{{ route('ventas.index') }}" class="btn btn-primary">Volver a la lista de ventas</a>
        </div>
    </div>
</div>
@endsection
