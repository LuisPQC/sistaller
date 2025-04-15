@extends('adminlte::page')

@section('title', 'Editar Vehículo')

@section('content')
<div class="container">
    <h1>Editar Vehículo</h1>

    <form action="{{ route('admin.vehiculos.update', $vehiculo->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="cliente_id">Cliente</label>
            <select name="cliente_id" class="form-control" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $vehiculo->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="marca">Marca</label>
            <input type="text" name="marca" class="form-control" value="{{ old('marca', $vehiculo->marca) }}" required>
        </div>

        <div class="mb-3">
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $vehiculo->modelo) }}" required>
        </div>

        <div class="mb-3">
            <label for="placas">Placas</label>
            <input type="text" name="placas" class="form-control" value="{{ old('placas', $vehiculo->placas) }}">
        </div>

        <div class="mb-3">
            <label for="anio">Año</label>
            <input type="number" name="anio" class="form-control" value="{{ old('anio', $vehiculo->anio) }}" min="1900" max="{{ date('Y') }}">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
