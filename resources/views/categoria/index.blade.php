@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Gerenciamento de Categorias</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Categorias</h3>
            <div class="card-tools">
                <a href="{{ route('categoria.create') }}" class="btn btn-success btn-sm">Nova Categoria</a>
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
                        <th>Nome</th>
                        <th>Criação</th>
                        <th>Última Atualização</th>
                        <th style="width: 150px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nome }}</td>
                            <td>{{ $categoria->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $categoria->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('categoria.show', $categoria->id) }}" class="btn btn-info btn-sm">Visualizar</a>
                                <a href="{{ route('categoria.edit', $categoria->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Nenhuma categoria encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $categorias->links() }}
            </div>
        </div>
    </div>
@stop
