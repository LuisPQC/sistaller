@extends('adminlte::page')
@section('title', 'Vehículos')
@section('content_header')
<h1><b>Listado de Vehiculos </b></h1>
<hr>
@stop
@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Vehículos registrados</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.vehiculos.create') }}" class="btn btn-primary mb-3">+ Nuevo Vehiculo</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="mitabla" class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Cliente</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Año</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1;?>
                        @foreach($vehiculos as $vehiculo)
                        <tr>
                        <td style="text-align: center">{{$contador++}}</td>
                            <td>{{ $vehiculo->cliente->nombre }}</td>
                            <td>{{ $vehiculo->marca }}</td>
                            <td>{{ $vehiculo->modelo }}</td>
                            <td>{{ $vehiculo->placas ?? '-' }}</td>
                            <td>{{ $vehiculo->anio ?? '-' }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.vehiculos.edit', $vehiculo->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('admin.vehiculos.destroy', $vehiculo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este vehículo?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $('#mitabla').DataTable({
        "pageLength": 5,
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Vehiculo",
            "infoEmpty": "Mostrando 0 a 0 de 0 Vehiculo",
            "infoFiltered": "(Filtrado de _MAX_ total Vehiculo)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Vehiculo",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscador:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });
</script>
@stop