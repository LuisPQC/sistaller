@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Cliente</h1>

    <form action="{{ route('admin.clientes.update', $cliente) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $cliente->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $cliente->telefono) }}">
        </div>

        <div class="mb-3">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $cliente->email) }}">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
