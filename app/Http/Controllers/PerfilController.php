<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return response()->json([
            'nome' => $user->nome,
            'email' => $user->email,
            'imagem' => $user->imagem, // já é uma URL
        ]);
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|url',
        ]);

        $user->name = $request->nome;

        if ($request->filled('imagem')) {
            $user->imagem = $request->imagem;
        }

        $user->save();

        return response()->json(['mensagem' => 'Perfil atualizado com sucesso!']);
    }
}
