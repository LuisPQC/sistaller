@extends('adminlte::page')
@section('title', 'Clientes')
@section('content_header')
<h1><b>Listado de Clientes </b></h1>
<hr>
@stop
@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Clientes registrados</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary mb-3">+ Nuevo Cliente</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="mitabla" class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1; ?>
                        @foreach($clientes as $cliente)
                        <tr>
                            <td style="text-align: center">{{$contador++}}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->telefono ?? '-' }}</td>
                            <td>{{ $cliente->email ?? '-' }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.clientes.edit', $cliente) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('admin.clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este cliente?')">
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
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
            "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
            "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Clientes",
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