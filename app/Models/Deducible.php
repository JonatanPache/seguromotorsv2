<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deducible extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'value'
    ];

    public function cotizacionDeducible()
    {
        return $this->hasMany(CotizacionDeducible::class);
    }
}
