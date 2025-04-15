@extends('adminlte::page')
@section('title', 'Facturas')
@section('content_header')
<h1><b>Listado de Facturas </b></h1>
<hr>
@stop
@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Facturas registradas</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.facturas.create') }}" class="btn btn-primary mb-3">+ Nueva Factura</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="mitabla" class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Trabajo</th>
                            <th>Vehículo</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Emisión</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1; ?>
                        @foreach($facturas as $factura)
                        <tr>
                            <td style="text-align: center">{{$contador++}}</td>
                            <td>#{{ $factura->trabajo_id }}</td>
                            <td>{{ $factura->trabajo->vehiculo->marca }} {{ $factura->trabajo->vehiculo->modelo }}</td>
                            <td> {{$configuracion->moneda}} {{ number_format($factura->monto_total, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $factura->estado_pago == 'pagado' ? 'success' : 'warning' }}">
                                    {{ ucfirst($factura->estado_pago) }}
                                </span>
                            </td>
                            <td>{{ $factura->fecha_emision }}</td>
                            <td style="text-align: centers;">
                                <a href="{{ route('admin.facturas.show', $factura->id) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('admin.facturas.edit', $factura->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('admin.facturas.destroy', $factura->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta factura?')">
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
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Facturas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Facturas",
            "infoFiltered": "(Filtrado de _MAX_ total Facturas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Facturas",
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