@extends('adminlte::page')

@section('title', 'Detalle del Trabajo')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalle del Trabajo</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Vehículo:</strong> {{ $trabajo->vehiculo->marca }} {{ $trabajo->vehiculo->modelo }} ({{ $trabajo->vehiculo->placas }})</p>
            <p><strong>Técnico:</strong> {{ $trabajo->tecnico->name ?? 'Sin asignar' }}</p>
            <p><strong>Descripción:</strong> {{ $trabajo->descripcion }}</p>
            <p><strong>Estado:</strong> <span class="badge bg-info">{{ ucfirst($trabajo->estado) }}</span></p>
            <p><strong>Avance:</strong> {{ $trabajo->porcentaje_avance }}%</p>
            <p><strong>Inicio:</strong> {{ $trabajo->fecha_inicio }}</p>
            <p><strong>Fin:</strong> {{ $trabajo->fecha_fin }}</p>
            <p><strong>Total Factura:</strong> ${{ number_format($trabajo->total_factura, 2) }}</p>
        </div>
    </div>

    <h4>Galería de Archivos</h4>

    <div class="row">
        @foreach($trabajo->archivos as $archivo)
            <div class="col-md-3 mb-4">
                <div class="card">
                    @if($archivo->tipo_archivo === 'imagen')
                        <img src="{{ asset('storage/' . $archivo->ruta_archivo) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @elseif($archivo->tipo_archivo === 'video')
                        <video controls style="width: 100%; height: 200px; object-fit: cover;">
                            <source src="{{ asset('storage/' . $archivo->ruta_archivo) }}" type="video/mp4">
                            Tu navegador no soporta videos.
                        </video>
                    @else
                        <div class="p-3">
                            <p class="mb-1"><strong>Documento</strong></p>
                            <a href="{{ asset('storage/' . $archivo->ruta_archivo) }}" target="_blank">Ver archivo</a>
                        </div>
                    @endif
                    <div class="card-body p-2">
                        <small class="text-muted">{{ $archivo->tipo_de_golpe ?? 'Sin tipo de golpe' }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- <a href="{{ route('admin.archivos.edit', $archivo->id) }}" class="btn btn-sm btn-outline-primary mt-1">
    Editar</a>-->
    <a href="{{ route('admin.trabajos.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('admin.trabajos.pdf', $trabajo->id) }}" target="_blank" class="btn btn-outline-primary">
    <i class="fas fa-file-pdf"></i> Exportar PDF
</a>

</div>
@endsection
