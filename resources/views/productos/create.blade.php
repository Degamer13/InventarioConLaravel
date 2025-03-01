@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')

@section('content')
    <div class="container">  
    <h3>Registrar Producto</h3>
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" required>
        </div>

        <!-- Select con Select2 para Categoría (Estilo Mejorado) -->
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <div class="input-group">
                
                <select name="categoria_id" class="form-control select2" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="number" name="precio_unitario" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="precio_caja" class="form-label">Precio al Mayor</label>
            <input type="number" name="precio_caja" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="unidad_de_medida" class="form-label">Descripción</label>
            <input type="text" name="unidad_de_medida" class="form-control" required>
        </div>

        <!-- Cantidad por Unidad y Multiplicador -->
        <div class="mb-3">
            <label for="cantidad_por_unidad" class="form-label">Cantidad por Unidad</label>
            <input type="number" id="cantidad_por_unidad" name="cantidad_por_unidad" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="multiplicador" class="form-label">Multiplicador</label>
            <input type="number" id="multiplicador" class="form-control" placeholder="Ingrese el valor a multiplicar" required>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" readonly>
        </div>

        <!-- Select con Select2 para Proveedor (Estilo Mejorado) -->
        <div class="mb-3">
            <label for="proveedor_id" class="form-label">Proveedor</label>
            <div class="input-group">
               
                <select name="proveedor_id" class="form-control select2" required>
                    <option value="">Seleccione un proveedor</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">
                            {{ $proveedor->nombre }} - {{ $proveedor->cedula }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

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
        $(document).ready(function() {
          
            
            // Lógica para calcular la cantidad automáticamente
            $('#cantidad_por_unidad, #multiplicador').on('input', function() {
                let cantidadPorUnidad = parseFloat($('#cantidad_por_unidad').val()) || 0;
                let multiplicador = parseFloat($('#multiplicador').val()) || 0;
                $('#cantidad').val(cantidadPorUnidad * multiplicador);
            });
        });
    </script>

@endsection
