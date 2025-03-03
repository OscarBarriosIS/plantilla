<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apodo'];
    public function estado() {
        return $this->belongsTo(Estado::class);
    }
    
    
}
