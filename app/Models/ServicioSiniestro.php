<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioSiniestro extends Model
{
    use HasFactory;

    protected $fillable = [
        'solicitud_siniestro_id',
        'empleado_id',
        'observaciones',
        'status',
        'latitude',
        'longitude',
        'total_costo'
    ];

    public function solicitudSiniestro()
    {
        return $this->belongsTo(SolicitudSiniestro::class);
    }

    public function empleado()
    {
        return $this->belongsTo(User::class);
    }

    public function costoSiniestro()
    {
        return $this->hasMany(CostoSiniestro::class);
    }

    public function otroPago()
    {
        return $this->hasMany(OtroPago::class);
    }
}
