<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionDeducible extends Model
{
    use HasFactory;

    protected $fillable = [
        'cotizacion_id',
        'tipo_cobertura_id',
        'deducible_id',
        'deducible_value'
    ];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

    public function deducible()
    {
        return $this->belongsTo(Deducible::class);
    }

    public function tipoCobertura()
    {
        return $this->belongsTo(TipoCobertura::class);
    }
}
