<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'clase',
        'modelo',
        'motor_nro',
        'motor_serie',
        'motor_potencia',
        'nro_puerta',
        'capacidad',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


}
