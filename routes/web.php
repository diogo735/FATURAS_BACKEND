<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    try {
        DB::connection()->getPdo();
        $mensagem = "CONECTADO COM SUCESSO";
    } catch (\Exception $e) {
        $mensagem = "NÃO CONECTADO: " . $e->getMessage();
    }

    return view('pagina_inicial', compact('mensagem'));
});



