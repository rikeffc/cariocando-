@extends('layouts.cariocando')

@section('title', 'Contato - Cariocando.com')

@push('styles')
    <style>
        /* Additional styles specific to contact page if needed */
        .contact-form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 700px; /* Adjust as needed */
            margin: 30px auto; /* Center it in the container */
        }

        .contact-form-container h1 {
            text-align: center;
            color: #F47920; /* Orange */
            margin-bottom: 25px;
        }

        .contact-form-container .form-group {
            margin-bottom: 20px;
        }

        .contact-form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .contact-form-container input[type="text"],
        .contact-form-container input[type="email"],
        .contact-form-container input[type="tel"],
        .contact-form-container textarea {
            width: calc(100% - 22px); /* Account for padding */
            padding: 12px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1em;
            background-color: #f9f9f9;
        }

        .contact-form-container textarea {
            min-height: 120px;
            resize: vertical;
        }

        .contact-form-container button[type="submit"] {
            background-color: #8CC63F; /* Green */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
            display: block;
            width: auto; /* Or 100% if you want full width */
            margin: 20px auto 0; /* Center the button */
        }

        .contact-form-container button[type="submit"]:hover {
            background-color: #76a832; /* Darker green */
        }
    </style>
@endpush

@section('content')
    <div class="contact-form-container">
        <h1>Entre em Contato</h1>
        <form  action="{{ url('/contato') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="contact-nome">Nome Completo:</label>
                <input type="text" id="contact-nome" name="nome" placeholder="Seu nome completo" required>
            </div>
            <div class="form-group">
                <label for="contact-email">E-mail:</label>
                <input type="email" id="contact-email" name="email" placeholder="seuemail@exemplo.com" required>
            </div>
            <div class="form-group">
                <label for="contact-telefone">Telefone: (Opcional)</label>
                <input type="tel" id="contact-telefone" name="telefone" placeholder="(XX) XXXXX-XXXX">
            </div>
            <div class="form-group">
                <label for="contact-mensagem">Mensagem:</label>
                <textarea id="contact-mensagem" name="mensagem" rows="6" placeholder="Digite sua mensagem aqui..." required></textarea>
            </div>
            <button type="submit">Enviar Mensagem</button>
        </form>
    </div>
@endsection
