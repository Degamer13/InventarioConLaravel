@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Registrar Compra</h1>

    <form action="{{ route('compras.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="producto_id">Producto</label>
            <select name="producto_id" id="producto_id" class="form-control select2" required>
                <option value="">Seleccionar Producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
            @error('producto_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="proveedor_id">Proveedor</label>
            <select name="proveedor_id" id="proveedor_id" class="form-control select2" required>
                <option value="">Seleccionar Proveedor</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
            @error('proveedor_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control select2" required>
                <option value="">Seleccionar Categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            @error('categoria_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="unidad_medida">Unidad de Medida</label>
            <input type="text" name="unidad_medida" id="unidad_medida" class="form-control" required>
            @error('unidad_medida')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" required min="1">
            @error('cantidad')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" required step="0.01" min="0">
            @error('precio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
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
@endsection




