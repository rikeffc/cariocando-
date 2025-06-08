<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; // Para created_at e updated_at

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nome' => 'André Neves 1',
                'email' => 'andre1@r.com.br',
                'password' => Hash::make('123456789'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'sobrenome' => 'Neves',
                'usuario' => 'andre_n1',
                'avatar' => null,
                'genero' => 'Masculino',
                'data_nascimento' => '1990-01-01',
                'telefone' => '21987654321',
                'endereco' => 'Rua A, 123',
                'localizacao' => 'Rio de Janeiro, RJ',
                'bio' => 'Amo explorar o Rio!',
            ],
            [
                'nome' => 'André Neves 2',
                'email' => 'andre2@r.com.br',
                'password' => Hash::make('123456789'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'sobrenome' => 'Silva',
                'usuario' => 'andre_s2',
                'avatar' => null,
                'genero' => 'Masculino',
                'data_nascimento' => '1992-02-02',
                'telefone' => '21998765432',
                'endereco' => 'Rua B, 456',
                'localizacao' => 'Niterói, RJ',
                'bio' => 'Apaixonado por trilhas cariocas.',
            ],
        ]);
    }
}
