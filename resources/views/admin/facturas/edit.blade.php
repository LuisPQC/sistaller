@extends('adminlte::page')

@section('title', 'Editar Factura')

@section('content')
<div class="container">
    <h1>Editar Factura</h1>

    <form action="{{ route('admin.facturas.update', $factura->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="trabajo_id">Trabajo</label>
            <select name="trabajo_id" class="form-control" required>
                @foreach($trabajos as $trabajo)
                    <option value="{{ $trabajo->id }}" {{ $factura->trabajo_id == $trabajo->id ? 'selected' : '' }}>
                        #{{ $trabajo->id }} - {{ $trabajo->vehiculo->marca }} {{ $trabajo->vehiculo->modelo }} ({{ $trabajo->vehiculo->placas }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="monto_total">Monto Total</label>
            <input type="number" name="monto_total" class="form-control" value="{{ $factura->monto_total }}" required step="0.01">
        </div>

        <div class="mb-3">
            <label for="estado_pago">Estado de Pago</label>
            <select name="estado_pago" class="form-control" required>
                <option value="pendiente" {{ $factura->estado_pago == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="pagado" {{ $factura->estado_pago == 'pagado' ? 'selected' : '' }}>Pagado</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_emision">Fecha de Emisión</label>
            <input type="date" name="fecha_emision" class="form-control" value="{{ $factura->fecha_emision }}" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.facturas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
