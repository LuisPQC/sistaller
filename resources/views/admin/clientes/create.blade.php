@extends('adminlte::page')
@section('content_header')
<h1><b>Registro de un nuevo cliente</b></h1>
<hr>
@stop
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Lleno los datos del formulario</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.clientes.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre">Nombre</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre..." required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="telefono">Teléfono</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" name="telefono" class="form-control" placeholder="Numero de contacto..." required>

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Correo Electrónico</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Escriba aqui..." required>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection