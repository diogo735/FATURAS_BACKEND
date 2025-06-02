<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaturaController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/obter_fatura', [FaturaController::class, 'index']);
    Route::post('/criar_fatura', [FaturaController::class, 'store']);
    Route::delete('/apagar_fatura/{id}', [FaturaController::class, 'destroy']);
});
