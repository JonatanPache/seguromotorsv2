<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'description',
        'pago_id',
        'total_pagado'
    ];

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }
}
