@extends('adminlte::page')

@section('title', 'Alterar Senha')

@section('content_header')
    <h1>Alterar Senha de <strong>{{ Auth::user()->nome }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulário de Alteração de Senha</h3>
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
            <form action="{{ route('admin.update.senha') }}" method="POST">
                @csrf
                @method('PUT') {{-- Para simular o método PUT --}}

                <div class="form-group">
                    <label for="password_old">Senha Antiga:</label>
                    <input type="password" name="password_old" id="password_old" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password_new">Nova Senha:</label>
                    <input type="password" name="password_new" id="password_new" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password_new_2">Repita a Senha Nova:</label>
                    <input type="password" name="password_new_2" id="password_new_2" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Alterar Senha</button>
            </form>
        </div>
    </div>
@stop
