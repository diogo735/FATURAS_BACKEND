<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    try {
        $pdo = DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        $host = DB::getConfig('host');
        $mensagem = "✅  Sucesso";
    } catch (\Exception $e) {
        $mensagem = "❌ Conexão com a base de dados: Insucesso<br>Erro: " . $e->getMessage();
    }

    return view('welcome', ['mensagem' => $mensagem]);
});
