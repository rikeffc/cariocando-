@extends('layouts.cariocando')

@section('title', 'Meu Perfil - Cariocando.com')

@push('styles')
    <style>
        .profile-view-header { text-align: center; margin-bottom: 30px; background-image: url('https://via.placeholder.com/1200x250/ADD8E6/000000?text=Capa+do+Perfil+(Opcional)'); background-size: cover; background-position: center; padding: 40px 20px; border-radius: 8px; position: relative; }
        .profile-view-avatar { width: 120px; height: 120px; border-radius: 50%; background-color: #ccc; margin: -60px auto 20px auto; border: 4px solid white; display: flex; justify-content: center; align-items: center; font-size: 4em; color: white; overflow: hidden; position: relative; z-index: 2; }
        .profile-view-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .profile-view-name { font-size: 2em; font-weight: bold; color: #333; margin-top: 0; }
        .profile-view-username { font-size: 1.1em; color: #777; margin-bottom: 20px; }
        .profile-details-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .profile-detail-item { background-color: #f9f9f9; padding: 15px; border-radius: 6px; border-left: 4px solid #F47920; }
        .profile-detail-item strong { display: block; color: #555; margin-bottom: 5px; font-size: 0.9em; }
        .profile-detail-item span { color: #333; word-break: break-word; }
        .profile-bio { grid-column: 1 / -1; line-height: 1.6; }
        .profile-actions-footer { text-align: center; margin-top: 30px; }
        .profile-actions-footer .btn { padding: 12px 25px; margin: 5px 10px; border-radius: 25px; cursor: pointer; font-weight: bold; font-size: 1em; text-decoration: none; transition: all 0.3s ease; }
        .profile-actions-footer .btn-edit-profile { background-color: #e9ecef; color: #333; border: 1px solid #ccc; }
        .profile-actions-footer .btn-edit-profile:hover { background-color: #d8dde2; }
        .profile-actions-footer .btn-new-post { background-color: #F47920; color: white; border: none; }
        .profile-actions-footer .btn-new-post:hover { background-color: #e06f1a; }
        .profile-content-tabs { margin-top:30px; text-align: center; padding: 15px; background-color: #fff; border-radius: 8px;}
        /* Estilos para o grid de roteiros no perfil (copiado de roteiros.blade.php) */
        .roteiros-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        .roteiro-card {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%; /* Ajuste para preencher a coluna do grid */
            text-align: left;
            transition: transform 0.3s ease;
        }
        .roteiro-card:hover {
            transform: scale(1.03);
        }
        .roteiro-card .card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .roteiro-card .card-content {
            padding: 15px 20px;
        }
        .roteiro-card .card-content h3 {
            margin: 0 0 5px 0;
            font-size: 20px;
            font-weight: bold;
            color: #000;
        }
        .roteiro-card .card-content p {
            margin: 0;
            color: #333;
            font-size: 14px;
        }
        .roteiro-card .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9em;
            color: #666;
        }
        .roteiro-card .card-rating {
            color: #F47920;
            font-size: 1.2em;
        }
        .roteiro-card .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }
        .roteiro-card .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 8px;
        }
        .roteiro-card .post-time {
            font-size: 0.85em;
            color: #999;
        }
    </style>
@endpush

@section('content')
    <div class="profile-view-header"></div>
    <div class="profile-view-avatar" id="profileAvatar">
        @if(Auth::user()->avatar)
            <img src="{{ Auth::user()->avatar }}" alt="Avatar de {{ Auth::user()->nome }}">
        @else
            {{ Auth::user()->nome[0] ?? 'U' }}
        @endif
    </div>
    <h1 class="profile-view-name" id="profileFullName">{{ Auth::user()->nome }} {{ Auth::user()->sobrenome }}</h1>
    <p class="profile-view-username" id="profileUsername">@if(Auth::user()->usuario){{ Auth::user()->usuario }}@else{{ Str::before(Auth::user()->email, '@') }}@endif</p>

    <div class="profile-details-grid">
        <div class="profile-detail-item profile-bio"><strong>Bio:</strong><span id="profileBio">{{ Auth::user()->bio ?? 'Nenhuma bio adicionada ainda.' }}</span></div>
        <div class="profile-detail-item"><strong>Email:</strong><span id="profileEmail">{{ Auth::user()->email ?? 'Não informado' }}</span></div>
        <div class="profile-detail-item"><strong>Celular:</strong><span id="profileCelular">{{ Auth::user()->telefone ?? 'Não informado' }}</span></div>
        <div class="profile-detail-item"><strong>Data de Nascimento:</strong><span id="profileDataNascimento">
            @if(Auth::user()->data_nascimento){{ \Carbon\Carbon::parse(Auth::user()->data_nascimento)->format('d/m/Y') }}@else Não informada @endif
        </span></div>
        <div class="profile-detail-item"><strong>Gênero:</strong><span id="profileGenero">{{ Auth::user()->genero ?? 'Não informado' }}</span></div>
        <div class="profile-detail-item"><strong>Endereço:</strong><span id="profileEndereco">{{ Auth::user()->endereco ?? 'Não informado' }}</span></div>
        <div class="profile-detail-item"><strong>Localização:</strong><span id="profileLocalizacao">{{ Auth::user()->localizacao ?? 'Não informado' }}</span></div>
    </div>

    <div class="profile-actions-footer">
        <a href="{{ route('user.editar.perfil') }}" class="btn btn-edit-profile">Editar perfil</a>
        <a href="{{ route('postagem.create') }}" class="btn btn-new-post">Publicar Novo Roteiro</a>
    </div>

    <div class="profile-content-tabs">
        <h3>Meus Roteiros</h3>
        {{-- Aqui você pode listar os roteiros do usuário logado, semelhante à página welcome, mas filtrando por user_id --}}
        @php
            // Necessário carregar o trait Str no topo do arquivo se não estiver globalmente disponível
            // use Illuminate\Support\Str; // Adicione se necessário
            $meusRoteiros = \App\Models\Postagem::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        @endphp
        <div class="roteiros-grid">
            @forelse($meusRoteiros as $postagem)
                <a href="{{ route('site.roteiro.detalhe', $postagem->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="roteiro-card">
                        @php
                            $firstImage = null;
                            if (preg_match('/<img[^>]+src="data:image\/[^;]+;base64,([^"]+)"/', $postagem->descricao, $matches)) {
                                $firstImage = 'data:image/jpeg;base64,' . $matches[1];
                            }
                        @endphp
                        <img src="{{ $firstImage ?: asset('cariocando_assets/sem_capa.png') }}" alt="{{ $postagem->titulo }}" class="card-img">
                        <div class="card-content">
                            <h3>{{ $postagem->titulo }}</h3>
                            <p style="font-size: 0.85em; color: #666; min-height: 30px; margin-bottom:10px;">
                                {!! Str::limit(strip_tags($postagem->descricao), 70) !!}
                            </p>
                            <div class="card-meta" style="margin-bottom:10px;">
                                <span class="card-rating">
                                    @php
                                        $rating = rand(3,5); // Aulas não definiram campo de avaliação em postagens. Gerando aleatoriamente.
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo $i <= $rating ? '★' : '☆';
                                        }
                                    @endphp
                                </span>
                            </div>
                            <div class="card-actions">
                                <div>
                                    <img src="{{ Auth::user()->avatar ?: 'https://via.placeholder.com/30/F47920/FFFFFF?Text=' . (Auth::user()->nome[0] ?? 'U') }}" alt="{{ Auth::user()->nome ?? 'Autor Desconhecido' }}" class="user-avatar">
                                    <span>{{ Auth::user()->nome ?? 'Autor Desconhecido' }}</span>
                                </div>
                                <span class="post-time">{{ $postagem->created_at->format('d \d\e F \d\e Y') }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <p style="text-align:center; grid-column: 1 / -1; color: #777; padding: 20px;">Você ainda não publicou nenhum roteiro.</p>
            @endforelse
        </div>
    </div>
@endsection
