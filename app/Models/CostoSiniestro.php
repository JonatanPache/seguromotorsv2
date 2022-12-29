<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostoSiniestro extends Model
{
    use HasFactory;

    protected $fillable = [
        'siniestro_id',
        'name',
        'detalle',
        'costo'
    ];

    public function siniestro()
    {
        return $this->belongsTo(ServicioSiniestro::class);
    }
}
