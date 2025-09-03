<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();

    if ($request->has('updated_since')) {
        $since = $request->query('updated_since');

        if (!$user->updated_at || $user->updated_at->lte($since)) {
            return response()->json([
                'mensagem' => 'Sem atualizações no perfil.'
            ]);
        }
    }

    return response()->json([
        'nome' => $user->nome,
        'email' => $user->email,
        'imagem' => $user->imagem,
        'updated_at' => $user->updated_at
    ]);
}

    public function store(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'nome' => 'required|string|max:255',
        'password' => 'nullable|string|min:4|confirmed',
        'imagem' => 'nullable|url',
    ]);

    $user->nome = $request->nome;

    if ($request->filled('imagem')) {
        $user->imagem = $request->imagem;
    }

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return response()->json(['mensagem' => 'Perfil atualizado com sucesso!']);
}

}
