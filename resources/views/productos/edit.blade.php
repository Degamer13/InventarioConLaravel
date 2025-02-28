@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')

@section('content')
    <div class="container">  

    <h3>Editar Producto</h3>
    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required value="{{ old('nombre', $producto->nombre) }}">
        </div>
        
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" required value="{{ old('ubicacion', $producto->ubicacion) }}">
        </div>

        <!-- Select con Select2 para Categoría (Estilo Mejorado) -->
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <div class="input-group">
                <select name="categoria_id" class="form-control select2" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" class="form-control" required value="{{ old('marca', $producto->marca) }}">
        </div>

        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="number" name="precio_unitario" class="form-control" step="0.01" required value="{{ old('precio_unitario', $producto->precio_unitario) }}">
        </div>

        <div class="mb-3">
            <label for="precio_caja" class="form-label">Precio Caja</label>
            <input type="number" name="precio_caja" class="form-control" step="0.01" required value="{{ old('precio_caja', $producto->precio_caja) }}">
        </div>

        <div class="mb-3">
            <label for="unidad_de_medida" class="form-label">Unidad de Medida</label>
            <input type="text" name="unidad_de_medida" class="form-control" required value="{{ old('unidad_de_medida', $producto->unidad_de_medida) }}">
        </div>

        <!-- Cantidad por Unidad y Multiplicador -->
        <div class="mb-3">
            <label for="cantidad_por_unidad" class="form-label">Cantidad por Unidad</label>
            <input type="number" id="cantidad_por_unidad" name="cantidad_por_unidad" class="form-control" required value="{{ old('cantidad_por_unidad', $producto->cantidad_por_unidad) }}">
        </div>

        <div class="mb-3">
            <label for="multiplicador" class="form-label">Multiplicador</label>
            <input type="number" id="multiplicador" class="form-control" placeholder="Ingrese el valor a multiplicar" required value="{{ old('multiplicador', $producto->multiplicador ?? 1) }}">
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" readonly value="{{ old('cantidad', $producto->cantidad) }}">
        </div>

        <!-- Select con Select2 para Proveedor (Estilo Mejorado) -->
        <div class="mb-3">
            <label for="proveedor_id" class="form-label">Proveedor</label>
            <div class="input-group">
                <select name="proveedor_id" class="form-control select2" required>
                    <option value="">Seleccione un proveedor</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" {{ $producto->proveedor_id == $proveedor->id ? 'selected' : '' }}>
                            {{ $proveedor->nombre }} - {{ $proveedor->cedula }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

<!-- Estilos y Scripts de Select2 -->
@section('css')
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Seleccione una opción",
                allowClear: true,
                width: '100%'
            });
            
            // Lógica para calcular la cantidad automáticamente
            $('#cantidad_por_unidad, #multiplicador').on('input', function() {
                let cantidadPorUnidad = parseFloat($('#cantidad_por_unidad').val()) || 0;
                let multiplicador = parseFloat($('#multiplicador').val()) || 0;
                $('#cantidad').val(cantidadPorUnidad * multiplicador);
            });
        });
    </script>
@endsection
