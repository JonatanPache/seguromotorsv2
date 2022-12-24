<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudCotizacion extends Model
{
    use HasFactory;


    protected $fillable=[
        'date',
        'seguro_id',
        'cliente_id',
        'conductor_id',
        'prima_id',
        'placa',
        'image_hist_conduc',
        'image_hist_auto',
        'status'
    ];


    public function seguro()
    {
        return $this->belongsTo(Seguro::class);
    }

    public function cliente()
    {
        return $this->belongsTo(User::class);
    }

    public function conductor()
    {
        return $this->belongsTo(User::class);
    }

    public function prima()
    {
        return $this->belongsTo(Prima::class);
    }

    public function cotizacion()
    {
        return $this->hasMany(Cotizacion::class);
    }

}
