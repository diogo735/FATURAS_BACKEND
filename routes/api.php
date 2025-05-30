<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

//dados do user
Route::middleware('auth:sanctum')->get('/obter_dados_user/{id}', [AuthController::class, 'obterDadosUser']);

//ping
Route::get('/ping', function () {
    return response()->json(['message' => 'online'], 200);
});

//recuparer pass e enviar por email
Route::post('/recuperar_pass', [AuthController::class, 'RecuperarPass']);
