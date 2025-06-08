<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Certifique-se de ter este use statement

use App\Http\Controllers\SiteController; // Para a área pública
use App\Http\Controllers\HomeController; // Para o dashboard AdminLTE
use App\Http\Controllers\CategoriaController; // CRUD Categoria
use App\Http\Controllers\PostagemController;  // CRUD Postagem
use App\Http\Controllers\UserController;      // Alterar Senha, Perfil
use App\Http\Controllers\RoteiroController; // Para a página de roteiros

// Rotas da Área Pública
Route::get('/', [SiteController::class, 'index'])->name('site.principal');
Route::get('/roteiros', [RoteiroController::class, 'index'])->name('roteiros.index');
Route::get('/postagens/categoria/{id}', [SiteController::class, 'postagensByCategoriaId'])->name('site.postagens.by.categoria.id');
Route::get('/postagens/autor/{id}', [SiteController::class, 'postagensByAutorId'])->name('site.postagens.by.autor.id');
Route::get('/roteiro-detalhe/{id}', [SiteController::class, 'showPostagemDetalhe'])->name('site.roteiro.detalhe'); // Detalhes do roteiro
Route::get('/contato', [SiteController::class, 'contato'])->name('site.contato'); // Página de Contato
Route::get('/quem-somos', [SiteController::class, 'quemSomos'])->name('site.quem_somos'); // Página Quem Somos

// Rotas de Autenticação (Laravel UI)
Auth::routes();

// Grupo de Rotas da Área Administrativa e Funções de Usuário Protegidas (requer autenticação)
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home'); // Dashboard AdminLTE

    // Rotas CRUD para Categorias (AdminLTE)
    Route::resource('categoria', CategoriaController::class);

    // Rotas CRUD para Postagens (AdminLTE)
    Route::resource('postagem', PostagemController::class);

    // Rotas para Alteração de Senha (AdminLTE)
    Route::get('/admin/alterar-senha', [UserController::class, 'alterarSenha'])->name('admin.alterar.senha');
    Route::put('/admin/update-senha', [UserController::class, 'updateSenha'])->name('admin.update.senha');

    // Rotas para Perfil do Usuário (Frontend)
    Route::get('/perfil', [UserController::class, 'perfil'])->name('user.perfil'); // Visualizar perfil
    Route::get('/editar-perfil', [UserController::class, 'editarPerfil'])->name('user.editar.perfil'); // Formulário de edição
    Route::post('/update-perfil', [UserController::class, 'updatePerfil'])->name('user.update.perfil'); // Salvar edição (usando POST)
});


// Rota para a página de detalhes de um roteiro específico
Route::get('/roteiros/{id}', [RoteiroController::class, 'show'])->name('roteiros.show');

// Se você ainda não tem, crie rotas para login e perfil que são usadas no JS
// Exemplo (se estiver usando autenticação padrão do Laravel):
// Auth::routes(); // Para rotas de login, registro, etc.
// Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil.index')->middleware('auth');
