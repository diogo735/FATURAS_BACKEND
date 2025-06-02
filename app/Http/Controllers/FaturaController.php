<?php

namespace App\Http\Controllers;

use App\Models\Fatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaturaController extends Controller
{
    // Listar faturas do utilizador, com suporte a updated_since
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Fatura::where('user_id', $user->id);

        if ($request->has('updated_since')) {
            $query->where('updated_at', '>', $request->query('updated_since'));
        }

        $faturas = $query->get();

        if ($faturas->isEmpty()) {
            return response()->json(['mensagem' => 'O utilizador não tem faturas.'], 200);
        }

        return response()->json($faturas);
    }

    // Criar fatura
    public function store(Request $request)
    {
        try {
            $user = $request->user();

            $validated = $request->validate([
                'movimento_id' => 'required|exists:movimentos,id',
                'tipo_documento' => 'required|string',
                'numero_fatura' => 'required|string',
                'data_fatura' => 'required|date',
                'nif_emitente' => 'required|string',
                'codigo_ATCUD' => 'required|string',
                'nome_empresa' => 'nullable|string',
                'nif_cliente' => 'nullable|string',
                'descricao' => 'nullable|string',
                'total_iva' => 'required|numeric',
                'total_final' => 'required|numeric',
                'imagem_fatura' => 'nullable|string',
                'updated_at' => 'required|date',
            ]);

            $validated['user_id'] = $user->id;

            $fatura = Fatura::create($validated);

            return response()->json([
                'mensagem' => 'Fatura criada com sucesso!',
                'fatura' => $fatura
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['erro' => 'Erro ao criar fatura.', 'detalhes' => $e->getMessage()], 500);
        }
    }

 public function update(Request $request, $id)
    {
        try {
            $user = $request->user();

            $fatura = Fatura::where('id', $id)->whereHas('movimento', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->firstOrFail();

            $validated = $request->validate([
                'movimento_id' => 'sometimes|exists:movimentos,id',
                'tipo_documento' => 'sometimes|string',
                'numero_fatura' => 'sometimes|string',
                'data_fatura' => 'sometimes|date',
                'nif_emitente' => 'sometimes|string',
                'codigo_ATCUD' => 'sometimes|string',
                'nome_empresa' => 'nullable|string',
                'nif_cliente' => 'nullable|string',
                'descricao' => 'nullable|string',
                'total_iva' => 'sometimes|numeric',
                'total_final' => 'sometimes|numeric',
                'imagem_fatura' => 'nullable|string',
                'updated_at' => 'required|date',
            ]);

            $fatura->update($validated);

            return response()->json([
                'mensagem' => 'Fatura atualizada com sucesso!',
                'fatura' => $fatura
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Erro ao atualizar fatura',
                'detalhes' => $e->getMessage()
            ], 500);
        }
    }
    // Eliminar fatura
    public function destroy(Request $request, $id)
    {
        try {
            $user = $request->user();
            $fatura = Fatura::where('id', $id)->where('user_id', $user->id)->first();

            if (!$fatura) {
                return response()->json(['erro' => 'Fatura não encontrada ou não pertence ao utilizador.'], 404);
            }

            $fatura->delete();

            return response()->json(['mensagem' => 'Fatura apagada com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(['erro' => 'Erro ao apagar fatura.', 'detalhes' => $e->getMessage()], 500);
        }
    }
}
