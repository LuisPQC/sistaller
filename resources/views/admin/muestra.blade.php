<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Trabajo</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 40px 0;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h4 {
            text-align: center;
            color: #0d6efd;
        }
        .detalle p {
            margin: 10px 0;
            font-size: 16px;
        }
        .detalle i {
            color: #6c757d;
            margin-right: 6px;
        }
        .badge {
            padding: 5px 10px;
            background-color: #0dcaf0;
            color: white;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .galeria {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
            width: 200px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }
        .card img, .card video {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card .desc {
            padding: 8px;
            font-size: 13px;
            color: #555;
            text-align: center;
        }
        .acciones {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            text-decoration: none;
            font-size: 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-volver {
            background-color: #6c757d;
            color: white;
        }
        .btn-pdf {
            background-color: #dc3545;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-tools"></i> Detalle del Trabajo # <span>{{ $trabajo->id }}</span></h1>

        <div class="detalle">
            <p><strong><i class="fas fa-car"></i>Vehículo:</strong> {{ $trabajo->vehiculo->marca }} {{ $trabajo->vehiculo->modelo }} ({{ $trabajo->vehiculo->placas }})</p>
            <p><strong><i class="fas fa-user-cog"></i>Técnico:</strong> {{ $trabajo->tecnico->name ?? 'Sin asignar' }}</p>
            <p><strong><i class="fas fa-align-left"></i>Descripción:</strong> {{ $trabajo->descripcion }}</p>
            <p><strong><i class="fas fa-signal"></i>Estado:</strong> <span class="badge">{{ ucfirst($trabajo->estado) }}</span></p>
            <p><strong><i class="fas fa-percent"></i>Avance:</strong> {{ $trabajo->porcentaje_avance }}%</p>
            <p><strong><i class="fas fa-hourglass-start"></i>Inicio:</strong> {{ $trabajo->fecha_inicio }}</p>
            <p><strong><i class="fas fa-hourglass-end"></i>Fin:</strong> {{ $trabajo->fecha_fin }}</p>
            <p><strong><i class="fas fa-dollar-sign"></i>Total Factura:</strong> ${{ number_format($trabajo->total_factura, 2) }}</p>
        </div>

        <h4><i class="fas fa-images"></i> Galería de Archivos</h4>

        <div class="galeria">
            @foreach($trabajo->archivos as $archivo)
                <div class="card">
                    @if($archivo->tipo_archivo === 'imagen')
                        <img src="{{ asset('storage/' . $archivo->ruta_archivo) }}" alt="Imagen">
                    @elseif($archivo->tipo_archivo === 'video')
                        <video controls>
                            <source src="{{ asset('storage/' . $archivo->ruta_archivo) }}" type="video/mp4">
                            Tu navegador no soporta video.
                        </video>
                    @else
                        <div class="desc">
                            <i class="fas fa-file-alt fa-2x text-muted"></i><br>
                            <a href="{{ asset('storage/' . $archivo->ruta_archivo) }}" target="_blank">Ver documento</a>
                        </div>
                    @endif
                    <div class="desc">{{ $archivo->tipo_de_golpe ?? 'Sin tipo de golpe' }}</div>
                </div>
            @endforeach
        </div>

        <div class="acciones">
            <a href="{{ url('/') }}" class="btn btn-volver"><i class="fas fa-arrow-left"></i> Volver</a>
            <a href="{{ route('admin.trabajos.pdf', $trabajo->id) }}" target="_blank" class="btn btn-pdf"><i class="fas fa-file-pdf"></i> Exportar PDF</a>
        </div>
    </div>
</body>
</html>
