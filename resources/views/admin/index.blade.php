@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Bienvenido al sistema:</b> {{ Auth::user()->name }}</h1>
    <hr>
@stop

@section('content')
<div class="row">

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP">
            <a href="{{ url('/admin/roles') }}">
                <img src="{{ url('/img/roles.gif') }}" alt="Roles" width="50">
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Roles registrados</span>
                <span class="info-box-number">{{ $total_roles }} roles</span>
            </div>
        </div>
    </div>

    {{-- Clientes --}}
    <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box zoomP">
            <a href="{{ url('/admin/clientes') }}">
                <img src="{{ url('/img/cliente.gif') }}" alt="Clientes" width="50">
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Clientes registrados</span>
                <span class="info-box-number">{{ $clientesall }} clientes</span>
            </div>
        </div>
    </div>

    {{-- Usuarios --}}
    <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box zoomP">
            <a href="{{ url('/admin/usuarios') }}">
                <img src="{{ url('/img/usuario.gif') }}" alt="Usuario" width="50">
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Usuarios registrados</span>
                <span class="info-box-number">{{ $usuarios }} usuarios</span>
            </div>
        </div>
    </div>

    {{-- Trabajos --}}
    <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box zoomP">
            <a href="{{ url('/admin/trabajos') }}">
                <img src="{{ url('/img/controlar.gif') }}" alt="Trabajos" width="50">
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Trabajos registrados</span>
                <span class="info-box-number">{{ $trabajos }} trabajos</span>
            </div>
        </div>
    </div>

    

</div>

{{-- Trabajos por estado --}}
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box zoomP">
                <img src="{{ url('/img/advertencia.gif') }}" alt="Factura" width="50">
            <div class="info-box-content">
                <span class="info-box-text">Trabajos Pendientes</span>
                <span class="info-box-number">{{ $trabajosPendientes }} trabajos pendientes</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box zoomP">
                <img src="{{ url('/img/cronografo.gif') }}" alt="Factura" width="50">
            <div class="info-box-content">
                <span class="info-box-text">En proceso</span>
                <span class="info-box-number">{{ $trabajosProceso }} trabajos en proceso</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box zoomP">
                <img src="{{ url('/img/verificado.gif') }}" alt="Factura" width="50">
            <div class="info-box-content">
                <span class="info-box-text">Concluidos</span>
                <span class="info-box-number">{{ $trabajosConcluidos }} trabajos concluidos</span>
            </div>
        </div>
    </div>
    {{-- Total Facturado --}}
    <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box zoomP">
            <a href="{{ url('/admin/facturas') }}">
                <img src="{{ url('/img/computadora-portatil.gif') }}" alt="Factura" width="50">
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Total facturado</span>
                <span class="info-box-number"> {{$config->moneda}} {{ number_format($totalFacturado, 2) }} </span>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <form method="GET" action="{{ route('admin.index') }}" class="form-inline">
            <div class="form-group mr-3">
                <label for="mes">Mes:</label>
                <select name="mes" class="form-control ml-2">
                    <option value="">Todos</option>
                    @foreach($meses as $key => $mes)
                        <option value="{{ $key }}" {{ request('mes') == $key ? 'selected' : '' }}>{{ $mes }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mr-3">
                <label for="anio">Año:</label>
                <select name="anio" class="form-control ml-2">
                    @for($i = now()->year; $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ request('anio') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header card-title">Total de Trabajos por mes</div>
            <div class="card-body">
                <canvas id="graficoTrabajos"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header card-title">Total de Facturas por mes</div>
            <div class="card-body">
                <canvas id="graficoFacturas"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header card-title">Distribución de Trabajos por Estado</div>
            <div  class="card-body">
                <canvas style="max-height: 250px;" id="graficoEstados"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header card-title">Trabajos asignados por Usuario</div>
            <div class="card-body">
                <canvas id="graficoUsuarios"></canvas>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const meses = @json(array_values($meses));
    const datosTrabajos = @json(array_values($reporteTrabajos));
    const datosFacturas = @json(array_values($reporteFacturas));
    const trabajosPorEstado = @json($trabajosPorEstado);
    const trabajosPorUsuario = @json($trabajosPorUsuario);


    new Chart(document.getElementById('graficoTrabajos'), {
        type: 'line',
        data: {
            labels: meses,
            datasets: [{
                label: 'Trabajos por mes',
                data: datosTrabajos,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    new Chart(document.getElementById('graficoFacturas'), {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Facturas por mes',
                data: datosFacturas,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
    new Chart(document.getElementById('graficoEstados'), {
        type: 'pie',
        data: {
            labels: Object.keys(trabajosPorEstado),
            datasets: [{
                label: 'Trabajos por Estado',
                data: Object.values(trabajosPorEstado),
                backgroundColor: ['#f39c12', '#17a2b8', '#28a745'],
            }]
        },
        options: {
            responsive: true
        }
    });

    new Chart(document.getElementById('graficoUsuarios'), {
        type: 'bar',
        data: {
            labels: Object.keys(trabajosPorUsuario),
            datasets: [{
                label: 'Trabajos por Usuario',
                data: Object.values(trabajosPorUsuario),
                backgroundColor: 'rgba(255, 159, 64, 0.6)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@stop
