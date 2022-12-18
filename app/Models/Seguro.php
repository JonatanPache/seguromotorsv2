<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cost',
        'plan_id',
        'is_enable'
    ];

    protected $casts=[
        'is_enable' => 'boolean'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function contrato()
    {
        return $this->hasMany(Contrato::class);
    }
}
