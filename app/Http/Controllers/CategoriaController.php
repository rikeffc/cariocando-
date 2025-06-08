<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Para validação explícita se preferir

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::orderBy('nome', 'asc')->paginate(10); // Paginação opcional
        return view('categoria.index', compact('categorias'));
    }

/**
* Show the form for creating a new resource.
*/
public function create()
{
return view('categoria.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:5',
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.min' => 'O nome da categoria precisa ter no mínimo :min caracteres.',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categoria.index')->with('success', 'Categoria cadastrada com sucesso!');
    }
       /**
* Display the specified resource.
*/
public function show(string $id)
{
$categoria = Categoria::find($id);
if (!$categoria) {
return redirect()->route('categoria.index')->with('error', 'Categoria não encontrada.');
}
return view('categoria.show', compact('categoria'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return redirect()->route('categoria.index')->with('error', 'Categoria não encontrada.');
        }
        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|min:5',
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.min' => 'O nome da categoria precisa ter no mínimo :min caracteres.',
        ]);

        $categoria = Categoria::find($id);
        if (!$categoria) {
            return redirect()->route('categoria.index')->with('error', 'Categoria não encontrada para atualização.');
        }
        $categoria->update($request->all());

        return redirect()->route('categoria.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return redirect()->route('categoria.index')->with('error', 'Categoria não encontrada para exclusão.');
        }
        $categoria->delete();

        return redirect()->route('categoria.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
