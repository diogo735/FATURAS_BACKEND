<?php

namespace App\Http\Controllers;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    // Buscar subcategorias do user
    public function index(Request $request)
{
    $user = $request->user();

    $query = SubCategoria::where('user_id', $user->id);

    if ($request->has('updated_since')) {
        $query->where('updated_at', '>', $request->query('updated_since'));
    }

    $subcategorias = $query->get();

    if ($subcategorias->isEmpty()) {
        return response()->json([
            'mensagem' => 'O utilizador não tem subcategorias registadas.'
        ], 200);
    }

    return response()->json($subcategorias);
}


    // Criar nova subcategoria
public function store(Request $request)
{
    try {
        $user = $request->user();

        $validated = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nome_subcat' => 'required|string',
            'icone_nome' => 'required|string',
            'cor_subcat' => 'required|string',
            'updated_at' => 'nullable|date',
        ]);

        // Verifica duplicado para o mesmo user
        $existe = SubCategoria::where('user_id', $user->id)
            ->where('nome_subcat', $validated['nome_subcat'])
            ->exists();

        if ($existe) {
            return response()->json([
                'erro' => 'Já existe uma subcategoria com esse nome para este utilizador.'
            ], 409); // 409 Conflict
        }

        $validated['user_id'] = $user->id;

        $subCat = SubCategoria::create($validated);

        return response()->json([
            'mensagem' => 'Subcategoria criada com sucesso!',
            'subcategoria' => $subCat
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'erro' => 'Erro ao criar subcategoria.',
            'detalhes' => $e->getMessage()
        ], 500);
    }
}



    // Atualizar subcategoria existente
 public function update(Request $request, $id)
{
    try {
        $user = $request->user();

        $subCat = SubCategoria::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $validated = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nome_subcat' => 'required|string',
            'icone_nome' => 'required|string',
            'cor_subcat' => 'required|string',
            'updated_at' => 'nullable|date',
        ]);

        // Verifica se outra subcategoria do user tem o mesmo nome
        $existe = SubCategoria::where('user_id', $user->id)
            ->where('nome_subcat', $validated['nome_subcat'])
            ->where('id', '!=', $subCat->id)
            ->exists();

        if ($existe) {
            return response()->json([
                'erro' => 'Já existe outra subcategoria com esse nome para este utilizador.'
            ], 409);
        }

        $subCat->update($validated);

        return response()->json([
            'mensagem' => 'Subcategoria atualizada com sucesso!',
            'subcategoria' => $subCat
        ]);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'erro' => 'Subcategoria não encontrada ou não pertence a este utilizador.'
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'erro' => 'Erro ao atualizar subcategoria.',
            'detalhes' => $e->getMessage()
        ], 500);
    }
}


    // Deletar subcategoria
   public function destroy(Request $request, $id)
{
    try {
        $user = $request->user();

        $subCat = SubCategoria::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $subCat->delete();

        return response()->json([
            'mensagem' => 'Subcategoria apagada com sucesso!'
        ], 200);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'erro' => 'Subcategoria não encontrada ou não pertence a este utilizador.'
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'erro' => 'Erro ao apagar subcategoria.',
            'detalhes' => $e->getMessage()
        ], 500);
    }
}

}
