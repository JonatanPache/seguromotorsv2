<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coaseguro extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'value'
    ];

    public function cotizacion()
    {
        return $this->hasMany(Cotizacion::class);
    }

}
