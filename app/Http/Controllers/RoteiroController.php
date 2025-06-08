<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoteiroController extends Controller
{
    /**
     * Display a listing of the roteiros.
     */
    public function index()
    {
        // A lógica de carregamento dos roteiros é feita via JavaScript (localStorage)
        // Então, apenas retornamos a view.
        return view('roteiros.index');
    }

    /**
     * Display the specified roteiro.
     */
    public function show($id)
    {
        // A view 'roteiros.show' usará JavaScript para carregar os detalhes do roteiro
        // do localStorage usando o $id.
        return view('roteiros.show', ['roteiroId' => $id]);
    }
}
