@extends('adminlte::page')

@section('title', 'Factura #'.$factura->id)

@section('content')
<div class="container">
    <h1>Factura #{{ $factura->id }}</h1>

    <p><strong>Trabajo:</strong> #{{ $factura->trabajo->id }}</p>
    <p><strong>Vehículo:</strong> {{ $factura->trabajo->vehiculo->marca }} {{ $factura->trabajo->vehiculo->modelo }}</p>
    <p><strong>Cliente:</strong> {{ $factura->trabajo->vehiculo->cliente->nombre }}</p>
    <p><strong>Monto Total:</strong> ${{ number_format($factura->monto_total, 2) }}</p>
    <p><strong>Estado de Pago:</strong> {{ ucfirst($factura->estado_pago) }}</p>
    <p><strong>Fecha Emisión:</strong> {{ $factura->fecha_emision }}</p>

    <a href="{{ route('admin.facturas.pdf', $factura->id) }}" target="_blank" class="btn btn-outline-primary">
        <i class="fas fa-file-pdf"></i> Exportar PDF
    </a>

    <a href="{{ route('admin.facturas.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
