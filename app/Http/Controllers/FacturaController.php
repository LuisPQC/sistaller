<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Factura;
use App\Models\Trabajo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with('trabajo.vehiculo')->latest()->paginate(10);
        $configuracion = Configuracion::first();

        return view('admin.facturas.index', compact('facturas', 'configuracion'));
    }

    public function create()
    {
        $trabajos = Trabajo::doesntHave('factura')->get(); // solo trabajos sin factura
        return view('admin.facturas.create', compact('trabajos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trabajo_id' => 'required|exists:trabajos,id',
            'monto_total' => 'required|numeric|min:0',
            'estado_pago' => 'required|in:pendiente,pagado',
            'fecha_emision' => 'required|date'
        ]);

        Factura::create($request->all());

        return redirect()->route('admin.facturas.index')->with('success', 'Factura creada correctamente.');
    }

    public function edit(Factura $factura)
    {
        $trabajos = Trabajo::all();
        return view('admin.facturas.edit', compact('factura', 'trabajos'));
    }

    public function update(Request $request, Factura $factura)
    {
        $request->validate([
            'trabajo_id' => 'required|exists:trabajos,id',
            'monto_total' => 'required|numeric|min:0',
            'estado_pago' => 'required|in:pendiente,pagado',
            'fecha_emision' => 'required|date'
        ]);

        $factura->update($request->all());

        return redirect()->route('admin.facturas.index')->with('success', 'Factura actualizada correctamente.');
    }
    public function show(Factura $factura)
{
    // Aseguramos que estén cargadas las relaciones necesarias
    $factura->load('trabajo.vehiculo.cliente');

    return view('admin.facturas.show', compact('factura'));
}


    public function destroy(Factura $factura)
    {
        $factura->delete();
        return redirect()->route('admin.facturas.index')->with('success', 'Factura eliminada.');
    }
    public function pdf(Factura $factura)
{
    $factura->load('trabajo.vehiculo.cliente');
    $config = Configuracion::first();

    $pdf = Pdf::loadView('admin.facturas.pdf', compact('factura', 'config'));
    return $pdf->stream('factura_' . $factura->id . '.pdf');
}
}
