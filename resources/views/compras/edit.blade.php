@extends('layouts.admin')

@section('content')

    <h3>Editar Compra</h3>

    <!-- Formulario para editar la compra -->
    <form action="{{ route('compras.update', $compra->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Selección de Producto -->
        <div class="form-group">
            <label for="producto_id">Producto</label>
            <select name="producto_id" id="producto_id" class="form-control select2" required>
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ $producto->id == $compra->producto_id ? 'selected' : '' }}>
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Selección de Proveedor -->
        <div class="form-group">
            <label for="proveedor_id">Proveedor</label>
            <select name="proveedor_id" id="proveedor_id" class="form-control select2" required>
                <option value="">Seleccione un proveedor</option>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" {{ $proveedor->id == $compra->proveedor_id ? 'selected' : '' }}>
                        {{ $proveedor->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Selección de Categoría -->
        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control select2" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $categoria->id == $compra->categoria_id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Unidad de Medida -->
        <div class="form-group">
            <label for="unidad_medida">Unidad de Medida</label>
            <input type="text" name="unidad_medida" id="unidad_medida" class="form-control" value="{{ $compra->unidad_medida }}" required>
        </div>

        <!-- Cantidad -->
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $compra->cantidad }}" required>
        </div>

        <!-- Precio -->
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="{{ $compra->precio }}" required>
        </div>

       

        <!-- Botón de Actualizar -->
        <button type="submit" class="btn btn-success mt-3">Actualizar Compra</button>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>

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
@endsection
