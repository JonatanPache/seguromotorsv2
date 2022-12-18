<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code_postal'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function userVehiculo()
    {
        return $this->hasMany(UserVehiculo::class);
    }
}
