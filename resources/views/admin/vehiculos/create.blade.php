@extends('adminlte::page')

@section('title', 'Registrar Vehículo')
@section('content_header')
<h1><b>Registro de un nuevo vehiculo</b></h1>
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
                <form action="{{ route('admin.vehiculos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="cliente_id">Cliente</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                            </div>
                            <select name="cliente_id" class="form-control" required>
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="marca">Marca</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-car"></i></span>
                            </div>
                            <input type="text" name="marca" class="form-control" placeholder="Escriba aqui..." required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="modelo">Modelo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                            </div>
                            <input type="text" name="modelo" class="form-control" placeholder="Escriba aqui..." required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="placas">Placas</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-car"></i></span>
                            </div>
                            <input type="text" name="placas" class="form-control" placeholder="Escriba aqui..." required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="anio">Año</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            </div>
                            <input type="number" name="anio" class="form-control" placeholder="Anota aqui..." min="1900" max="{{ date('Y') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('admin.vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection