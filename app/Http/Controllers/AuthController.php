<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function obterDadosUser($id)
    {
        if (auth()->id() != $id) {
            return response()->json(['erro' => 'Acesso negado.'], 403);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['erro' => 'Usuário não encontrado.'], 404);
        }

        return response()->json([
            'id' => $user->id,
            'nome' => $user->nome,
            'email' => $user->email,
            'imagem' => $user->imagem,
            'primeiro_login' => $user->primeiro_login,
        ]);
    }

}
