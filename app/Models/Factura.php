<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $table = 'facturas';

    protected $fillable = [
        'trabajo_id',
        'monto_total',
        'estado_pago',
        'fecha_emision'
    ];
    public function trabajo()
{
    return $this->belongsTo(Trabajo::class);
}

}
