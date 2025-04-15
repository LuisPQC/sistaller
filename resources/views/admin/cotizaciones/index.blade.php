@extends('adminlte::page')
@section('title', 'Cotizaciones')
@section('content_header')
<h1><b>Listado de Cotizaciones </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Cotizaciones registradas</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.cotizaciones.create') }}" class="btn btn-primary mb-3">+ Nueva Cotizacion</a>
                </div>
            </div>
            <div class="card-body table-responsive">
    <table id="mitabla" class="table table-striped table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Cliente</th>
                <th>Vehículo</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php $contador = 1; ?>
            @foreach($cotizaciones as $cotizacion)
                <tr>
                <td style="text-align: center">{{$contador++}}</td>
                    <td>{{ $cotizacion->cliente->nombre }}</td>
                    <td>{{ $cotizacion->vehiculo->marca }} {{ $cotizacion->vehiculo->modelo }}</td>
                    <td> {{$configuracion->moneda}} {{ number_format($cotizacion->total_estimado, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $cotizacion->estado == 'aceptada' ? 'success' : ($cotizacion->estado == 'rechazada' ? 'danger' : 'secondary') }}">
                            {{ ucfirst($cotizacion->estado) }}
                        </span>
                    </td>
                    <td>{{ $cotizacion->fecha_cotizacion }}</td>
                    <td style="text-align: center;">
                        <!--<a href="{{ route('admin.cotizaciones.edit', $cotizacion) }}" class="btn btn-sm btn-warning">Editar</a>-->
                        <form action="{{ route('admin.cotizaciones.destroy', $cotizacion) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta cotización?')">
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
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Cotizaciones",
            "infoEmpty": "Mostrando 0 a 0 de 0 Cotizaciones",
            "infoFiltered": "(Filtrado de _MAX_ total Cotizaciones)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Cotizaciones",
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