<?php
namespace App\Http\Controllers;

use App\Models\Movimento;
use Illuminate\Http\Request;

class MovimentoController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Movimento::where('user_id', $user->id);

        if ($request->has('updated_since')) {
            $query->where('updated_at', '>', $request->query('updated_since'));
        }

        $movimentos = $query->get();

        if ($movimentos->isEmpty()) {
            return response()->json(['mensagem' => 'Sem movimentos registados.']);
        }

        return response()->json($movimentos);
    }

    public function store(Request $request)
    {
        try {
            $user = $request->user();

            $validated = $request->validate([
                'categoria_id' => 'required|exists:categorias,id',
                'sub_categoria_id' => 'nullable|exists:sub_categorias,id',
                'valor' => 'required|numeric',
                'data_movimento' => 'required|date',
                'nota' => 'nullable|string',
                'updated_at' => 'required|date'
            ], [
                'categoria_id.required' => 'O campo categoria é obrigatório.',
                'categoria_id.exists' => 'A categoria selecionada é inválida.',
                'sub_categoria_id.exists' => 'A subcategoria selecionada é inválida.',
                'valor.required' => 'O valor é obrigatório.',
                'valor.numeric' => 'O valor deve ser numérico.',
                'data_movimento.required' => 'A data do movimento é obrigatória.',
                'data_movimento.date' => 'A data do movimento deve ser válida.',
                'updated_at.required' => 'A data de atualização é obrigatória.',
                'updated_at.date' => 'A data de atualização deve ser válida.'
            ]);

            $validated['user_id'] = $user->id;

            $mov = Movimento::create($validated);

            return response()->json([
                'mensagem' => 'Movimento criado com sucesso!',
                'movimento' => $mov
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Erro ao criar movimento.',
                'detalhes' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $request->user();

            $mov = Movimento::where('id', $id)->where('user_id', $user->id)->firstOrFail();

            $validated = $request->validate([
                'categoria_id' => 'required|exists:categorias,id',
                'sub_categoria_id' => 'nullable|exists:sub_categorias,id',
                'nota' => 'nullable|string',
                'updated_at' => 'required|date',
            ], [
                'categoria_id.required' => 'O campo categoria é obrigatório.',
                'categoria_id.exists' => 'A categoria selecionada é inválida.',
                'sub_categoria_id.exists' => 'A subcategoria selecionada é inválida.',
                'valor.required' => 'O valor é obrigatório.',
                'valor.numeric' => 'O valor deve ser numérico.',
                'data_movimento.required' => 'A data do movimento é obrigatória.',
                'data_movimento.date' => 'A data do movimento deve ser válida.',
                'updated_at.required' => 'A data de atualização é obrigatória.',
                'updated_at.date' => 'A data de atualização deve ser válida.'
            ]);

            $mov->update($validated);

            return response()->json([
                'mensagem' => 'Movimento atualizado com sucesso!',
                'movimento' => $mov
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Erro ao atualizar movimento.',
                'detalhes' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy(Request $request, $id)
    {
        try {
            $user = $request->user();

            $mov = Movimento::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (!$mov) {
                return response()->json(['erro' => 'Movimento não encontrado ou não pertence ao utilizador.'], 404);
            }

            $mov->delete();

            return response()->json(['mensagem' => 'Movimento apagado com sucesso.']);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Erro ao apagar movimento.',
                'detalhes' => $e->getMessage()
            ], 500);
        }
    }

}
