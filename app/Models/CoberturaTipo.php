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
        'porcentaje_cob',
        'monto_cobertura',
        'limite_id',
    ];

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }

    public function limite()
    {
        return $this->belongsTo(Limite::class);
    }


}
