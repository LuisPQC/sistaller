<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $table = 'cotizaciones';

    protected $fillable = [
        'cliente_id',
        'vehiculo_id',
        'descripcion',
        'total_estimado',
        'estado',
        'fecha_cotizacion',
        'fecha_autorizacion',
        'archivo_pdf'
    ];

    // Relaciones

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    // Scope útil para filtros rápidos
    public function scopePendiente($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeAceptadas($query)
    {
        return $query->where('estado', 'aceptada');
    }

    public function scopeRechazadas($query)
    {
        return $query->where('estado', 'rechazada');
    }
}
