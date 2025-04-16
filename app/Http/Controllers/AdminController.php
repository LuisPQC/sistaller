<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\User;
use App\Models\Cotizacion;
use App\Models\Trabajo;
use App\Models\Factura;
use App\Models\Role;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $mesFiltro = $request->input('mes');
    $anioFiltro = $request->input('anio', now()->year);
    $clienteFiltro = $request->input('cliente_id');

    $meses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];

    $clientesall = Cliente::count();
    $usuarios = User::count();
    $trabajos = Trabajo::count();
    $trabajosPendientes = Trabajo::where('estado', 'pendiente')->count();
    $trabajosProceso = Trabajo::where('estado', 'proceso')->count();
    $trabajosConcluidos = Trabajo::where('estado', 'concluido')->count();
    $totalFacturado = Factura::sum('monto_total');
    $total_roles = Role::count();

    $config = Configuracion::first();

    // Cotizaciones por mes
    $trabajosQuery = Trabajo::whereYear('fecha_inicio', $anioFiltro);
    if ($clienteFiltro) {
        $trabajosQuery->whereHas('cliente', function ($q) use ($clienteFiltro) {
            $q->where('cliente_id', $clienteFiltro);
        });
    }
    if ($mesFiltro) {
        $trabajosQuery->whereMonth('fecha_inicio', $mesFiltro);
    }
    $reporteTrabajos = array_fill(1, 12, 0);
    foreach ($trabajosQuery->get() as $cot) {
        $mes = (int)date('n', strtotime($cot->fecha_inicio));
        $reporteTrabajos[$mes]++;
    }

    // Facturas por mes
    $facturasQuery = Factura::with('trabajo')->whereYear('fecha_emision', $anioFiltro);
    if ($clienteFiltro) {
        $facturasQuery->whereHas('trabajo.cliente', function ($q) use ($clienteFiltro) {
            $q->where('cliente_id', $clienteFiltro);
        });
    }
    if ($mesFiltro) {
        $facturasQuery->whereMonth('fecha_emision', $mesFiltro);
    }
    $reporteFacturas = array_fill(1, 12, 0);
    foreach ($facturasQuery->get() as $factura) {
        $mes = (int)date('n', strtotime($factura->fecha_emision));
        $reporteFacturas[$mes] += $factura->monto_total;
    }

    $clientes = Cliente::all();

    $trabajosPorEstado = Trabajo::when($clienteFiltro, function ($q) use ($clienteFiltro) {
        $q->whereHas('cotizacion.taller', function ($sub) use ($clienteFiltro) {
            $sub->where('cliente_id', $clienteFiltro);
        });
    })
        ->when($anioFiltro, fn($q) => $q->whereYear('created_at', $anioFiltro))
        ->when($mesFiltro, fn($q) => $q->whereMonth('created_at', $mesFiltro))
        ->selectRaw('estado, COUNT(*) as total')
        ->groupBy('estado')
        ->pluck('total', 'estado');

    $trabajosPorUsuario = Trabajo::when($clienteFiltro, function ($q) use ($clienteFiltro) {
        $q->whereHas('cotizacion.cliente', function ($sub) use ($clienteFiltro) {
            $sub->where('cliente_id', $clienteFiltro);
        });
    })
        ->when($anioFiltro, fn($q) => $q->whereYear('created_at', $anioFiltro))
        ->when($mesFiltro, fn($q) => $q->whereMonth('created_at', $mesFiltro))
        ->whereNotNull('usuario_id')
        ->with('usuario')
        ->selectRaw('usuario_id, COUNT(*) as total')
        ->groupBy('usuario_id')
        ->get()
        ->pluck('total', 'usuario.name');

    return view('admin.index', compact(
        'clientesall',
        'usuarios',
        'trabajos',
        'trabajosPendientes',
        'trabajosProceso',
        'trabajosConcluidos',
        'totalFacturado',
        'total_roles',
        'reporteTrabajos',
        'reporteFacturas',
        'meses',
        'clientes',
        'trabajosPorEstado',
        'trabajosPorUsuario', 'config'
    ));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
