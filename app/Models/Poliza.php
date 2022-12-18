<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    use HasFactory;


    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }
}
