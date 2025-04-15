<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;
    protected $table = 'trabajos';

    protected $fillable = [
        'vehiculo_id',
        'usuario_id',
        'descripcion',
        'cod_seguimiento',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'porcentaje_avance',
        'total_factura'
    ];
    public function vehiculo()
{
    return $this->belongsTo(Vehiculo::class);
}

public function tecnico()
{
    return $this->belongsTo(User::class, 'usuario_id');
}
public function usuario()
{
    return $this->belongsTo(User::class);
}

public function archivos()
{
    return $this->hasMany(ArchivoTrabajo::class);
}

public function factura()
{
    return $this->hasOne(Factura::class);
}

}
