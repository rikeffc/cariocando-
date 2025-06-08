<?php

namespace App\Http\Controllers;

use App\Models\Postagem;
use App\Models\Categoria; // Para carregar categorias no formulário
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Para pegar o usuário logado

class PostagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postagens = Postagem::orderBy('titulo', 'asc')->paginate(10);
        return view('postagem.index', compact('postagens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        // Se precisar de $categoriasData, mantenha também:
        $categoriasData = Categoria::with('subcategorias')->get()->mapWithKeys(function($cat) {
            return [$cat->id => $cat->subcategorias->map(function($sub) {
                return ['id' => $sub->id, 'nome' => $sub->nome];
            })];
        });
        return view('postagem.create', compact('categorias', 'categoriasData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|min:5',
            'descricao' => 'required|min:10',
            'categoria_id' => 'required|exists:categorias,id', // Garante que a categoria exista
        ], [
            'titulo.required' => 'O título é obrigatório.',
            'titulo.min' => 'O título precisa ter no mínimo :min caracteres.',
            'descricao.required' => 'A descrição é obrigatória.',
            'descricao.min' => 'A descrição precisa ter no mínimo :min caracteres.',
            'categoria_id.required' => 'A categoria é obrigatória.',
            'categoria_id.exists' => 'A categoria selecionada não é válida.',
        ]);

        $postagem = new Postagem();
        $postagem->titulo = $request->titulo;
        $postagem->descricao = $request->descricao;
        $postagem->categoria_id = $request->categoria_id;
        $postagem->user_id = Auth::user()->id; // Vincula ao usuário logado
        $postagem->save();

        return redirect()->route('postagem.index')->with('success', 'Postagem cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $postagem = Postagem::find($id);
        if (!$postagem) {
            return redirect()->route('postagem.index')->with('error', 'Postagem não encontrada.');
        }
        return view('postagem.show', compact('postagem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postagem = Postagem::find($id);
        if (!$postagem) {
            return redirect()->route('postagem.index')->with('error', 'Postagem não encontrada.');
        }
        $categorias = Categoria::orderBy('nome', 'asc')->get(); // Para o dropdown de categorias
        return view('postagem.edit', compact('postagem', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titulo' => 'required|min:5',
            'descricao' => 'required|min:10',
            'categoria_id' => 'required|exists:categorias,id',
        ], [
            'titulo.required' => 'O título é obrigatório.',
            'titulo.min' => 'O título precisa ter no mínimo :min caracteres.',
            'descricao.required' => 'A descrição é obrigatória.',
            'descricao.min' => 'A descrição precisa ter no mínimo :min caracteres.',
            'categoria_id.required' => 'A categoria é obrigatória.',
            'categoria_id.exists' => 'A categoria selecionada não é válida.',
        ]);

        $postagem = Postagem::find($id);
        if (!$postagem) {
            return redirect()->route('postagem.index')->with('error', 'Postagem não encontrada para atualização.');
        }
        $postagem->titulo = $request->titulo;
        $postagem->descricao = $request->descricao;
        $postagem->categoria_id = $request->categoria_id;
        // user_id não é alterado na atualização
           $postagem->save();

        return redirect()->route('postagem.index')->with('success', 'Postagem atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postagem = Postagem::find($id);
        if (!$postagem) {
            return redirect()->route('postagem.index')->with('error', 'Postagem não encontrada para exclusão.');
        }
        $postagem->delete();

        return redirect()->route('postagem.index')->with('success', 'Postagem excluída com sucesso!');
    }
}
