@extends('adminlte::page')

@section('title', 'Detalhes da Postagem')

@section('content_header')
    <h1>Detalhes da Postagem: {{ $postagem->titulo }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informações da Postagem</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <strong>ID:</strong> {{ $postagem->id }}
            </div>
            <div class="form-group">
                <strong>Título:</strong> {{ $postagem->titulo }}
            </div>
            <div class="form-group">
                <strong>Descrição:</strong>
                <div>{!! $postagem->descricao !!}</div> {{-- Renderiza o HTML do Rick Editor --}}
            </div>
            <div class="form-group">
                <strong>Categoria:</strong> {{ $postagem->categoria->nome ?? 'N/A' }}
            </div>
            <div class="form-group">
                <strong>Autor:</strong> {{ $postagem->autor->nome ?? 'N/A' }}
            </div>
            <div class="form-group">
                <strong>Criado em:</strong> {{ $postagem->created_at->format('d/m/Y H:i:s') }}
            </div>
            <div class="form-group">
                <strong>Última atualização:</strong> {{ $postagem->updated_at->format('d/m/Y H:i:s') }}
            </div>
            <a href="{{ route('postagem.index') }}" class="btn btn-primary">Voltar para a Lista</a>
        </div>
    </div>
@stop
