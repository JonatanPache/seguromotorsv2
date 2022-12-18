<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'seguro_id'
    ];

    /*public function polizas()
    {
        return $this->belongsTo(Poliza::class);
    }*/

    public function seguro()
    {
        return $this->belongsTo(Seguro::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
