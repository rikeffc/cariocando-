<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Importa o modelo User
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // Para usar Str::before

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Ou para onde você quer redirecionar

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => ['required', 'string', 'max:255'],
            'sobrenome' => ['nullable', 'string', 'max:255'],
            'usuario' => ['nullable', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefone' => ['required', 'string', 'max:20'], // De 'celular' para 'telefone'
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' verifica 'password_confirmation'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nome' => $data['nome'],
            'sobrenome' => $data['sobrenome'] ?? null,
            'usuario' => $data['usuario'] ?? Str::before($data['email'], '@'), // Se usuário for opcional, gera um do email
            'email' => $data['email'],
            'telefone' => $data['telefone'],
            'password' => Hash::make($data['password']),
            // Campos adicionais como avatar, genero, data_nascimento, endereco, localizacao, bio
            // Serão preenchidos no Editar Perfil, mas podem ser adicionados aqui se forem obrigatórios no cadastro.
        ]);
    }
}
