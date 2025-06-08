<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage; // Para upload de avatar

class UserController extends Controller
{
    public function alterarSenha()
    {
        return view('user.alterar-senha');
    }

    public function updateSenha(Request $request)
    {
        $request->validate([
            'password_old' => 'required',
            'password_new' => 'required|min:8',
            'password_new_2' => 'required|same:password_new',
        ], [
            'password_old.required' => 'A senha antiga é obrigatória.',
            'password_new.required' => 'A nova senha é obrigatória.',
            'password_new.min' => 'A nova senha precisa ter no mínimo :min caracteres.',
            'password_new_2.required' => 'A repetição da nova senha é obrigatória.',
            'password_new_2.same' => 'As novas senhas não conferem.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_old, $user->password)) {
            return redirect()->back()->with('error', 'A senha antiga não confere.');
        }

        $user->password = Hash::make($request->password_new);
        $user->save();

        return redirect()->back()->with('success', 'Senha alterada com sucesso!');
    }

    public function perfil()
    {
        return view('user.perfil');
    }

    public function editarPerfil()
    {
        return view('user.editar_perfil');
    }

    public function updatePerfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nome' => 'required|string|max:255',
            'sobrenome' => 'nullable|string|max:255',
            'usuario' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Garante que o nome de usuário seja único
            ],
            'data_nascimento' => 'nullable|date',
            'genero' => 'nullable|string|max:50',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Garante que o email seja único
            ],
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'localizacao' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024', // Max 1MB
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.unique' => 'Este e-mail já está em uso por outro usuário.',
            'usuario.unique' => 'Este nome de usuário já está em uso.',
            'avatar.max' => 'A imagem do avatar não pode exceder 1MB.',
            'avatar.image' => 'O arquivo deve ser uma imagem válida.',
            'avatar.mimes' => 'O avatar deve ser um arquivo do tipo: jpeg, png, jpg, gif.',
        ]);

        $userData = $request->except(['_token', '_method', 'avatar']);

        if ($request->hasFile('avatar')) {
            // Deletar avatar antigo se existir e não for padrão
            if ($user->avatar && Storage::exists(str_replace('/storage/', 'public/', $user->avatar))) {
                Storage::delete(str_replace('/storage/', 'public/', $user->avatar));
            }
            $path = $request->file('avatar')->store('public/avatars'); // Salva em storage/app/public/avatars
            $userData['avatar'] = Storage::url($path); // Pega a URL pública
        }

        $user->update($userData);

        return redirect()->route('user.perfil')->with('success', 'Perfil atualizado com sucesso!');
    }
}
