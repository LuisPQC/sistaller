@extends('adminlte::page')

@section('title', 'Editar Trabajo')

@section('content')
<div class="container">
    <h1>Editar Trabajo</h1>

    <form action="{{ route('admin.trabajos.update', $trabajo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="vehiculo_id">Vehículo</label>
            <select name="vehiculo_id" class="form-control" required>
                @foreach($vehiculos as $vehiculo)
                <option value="{{ $vehiculo->id }}" {{ $trabajo->vehiculo_id == $vehiculo->id ? 'selected' : '' }}>
                    {{ $vehiculo->marca }} {{ $vehiculo->modelo }} - {{ $vehiculo->placas }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="usuario_id">Técnico</label>
            <select name="usuario_id" class="form-control">
                <option value="">Sin asignar</option>
                @foreach($tecnicos as $tecnico)
                <option value="{{ $tecnico->id }}" {{ $trabajo->usuario_id == $tecnico->id ? 'selected' : '' }}>
                    {{ $tecnico->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" required>{{ old('descripcion', $trabajo->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fecha_inicio">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ $trabajo->fecha_inicio }}">
        </div>

        <div class="mb-3">
            <label for="fecha_fin">Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control" value="{{ $trabajo->fecha_fin }}">
        </div>

        <div class="mb-3">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control">
                <option value="pendiente" {{ $trabajo->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="proceso" {{ $trabajo->estado == 'proceso' ? 'selected' : '' }}>En Proceso</option>
                <option value="concluido" {{ $trabajo->estado == 'concluido' ? 'selected' : '' }}>Concluido</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="porcentaje_avance">Avance (%)</label>
            <input type="number" name="porcentaje_avance" class="form-control" value="{{ $trabajo->porcentaje_avance }}">
        </div>

        <div class="mb-3">
            <label for="total_factura">Total Factura</label>
            <input type="number" name="total_factura" class="form-control" step="0.01" value="{{ $trabajo->total_factura }}">
        </div>

        <div class="mb-3">
            <label for="archivos[]">Agregar Archivos Nuevos</label>
            <div id="contenedor-archivos">
                <input type="file" id="input-archivos" name="archivos[]" class="form-control" multiple>
            </div>
            <div id="vista-previa"></div>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.trabajos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    @push('js')
<script>
document.getElementById('input-archivos').addEventListener('change', function (e) {
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