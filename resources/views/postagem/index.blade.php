@extends('adminlte::page')

@section('title', 'Postagens')

@section('content_header')
    <h1>Gerenciamento de Postagens</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Postagens</h3>
            <div class="card-tools">
                <a href="{{ route('postagem.create') }}" class="btn btn-success btn-sm">Nova Postagem</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Autor</th>
                        <th>Criação</th>
                        <th style="width: 180px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($postagens as $postagem)
                        <tr>
                            <td>{{ $postagem->id }}</td>
                            <td>{{ $postagem->titulo }}</td>
                            <td>{{ $postagem->categoria->nome ?? 'N/A' }}</td>
                            <td>{{ $postagem->autor->nome ?? 'N/A' }}</td>
                            <td>{{ $postagem->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('postagem.show', $postagem->id) }}" class="btn btn-info btn-sm">Visualizar</a>
                                <a href="{{ route('postagem.edit', $postagem->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('postagem.destroy', $postagem->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta postagem?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Nenhuma postagem encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $postagens->links() }}
            </div>
        </div>
    </div>
@stop
