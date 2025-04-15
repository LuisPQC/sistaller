<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Trabajo #{{ $trabajo->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            color: #333;
        }

        .logo {
            width: 150px;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .datos,
        .resumen {
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 6px;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path($config->logo) }}" alt="Logo Taller" class="logo"><br>
        <strong>{{ $config->nombre }}</strong><br>
        {{ $config->direccion }} - Tel: {{ $config->telefono }}<br>
        <small>{{ $config->web }}</small><br>
        {{ date('d/m/Y') }}
    </div>

    <h2 style="text-align: center;">Reporte de Trabajo #{{ $trabajo->id }}</h2>

    <div class="datos">
        <strong>Cliente:</strong> {{ $trabajo->vehiculo->cliente->nombre }}<br>
        <strong>Vehículo:</strong> {{ $trabajo->vehiculo->marca }} {{ $trabajo->vehiculo->modelo }} ({{ $trabajo->vehiculo->placas }})<br>
        <strong>Técnico:</strong> {{ $trabajo->tecnico->name ?? 'Sin asignar' }}<br>
        <strong>Estado:</strong> {{ ucfirst($trabajo->estado) }} | Avance: {{ $trabajo->porcentaje_avance }}%<br>
        <strong>Inicio:</strong> {{ $trabajo->fecha_inicio }} | <strong>Fin:</strong> {{ $trabajo->fecha_fin }}
    </div>

    <div class="resumen">
        <strong>Descripción:</strong><br>
        {{ $trabajo->descripcion }}
    </div>

    @if($trabajo->archivos->count())
    <h4>Archivos relacionados</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Archivo</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Tipo de Golpe</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trabajo->archivos as $archivo)
            <tr>
                <td>
                    @if($archivo->tipo_archivo === 'imagen')
                    <img src="{{ public_path('storage/' . $archivo->ruta_archivo) }}" width="100" height="75">
                    @else
                    {{ basename($archivo->ruta_archivo) }}
                    @endif
                </td>

                <td>{{ ucfirst($archivo->tipo_archivo) }}</td>
                <td>{{ $archivo->descripcion ?? '-' }}</td>
                <td>{{ $archivo->tipo_de_golpe ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="footer">
        <p>Gracias por confiar en {{ $config->nombre }}</p>
    </div>

</body>

</html>