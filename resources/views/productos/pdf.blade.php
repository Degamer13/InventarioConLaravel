<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código de Barras - Producto</title>
</head>
<body>
    <h2>Producto: {{ $producto->nombre }}</h2>
    <p><strong>Ubicación:</strong> {{ $producto->ubicacion }}</p>
    <p><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
    <p><strong>Marca:</strong> {{ $producto->marca }}</p>
    <p><strong>Precio Unitario:</strong> ${{ $producto->precio_unitario }}</p>
    <p><strong>Código de Barras:</strong></p>
    <img src="{{ $barcodeDataUrl }}" alt="Código de Barras"> <!-- Aquí incrustamos el código de barras en formato base64 -->

    <footer>
        <p>Generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
    </footer>
</body>
</html>
