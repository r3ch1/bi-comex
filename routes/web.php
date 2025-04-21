<?php

use Illuminate\Support\Facades\Route;
use App\Actions\{GetExportacoesAction, GetExportacoesDto};
use App\Actions\{GetMesesPorUfDto, GetMesesPorUfAction};
use App\Http\Controllers\GetCampoPorUfController;
use App\Http\Controllers\GetTotaisPorUfController;

Route::prefix('api')->group(function(){
    Route::prefix('exportacoes')->group(function(){
        Route::get('{uf}/get-por/{campo}', GetCampoPorUfController::class);
        Route::get('{uf}/get-totais', GetTotaisPorUfController::class);
    });
});
Route::get('/', function () {
    return view('welcome');
});
