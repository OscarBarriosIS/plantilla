<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoIne extends Model
{
    use HasFactory;

    protected $fillable = [
        'clave_elector',
        'curp',
        'nombre',
        'paterno',
        'materno',
        'direccion',
        'seccion',
        'sexo',
        'fecha_registro',
        'fecha_emision',
        'fecha_expiracion',
        'ine',
        'retrato',
        'firma',
        'version_ine',
        'estatus',
        'id_user',
        'id_user_alta',
        'id_municipio',
        'correo',
        'telefono',
        'fecha_nacimiento',
        'codigo',
        'codigo_alta',
    ];

    // Accesor para la URL de la foto
    public function getIneAttribute($value)
    {
        return asset('storage/' . $value); // Ajusta la ruta según la ubicación de tus imágenes
    }

     public function usuarioLogueado()
    {
        return $this->belongsTo(User::class, 'id_user'); 
    }

}
          