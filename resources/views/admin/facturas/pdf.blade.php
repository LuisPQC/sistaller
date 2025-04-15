<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #{{ $factura->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 13px; color: #333; }
        .logo { width: 150px; }
        .header, .footer { text-align: center; margin-bottom: 20px; }
        .datos, .resumen { margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #ccc; padding: 6px; }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path($config->logo) }}" class="logo"><br>
        <strong>{{$config->nombre}}</strong> - {{$config->descripcion}}<br>
        {{$config->direccion}} - {{$config->telefono}}<br>
        {{ date('d/m/Y') }}
    </div>

    <h2 style="text-align: center;">Factura #{{ $factura->id }}</h2>

    <div class="datos">
        <strong>Cliente:</strong> {{ $factura->trabajo->vehiculo->cliente->nombre }}<br>
        <strong>Vehículo:</strong> {{ $factura->trabajo->vehiculo->marca }} {{ $factura->trabajo->vehiculo->modelo }} ({{ $factura->trabajo->vehiculo->placas }})<br>
        <strong>Fecha de Emisión:</strong> {{ $factura->fecha_emision }}
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Descripción del Trabajo</th>
                <th>Estado</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $factura->trabajo->descripcion }}</td>
                <td>{{ ucfirst($factura->estado_pago) }}</td>
                <td> {{$config->moneda}} {{ number_format($factura->monto_total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Gracias por confiar en nosotros</p>
    </div>

</body>
</html>
