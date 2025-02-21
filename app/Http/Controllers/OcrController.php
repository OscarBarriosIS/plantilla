<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OcrService;

class OcrController extends Controller
{
   protected $ocrService;

   public function __construct(OcrService $ocrService)
   {
       $this->ocrService = $ocrService;
   }

   public function procesar_ine(Request $request)
   {
       return $this->ocrService->procesar_ine($request);
   }
}
