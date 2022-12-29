<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'poliza_id',
        'cliente_id',
        'date',
        'date_pay',
        'otros_pagos',
        'total',
        'dias_plazo',
        'recargo_financiero'
    ];


    public function poliza()
    {
        return $this->belongsTo(Poliza::class);
    }

    public function cliente()
    {
        return $this->belongsTo(User::class);
    }

    public function factura()
    {
        return $this->hasOne(Facturas::class);
    }

    public function otroPago()
    {
        return $this->hasMany(OtroPago::class);
    }

}
