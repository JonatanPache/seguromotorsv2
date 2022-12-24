<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prima extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'plazo_baja',
        'tasa_interes'
    ];

    public function seguro()
    {
        return $this->hasMany(Seguro::class);
    }
}
