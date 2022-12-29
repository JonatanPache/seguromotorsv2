<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'preposicion',
        'user_id',
        'cotizacion_id',
        'date_start',
        'date_end',
        'cliente_firm',
        'status'
    ];

    /*public function polizas()
    {
        return $this->belongsTo(Poliza::class);
    }*/

    public function seguro()
    {
        return $this->belongsTo(Seguro::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

    public function contratoPoliza()
    {
        return $this->hasMany(ContratoPoliza::class);
    }
}
