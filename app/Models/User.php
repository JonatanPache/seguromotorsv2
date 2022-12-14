<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ci',
        'last_name',
        'phone',
        'address',
        'birthday',
        'notification_token',
        'city_id',
        'rol_id',
        'image1',
        'image2',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function contrato()
    {
        return $this->hasMany(Contrato::class);
    }

    public function userVehiculo()
    {
        return $this->hasMany(UserVehiculo::class);
    }

    public function pago()
    {
        return $this->hasMany(Pago::class);
    }

    public function solicitudSiniestro()
    {
        return $this->hasMany(SolicitudSiniestro::class);
    }

    public function servicioSiniestro()
    {
        return $this->hasMany(ServicioSiniestro::class);
    }
}
