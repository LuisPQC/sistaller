<?php

namespace App\Http\Controllers;

use App\Models\ArchivoTrabajo;
use Illuminate\Http\Request;

class ArchivoTrabajoController extends Controller
{
    public function edit(ArchivoTrabajo $archivo)
    {
        return view('admin.archivos.edit', compact('archivo'));
    }

    public function update(Request $request, ArchivoTrabajo $archivo)
    {
        $request->validate([
            'descripcion' => 'nullable|string|max:255',
            'tipo_de_golpe' => 'nullable|string|max:255',
        ]);

        $archivo->update($request->only('descripcion', 'tipo_de_golpe'));

        return redirect()->route('admin.trabajos.show', $archivo->trabajo_id)
                         ->with('success', 'Archivo actualizado correctamente.');
    }
}
