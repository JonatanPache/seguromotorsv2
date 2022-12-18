<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCoberturaMotivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_cobertura_id',
        'motivo_id',
    ];
}
