<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('sobrenome')->nullable(); // Certifique-se que é nullable ou required na validação
            $table->string('usuario')->unique()->nullable(); // Certifique-se que é nullable ou required na validação, e unique
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('genero')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('telefone')->nullable(); // Certifique-se que é nullable ou required
            $table->string('endereco')->nullable();
            $table->string('localizacao')->nullable();
            $table->text('bio')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
