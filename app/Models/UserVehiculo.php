<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVehiculo extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'vehiculo_id',
        'tipo_servicio_id',
        'tipo_uso_id',
        'city_id',
        'placa',
        'image1',
        'image2',
        'image3'
    ];

    public function cities()
    {
        return $this->belongsTo(City::class);
    }

    public function tipo_servicio()
    {
        return $this->belongsTo(TipoServicioVehiculo::class);
    }

    public function tipo_uso()
    {
        return $this->belongsTo(TipoUsoVehiculo::class);
    }
}
