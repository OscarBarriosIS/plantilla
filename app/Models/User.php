<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'imagen',
        'fecha_nacimiento',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'estado_civil',
        'nacionalidad',
        'curp',
        'rfc',
        'telefono',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }

    public function getNombreCompletoAttribute()
    {
        return $this->name . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
    }

    public function attendances() {
        return $this->hasMany(Attendance::class);
    }

    // Funcion para regresar la asistencia del dia actual
    public function attendancesToday() {
        return $this->hasMany(Attendance::class)
            ->whereDate('fecha', Carbon::today());
    }

    // Accesor para la URL de la foto
    public function getImagenAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('/default.png'); // Ajusta la ruta según la ubicación de tus imágenes
    }
}
