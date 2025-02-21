<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sepomex extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_postal',
        'asentamiento',
        'tipo_asentamiento',
        'id_municipio',
        'id_estado',
    ];
    public function municipio()
   {
       return $this->belongsTo(Municipio::class, 'id_municipio');
   }

   public function estado()
  {
      return $this->belongsTo(Estado::class, 'id_estado');
  }
}
