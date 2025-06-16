<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index()
{
    return view('contato');
}

public function enviar(Request $request)
{
    // Processa o formulário
    return back()->with('success', 'Mensagem enviada!');
}
}
