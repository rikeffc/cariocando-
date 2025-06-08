<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - Cariocando.com</title>
    <link rel="stylesheet" href="{{ asset('cariocando_assets/styles.css') }}">
    <style>
        /* Estilos do auth-page e auth-container (mantidos do seu CSS original) */
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
        .auth-container input[type="email"] {
            width: calc(100% - 20px);
            padding: 12px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            background-color: #f9f9f9;
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
        .logo-auth {
            color: #F47920;
        }
    </style>
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="logo-auth" style="text-align: center; font-size: 20px; font-weight: bold; color: #F47920; margin-bottom: 10px;">CARIOCANDO.COM</div>
        <h2 style="color: #007bff; font-weight:bold;">Recuperar senha</h2>
        <p style="margin-bottom: 20px; color: #555;">Informe seu e-mail de acesso:</p>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <input type="email" id="email-recuperacao" name="email" placeholder="Insira seu e-mail" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <p style="font-size: 0.85em; color: #777; margin-bottom: 20px;">Você irá receber um email no endereço informado acima contendo as instruções para criar a nova senha deste usuário.</p>
            <button type="submit" class="btn-primary">Enviar e-mail</button>
        </form>
        <div class="extra-links">
            <a href="{{ route('login') }}">Voltar para Login</a>
        </div>
    </div>
</body>
</html>
