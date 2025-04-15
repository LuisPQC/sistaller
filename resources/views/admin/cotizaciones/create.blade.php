@extends('adminlte::page')
@section('content_header')
<h1><b>Registro de una nueva cotizacion</b></h1>
<hr>
@stop
@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Lleno los datos del formulario</h3>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('admin.cotizaciones.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="cliente_id">Cliente</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                </div>
                                <select name="cliente_id" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="vehiculo_id">Vehículo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-car"></i></span>
                                </div>
                                <select name="vehiculo_id" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->marca }} {{ $vehiculo->modelo }} - {{ $vehiculo->placas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="descripcion">Descripción</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-comments"></i></span>
                            </div>
                            <textarea name="descripcion" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="total_estimado">Total Estimado</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                </div>
                                <input type="number" step="0.01" name="total_estimado" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="fecha_cotizacion">Fecha Cotización</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                </div>
                                <input type="date" name="fecha_cotizacion" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="archivo_pdf">Archivo PDF (opcional)</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                            </div>
                            <input type="file" name="archivo_pdf" class="form-control" accept="application/pdf">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar Cotización</button>
                    <a href="{{ route('admin.cotizaciones.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection