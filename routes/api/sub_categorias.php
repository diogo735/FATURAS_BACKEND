<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubCategoriaController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/listar_categorias_user', [SubCategoriaController::class, 'index']);
    Route::post('/criar_categoria_user', [SubCategoriaController::class, 'store']);
    Route::put('/sub-categorias/{id}', [SubCategoriaController::class, 'update']);
    Route::delete('/sub-categorias/{id}', [SubCategoriaController::class, 'destroy']);
});
