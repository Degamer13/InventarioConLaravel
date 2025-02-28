@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')
@section('content')
    <div class="container">  
    <h3>Registrar Venta</h3>

    <!-- Mostrar mensaje de error si no hay suficiente stock -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulario para registrar la venta -->
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cliente_id">Cliente</label>
            <select name="cliente_id" class="form-control select2" required>
                <option value="">Selecciona un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div id="productos-container">
            <div class="product-row mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="producto_id">Producto</label>
                        <select name="productos[0][producto_id]" class="form-control product-select select2" required>
                            <option value="">Selecciona un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" data-precio="{{ $producto->precio_unitario }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="productos[0][cantidad]" class="form-control cantidad-input" placeholder="Cantidad" required min="1" required>
                    </div>
                    <div class="col-md-3">
                        <label for="total">Total Producto</label>
                        <p class="product-total">Total Producto: <span class="product-total-price">0</span> Bs</p>
                        <input type="hidden" name="productos[0][total]" class="total-input" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <button type="button" id="add-product" class="btn btn-success">Añadir Producto</button>
        </div>

        <!-- Total de la venta en dólares y bolívares -->
        <div class="form-group mt-3">
            <label for="total_dolares">Total en Dólares</label>
            <input type="text" id="total_dolares" name="total_dolares" class="form-control" readonly required>
        </div>

        <div class="form-group">
            <label for="total_bolivares">Total en Bolívares</label>
            <input type="text" id="total_bolivares" name="total_bolivares" class="form-control" readonly required>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

@section('css')
<!-- En tu archivo de encabezado, dentro de <head> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Ajuste de altura para Select2 */
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 6px 12px;
        }

        .select2-selection__rendered {
            line-height: 24px !important;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
        }
    </style>
@endsection

@section('js')
 <!-- En tu archivo de scripts, dentro de <body> antes de cerrar la etiqueta </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inicializar Select2 en los campos de selección
        $('.select2').select2({
            width: '100%'  // Asegurarse que Select2 ocupe todo el ancho disponible
        });
    });
</script>
<script>
    let productosCount = 1;

    // Función para actualizar los totales de productos y la venta
    function updateTotals() {
        let totalDolares = 0;
        let totalBolivares = 0;
        const dolarPrecio = @json($precioDolar->precio); // Usamos el precio del dólar de la tabla

        // Recorrer los productos y calcular el total
        document.querySelectorAll('.product-row').forEach((row, index) => {
            const cantidad = row.querySelector('.cantidad-input').value;
            const precio = row.querySelector('.product-select').selectedOptions[0].dataset.precio;
            const totalProducto = cantidad * precio;

            // Actualizar total producto
            row.querySelector('.product-total-price').textContent = (totalProducto * dolarPrecio).toFixed(2);

            // Acumular en total venta
            totalDolares += totalProducto;
            totalBolivares += totalProducto * dolarPrecio;

            // Establecer el total en los inputs ocultos
            row.querySelector('.total-input').value = totalProducto;
        });

        // Actualizar los campos de total en la venta
        document.querySelector('#total_dolares').value = totalDolares.toFixed(2);
        document.querySelector('#total_bolivares').value = totalBolivares.toFixed(2);
    }

    // Evento para cuando se cambia un producto o cantidad
    document.querySelector('#productos-container').addEventListener('change', updateTotals);
    document.querySelector('#productos-container').addEventListener('input', updateTotals);

    // Añadir producto
    document.querySelector('#add-product').addEventListener('click', function() {
        const newProductRow = document.createElement('div');
        newProductRow.classList.add('product-row', 'mb-3');
        newProductRow.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label for="producto_id">Producto</label>
                    <select name="productos[${productosCount}][producto_id]" class="form-control product-select" required>
                        <option value="">Selecciona un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" data-precio="{{ $producto->precio_unitario }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="productos[${productosCount}][cantidad]" class="form-control cantidad-input" placeholder="Cantidad" required min="1">
                </div>
                <div class="col-md-3">
                    <label for="total">Total Producto</label>
                    <p class="product-total">Total Producto: <span class="product-total-price">0</span> Bs</p>
                    <input type="hidden" name="productos[${productosCount}][total]" class="total-input">
                </div>
            </div>
        `;
        document.querySelector('#productos-container').appendChild(newProductRow);
        productosCount++;
        updateTotals();
    });
</script>
@endsection
</div>
@endsection
