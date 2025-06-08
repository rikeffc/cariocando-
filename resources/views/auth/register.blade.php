<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se - Cariocando.com</title>
    <link rel="stylesheet" href="{{ asset('cariocando_assets/styles.css') }}">
    <style>
        /* Seus estilos CSS personalizados aqui */
        body.auth-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f2f5;
        }
        .auth-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        .auth-container h2 {
            margin-bottom: 30px;
        }
        .auth-container .form-group {
            text-align: left;
            margin-bottom: 20px;
        }
        .auth-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .auth-container input[type="text"],
        .auth-container input[type="email"],
        .auth-container input[type="tel"],
        .auth-container input[type="password"] {
            width: calc(100% - 20px);
            padding: 12px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            background-color: #f9f9f9;
        }
        .auth-container .terms {
            display: flex;
            align-items: flex-start;
            margin-top: 25px;
            font-size: 0.9em;
        }
        .auth-container .terms input[type="checkbox"] {
            margin-right: 10px;
            margin-top: 5px;
        }
        .auth-container .terms a {
            color: #007bff;
            text-decoration: none;
        }
        .auth-container .terms a:hover {
            text-decoration: underline;
        }
        .auth-container .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            width: 100%;
            margin-top: 25px;
            transition: background-color 0.3s;
        }
        .auth-container .btn-primary:hover {
            background-color: #0056b3;
        }
        .auth-container .extra-links {
            margin-top: 25px;
            font-size: 0.95em;
        }
        .auth-container .extra-links a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .auth-container .extra-links a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            font-size: 0.85em;
            margin-top: 5px;
            display: block; /* Garante que a mensagem de erro apareça */
        }
    </style>
</head>
<body class="auth-page">
    <div class="auth-container">
        <h2 style="color: #007bff; font-weight: bold;">Cadastre-se</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="nome-completo">Nome completo:</label>
                {{-- Nome do campo 'name' para o Laravel UI --}}
                <input type="text" id="nome-completo" name="nome" placeholder="Insira seu nome" value="{{ old('nome') }}" required autocomplete="name" autofocus>
                @error('nome')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" id="sobrenome" name="sobrenome" placeholder="Insira seu sobrenome" value="{{ old('sobrenome') }}" autocomplete="family-name">
                @error('sobrenome')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
             <div class="form-group">
                <label for="usuario">Nome de Usuário:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Crie seu nome de usuário" value="{{ old('usuario') }}" autocomplete="username">
                @error('usuario')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                {{-- Nome do campo 'telefone' para o Laravel UI --}}
                <input type="tel" id="celular" name="telefone" placeholder="Insira seu número fixo ou celular" value="{{ old('telefone') }}" required autocomplete="tel">
                @error('telefone')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Insira seu e-mail" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                {{-- Nome do campo 'password' para o Laravel UI --}}
                <input type="password" id="senha" name="password" placeholder="Insira sua senha" required autocomplete="new-password">
                @error('password')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="repita-senha">Repita sua senha:</label>
                {{-- Nome do campo 'password_confirmation' para o Laravel UI --}}
                <input type="password" id="repita-senha" name="password_confirmation" placeholder="Repita sua senha" required autocomplete="new-password">
            </div>
            <div class="terms">
                <input type="checkbox" id="termos" name="termos" required>
                <label for="termos">Ao clicar em cadastrar, concordo que li e aceito os <a href="#">Termos de Uso</a>, <a href="#">Condições Gerais do Seguro</a> e <a href="#">Cobertura do produto</a>.</label>
            </div>
            <button type="submit" class="btn-primary">Cadastrar</button>
        </form>
        <div class="extra-links">
            <p style="margin-top: 15px;">Já tem uma conta? <a href="{{ route('login') }}">Faça Login</a></p>
        </div>
    </div>
</body>
</html>
