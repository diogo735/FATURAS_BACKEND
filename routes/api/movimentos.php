<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovimentoController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/listar_movimentos_user', [MovimentoController::class, 'index']);
    Route::post('/criar_movimento', [MovimentoController::class, 'store']);
    Route::put('/atualizar_movimento/{id}', [MovimentoController::class, 'update']);
    Route::delete('/apagar_movimento/{id}', [MovimentoController::class, 'destroy']);
});
