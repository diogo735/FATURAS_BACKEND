<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $categoriasDespesas = [
            [ 'img_cat' => 'compras_pessoais.png', 'cor_cat' => '#FA6FE0', 'nome_cat' => 'Compras Pessoais' ],
            [ 'img_cat' => 'contas_e_servicos.png', 'cor_cat' => '#7FCACF', 'nome_cat' => 'Contas e Serviços' ],
            [ 'img_cat' => 'despesas_gerais.png', 'cor_cat' => '#61C98D', 'nome_cat' => 'Despesas Gerais' ],
            [ 'img_cat' => 'educacao.png', 'cor_cat' => '#7FC5F3', 'nome_cat' => 'Educação' ],
            [ 'img_cat' => 'estimacao.png', 'cor_cat' => '#CF866C', 'nome_cat' => 'Estimação' ],
            [ 'img_cat' => 'financas.png', 'cor_cat' => '#B4CE61', 'nome_cat' => 'Finanças' ],
            [ 'img_cat' => 'habitacao.png', 'cor_cat' => '#60A0E0', 'nome_cat' => 'Habitação' ],
            [ 'img_cat' => 'lazer.png', 'cor_cat' => '#C370E5', 'nome_cat' => 'Lazer' ],
            [ 'img_cat' => 'outros.png', 'cor_cat' => '#B0C5C6', 'nome_cat' => 'Outros' ],
            [ 'img_cat' => 'restauracao.png', 'cor_cat' => '#E8CE62', 'nome_cat' => 'Restauração e Alojamento' ],
            [ 'img_cat' => 'saude.png', 'cor_cat' => '#FA6C5D', 'nome_cat' => 'Saúde' ],
            [ 'img_cat' => 'transportes.png', 'cor_cat' => '#E39F62', 'nome_cat' => 'Transportes' ],
        ];

        $categoriasReceitas = [
            [ 'img_cat' => 'aluguel.png', 'cor_cat' => '#5899FF', 'nome_cat' => 'Renda' ],
            [ 'img_cat' => 'caixa-de-ferramentas.png', 'cor_cat' => '#DAC44A', 'nome_cat' => 'Pequenos Trabalhos' ],
            [ 'img_cat' => 'deposito.png', 'cor_cat' => '#5899FF', 'nome_cat' => 'Depósitos' ],
            [ 'img_cat' => 'dinheiro.png', 'cor_cat' => '#ACBCC3', 'nome_cat' => 'Outras Receitas' ],
            [ 'img_cat' => 'lucro.png', 'cor_cat' => '#2B58FF', 'nome_cat' => 'Investimentos' ],
            [ 'img_cat' => 'presente.png', 'cor_cat' => '#FF6C64', 'nome_cat' => 'Presentes' ],
            [ 'img_cat' => 'salario.png', 'cor_cat' => '#39C89E', 'nome_cat' => 'Salário' ],
        ];

        $idDespesa = DB::table('tipo_movimento')->where('nome_movimento', 'Despesa')->value('id');
        $idReceita = DB::table('tipo_movimento')->where('nome_movimento', 'Receita')->value('id');

        foreach ($categoriasDespesas as $cat) {
            DB::table('categorias')->insert(array_merge($cat, [
                'tipo_movimento_id' => $idDespesa,
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }

        foreach ($categoriasReceitas as $cat) {
            DB::table('categorias')->insert(array_merge($cat, [
                'tipo_movimento_id' => $idReceita,
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
