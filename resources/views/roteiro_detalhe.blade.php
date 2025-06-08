@extends('layouts.cariocando')

@section('title', 'Detalhes do Roteiro - ' . ($postagem->titulo ?? ''))

@push('styles')
    <style>
        /* Seus estilos CSS customizados para roteiro_detalhe.html aqui */
        .roteiro-detalhe-container { background-color: #fff; padding: 20px 30px; margin: 20px auto; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .roteiro-detalhe-container h1 { color: #F47920; margin-bottom: 10px; }
        .detalhe-meta-info { margin-bottom: 20px; font-size: 0.9em; color: #555; }
        .detalhe-meta-info p { margin: 5px 0; }
        .detalhe-meta-info strong { color: #333; }
        .detalhe-rating .star { font-size: 1.5em; color: #F47920; }
        .detalhe-rating .star.empty { color: #ccc; }
        .roteiro-descricao-full { line-height: 1.7; color: #333; white-space: pre-wrap; margin-bottom:25px; }
        .roteiro-imagens-galeria { margin-top: 20px; margin-bottom:25px; }
        .roteiro-imagens-galeria h3 { margin-bottom: 10px; color: #444; }
        .galeria-grid { display: flex; flex-wrap: wrap; gap: 10px; }
        .galeria-grid img { width: calc(33.333% - 10px); max-width: 200px; height: auto; object-fit: cover; border-radius: 4px; border: 1px solid #eee; cursor: pointer; }
        @media (max-width: 768px) { .galeria-grid img { width: calc(50% - 5px); max-width: 100%;} }
        @media (max-width: 480px) { .galeria-grid img { width: 100%; } }
        .no-roteiro { text-align: center; padding: 50px; font-size: 1.2em; color: #777; }
        .roteiro-actions { margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; text-align: right; }
        .roteiro-actions button {
            padding: 10px 15px;
            margin-left: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-alterar { background-color: #ffc107; border: none; color: #333;}
        .btn-remover { background-color: #dc3545; border: none; color: white;}
        .btn-alterar:hover { background-color: #e0a800;}
        .btn-remover:hover { background-color: #c82333;}
    </style>
@endpush

@section('content')
    @if ($postagem)
        <div id="roteiroDetalheContent" class="roteiro-detalhe-container">
            <h1 id="detalheTitulo">{{ $postagem->titulo }}</h1>
            <div class="detalhe-meta-info">
                <p><strong>Autor:</strong> <span id="detalheAutor">{{ $postagem->autor->nome ?? 'Desconhecido' }}</span></p>
                <p><strong>Data:</strong> <span id="detalheData">{{ $postagem->created_at->format('d \d\e F \d\e Y') }}</span></p>
                <p><strong>Localização:</strong> <span id="detalheLocalizacao">{{ $postagem->localizacao ?? 'Não informada' }}</span></p>
                <p><strong>Categoria:</strong> <span id="detalheCategoria">{{ $postagem->categoria->nome ?? 'Não informada' }}</span> / <span id="detalheSubcategoria">{{ $postagem->subcategoria ?? 'Não informada' }}</span></p>
                <p><strong>Orçamento Estimado:</strong> <span id="detalheOrcamento">{{ $postagem->orcamento ?? 'Não informado' }}</span></p>
                <p class="detalhe-rating"><strong>Avaliação:</strong> <span id="detalheAvaliacaoEstrelas">
                    @php
                        $rating = $postagem->rating ?? 0; // Assumindo campo 'rating' na Postagem
                        for ($i = 1; $i <= 5; $i++) {
                            echo ($i <= $rating) ? '★' : '☆';
                        }
                    @endphp
                </span></p>
            </div>

            <div class="roteiro-imagens-galeria">
                <h3>Fotos do Passeio</h3>
                <div id="detalheGaleriaImagens" class="galeria-grid">
                    {{-- Tenta extrair e exibir imagens Base64 da descrição, se houver --}}
                    @php
                        $allContent = explode(',', $postagem->descricao);
                        $base64Images = [];
                        foreach($allContent as $part) {
                            if (str_starts_with(trim($part), 'data:image')) {
                                $base64Images[] = trim($part);
                            }
                        }
                    @endphp
                    @forelse($base64Images as $base64Img)
                        <img src="{{ $base64Img }}" alt="Foto do passeio">
                    @empty
                        <p>Nenhuma imagem disponível para este roteiro diretamente na descrição.</p>
                        <img src="{{ asset('cariocando_assets/sem_capa.png') }}" alt="Sem imagem de capa" style="max-width: 200px;">
                    @endforelse
                </div>
            </div>

            <h3>Descrição Completa</h3>
            <p id="detalheDescricao" class="roteiro-descricao-full">{!! $postagem->descricao !!}</p> {{-- Renderiza HTML --}}

            <div class="roteiro-actions" id="roteiroActionsContainer" @if(Auth::check() && Auth::user()->id == $postagem->user_id) style="display: block;" @else style="display: none;" @endif>
                <button id="btnAlterarRoteiro" class="btn-alterar" onclick="window.location.href='{{ route('postagem.edit', $postagem->id) }}'">Alterar Roteiro</button>
                <button id="btnRemoverRoteiro" class="btn-remover" onclick="if(confirm('Tem certeza que deseja remover este roteiro? Esta ação não pode ser desfeita.')) { document.getElementById('delete-form-{{$postagem->id}}').submit(); }">Remover Roteiro</button>
                <form id="delete-form-{{$postagem->id}}" action="{{ route('postagem.destroy', $postagem->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    @else
        <p class="no-roteiro">Roteiro não encontrado.</p>
    @endif
@endsection
