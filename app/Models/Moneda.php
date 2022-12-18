<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use HasFactory;

    protected $fillable=['name','slug'];

    public function coberturaTipo()
    {
        return $this->belongsTo(CoberturaTipo::class);
    }
}
