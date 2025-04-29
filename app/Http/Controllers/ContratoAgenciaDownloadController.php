<?php

namespace App\Http\Controllers;

use App\Models\ContratoAgencia;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ContratoAgenciaDownloadController extends Controller
{
    public function download($contratoId)
    {
        $contrato = ContratoAgencia::find($contratoId);

        if (!$contrato || !$contrato->archivo_contrato) {
            return redirect()->back()->with('error', 'Este contrato no tiene un archivo disponible para descargar.');
        }

        $path = 'private/' . $contrato->archivo_contrato;

        if (!Storage::disk('local')->exists($path)) {
            return redirect()->back()->with('error', 'El archivo del contrato no existe en el sistema.');
        }

        return Storage::disk('local')->download($path);
    }
}
