<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances'; // Nombre de la tabla en la base de datos
    protected $fillable = ['user_id', 'fecha', 'hora_entrada', 'hora_salida']; // Columnas que se pueden llenar
    public $timestamps = true; // Tenemos created_at y updated_at

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}