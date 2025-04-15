@extends('adminlte::page')

@section('title', 'Registrar Trabajo')
@section('content_header')
<h1><b>Registro de un nuevo trabajo</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Lleno los datos del formulario</h3>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('admin.trabajos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="vehiculo_id">Vehículo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-car"></i></span>
                                </div>
                                <select name="vehiculo_id" class="form-control" required>
                                    <option value="">Seleccione un vehículo</option>
                                    @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->placas }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="usuario_id">Técnico</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                </div>
                                <select name="usuario_id" class="form-control" required>
                                    <option value="">Sin asignar</option>
                                    @foreach($tecnicos as $tecnico)
                                    <option value="{{ $tecnico->id }}">{{ $tecnico->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="descripcion">Descripción</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-comments"></i></span>
                            </div>
                            <textarea name="descripcion" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="fecha_inicio">Fecha Inicio</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hourglass-start"></i></span>
                                </div>
                                <input type="date" name="fecha_inicio" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="fecha_fin">Fecha Fin</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hourglass-end"></i></span>
                                </div>
                                <input type="date" name="fecha_fin" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="estado">Estado</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                </div>
                                <select name="estado" class="form-control">
                                    <option value="pendiente">Pendiente</option>
                                    <option value="proceso">En Proceso</option>
                                    <option value="concluido">Concluido</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="porcentaje_avance">Avance (%)</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-exclamation-triangle"></i></span>
                                </div>
                                <input type="number" placeholder="Escriba en un rango de 0 a 100" name="porcentaje_avance" class="form-control" min="0" max="100" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="total_factura">Total a Facturar</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                </div>
                                <input type="number" name="total_factura" class="form-control" placeholder="Anota aqui..." step="0.01">
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="archivos[]">Archivos (fotos, videos, documentos)</label>
                        <div id="contenedor-archivos">
                            <input type="file" id="input-archivos" name="archivos[]" class="form-control" multiple>
                        </div>
                        <div id="vista-previa"></div>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar Trabajo</button>
                    <a href="{{ route('admin.trabajos.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@push('js')
<script>
    document.getElementById('input-archivos').addEventListener('change', function(e) {
        const container = document.getElementById('vista-previa');
        container.innerHTML = '';

        for (let i = 0; i < e.target.files.length; i++) {
            const archivo = e.target.files[i];

            const div = document.createElement('div');
            div.classList.add('mb-2');

            div.innerHTML = `
            <strong>${archivo.name}</strong>
            <input type="text" name="tipos_golpe[]" class="form-control mt-1" placeholder="Tipo de golpe para este archivo">
        `;

            container.appendChild(div);
        }
    });
</script>
@endpush

</div>
@endsection