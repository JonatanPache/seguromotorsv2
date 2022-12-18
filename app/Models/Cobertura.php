<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobertura extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function coberturaTipo()
    {
        return $this->hasMany(CoberturaTipo::class);
    }
}
