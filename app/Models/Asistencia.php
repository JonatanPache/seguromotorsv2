<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as Audi;
use OwenIt\Auditing\Auditable as dos;

class Asistencia extends Model implements Audi
{
    use HasFactory, dos;

    protected $fillable = [
        'name',
        'descripcion',
        'status'
    ];
}
