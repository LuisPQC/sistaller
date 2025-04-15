<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function index()
    {
        $cotizaciones = Cotizacion::with('cliente', 'vehiculo')->latest()->paginate(10);
        $configuracion = Configuracion::first();
        return view('admin.cotizaciones.index', compact('cotizaciones', 'configuracion'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        return view('admin.cotizaciones.create', compact('clientes', 'vehiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'descripcion' => 'nullable|string',
            'total_estimado' => 'required|numeric|min:0',
            'fecha_cotizacion' => 'nullable|date',
            'archivo_pdf' => 'nullable|file|mimes:pdf|max:2048'
        ]);

        $data = $request->all();

        // Manejar archivo
        if ($request->hasFile('archivo_pdf')) {
            $path = $request->file('archivo_pdf')->store('cotizaciones', 'public');
            $data['archivo_pdf'] = $path;
        }

        Cotizacion::create($data);

        return redirect()->route('admin.cotizaciones.index')->with('success', 'Cotización creada correctamente.');
    }

    public function edit(Cotizacion $cotizacion)
    {
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        return view('admin.cotizaciones.edit', compact('cotizacion', 'clientes', 'vehiculos'));
    }

    public function update(Request $request, Cotizacion $cotizacion)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'descripcion' => 'nullable|string',
            'total_estimado' => 'required|numeric|min:0',
            'fecha_cotizacion' => 'nullable|date',
            'fecha_autorizacion' => 'nullable|date',
            'estado' => 'in:pendiente,aceptada,rechazada',
            'archivo_pdf' => 'nullable|file|mimes:pdf|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('archivo_pdf')) {
            $path = $request->file('archivo_pdf')->store('cotizaciones', 'public');
            $data['archivo_pdf'] = $path;
        }

        $cotizacion->update($data);

        return redirect()->route('admin.cotizaciones.index')->with('success', 'Cotización actualizada correctamente.');
    }

    public function destroy(Cotizacion $cotizacion)
    {
        $cotizacion->delete();
        return redirect()->route('admin.cotizaciones.index')->with('success', 'Cotización eliminada.');
    }
}
