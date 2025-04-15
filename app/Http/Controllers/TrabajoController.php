<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Models\Vehiculo;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class TrabajoController extends Controller
{
    public function index()
    {
        $trabajos = Trabajo::with(['vehiculo.cliente', 'tecnico'])->latest()->paginate(10);
        return view('admin.trabajos.index', compact('trabajos'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::with('cliente')->get();
        $tecnicos = User::role('tecnico')->get(); // si usas Spatie
        return view('admin.trabajos.create', compact('vehiculos', 'tecnicos'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'usuario_id' => 'nullable|exists:users,id',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
            'estado' => 'in:pendiente,proceso,concluido',
            'porcentaje_avance' => 'nullable|numeric|min:0|max:100',
            'total_factura' => 'nullable|numeric|min:0',
            'archivos.*' => 'nullable|file|max:10240' // 10MB
        ]);
        // Generar código si no viene
    $request['cod_seguimiento'] = $request->cod_seguimiento ?? strtoupper(Str::random(4));
        $trabajo = Trabajo::create($request->all());
    
        // Guardar archivos
        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $i => $archivo) {
                $tipo = $this->detectarTipoArchivo($archivo->getMimeType());
                $ruta = $archivo->store('archivos_trabajo', 'public');
                $tipoDeGolpe = $request->tipos_golpe[$i] ?? null;
            
                $trabajo->archivos()->create([
                    'ruta_archivo' => $ruta,
                    'tipo_archivo' => $tipo,
                    'tipo_de_golpe' => $tipoDeGolpe,
                    'descripcion' => 'Archivo subido automáticamente'
                ]);
            }
            
        }
    
        return redirect()->route('admin.trabajos.index')->with('success', 'Trabajo creado correctamente.');
    }
    

    public function edit(Trabajo $trabajo)
    {
        $vehiculos = Vehiculo::with('cliente')->get();
        $tecnicos = User::role('tecnico')->get();
        return view('admin.trabajos.edit', compact('trabajo', 'vehiculos', 'tecnicos'));
    }

    public function update(Request $request, Trabajo $trabajo)
{
    $request->validate([
        'vehiculo_id' => 'required|exists:vehiculos,id',
        'usuario_id' => 'nullable|exists:users,id',
        'descripcion' => 'required|string',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date',
        'estado' => 'in:pendiente,proceso,concluido',
        'porcentaje_avance' => 'required|numeric|min:0|max:100',
        'total_factura' => 'nullable|numeric|min:0',
        'archivos.*' => 'nullable|file|max:10240'
    ]);

    $trabajo->update($request->all());

    if ($request->hasFile('archivos')) {
        foreach ($request->file('archivos') as $i => $archivo) {
            $tipo = $this->detectarTipoArchivo($archivo->getMimeType());
            $ruta = $archivo->store('archivos_trabajo', 'public');
            $tipoDeGolpe = $request->tipos_golpe[$i] ?? null;
        
            $trabajo->archivos()->create([
                'ruta_archivo' => $ruta,
                'tipo_archivo' => $tipo,
                'tipo_de_golpe' => $tipoDeGolpe,
                'descripcion' => 'Archivo subido automáticamente'
            ]);
        }
        
    }

    return redirect()->route('admin.trabajos.index')->with('success', 'Trabajo actualizado.');
}

public function pdf(Trabajo $trabajo)
{
    $trabajo->load(['vehiculo.cliente', 'tecnico', 'archivos']);
    $config = configuracion(); // usar helper

    $pdf = Pdf::loadView('admin.trabajos.pdf', compact('trabajo', 'config'));
    return $pdf->stream('trabajo_' . $trabajo->id . '.pdf');
}

    public function show(Trabajo $trabajo)
{
    // Aseguramos que se carguen sus relaciones
    $trabajo->load(['vehiculo.cliente', 'tecnico', 'archivos']);

    return view('admin.trabajos.show', compact('trabajo'));
}

    public function destroy(Trabajo $trabajo)
    {
        $trabajo->delete();
        return redirect()->route('admin.trabajos.index')->with('success', 'Trabajo eliminado.');
    }
    private function detectarTipoArchivo($mime)
{
    if (str_starts_with($mime, 'image/')) {
        return 'imagen';
    }

    if (str_starts_with($mime, 'video/')) {
        return 'video';
    }

    return 'documento';
}
public function redirigirPorCodigo(Request $request)
{
    $codigo = $request->input('codigo');

    $trabajo = \App\Models\Trabajo::where('cod_seguimiento', $codigo)->first();

    if (!$trabajo) {
        return redirect()->back()->with('error', 'Código no encontrado.');
    }

    return redirect()->route('admin.muestra', $trabajo->id);
}
public function muestra(Trabajo $trabajo)
{
    // Aseguramos que se carguen sus relaciones
    $trabajo->load(['vehiculo.cliente', 'tecnico', 'archivos']);

    return view('admin.muestra', compact('trabajo'));
}

}
