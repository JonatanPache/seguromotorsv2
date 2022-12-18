<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoberturaTipo extends Model
{
    use HasFactory;

    protected $fillable=[
        'cobertura_id',
        'cobertura_tipo_id',
        'moneda_id',
        'porcentaje_cob',
        'porcentaje_partir',
        'monto_cobertura',
        'limite_max',
        'prima_cant'
    ];

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }


}
