@extends('adminlte::page')

@section('title', 'Nueva Factura')
@section('content_header')
<h1><b>Registro de una nueva factura</b></h1>
<hr>
@stop
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Lleno los datos del formulario</h3>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('admin.facturas.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="trabajo_id">Trabajo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tools"></i></span>
                            </div>
                            <select name="trabajo_id" class="form-control" required>
                                <option value="">Seleccione un trabajo</option>
                                @foreach($trabajos as $trabajo)
                                <option value="{{ $trabajo->id }}">
                                    #{{ $trabajo->id }} - {{ $trabajo->vehiculo->marca }} {{ $trabajo->vehiculo->modelo }} ({{ $trabajo->vehiculo->placas }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="monto_total">Monto Total</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                            </div>
                            <input type="number" name="monto_total" class="form-control" placeholder="anote aqui..." required step="0.01" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="estado_pago">Estado de Pago</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <select name="estado_pago" class="form-control" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="pagado">Pagado</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_emision">Fecha de Emisión</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" name="fecha_emision" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('admin.facturas.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection