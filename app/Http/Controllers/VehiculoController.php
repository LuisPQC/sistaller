<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::with('cliente')->get();
        return view('admin.vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('admin.vehiculos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'placas' => 'nullable|string|max:20',
            'anio' => 'nullable|integer|min:1900|max:'.date('Y'),
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('admin.vehiculos.index')->with('success', 'Vehículo registrado correctamente.');
    }

    public function edit(Vehiculo $vehiculo)
    {
        $clientes = Cliente::all();
        return view('admin.vehiculos.edit', compact('vehiculo', 'clientes'));
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'placas' => 'nullable|string|max:20',
            'anio' => 'nullable|integer|min:1900|max:'.date('Y'),
        ]);

        $vehiculo->update($request->all());

        return redirect()->route('admin.vehiculos.index')->with('success', 'Vehículo actualizado.');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('admin.vehiculos.index')->with('success', 'Vehículo eliminado.');
    }
}
