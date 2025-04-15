@extends('adminlte::page')

@section('title', 'Editar Archivo')

@section('content')
<div class="container">
    <h1>Editar Archivo</h1>

    <form action="{{ route('admin.archivos.update', $archivo->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Archivo:</label><br>
            @if($archivo->tipo_archivo === 'imagen')
                <img src="{{ asset('storage/' . $archivo->ruta_archivo) }}" width="150">
            @else
                <a href="{{ asset('storage/' . $archivo->ruta_archivo) }}" target="_blank">Ver archivo</a>
            @endif
        </div>

        <div class="mb-3">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion', $archivo->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tipo_de_golpe">Tipo de golpe</label>
            <input type="text" name="tipo_de_golpe" class="form-control" value="{{ old('tipo_de_golpe', $archivo->tipo_de_golpe) }}">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.trabajos.show', $archivo->trabajo_id) }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
