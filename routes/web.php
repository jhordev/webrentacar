<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContratoAgenciaDownloadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contratos/download/{contrato}', [ContratoAgenciaDownloadController::class, 'download'])
    ->name('contratos.download');
