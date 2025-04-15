<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    
    protected $table = 'vehiculos';

    protected $fillable = [
        'cliente_id',
        'marca',
        'modelo',
        'placas',
        'anio'
    ];
    public function cliente()
{
    return $this->belongsTo(Cliente::class);
}

public function trabajos()
{
    return $this->hasMany(Trabajo::class);
}

}
