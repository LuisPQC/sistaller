@extends('adminlte::page')
@section('title', 'Trabajos')
@section('content_header')
<h1><b>Listado de Trabajos </b></h1>
<hr>
@stop
@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Trabajos registrados</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.trabajos.create') }}" class="btn btn-primary mb-3">+ Nuevo Trabajo</a>
                </div>
            </div>
            <div class="card-body table-responsive">
    <table id="mitabla" class="table table-striped table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Vehículo</th>
                <th>Técnico</th>
                <th>Estado</th>
                <th>Avance</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Codigo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php $contador = 1; ?>
            @foreach($trabajos as $trabajo)
                <tr>
                <td style="text-align: center">{{$contador++}}</td>
                    <td>{{ $trabajo->vehiculo->marca }} {{ $trabajo->vehiculo->modelo }}</td>
                    <td>{{ $trabajo->tecnico->name ?? 'Sin asignar' }}</td>
                    <td>
                        <span class="badge bg-{{ $trabajo->estado == 'concluido' ? 'success' : ($trabajo->estado == 'proceso' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($trabajo->estado) }}
                        </span>
                    </td>
                    <td>{{ $trabajo->porcentaje_avance }}%</td>
                    <td>{{ $trabajo->fecha_inicio }}</td>
                    <td>{{ $trabajo->fecha_fin }}</td>
                    <td>{{ $trabajo->cod_seguimiento }}</td>
                    <td style="text-align: center;">
                        <a href="{{ route('admin.trabajos.show', $trabajo->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('admin.trabajos.edit', $trabajo->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('admin.trabajos.destroy', $trabajo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este trabajo?')">
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
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Trabajos",
            "infoEmpty": "Mostrando 0 a 0 de 0 Trabajos",
            "infoFiltered": "(Filtrado de _MAX_ total Trabajos)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Trabajos",
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