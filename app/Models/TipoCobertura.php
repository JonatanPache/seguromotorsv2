<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCobertura extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function tipoCoberturaMotivo()
    {
        return $this->hasMany(TipoCoberturaMotivo::class);
    }
}
