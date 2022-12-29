<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    use HasFactory;

    protected $fillable = [
        'detalle',
        'user_id',
        'cotizacion_id',
        'duracion',
        'date_start',
        'date_end'
    ];

    public function pago()
    {
        return $this->hasMany(Pago::class);
    }

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
