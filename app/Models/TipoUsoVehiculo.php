<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsoVehiculo extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description'
    ];

    public function userVehiculo()
    {
        return $this->hasMany(UserVehiculo::class);
    }
}
