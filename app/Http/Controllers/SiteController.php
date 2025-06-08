<?php

namespace App\Http\Controllers;

use App\Models\Categoria; // VERIFIQUE ESTA LINHA COM ATENÇÃO
use App\Models\Postagem;  // VERIFIQUE ESTA LINHA COM ATENÇÃO
use App\Models\User;      // VERIFIQUE ESTA LINHA COM ATENÇÃO
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Geralmente já está lá, mas verifique

class SiteController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nome', 'asc')->get();
        $autores = User::orderBy('nome', 'asc')->get();
        $postagens = Postagem::orderBy('created_at', 'desc')->paginate(8);

        return view('welcome', compact('categorias', 'autores', 'postagens'));
    }

    public function postagensByCategoriaId(string $id)
    {
        $categorias = Categoria::orderBy('nome', 'asc')->get();
        $autores = User::orderBy('nome', 'asc')->get();
        $postagens = Postagem::where('categoria_id', $id)->orderBy('created_at', 'desc')->paginate(8);

        return view('welcome', compact('categorias', 'autores', 'postagens'));
    }

    public function showPostagemDetalhe(string $id)
    {
        $postagem = Postagem::find($id);
        if (!$postagem) {
            return redirect()->route('site.principal')->with('error', 'Roteiro não encontrado.');
        }
        return view('roteiro_detalhe', compact('postagem'));
    }

    public function contato()
    {
        return view('contato');
    }

    public function quemSomos()
    {
        return view('quemsomos');
    }
}
