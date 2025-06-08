@extends('adminlte::page')

@section('title', 'Detalhes da Categoria')

@section('content_header')
    <h1>Detalhes da Categoria: {{ $categoria->nome }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informações da Categoria</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <strong>ID:</strong> {{ $categoria->id }}
            </div>
            <div class="form-group">
                <strong>Nome:</strong> {{ $categoria->nome }}
            </div>
            <div class="form-group">
                <strong>Criado em:</strong> {{ $categoria->created_at->format('d/m/Y H:i:s') }}
            </div>
            <div class="form-group">
                <strong>Última atualização:</strong> {{ $categoria->updated_at->format('d/m/Y H:i:s') }}
            </div>
            <a href="{{ route('categoria.index') }}" class="btn btn-primary">Voltar para a Lista</a>
        </div>
    </div>
@stop
