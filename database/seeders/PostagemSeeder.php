<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postagens = [];
        for ($i = 1; $i <= 12; $i++) {
            $userId = ($i <= 6) ? 1 : 2; // André Neves 1 para as primeiras 6, André Neves 2 para as demais
            $categoriaId = ($i % 3 == 1) ? 1 : (($i % 3 == 2) ? 2 : 3); // Alterna entre categorias

            $postagens[] = [
                'titulo' => "Postagem $i",
                'descricao' => "Descrição da Postagem $i. Este é um texto de exemplo para demonstrar o conteúdo de uma postagem.",
                'categoria_id' => $categoriaId,
                'user_id' => $userId,
                'created_at' => Carbon::now()->subDays(12 - $i), // Datas decrescentes
                'updated_at' => Carbon::now()->subDays(12 - $i),
            ];
        }
        DB::table('postagens')->insert($postagens);
    }
}
