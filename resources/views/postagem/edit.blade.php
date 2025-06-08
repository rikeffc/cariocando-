@extends('layouts.cariocando')

@section('title', 'Editar Postagem - Cariocando.com')

@push('styles')
    {{-- Rick Editor CSS --}}
    <link rel="stylesheet" href="{{ asset('RickEditor/rtedefault.css') }}">
    <link rel="stylesheet" href="{{ asset('RickEditor/urte.css') }}">
    <style>
        /* Seus estilos CSS customizados para nova_postagem.html aqui */
        .form-group-icon { display: flex; align-items: center; margin-bottom: 15px; }
        .form-group-icon .icon { font-size: 1.8em; margin-right: 10px; color: #F47920; }
        .form-group-icon input[type="file"], .form-group-icon input[type="text"], .form-group-icon .star-rating, .form-group-icon select { flex-grow: 1; }
        .star-rating { display: inline-block; }
        .star-rating .star { font-size: 2em; color: #ccc; cursor: pointer; transition: color 0.2s; }
        .star-rating .star:hover, .star-rating .star.selected { color: #F47920; }
        #imagePreviewsContainer { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; margin-bottom: 15px; }
        .img-preview { width: 100px; height: 100px; object-fit: cover; border: 1px solid #ddd; border-radius: 4px; position: relative; }
        .img-preview.cover-image-preview { border: 3px solid #8CC63F; }
        .remove-img-btn { position: absolute; top: -5px; right: -5px; background: rgba(0,0,0,0.6); color: white; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 12px; cursor: pointer; display: flex; align-items: center; justify-content: center; line-height: 1; }
        /* Estilo do container principal da página nova postagem */
        .nova-postagem-page {
            display: flex;
            gap: 20px;
            background-color: #f0f0f0; /* Fundo cinza claro para a área */
            padding: 20px; /* Padding ao redor das duas colunas */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        /* Estilo da área do formulário principal */
        .post-form-area {
            flex: 3; /* Ocupa 3 partes do espaço disponível */
            background-color: #fff; /* Fundo branco para o formulário */
            padding: 20px;
            border-radius: 8px; /* Cantos arredondados */
        }
        /* Estilo da área de categorias/filtros */
        .categories-area {
            flex: 1; /* Ocupa 1 parte do espaço disponível */
            background-color: #C5E1A5; /* Cor verde clara */
            padding: 20px;
            border-radius: 8px; /* Cantos arredondados */
        }
        .categories-area h3 {
            color: #333;
            margin-bottom: 15px;
        }
        .categories-area .form-group {
            margin-bottom: 15px;
        }
        .categories-area label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #444;
        }
        .categories-area select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
        }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }

        /* Responsividade */
        @media (max-width: 768px) {
            .nova-postagem-page {
                flex-direction: column; /* Colunas empilhadas em telas menores */
            }
            .post-form-area, .categories-area {
                flex: auto; /* Deixa de ter flex-basis e se ajusta automaticamente */
                border-radius: 8px; /* Arredonda todos os cantos */
            }
            .categories-area {
                margin-top: 20px; /* Adiciona um espaço entre as seções empilhadas */
            }
        }
    </style>
@endpush

@section('content')
    <div class="nova-postagem-page">
        <div class="post-form-area">
            <h2 id="formTitle">Editar Postagem</h2>
            <form id="novaPostagemForm" action="{{ route('postagem.update', $postagem->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Indica que é uma requisição PUT para atualização --}}
                <input type="hidden" id="roteiroEditId" value="{{ $postagem->id }}">

                <div class="form-group">
                    <label for="postTitulo">Título:</label>
                    <input type="text" id="postTitulo" name="titulo" placeholder="Título do seu passeio" class="form-control" style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ddd;" value="{{ old('titulo', $postagem->titulo) }}">
                    @error('titulo')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="postDescricao">Conte aqui tudo sobre seu passeio no RJ:</label>
                    <textarea id="postDescricao" name="descricao" placeholder="Detalhes, dicas, o que você mais gostou..." class="form-control" style="width: calc(100% - 22px); min-height: 100px; padding:10px; border: 1px solid #ddd;">{{ old('descricao', $postagem->descricao) }}</textarea>
                    @error('descricao')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campos não mapeados no DB do professor, mas presentes no seu HTML --}}
                <div class="form-group-icon">
                    <span class="icon">📷</span>
                    <div>
                        <label for="postImagens" style="display:block; margin-bottom:5px;">Fotos do Passeio (pelo menos 1, máx. 5, até 1MB cada):</label>
                        <input type="file" id="postImagens" name="imagens_upload[]" accept="image/*" multiple>
                        <div id="imagePreviewsContainer">
                            {{-- Se tiver imagens antigas no DB, renderizá-las aqui --}}
                        </div>
                        <small>A primeira imagem selecionada será a foto de capa.</small>
                        <div class="error-message" id="errorImagens"></div>
                    </div>
                </div>

                <div class="form-group-icon">
                    <span class="icon">📍</span>
                    <input type="text" id="postLocalizacao" name="localizacao" placeholder="Onde foi o passeio? (Ex: Praia de Copacabana)" class="form-control" style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ddd;" value="{{ old('localizacao', $postagem->localizacao) }}">
                    <div class="error-message" id="errorLocalizacao"></div>
                </div>

                <div class="form-group-icon">
                    <span class="icon">⭐</span>
                    <div id="postAvaliacao" class="star-rating">
                        <span class="star" data-value="1">☆</span><span class="star" data-value="2">☆</span><span class="star" data-value="3">☆</span><span class="star" data-value="4">☆</span><span class="star" data-value="5">☆</span>
                    </div>
                    <input type="hidden" id="ratingValue" name="rating" value="{{ old('rating', $postagem->rating ?? 0) }}">
                    <div class="error-message" id="errorAvaliacao"></div>
                </div>

                <div class="post-actions" style="text-align:right; margin-top:20px;">
                    <button type="submit" class="btn-send">ATUALIZAR</button>
                </div>
</form>
</div>

        <aside class="categories-area">
            <h3>Categorizar Passeio</h3>
            <div class="form-group">
                <label for="postCategoria">Categoria:</label>
                <select id="postCategoria" name="categoria_id" class="form-control">
                    <option value="">Selecione...</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @if(old('categoria_id', $postagem->categoria_id) == $categoria->id) selected @endif>{{ $categoria->nome }}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="postSubcategoria">Subcategoria:</label>
                <select id="postSubcategoria" name="subcategoria" class="form-control">
                    <option value="">Selecione...</option>
                    {{-- As opções serão populadas via JS --}}
                </select>
                <div class="error-message" id="errorSubcategoria"></div>
            </div>
            <div class="form-group">
                <label for="postOrcamento">Orçamento Estimado:</label>
                <select id="postOrcamento" name="orcamento" class="form-control">
                    <option value="" @if(old('orcamento', $postagem->orcamento) == '') selected @endif>Selecione...</option>
                    <option value="Baixo" @if(old('orcamento', $postagem->orcamento) == 'Baixo') selected @endif>Baixo</option>
                    <option value="Medio" @if(old('orcamento', $postagem->orcamento) == 'Medio') selected @endif>Médio</option>
                    <option value="Alto" @if(old('orcamento', $postagem->orcamento) == 'Alto') selected @endif>Alto</option>
                </select>
                <div class="error-message" id="errorOrcamento"></div>
            </div>
        </aside>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('RickEditor/plugins.all.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Rich Text Editor
            var editor = new RichTextEditor("#postDescricao");
            // Preenche o editor com o valor da descrição do Blade
            editor.setHTML(`{!! addslashes(old('descricao', $postagem->descricao ?? '')) !!}`);

            // Existing categories for dynamic subcategory dropdown
            const categoriasData = {
                "Praia e Natureza": ["Praia", "Trilha", "Parque", "Mirante"],
                "Cultura e História": ["Museu", "Centro Cultural", "Monumento Histórico", "Teatro"],
                "Gastronomia": ["Restaurante", "Bar", "Cafeteria", "Feira Gastronômica"],
                "Entretenimento": ["Cinema", "Show", "Evento Esportivo", "Shopping"],
                "Vida Noturna": ["Boate", "Bar com Música Ao Vivo", "Pub"]
            };

            const categoriaSelect = document.getElementById('postCategoria');
            const subcategoriaSelect = document.getElementById('postSubcategoria');
            const ratingValueInput = document.getElementById('ratingValue');
            const stars = document.querySelectorAll('#postAvaliacao .star');
            const imageUploadInput = document.getElementById('postImagens');
            const previewsContainer = document.getElementById('imagePreviewsContainer');

            let currentRating = parseInt(ratingValueInput.value) || 0;
            let selectedImagesBase64 = []; // This will not persist across page loads unless you add DB fields for it.
            const MAX_IMAGES = 5;
            const MAX_FILE_SIZE_MB = 1; // 1MB

            // Populate subcategories based on selected category or old value
            const populateSubcategories = (selectedCatValue, oldSubcatValue = null) => {
                subcategoriaSelect.innerHTML = '<option value="">Selecione...</option>';
                if (selectedCatValue && categoriasData[selectedCatValue]) {
                    categoriasData[selectedCatValue].forEach(subcat => {
                        const option = new Option(subcat, subcat);
                        if (oldSubcatValue && oldSubcatValue === subcat) {
                            option.selected = true;
                        }
                        subcategoriaSelect.options[subcategoriaSelect.options.length] = option;
                    });
                }
            };

            // Initial population for subcategories (e.g., on page load with old values)
            const initialCategoria = categoriaSelect.value;
            const initialSubcategoria = "{{ old('subcategoria', $postagem->subcategoria ?? '') }}";
            if (initialCategoria) {
                populateSubcategories(initialCategoria, initialSubcategoria);
            }
            categoriaSelect.addEventListener('change', function() {
                populateSubcategories(this.value);
            });


            // Set rating UI
            function setRatingUI(rating) {
                currentRating = rating;
                ratingValueInput.value = currentRating;
                stars.forEach(s => {
                    const starValue = parseInt(s.dataset.value);
                    s.classList.toggle('selected', starValue <= currentRating);
                    s.textContent = starValue <= currentRating ? '★' : '☆';
                });
            }
            setRatingUI(currentRating); // Set initial state of stars

            stars.forEach(star => {
                star.addEventListener('click', function() { setRatingUI(parseInt(this.dataset.value)); });
                star.addEventListener('mouseover', function() {
                    const hoverValue = parseInt(this.dataset.value);
                    stars.forEach(s => { s.textContent = parseInt(s.dataset.value) <= hoverValue ? '★' : '☆'; });
                });
                star.addEventListener('mouseout', function() { setRatingUI(currentRating); });
            });

            // Image preview and handling (same as create, needs backend integration for persistence)
            function renderImagePreviews() {
                previewsContainer.innerHTML = '';
                selectedImagesBase64.forEach((imgData, index) => {
                    const previewWrapper = document.createElement('div');
                    previewWrapper.style.position = 'relative';
                    previewWrapper.style.display = 'inline-block';
                    const imgElement = document.createElement('img');
                    imgElement.src = imgData.base64;
                    imgElement.classList.add('img-preview');
                    if (index === 0) { imgElement.classList.add('cover-image-preview'); }
                    previewWrapper.appendChild(imgElement);
                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '&times;';
                    removeBtn.classList.add('remove-img-btn');
                    removeBtn.type = 'button';
                    removeBtn.onclick = function() {
                        selectedImagesBase64.splice(index, 1);
                        renderImagePreviews();
                    };
                    previewWrapper.appendChild(removeBtn);
                    previewsContainer.appendChild(previewWrapper);
                });
            }

            imageUploadInput.addEventListener('change', function(event) {
                if (selectedImagesBase64.length >= MAX_IMAGES) {
                    alert(`Você pode selecionar no máximo ${MAX_IMAGES} imagens.`);
                    this.value = "";
                    return;
                }
                const files = Array.from(event.target.files);
                let filesToProcess = files.slice(0, MAX_IMAGES - selectedImagesBase64.length);

                filesToProcess.forEach((file) => {
                    if (file.size > MAX_FILE_SIZE_MB * 1024 * 1024) {
                        alert(`A imagem "${file.name}" é maior que ${MAX_FILE_SIZE_MB}MB e não será adicionada.`);
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        selectedImagesBase64.push({name: file.name, base64: e.target.result});
                        renderImagePreviews();
                    }
                    reader.readAsDataURL(file);
                });
                this.value = "";
            });
        });
    </script>
@endpush
