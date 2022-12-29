<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtroPago extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pago_id',
        'siniestro_id',
        'detalle',
        'costo'
    ];

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }

    public function siniestro()
    {
        return $this->belongsTo(ServicioSiniestro::class);
    }
}
