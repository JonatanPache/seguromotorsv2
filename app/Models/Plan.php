<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'time_id',
        'status'
    ];

    public function time()
    {
        return $this->belongsTo(Time::class);
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    public function planAsistencia()
    {
        return $this->hasMany(PlanAsistencia::class);
    }

    public function planCobertura()
    {
        return $this->hasMany(PlanCobertura::class);
    }


}
