<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nome' => 'Sapato', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Meia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Tênis', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
