<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudSiniestro extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'date_solicitud',
        'cliente_id',
        'status',
        'latitude',
        'longitude'
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class);
    }

    public function servicioSiniestro()
    {
        return $this->hasMany(ServicioSiniestro::class);
    }

}
