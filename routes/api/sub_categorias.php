<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubCategoriaController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/listar_categorias_user', [SubCategoriaController::class, 'index']);
    Route::post('/criar_categoria_user', [SubCategoriaController::class, 'store']);
    Route::put('/atualizar_categoria/{id}', [SubCategoriaController::class, 'update']);
    Route::delete('/apagar_categoria/{id}', [SubCategoriaController::class, 'destroy']);
});
