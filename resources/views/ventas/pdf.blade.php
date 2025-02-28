<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #{{ $venta->id }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            width: 210mm; /* Ancho del papel A4 */
            max-width: 100%;
            margin: 0 auto;
        }

        .ticket {
            width: 300px; /* Ancho para un formato tipo ticket */
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #000;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            font-size: 16px;
            margin: 0;
        }

        .header {
            text-align: center;
            font-size: 14px;
        }

        .header p {
            margin: 2px 0;
        }

        .section-title {
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .table {
            width: 100%;
            margin-top: 10px;
            font-size: 12px;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 5px;
            border: 1px solid #000;
            text-align: left;
        }

        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
        }

        .footer p {
            margin: 2px 0;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <h3>Factura</h3>
            <p>RIF: J-504935760</p>
            <p>Centro hípico tasca restaurante y pool Black Sweet C.A</p>
            <p>Dirección: Av. Libertador local nro 10 barrio Angostura parroquia Vista Hermosa municipio Angostura del Orinoco Ciudad Bolívar Bolivar zona postal 8001</p>
            <p>Tel: 0212-1234567</p>
        </div>

        <div>
            <p class="section-title">Venta #: {{ $venta->id }}</p>
            <p>Fecha: {{ $venta->created_at->format('d/m/Y H:i:s') }}</p>
            <p>Cliente: {{ $venta->cliente->nombre }}</p>
        </div>

        <div>
            <p class="section-title">Productos:</p>
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
                            <td>{{ number_format($producto->pivot->total, 2) }} $</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total">
            <p><strong>Total en Dólares:</strong> ${{ number_format($venta->total_dolares, 2) }}</p>
            <p><strong>Total en Bolívares:</strong> Bs. {{ number_format($venta->total_bolivares, 2) }}</p>
        </div>

        <div class="footer">
            <p>Gracias por tu compra!</p>
            <p>Visítanos nuevamente.</p>
        </div>
    </div>
</body>
</html>
