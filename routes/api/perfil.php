<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index']);
    Route::post('/perfil', [PerfilController::class, 'store']);
});

