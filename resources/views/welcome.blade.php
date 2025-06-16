@extends('layouts.cariocando')

@section('title', 'Cariocando.com: Encontre o melhor roteiro para seu passeio no RJ')

@section('content')
    @push('styles')
    <style>
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
        .hero {
            background-image: url('{{ asset('cariocando_assets/fundo-rio.jpg') }}');
            height: 100vh;
             background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #7b9c32;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            }

            .navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 40px;
}

.logo {
  font-size: 24px;
  font-weight: bold;
}

.nav-links {
  list-style: none;
  display: flex;
  gap: 30px;
}

.nav-links a {
  text-decoration: none;
  color: white;
  font-weight: 600;
}

.login {
  display: flex;
  align-items: center;
  gap: 10px;
}

.login a {
  text-decoration: none;
  color: white;
  font-weight: bold;
}

.login img {
  width: 28px;
}

.hero-content {
  text-align: center;
  margin-bottom: 100px;
}

.hero-content h1 {
  font-size: 36px;
  color: #7b9c32;
  background-color: rgba(255,255,255,0.7);
  display: inline-block;
  padding: 20px 30px;
  border-radius: 10px;
}

/* Seção de destaques */
.features {
  padding: 60px 40px;
  background-color: white;
  text-align: center;
}

.features h2 {
  color: #8a9a3c;
  font-size: 28px;
  margin-bottom: 50px;
}

.feature-cards {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 40px;
}

.feature {
  max-width: 300px;
  text-align: center;
}

.feature img {
  width: 60px;
  height: auto;
  margin-bottom: 20px;
}

.feature .title {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 15px;
}

.orange {
  color: #ff5a1f;
}

.feature p {
  font-size: 15px;
  color: #333;
  line-height: 1.5;
}
.pontos-turisticos {
  padding: 60px 40px;
  text-align: center;
  background-color: #fff;
}

.pontos-turisticos h2 {
  color: #7b9c32;
  font-size: 28px;
  margin-bottom: 10px;
}

.pontos-turisticos .subtexto {
  font-size: 16px;
  color: #333;
  margin-bottom: 40px;
}

.cards {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 30px;
}

.card {
  background-color: white;
  border-radius: 20px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  overflow: hidden;
  width: 300px;
  text-align: left;
  transition: transform 0.3s ease;
}

.card:hover {
  transform: scale(1.03);
}

.card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.card-content {
  padding: 15px 20px;
}

.card-content h3 {
  margin: 0 0 5px 0;
  font-size: 20px;
  font-weight: bold;
  color: #000;
}

.card-content p {
  margin: 0;
  color: #333;
  font-size: 14px;
}

.icon {
  margin-right: 5px;
}

    </style>

    <header class="hero" style="background-image: url('{{ asset('cariocando_assets/fundo-rio.jpg') }}');">
        <div class="hero-content">
            <h1>Encontre o melhor roteiro<br> para seu passeio no RJ.</h1>
        </div>
    </header>

    <section class="features">
        <h2>Porque escolher o Cariocando.com?</h2>
        <div class="feature-cards">
            <div class="feature">
                <img src="{{ asset('cariocando_assets/map-icon.png') }}" alt="Ícone de mapa">
                <h3 class="title orange">Vários roteiros</h3>
                <p>
                    O Cariocando oferece diversos roteiros para explorar o Rio de Janeiro, desde passeios pelas praias famosas até trilhas na Floresta da Tijuca. Há opções para todos os gostos, como roteiros culturais, gastronômicos e de aventura, garantindo uma experiência completa na cidade.
                </p>
            </div>
            <div class="feature">
                <img src="{{ asset('cariocando_assets/users-icon.png') }}" alt="Ícone de usuários">
                <h3 class="title orange">+ 1.000 Usuários</h3>
                <p>
                    No Cariocando, mais de mil usuários compartilham suas experiências e dicas sobre o Rio de Janeiro, criando uma comunidade rica em informações sobre as melhores atrações, eventos e locais da cidade.
                </p>
            </div>
            <div class="feature">
                <img src="{{ asset('cariocando_assets/chat-icon.png') }}" alt="Ícone de conversa">
                <h3 class="title orange">Comunidade Interativa</h3>
                <p>
                    A Comunidade Interativa Cariocando conecta usuários que compartilham dicas e experiências sobre o Rio de Janeiro. Troque ideias sobre praias, eventos e passeios, e descubra novos lugares com quem conhece a cidade!
                </p>
            </div>
        </div>
    </section>

    <section class="pontos-turisticos">
        <h2>Saiba quais são os pontos turísticos mais visitados do RJ</h2>
        <p class="subtexto">
            Descubra os pontos turísticos mais visitados do Rio, como o Cristo Redentor, Pão de Açúcar,
            Copacabana e o Maracanã, atrações que encantam turistas com sua beleza e história.
        </p>

        <div class="cards">
            <div class="card">
                <img src="{{ asset('cariocando_assets/cristo-redentor.jpg') }}" alt="Cristo Redentor" />
                <div class="card-content">
                    <h3>Cristo Redentor</h3>
                    <p><span class="icon">📍</span> Cosme Velho, RJ</p>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('cariocando_assets/pao-de-acucar.jpg') }}" alt="Pão de Açúcar" />
                <div class="card-content">
                    <h3>Pão de Açúcar</h3>
                    <p><span class="icon">📍</span> Urca, RJ</p>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('cariocando_assets/parque-lage.jpg') }}" alt="Parque Lage" />
                <div class="card-content">
                    <h3>Parque Lage</h3>
                    <p><span class="icon">📍</span> Jardim Botânico, RJ</p>
                </div>
            </div>
        </div>
    </section>

    <section class="roteiros">
        <h2>Nossos Roteiros Recentes</h2>
        <div class="roteiros-grid">
            @forelse($postagens as $postagem)
                <a href="{{ route('site.roteiro.detalhe', $postagem->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="roteiro-card">
                        {{-- Lógica para imagem de capa (tentando extrair de descricao se Base64 ou fallback) --}}
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
                                {!! Str::limit(strip_tags($postagem->descricao), 70) !!} {{-- Exibe trecho da descrição sem HTML --}}
                            </p>
                            <div class="card-meta" style="margin-bottom:10px;">
                                <span class="card-rating">
                                    @php
                                        // As aulas não definiram campo de avaliação em postagens. Gerando aleatoriamente.
                                        $rating = rand(3,5);
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo $i <= $rating ? '★' : '☆';
                                        }
                                    @endphp
                                </span>
                            </div>
                            <div class="card-actions">
                                <div>
                                    {{-- Assumindo que o user tem um avatar na tabela de users ou gravatar --}}
                                    <img src="{{ $postagem->autor->avatar ?: 'https://via.placeholder.com/30/F47920/FFFFFF?Text=' . (isset($postagem->autor->nome[0]) ? $postagem->autor->nome[0] : 'U') }}" alt="{{ $postagem->autor->nome ?? 'Autor Desconhecido' }}" class="user-avatar">
                                    <span>{{ $postagem->autor->nome ?? 'Autor Desconhecido' }}</span>
                                </div>
                                <span class="post-time">{{ $postagem->created_at->format('d \d\e F \d\e Y') }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <p style="text-align:center; grid-column: 1 / -1; color: #777; padding: 20px;">Nenhum roteiro publicado ainda. Seja o primeiro a compartilhar sua experiência!</p>
            @endforelse
        </div>

        <div class="pagination-controls" id="paginationControls">
            {!! $postagens->links() !!} {{-- Links de Paginação --}}
        </div>
    </section>
@endsection
