<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'time_id',
        'it'
    ];


    public function planes()
    {
        return $this->hasMany(Plan::class);
    }

    public function contratos()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function time()
    {
        return $this->belongsTo(Time::class);
    }
}
