<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoPoliza extends Model
{
    use HasFactory;

    protected $fillable = [
        'contrato_id',
        'poliza_id',
        'prima_total'
    ];


}
