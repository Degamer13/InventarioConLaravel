@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')

@section('content')
    <div class="container">

        <h3>Detalles del Producto</h3>

        <p class="card-text"><strong>Nombre:</strong> {{ $producto->nombre }}</p>
        <p class="card-text"><strong>Ubicación:</strong> {{ $producto->ubicacion }}</p>
        <p class="card-text"><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
        <p class="card-text"><strong>Marca:</strong> {{ $producto->marca }}</p>
        <p class="card-text"><strong>Precio Unitario:</strong> {{ $producto->precio_unitario }}</p>
        <p class="card-text"><strong>Precio al Mayor:</strong> {{ $producto->precio_caja }}</p>
        <p class="card-text"><strong>Descripción:</strong> {{ $producto->unidad_de_medida }}</p>
        <p class="card-text"><strong>Cantidad por Unidad:</strong> {{ $producto->cantidad_por_unidad }}</p>
        <p class="card-text"><strong>Cantidad:</strong> {{ $producto->cantidad }}</p>
        <p class="card-text"><strong>Proveedor:</strong> {{ $producto->proveedor->nombre }}</p>

        <!-- Mostrar el código de barras -->
        <p><strong>Código de Barras:</strong></p>
        <img src="{{ asset('storage/' . $producto->codigo_barras) }}" alt="Código de Barras" style="width: 200px; height: auto; ">
        <br><br>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Regresar</a>

    </div>
@endsection
