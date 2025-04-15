<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoTrabajo extends Model
{
    use HasFactory;
    protected $table = 'archivos_trabajo';

    protected $fillable = [
        'trabajo_id',
        'ruta_archivo',
        'tipo_archivo',
        'tipo_de_golpe',
        'descripcion',
        'fecha_subida'
    ];
    public function trabajo()
{
    return $this->belongsTo(Trabajo::class);
}

}
