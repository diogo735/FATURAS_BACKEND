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
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user) {
        return response()->json(['message' => 'O email fornecido não está registado.'], 404);
    }

    if (! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'A pass está incorreta.'], 401);
    }

    // Revoga tokens anteriores
    $user->tokens()->delete();

    // Cria novo token
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Login efetuado com sucesso',
        'token' => $token,
        'user' => $user
    ]);
}



 public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logout efetuado com sucesso. Token revogado.'
    ]);
}



    public function obterDadosUser($id, Request $request)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['error' => 'Usuário não encontrado'], 404);
    }

    if ($request->user()->id !== $user->id) {
        return response()->json(['error' => 'Acesso não autorizado'], 403);
    }

    // 1. Clona os dados do user antes de alterar
    $dadosAntes = $user->replicate();

    $mensagem = null;

    // 2. Se for o primeiro login, só depois de exibir muda pra false
    if ($user->primeiro_login) {
        $user->primeiro_login = false;
        $user->save();
        $mensagem = 'primeiro_login foi alterado para false !!.';
    }

    // 3. Retorna os dados originais e mensagem
    return response()->json([
        'user' => $dadosAntes,
        'mensagem' => $mensagem ?? 'primeiro_login já estava como false.'
    ]);
}



}
