<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as Audi;
use OwenIt\Auditing\Auditable as dos;

class Brand extends Model implements audi
{
    use HasFactory,dos;

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }
}
