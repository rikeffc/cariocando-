<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cariocando.com</title>
    <link rel="stylesheet" href="{{ asset('cariocando_assets/styles.css') }}">
    <style>
        /* Estilos do auth-page e auth-container */
        .auth-page {
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
        .logo-auth {
            color: #007bff;
        }
        .social-login {
            margin-bottom: 25px;
        }
        .social-login button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            background-color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .social-login button img {
            margin-right: 10px;
        }
        .social-login button:hover {
            background-color: #f0f0f0;
        }
        .or-separator {
            margin: 20px 0;
            color: #999;
            position: relative;
            font-size: 0.9em;
        }
        .or-separator::before,
        .or-separator::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background-color: #eee;
        }
        .or-separator::before { left: 0; }
        .or-separator::after { right: 0; }

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
        .auth-container input[type="email"],
        .auth-container input[type="password"] {
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
        .error-message {
            color: red;
            font-size: 0.85em;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="logo-auth" style="text-align: center; font-size: 28px; font-weight: bold; color: #007bff; margin-bottom: 20px;">Login</div>

        <div class="social-login">
            <button><img src="https://via.placeholder.com/20/3B5998/FFFFFF?Text=F" alt="Facebook Icon"> Entre com o Facebook</button>
            <button><img src="https://via.placeholder.com/20/DB4437/FFFFFF?Text=G" alt="Google Icon"> Entre com o Google</button>
        </div>

        <p class="or-separator">OU</p>
        <p style="margin-bottom: 15px; color: #555;">Acesse com seu e-mail e senha</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Insira seu e-mail" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="password" placeholder="Insira sua senha" required autocomplete="current-password">
                @error('password')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn-primary">Efetuar Login</button>
        </form>

        <div class="extra-links">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Esqueceu?</a>
            @endif
            <p style="margin-top: 15px;">Ainda sem login? <a href="{{ route('register') }}">Cadastre-se aqui</a></p>
        </div>
    </div>
</body>
</html>
