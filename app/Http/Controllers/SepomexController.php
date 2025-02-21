<?php

namespace App\Http\Controllers;

use App\Models\Sepomex;
use Illuminate\Http\Request;

class SepomexController extends Controller
{
    public function getColonias($cp)
    {
        $colonias = Sepomex::with('municipio')->where('codigo_postal', $cp)->get();
  
        // Mapea las colonias para incluir el nombre del municipio en la respuesta
        $colonias = $colonias->map(function($colonia) {
            return [
                'id' => $colonia->id,
                'asentamiento' => $colonia->asentamiento,
                'codigo_postal' => $colonia->codigo_postal,
                'municipio' => $colonia->municipio->nombre ?? null, // incluye el nombre del municipio
                'id_municipio' => $colonia->municipio->id ?? null,
            ];
        });
  
        return response()->json($colonias);
    }
}
