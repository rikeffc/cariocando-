@extends('layouts.cariocando')

@section('title', 'Editar Perfil - Cariocando.com')

@push('styles')
    <style>
        .profile-avatar-edit-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .profile-avatar-edit-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #ccc;
            margin-right: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.5em;
            color: white;
            overflow: hidden;
            border: 2px solid #eee;
        }
        .profile-avatar-edit-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .form-group label.file-upload-label {
            display: inline-block;
            padding: 8px 12px;
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            margin-top: 5px;
        }
        .form-group input[type="file"] {
            display: none; /* Escondemos o input padrão */
        }
        #fileNameDisplay {
            margin-left: 10px;
            font-style: italic;
            color: #555;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .form-group-full {
            grid-column: 1 / -1;
        }
        .edit-profile-actions {
            text-align: right;
            margin-top: 30px;
        }
        .edit-profile-actions .btn-sair,
        .edit-profile-actions .btn-cancelar {
            background-color: #f0f0f0;
            color: #555;
            border: 1px solid #ddd;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        .edit-profile-actions .btn-salvar {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .edit-profile-actions .btn-sair:hover,
        .edit-profile-actions .btn-cancelar:hover {
            background-color: #e0e0e0;
        }
        .edit-profile-actions .btn-salvar:hover {
            background-color: #0056b3;
        }
        .profile-header-edit {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .profile-header-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .error-message {
            color: red;
            font-size: 0.85em;
            margin-top: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="profile-header-edit">
        <div class="profile-avatar-edit-container">
            <div class="profile-avatar-edit-preview" id="avatarPreview">
                @if(Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="Avatar">
                @else
                    {{ Auth::user()->nome[0] ?? 'U' }}
                @endif
            </div>
            <div class="profile-header-details">
                <div id="avatarNomeDisplay" style="font-size: 1.2em; font-weight: bold;">{{ Auth::user()->nome }}</div>
            </div>
        </div>
    </div>

    <form class="edit-profile-form" id="editProfileForm" action="{{ route('user.update.perfil') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Laravel trata PUT/PATCH via POST + _method. UserUpdate usa POST puro. --}}
        {{-- @method('PUT') --}}

        <div class="form-group form-group-full">
            <label for="avatarUpload">Foto do Perfil:</label>
            <input type="file" id="avatarUpload" name="avatar" accept="image/*">
            <label for="avatarUpload" class="file-upload-label">Escolher arquivo...</label>
            <span id="fileNameDisplay">Nenhum arquivo selecionado</span>
            <small style="display:block; margin-top:5px; color:#777;">Use imagens pequenas (ex: JPG, PNG menores que 1MB) para melhor performance.</small>
            @error('avatar')
                <span class="error-message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Seu nome" value="{{ old('nome', Auth::user()->nome) }}" required>
                @error('nome')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" id="sobrenome" name="sobrenome" placeholder="Seu sobrenome" value="{{ old('sobrenome', Auth::user()->sobrenome) }}">
                @error('sobrenome')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group form-group-full">
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Seu nome de usuário" value="{{ old('usuario', Auth::user()->usuario) }}">
                @error('usuario')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="dataNascimento">Data de nascimento:</label>
                <input type="date" id="dataNascimento" name="data_nascimento" value="{{ old('data_nascimento', Auth::user()->data_nascimento) }}">
                @error('data_nascimento')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="genero">Gênero:</label>
                <select id="genero" name="genero" class="form-control" style="padding: 10px; width: 100%; border: 1px solid #ddd; border-radius: 4px; background-color: #f9f9f9;">
                    <option value="" @if(old('genero', Auth::user()->genero) == '') selected @endif>Prefiro não informar</option>
                    <option value="Feminino" @if(old('genero', Auth::user()->genero) == 'Feminino') selected @endif>Feminino</option>
                    <option value="Masculino" @if(old('genero', Auth::user()->genero) == 'Masculino') selected @endif>Masculino</option>
                    <option value="Outro" @if(old('genero', Auth::user()->genero) == 'Outro') selected @endif>Outro</option>
                </select>
                @error('genero')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="seu@email.com" value="{{ old('email', Auth::user()->email) }}" required>
                @error('email')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="tel" id="celular" name="telefone" placeholder="(XX) XXXXX-XXXX" value="{{ old('telefone', Auth::user()->telefone) }}">
                @error('telefone')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group form-group-full">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" placeholder="Sua rua, número, bairro" value="{{ old('endereco', Auth::user()->endereco) }}">
                @error('endereco')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group form-group-full">
                <label for="localizacao">Localização (Cidade, Estado):</label>
                <input type="text" id="localizacao" name="localizacao" placeholder="Ex: Rio de Janeiro, RJ" value="{{ old('localizacao', Auth::user()->localizacao) }}">
                @error('localizacao')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group form-group-full">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" rows="4" placeholder="Conte um pouco sobre você...">{{ old('bio', Auth::user()->bio) }}</textarea>
                @error('bio')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="edit-profile-actions">
            <button type="button" class="btn-sair" onclick="window.location.href='{{ route('user.perfil') }}'">Sair ↪</button>
            <button type="button" class="btn-cancelar" onclick="window.location.href='{{ route('user.perfil') }}'">Cancelar</button>
            <button type="submit" class="btn-salvar">Salvar</button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const avatarPreview = document.getElementById('avatarPreview');
        const avatarNomeDisplay = document.getElementById('avatarNomeDisplay');
        const avatarUploadInput = document.getElementById('avatarUpload');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const currentUserName = document.getElementById('nome').value;
        // Use o avatar atual do usuário logado. Se for URL, já funcionará.
        // Se for Base64 e você o salva no DB, ele virá como string Base64.
        const currentAvatar = '{{ Auth::user()->avatar }}';

        // Função para atualizar a pré-visualização do avatar
        function updateAvatarPreview(avatarSource, name) {
            if (avatarSource && avatarSource !== 'null' && avatarSource !== '') { // Verifica se há uma fonte de avatar
                avatarPreview.innerHTML = `<img src="${avatarSource}" alt="Avatar">`;
            } else if (name && name.trim() !== "") {
                avatarPreview.innerHTML = name.charAt(0).toUpperCase();
                avatarPreview.style.backgroundColor = '#F47920'; // Cor padrão se não tiver imagem
            } else {
                avatarPreview.innerHTML = 'U'; // Default se nome vazio
                avatarPreview.style.backgroundColor = '#cccccc';
            }
            avatarNomeDisplay.textContent = name || 'Nome';
        }

        // Inicializar a pré-visualização com dados do Laravel
        updateAvatarPreview(currentAvatar, currentUserName);

        // Listener para o campo de upload de arquivo
        avatarUploadInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                fileNameDisplay.textContent = file.name;
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Atualiza a pré-visualização com a nova imagem em Base64
                    updateAvatarPreview(e.target.result, document.getElementById('nome').value);
                    if (file.size > 1024 * 1024) { // Maior que 1MB
                        alert("A imagem selecionada é grande (>1MB). Isso pode afetar o desempenho ou não ser salvo corretamente.");
                    }
                }
                reader.readAsDataURL(file); // Converte a imagem para Base64
            } else {
                fileNameDisplay.textContent = "Nenhum arquivo selecionado";
                // Volta para o avatar atual do usuário se nenhum arquivo for selecionado
                updateAvatarPreview(currentAvatar, document.getElementById('nome').value);
            }
        });

        // Atualizar pré-visualização ao digitar o nome
        document.getElementById('nome').addEventListener('input', function(e) {
            // Tenta manter a imagem se já houver uma, caso contrário, usa a inicial do servidor
            const currentPreviewSource = avatarPreview.querySelector('img') ? avatarPreview.querySelector('img').src : currentAvatar;
            updateAvatarPreview(currentPreviewSource, e.target.value);
        });
    });
</script>
@endpush
