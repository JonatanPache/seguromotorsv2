<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_start',
        'date_end',
        'total_primas',
        'descuento',
        'prima_neta',
        'gastos',
        'iva',
        'prima_total',
        'status',
        'coaseguro_id',
        'solicitud_id'
    ];

    public function coaseguro()
    {
        return $this->belongsTo(Coaseguro::class);
    }

    public function solicitud()
    {
        return $this->belongsTo(SolicitudCotizacion::class);
    }

    public function cotizacionDeducible()
    {
        return $this->hasMany(CotizacionDeducible::class);
    }

    public function contrato()
    {
        return $this->hasMany(Contrato::class);
    }

    public function poliza()
    {
        return $this->hasMany(Poliza::class);
    }
}
