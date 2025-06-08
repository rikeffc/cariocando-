@extends('layouts.cariocando')

@section('title', 'Nova Postagem - Cariocando.com')

@push('styles')
    {{-- Rick Editor CSS (certifique-se de que a pasta RickEditor está em public) --}}
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
            <h2 id="formTitle">Nova Postagem</h2>
            <form id="novaPostagemForm" action="{{ route('postagem.store') }}" method="POST">
                @csrf
                <input type="hidden" id="roteiroEditId" value=""> {{-- Usado pelo JS original --}}
                <div class="form-group">
                    <label for="postTitulo">Título:</label>
                    <input type="text" id="postTitulo" name="titulo" placeholder="Título do seu passeio" class="form-control" style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ddd;" value="{{ old('titulo') }}">
                    @error('titulo')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="postDescricao">Conte aqui tudo sobre seu passeio no RJ:</label>
                    <textarea id="postDescricao" name="descricao" placeholder="Detalhes, dicas, o que você mais gostou..." class="form-control" style="width: calc(100% - 22px); min-height: 100px; padding:10px; border: 1px solid #ddd;">{{ old('descricao') }}</textarea>
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
                        <div id="imagePreviewsContainer"></div>
                        <small>A primeira imagem selecionada será a foto de capa.</small>
                        <div class="error-message" id="errorImagens"></div>
                        {{-- Nota: Para salvar imagens de forma separada, precisaria de uma nova migration
                             e lógica no controller para fazer upload e guardar as URLs.
                             Atualmente, se a imagem for Base64 via Rick Editor, ela vai para 'descricao'. --}}
                    </div>
                </div>

                <div class="form-group-icon">
                    <span class="icon">📍</span>
                    <input type="text" id="postLocalizacao" name="localizacao" placeholder="Onde foi o passeio? (Ex: Praia de Copacabana)" class="form-control" style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ddd;" value="{{ old('localizacao') }}">
                    <div class="error-message" id="errorLocalizacao"></div>
                     {{-- Nota: 'localizacao' precisa de uma migration para ser adicionado ao DB --}}
                </div>

                <div class="form-group-icon">
                    <span class="icon">⭐</span>
                    <div class="star-rating">
                        <span class="star">☆</span>
                        <span class="star">☆</span>
                        <span class="star">☆</span>
                        <span class="star">☆</span>
                        <span class="star">☆</span>
                        <input type="hidden" name="rating" id="ratingValue" value="{{ old('rating', $postagem->rating ?? 0) }}">
                    </div>
                    <div class="error-message" id="errorAvaliacao"></div>
                    {{-- Nota: 'rating' precisa de uma migration (campo int/decimal) para ser adicionado ao DB --}}
                </div>

                <div class="post-actions" style="text-align:right; margin-top:20px;">
                    <button type="submit" class="btn-send">ENVIAR</button>
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
                        <option value="{{ $categoria->id }}" @if(old('categoria_id') == $categoria->id) selected @endif>{{ $categoria->nome }}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="postSubcategoria">Subcategoria:</label>
                <select id="postSubcategoria" name="subcategoria_id" class="form-control">
                    <option value="">Selecione...</option>
                </select>
                <div class="error-message" id="errorSubcategoria"></div>
                {{-- Nota: 'subcategoria' precisa de uma migration para ser adicionado ao DB --}}
            </div>
            <div class="form-group">
                <label for="postOrcamento">Orçamento Estimado:</label>
                <select id="postOrcamento" name="orcamento" class="form-control">
                    <option value="" @if(old('orcamento') == '') selected @endif>Selecione...</option>
                    <option value="Baixo" @if(old('orcamento') == 'Baixo') selected @endif>Baixo</option>
                    <option value="Medio" @if(old('orcamento') == 'Medio') selected @endif>Médio</option>
                    <option value="Alto" @if(old('orcamento') == 'Alto') selected @endif>Alto</option>
                </select>
                <div class="error-message" id="errorOrcamento"></div>
                {{-- Nota: 'orcamento' precisa de uma migration para ser adicionado ao DB --}}
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

            let currentRating = parseInt(ratingValueInput.value) || 0; // Initial rating
            let selectedImagesBase64 = [];
            const MAX_IMAGES = 5;
            const MAX_FILE_SIZE_MB = 1; // 1MB

            // Helper to get the selected category's text (name)
            const getSelectedCategoryName = () => {
                if (categoriaSelect.value && categoriaSelect.selectedIndex >= 0) {
                    const selectedOption = categoriaSelect.options[categoriaSelect.selectedIndex];
                    return selectedOption ? selectedOption.text : null;
                }
                return null;
            };

            // Populate subcategories based on selected category NAME
            const populateSubcategories = (categoryName, oldSubcatValue = null) => {
                subcategoriaSelect.innerHTML = '<option value="">Selecione...</option>';
                if (categoryName && categoriasData[categoryName]) {
                    categoriasData[categoryName].forEach(subcat => {
                        const option = new Option(subcat, subcat);
                        if (oldSubcatValue && oldSubcatValue === subcat) {
                            option.selected = true;
                        }
                        subcategoriaSelect.add(option); // Use add() method
                    });
                }
            };

            // Initial population for subcategories (e.g., on page load with old values)
            const initialSelectedCategoryName = getSelectedCategoryName();
            const initialSubcategoria = "{{ old('subcategoria', isset($postagem) ? $postagem->subcategoria : '') }}";

            if (initialSelectedCategoryName) {
                populateSubcategories(initialSelectedCategoryName, initialSubcategoria);
            }

            // Event listener for category change
            categoriaSelect.addEventListener('change', function() {
                const selectedName = getSelectedCategoryName();
                populateSubcategories(selectedName, null); // Pass current selected category NAME
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

            // Image preview and handling
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
                this.value = ""; // Clear the input to allow re-selection
            });

            // Handle edit mode (pre-fill fields if editing)
            const editModeRoteiroId = "{{ $postagem->id ?? '' }}"; // From PHP variable in edit.blade.php
            if (editModeRoteiroId) {
                document.getElementById('formTitle').textContent = "Editar Postagem";
                document.getElementById('roteiroEditId').value = editModeRoteiroId;

                // Prefill text inputs and selects from $postagem object passed by controller
                document.getElementById('postTitulo').value = "{{ old('titulo', $postagem->titulo ?? '') }}";
                editor.setHTML(`{!! addslashes(old('descricao', $postagem->descricao ?? '')) !!}`); // Set editor content
                document.getElementById('postLocalizacao').value = "{{ old('localizacao', $postagem->localizacao ?? '') }}";
                setRatingUI(parseInt("{{ old('rating', $postagem->rating ?? 0) }}"));
                document.getElementById('postOrcamento').value = "{{ old('orcamento', $postagem->orcamento ?? '') }}";

                // For images in edit mode, if you have a way to retrieve them (e.g., from DB)
                // selectedImagesBase64 = [/* array of {name, base64} objects */];
                // renderImagePreviews();
            }
        });
    </script>
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star-rating .star');
        const ratingInput = document.getElementById('ratingValue');
        stars.forEach((star, idx) => {
            star.addEventListener('mouseover', () => {
                stars.forEach((s, i) => s.textContent = i <= idx ? '★' : '☆');
            });
            star.addEventListener('mouseout', () => {
                const val = parseInt(ratingInput.value) || 0;
                stars.forEach((s, i) => s.textContent = i < val ? '★' : '☆');
            });
            star.addEventListener('click', () => {
                ratingInput.value = idx + 1;
                stars.forEach((s, i) => s.textContent = i <= idx ? '★' : '☆');
            });
        });
    });
    </script>
    @endpush
@endpush

@push('scripts')
<script>
const categoriasData = @json($categoriasData ?? []);
document.addEventListener('DOMContentLoaded', function() {
    const categoriaSelect = document.getElementById('postCategoria');
    const subcategoriaSelect = document.getElementById('postSubcategoria');
    function populateSubcategories() {
        const catId = categoriaSelect.value;
        subcategoriaSelect.innerHTML = '<option value="">Selecione...</option>';
        if (categoriasData[catId]) {
            categoriasData[catId].forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id;
                opt.textContent = sub.nome;
                subcategoriaSelect.appendChild(opt);
            });
        }
    }
    if (categoriaSelect && subcategoriaSelect) {
        categoriaSelect.addEventListener('change', populateSubcategories);
        populateSubcategories(); // Para preencher ao carregar (edição)
    }
});
</script>
@endpush
