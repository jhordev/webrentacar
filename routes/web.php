<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContratoAgenciaDownloadController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/descargar-contrato/{filename}', function ($filename) {
    $path = storage_path('app/private/contratos/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'El archivo no existe');
    }

    return response()->download($path);
})->name('contratos.descargar');
