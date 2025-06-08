@extends('layouts.cariocando') {{-- Certifique-se que este é o nome do seu layout principal --}}

@section('title', 'Roteiros - Cariocando.com')

@push('styles')
    {{-- Se você tiver um arquivo CSS externo principal para esta página (ex: public/css/roteiros.css) --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/roteiros.css') }}"> --}}
    <style>
        /* Estilos específicos da página de roteiros que estavam no <head> ou em style.css */
        /* É altamente recomendável mover a maioria destes estilos para um arquivo CSS dedicado e linká-lo acima */

        /* Estilos Gerais da Página de Roteiros (Exemplos, adapte do seu style.css) */
        /* body { font-family: 'Arial', sans-serif; margin: 0; background-color: #f4f4f4; color: #333; } */ /* Removido pois o layout principal deve cuidar disso */

        .container-roteiros { /* Renomeado de .container para evitar conflito com Bootstrap ou layout principal */
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
        }

        .sorting-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .sorting-buttons button {
            padding: 10px 15px;
            border: 1px solid #ddd;
            background-color: #fff;
            color: #333;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .sorting-buttons button:hover,
        .sorting-buttons button.active {
            background-color: #F47920;
            color: white;
            border-color: #F47920;
        }

        .roteiros-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .roteiro-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s ease-in-out;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .roteiro-card:hover {
            transform: translateY(-5px);
        }
        .card-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .card-content {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .card-content h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.4em;
            color: #F47920;
        }
        .card-content .description-snippet { /* Classe adicionada para o snippet */
            font-size: 0.9em;
            color: #555;
            line-height: 1.5;
            margin-bottom: 15px;
            flex-grow: 1;
            min-height: 40px; /* Para alinhar cards com descrições de tamanhos diferentes */
        }
        .card-meta {
            font-size: 0.8em;
            color: #777;
            margin-bottom: 10px;
        }
        .card-rating {
            color: #f0ad4e;
        }
        .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85em;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
            margin-top: auto;
        }
        .card-actions .user-avatar {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            margin-right: 8px;
            vertical-align: middle;
        }
        .post-time {
            font-style: italic;
        }

        /* Estilos para Paginação */
        .pagination-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
            margin-top: 30px;
        }
        .pagination-controls button,
        .pagination-controls .page-number { /* .page-number é usado no JS */
            background-color: #fff;
            border: 1px solid #ddd;
            color: #F47920; /* Laranja */
            padding: 8px 12px;
            margin: 0 4px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s, color 0.3s;
        }
        .pagination-controls button:hover,
        .pagination-controls .page-number:hover {
            background-color: #f8f8f8;
        }
        .pagination-controls button:disabled {
            color: #ccc;
            cursor: not-allowed;
            background-color: #f9f9f9;
        }
        .pagination-controls .page-number.active {
            background-color: #F47920; /* Laranja */
            color: white;
            border-color: #F47920;
        }

        /* Estilos do Modal (Quiz) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050; /* Acima do navbar padrão do Bootstrap */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.6);
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 25px;
            border: 1px solid #ddd;
            width: 90%;
            max-width: 550px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            position: relative;
        }
        .modal-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }
        .modal-close:hover,
        .modal-close:focus {
            color: #333;
            text-decoration: none;
        }
        .modal-content h2 {
            margin-top: 0;
            color: #F47920;
            text-align: center;
            margin-bottom: 20px;
        }
        .modal-form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }
        .modal-form-group label {
            display: flex; /* Para alinhar ícone e texto */
            align-items: center;
            margin-bottom: 8px;
            font-weight: 500;
            color: #444;
        }
        .modal-form-group select,
        .modal-form-group .quantity-selector {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .quantity-selector {
            display: flex;
            align-items: center;
            border: 1px solid #ccc; /* Movido para cá para consistência */
            border-radius: 4px;    /* Movido para cá */
            padding: 0; /* Removido padding do container, aplicado aos filhos */
        }
        .quantity-selector button {
            background-color: #f0f0f0;
            border: none;
            color: #333;
            padding: 10px 15px; /* Aumentado para melhor clique */
            cursor: pointer;
            font-size: 1.1em;
            line-height: 1; /* Para alinhar melhor o texto do botão */
        }
        .quantity-selector button:first-child { border-radius: 4px 0 0 4px; border-right: 1px solid #ccc;}
        .quantity-selector button:last-child { border-radius: 0 4px 4px 0; border-left: 1px solid #ccc;}
        .quantity-selector span {
            font-weight:bold;
            margin: 0; /* Removido margin, padding controla o espaçamento */
            padding: 10px; /* Adicionado padding */
            min-width: 30px; /* Aumentado para melhor visualização */
            display: inline-block;
            text-align: center;
            flex-grow: 1; /* Para ocupar espaço entre os botões */
        }
        .modal-submit-btn {
            background-color: #8CC63F;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            width: 100%;
            transition: background-color 0.3s;
        }
        .modal-submit-btn:hover {
            background-color: #79b02f;
        }

        /* Ajustes no Modal do Quiz (Media Queries) */
        #quizModal .modal-form-group label { flex-basis: auto; margin-bottom: 8px; }
        #quizModal .modal-form-group select,
        #quizModal .modal-form-group .quantity-selector { width: 100%; }

        @media (min-width: 500px) {
            #quizModal .modal-form-group { flex-direction: row; align-items: center; }
            #quizModal .modal-form-group label { flex-basis: 40%; margin-bottom: 0; margin-right: 10px; }
            #quizModal .modal-form-group select,
            #quizModal .modal-form-group .quantity-selector { flex-basis: 55%; width: auto; }
        }
    </style>
@endpush

@section('content')
    {{-- O header do HTML original é omitido, pois o layout principal 'layouts.cariocando' já deve fornecer um. --}}
    {{-- Se o seu layout não tiver um header, você pode adicionar o header original aqui. --}}

    <div class="container-roteiros">
        <div class="sorting-buttons">
            <button class="active">Melhores avaliados</button>
            <button>Mais recentes</button>
            <button>Custo-Benefício</button>
            <button>Mais populares</button>
            <button id="openQuizModalBtnManualmente" style="background-color: #8CC63F; color: white; border-color: #8CC63F;">Abrir Quiz de Preferências</button>
        </div>

        <div class="roteiros-grid" id="roteirosGrid">
            {{-- Os roteiros serão carregados aqui pelo JavaScript --}}
        </div>

        <div class="pagination-controls" id="paginationControls">
            {{-- Controles de paginação serão carregados aqui pelo JavaScript --}}
        </div>
    </div>

    <div id="quizModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" id="closeQuizModalBtn">&times;</span>
            <h2>QUIZ DE PREFERÊNCIAS</h2>
            <form id="quizPreferenciasForm">
                <div class="modal-form-group">
                    <label for="quizPreferenciaPasseio"><span class="icon" style="font-size:1.2em; margin-right: 5px;">🗺️</span>Qual a sua preferência de passeio?</label>
                    <select id="quizPreferenciaPasseio" required>
                        <option value="">Selecione uma categoria...</option>
                        {{-- Opções preenchidas por JS --}}
                    </select>
                </div>
                <div class="modal-form-group">
                    <label for="quizPessoasHidden"><span class="icon" style="font-size:1.2em; margin-right: 5px;">👥</span>Quantas pessoas?</label>
                    <div class="quantity-selector">
                        <button type="button" id="quizPessoasMenos">-</button>
                        <span id="quizPessoasValor">1</span>
                        <button type="button" id="quizPessoasMais">+</button>
                        <input type="hidden" id="quizPessoasHidden" value="1">
                    </div>
                </div>
                <div class="modal-form-group">
                    <label for="quizOrcamento"><span class="icon" style="font-size:1.2em; margin-right: 5px;">💰</span>Qual seu orçamento?</label>
                    <select id="quizOrcamento" required>
                        <option value="">Selecione o orçamento...</option>
                        <option value="Baixo">Baixo (até R$50 por pessoa)</option>
                        <option value="Medio">Médio (R$50 - R$150 por pessoa)</option>
                        <option value="Alto">Alto (Acima de R$150 por pessoa)</option>
                    </select>
                </div>
                <button type="submit" class="modal-submit-btn">Encontrar meu roteiro ideal!</button>
            </form>
        </div>
    </div>

    {{-- O footer do HTML original é omitido, pois o layout principal 'layouts.cariocando' já deve fornecer um. --}}
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Dados e Configurações Iniciais ---
        const defaultProfileForRoteirosHeader = { nome: "Usuário", avatarBase64: null };
        const categoriasParaQuiz = {
            "Praia e Natureza": ["Praia", "Trilha", "Parque", "Mirante"],
            "Cultura e História": ["Museu", "Centro Cultural", "Monumento Histórico", "Teatro"],
            "Gastronomia": ["Restaurante", "Bar", "Cafeteria", "Feira Gastronômica"],
            "Entretenimento": ["Cinema", "Show", "Evento Esportivo", "Shopping"],
            "Vida Noturna": ["Boate", "Bar com Música Ao Vivo", "Pub"]
        };

        let todosOsRoteirosGlobais = [];
        let currentPageGlobal = 1;
        const itemsPerPageGlobal = 8;

        // --- Funções do Header (Adaptar para o header do layout Laravel) ---
        function loadProfileDataIntoRoteirosHeader(profile) {
            // Esta função precisa ser adaptada para interagir com os elementos
            // do header do SEU layout principal (ex: layouts/cariocando.blade.php).
            // O HTML original tinha 'roteirosPageAuthLink' e 'roteirosPageAuthAvatar'.
            // Você precisará encontrar os IDs/classes equivalentes no seu layout.
            // Exemplo:
            const authLink = document.getElementById('navbarUserLink'); // Supondo que seu link no navbar tenha este ID
            const authAvatar = document.getElementById('navbarUserAvatar'); // Supondo que seu avatar no navbar tenha este ID

            if (authLink) { // Avatar pode ser opcional
                if (profile && profile.nome !== "Usuário" && profile.nome) {
                    authLink.href = "{{ route('user.perfil') }}";
                    let linkContent = profile.nome;
                    if (authAvatar) {
                        if (profile.avatarBase64) {
                            authAvatar.src = profile.avatarBase64; authAvatar.alt = profile.nome;
                        } else {
                            authAvatar.src = `https://via.placeholder.com/30/F47920/FFFFFF?Text=${profile.nome.charAt(0).toUpperCase()}`; authAvatar.alt = profile.nome;
                        }
                        authAvatar.style.display = 'inline-block';
                        linkContent += ' ' + authAvatar.outerHTML; // Adiciona o avatar ao lado do nome
                    }
                     // Atualiza o conteúdo do link, preservando outros elementos se houver
                    const existingTextNode = Array.from(authLink.childNodes).find(node => node.nodeType === Node.TEXT_NODE && node.textContent.trim() !== '');
                    if(existingTextNode) existingTextNode.textContent = profile.nome + " "; else authLink.innerHTML = profile.nome + (authAvatar ? " " + authAvatar.outerHTML : "");

                } else {
                    authLink.href = "{{ route('login') }}"; // Rota de login padrão do Laravel
                    let linkContent = "Entrar";
                     if (authAvatar) {
                        authAvatar.src = "https://via.placeholder.com/30/F47920/FFFFFF?Text=User";
                        authAvatar.alt = "User Icon";
                        authAvatar.style.display = 'inline-block'; // Ou 'none' se preferir esconder
                        linkContent += ' ' + authAvatar.outerHTML;
                    }
                    const existingTextNode = Array.from(authLink.childNodes).find(node => node.nodeType === Node.TEXT_NODE && node.textContent.trim() !== '');
                    if(existingTextNode) existingTextNode.textContent = "Entrar "; else authLink.innerHTML = "Entrar " + (authAvatar ? " " + authAvatar.outerHTML : "");
                }
            } else {
                console.warn("Elementos do header para autenticação (ex: navbarUserLink) não encontrados. Adapte o JS ou seu layout.");
            }
        }

        // --- Funções de Paginação e Renderização de Roteiros ---
        function carregarTodosOsRoteirosDoLocalStorage() {
            let roteirosSalvos = JSON.parse(localStorage.getItem('cariocando_roteiros'));
            if (roteirosSalvos === null || !Array.isArray(roteirosSalvos)) {
                todosOsRoteirosGlobais = [];
            } else {
                todosOsRoteirosGlobais = roteirosSalvos.filter(r => r && r.id && r.title); // Garante integridade mínima
            }
        }

        function displayRoteirosDaPagina() {
            const roteirosGrid = document.getElementById('roteirosGrid');
            if (!roteirosGrid) return;
            roteirosGrid.innerHTML = '';
            const startIndex = (currentPageGlobal - 1) * itemsPerPageGlobal;
            const endIndex = startIndex + itemsPerPageGlobal;
            const roteirosDaPaginaAtual = todosOsRoteirosGlobais.slice(startIndex, endIndex);

            if (roteirosDaPaginaAtual.length === 0 && currentPageGlobal > 1) {
                currentPageGlobal--; displayRoteirosDaPagina(); setupPaginationControls(); return;
            }

            if (roteirosDaPaginaAtual.length === 0 && currentPageGlobal === 1) {
                 roteirosGrid.innerHTML = '<p style="text-align:center; grid-column: 1 / -1; color: #777; padding: 20px;">Nenhum roteiro publicado ainda. Seja o primeiro a compartilhar sua experiência!</p>';
            }

            roteirosDaPaginaAtual.forEach(roteiro => {
                const cardLink = document.createElement('a');
                cardLink.href = `{{ url('roteiros') }}/${roteiro.id}`; // Rota para detalhes do roteiro
                cardLink.style.textDecoration = 'none'; cardLink.style.color = 'inherit';

                const card = document.createElement('div'); card.classList.add('roteiro-card');
                let tempDiv = document.createElement("div"); tempDiv.innerHTML = roteiro.description || '';
                let plainDescription = tempDiv.textContent || tempDiv.innerText || "";
                let descriptionSnippet = plainDescription.substring(0, 70) + (plainDescription.length > 70 ? '...' : '');
                if (!descriptionSnippet.trim()) descriptionSnippet = 'Sem descrição.';

                let ratingStars = 'Sem avaliação';
                if (roteiro.rating && !isNaN(parseInt(roteiro.rating)) && parseInt(roteiro.rating) > 0) {
                    let ratingNum = parseInt(roteiro.rating);
                    ratingStars = '★'.repeat(ratingNum) + '☆'.repeat(Math.max(0, 5 - ratingNum));
                }

                card.innerHTML = `
                    <img src="${roteiro.coverImageBase64 || 'https://via.placeholder.com/400x200/cccccc/000000?Text=Sem+Capa'}" alt="${roteiro.title || 'Roteiro'}" class="card-img">
                    <div class="card-content">
                        <h3>${roteiro.title || 'Roteiro sem título'}</h3>
                        <p class="description-snippet">${descriptionSnippet}</p>
                        <div class="card-meta">
                            <span class="card-rating">${ratingStars}</span>
                        </div>
                        <div class="card-actions">
                            <div>
                                <img src="${roteiro.avatar || 'https://via.placeholder.com/30/F47920/FFFFFF?Text=U'}" alt="${roteiro.author || 'Autor'}" class="user-avatar">
                                <span>${roteiro.author || 'Autor Desconhecido'}</span>
                            </div>
                            <span class="post-time">${roteiro.postedDate || ''}</span>
                        </div>
                    </div>`;
                cardLink.appendChild(card); roteirosGrid.appendChild(cardLink);
            });
        }

        function setupPaginationControls() {
            const paginationControls = document.getElementById('paginationControls');
            if (!paginationControls) return;
            paginationControls.innerHTML = '';
            const totalPages = Math.ceil(todosOsRoteirosGlobais.length / itemsPerPageGlobal);

            if (totalPages <= 1) { paginationControls.style.display = 'none'; return; }
            paginationControls.style.display = 'flex';

            const createPageButton = (text, pageNum, isDisabled = false, isActive = false) => {
                const button = document.createElement('button');
                button.textContent = text;
                button.disabled = isDisabled;
                if (pageNum) button.dataset.page = pageNum;
                if (isActive) button.classList.add('active');
                button.classList.add('page-number'); // Adiciona classe para estilização consistente
                button.addEventListener('click', () => {
                    currentPageGlobal = pageNum || (text === 'Anterior' ? currentPageGlobal - 1 : currentPageGlobal + 1);
                    displayRoteirosDaPagina(); setupPaginationControls(); window.scrollTo(0,0);
                });
                return button;
            };

            paginationControls.appendChild(createPageButton('Anterior', null, currentPageGlobal === 1));

            let startPage = Math.max(1, currentPageGlobal - 2);
            let endPage = Math.min(totalPages, currentPageGlobal + 2);
            if (currentPageGlobal <= 3) endPage = Math.min(totalPages, 5);
            if (currentPageGlobal >= totalPages - 2) startPage = Math.max(1, totalPages - 4);

            if (startPage > 1) {
                paginationControls.appendChild(createPageButton('1', 1));
                if (startPage > 2) { const ellipsis = document.createElement('span'); ellipsis.textContent = '...'; ellipsis.style.padding = "8px 12px"; paginationControls.appendChild(ellipsis); }
            }
            for (let i = startPage; i <= endPage; i++) {
                paginationControls.appendChild(createPageButton(i.toString(), i, false, i === currentPageGlobal));
            }
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) { const ellipsis = document.createElement('span'); ellipsis.textContent = '...'; ellipsis.style.padding = "8px 12px"; paginationControls.appendChild(ellipsis); }
                paginationControls.appendChild(createPageButton(totalPages.toString(), totalPages));
            }
            paginationControls.appendChild(createPageButton('Próxima', null, currentPageGlobal === totalPages));
        }

        // --- Lógica do Modal do Quiz ---
        const quizModal = document.getElementById("quizModal");
        const btnOpenQuizManualmente = document.getElementById("openQuizModalBtnManualmente");
        const spanCloseQuiz = document.getElementById("closeQuizModalBtn");
        const quizForm = document.getElementById("quizPreferenciasForm");
        const quizPessoasMenosBtn = document.getElementById("quizPessoasMenos");
        const quizPessoasMaisBtn = document.getElementById("quizPessoasMais");
        const quizPessoasValorSpan = document.getElementById("quizPessoasValor");
        const quizPessoasHiddenInput = document.getElementById("quizPessoasHidden");
        const quizPreferenciaSelect = document.getElementById("quizPreferenciaPasseio");

        if (quizPreferenciaSelect) {
            for (const categoriaPrincipal in categoriasParaQuiz) {
                quizPreferenciaSelect.options[quizPreferenciaSelect.options.length] = new Option(categoriaPrincipal, categoriaPrincipal);
            }
        }

        if (btnOpenQuizManualmente) { btnOpenQuizManualmente.onclick = () => { if(quizModal) quizModal.style.display = "block"; }}
        if (spanCloseQuiz) { spanCloseQuiz.onclick = () => { if(quizModal) quizModal.style.display = "none"; }}
        window.addEventListener('click', (event) => { if (event.target == quizModal) { if(quizModal) quizModal.style.display = "none"; }});

        if(quizPessoasMenosBtn && quizPessoasMaisBtn && quizPessoasValorSpan && quizPessoasHiddenInput) {
            let numPessoas = 1;
            const updatePessoas = () => { quizPessoasValorSpan.textContent = numPessoas; quizPessoasHiddenInput.value = numPessoas; };
            quizPessoasMenosBtn.onclick = () => { if (numPessoas > 1) { numPessoas--; updatePessoas(); }};
            quizPessoasMaisBtn.onclick = () => { numPessoas++; updatePessoas(); };
            updatePessoas(); // Initialize
        }

        if (quizForm) {
            quizForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const preferenciaCategoria = document.getElementById('quizPreferenciaPasseio').value;
                const orcamentoEscolhido = document.getElementById('quizOrcamento').value;

                if (!preferenciaCategoria || !orcamentoEscolhido) { alert("Por favor, selecione todas as opções do quiz."); return; }

                localStorage.setItem('cariocando_quizPreferencias', JSON.stringify({ preferenciaCategoria, orcamentoEscolhido, quantasPessoas: quizPessoasHiddenInput.value }));
                if(todosOsRoteirosGlobais.length === 0) carregarTodosOsRoteirosDoLocalStorage();

                let roteirosCorrespondentes = todosOsRoteirosGlobais.filter(r => r && r.category === preferenciaCategoria && r.orcamento === orcamentoEscolhido);
                if (roteirosCorrespondentes.length === 0) {
                    roteirosCorrespondentes = todosOsRoteirosGlobais.filter(r => r && r.category === preferenciaCategoria);
                }

                if (roteirosCorrespondentes.length > 0) {
                    const roteiroSugerido = roteirosCorrespondentes[Math.floor(Math.random() * roteirosCorrespondentes.length)];
                    alert(`Encontramos um roteiro para você: ${roteiroSugerido.title}! Você será redirecionado.`);
                    window.location.href = `{{ url('roteiros') }}/${roteiroSugerido.id}`;
                } else {
                    alert('Nenhum roteiro encontrado com essas preferências no momento. Explore nossos outros roteiros ou tente outras combinações no quiz!');
                    if(quizModal) quizModal.style.display = "none";
                }
            });
        }

        // --- Inicialização da Página ---
        const userProfile = JSON.parse(localStorage.getItem('cariocando_perfilUsuario')) || defaultProfileForRoteirosHeader;
        loadProfileDataIntoRoteirosHeader(userProfile); // Adapte os IDs no JS e no seu layout!

        carregarTodosOsRoteirosDoLocalStorage();
        displayRoteirosDaPagina();
        setupPaginationControls();

        const quizJaRespondido = localStorage.getItem('cariocando_quizPreferencias');
        const urlParams = new URLSearchParams(window.location.search);
        if (quizModal) {
            if (urlParams.has('abrirQuiz')) {
                quizModal.style.display = "block";
            } else if (!quizJaRespondido && todosOsRoteirosGlobais.length > 0) {
                quizModal.style.display = "block";
            }
        }
    });
</script>
@endpush

{{-- Crie também uma view para os detalhes do roteiro em resources/views/roteiros/show.blade.php --}}
{{-- Exemplo para resources/views/roteiros/show.blade.php:
@extends('layouts.cariocando')
@section('title', 'Detalhes do Roteiro')
@push('styles')
<style>
.roteiro-detalhe-container { max-width: 800px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 8px; }
.roteiro-detalhe-container img.cover { width: 100%; max-height: 400px; object-fit: cover; border-radius: 4px; margin-bottom: 15px; }
.roteiro-detalhe-container h1 { color: #F47920; }
.description-content { margin-top: 20px; line-height: 1.6; }
</style>
@endpush
@section('content')
<div class="roteiro-detalhe-container" id="roteiroDetalheContent">
    <p>Carregando detalhes do roteiro...</p>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const roteiroId = "{{ $roteiroId ?? '' }}"; // Será passado pelo controller
    const roteiroDetalheContent = document.getElementById('roteiroDetalheContent');
    if (roteiroId && roteiroDetalheContent) {
        const todosOsRoteiros = JSON.parse(localStorage.getItem('cariocando_roteiros')) || [];
        const roteiro = todosOsRoteiros.find(r => String(r.id) === String(roteiroId));
        if (roteiro) {
            roteiroDetalheContent.innerHTML = `
                ${roteiro.coverImageBase64 ? `<img src="${roteiro.coverImageBase64}" alt="${roteiro.title}" class="cover">` : ''}
                <h1>${roteiro.title}</h1>
                <p><strong>Autor:</strong> ${roteiro.author || 'N/A'}</p>
                <p><strong>Avaliação:</strong> ${roteiro.rating ? '★'.repeat(roteiro.rating) + '☆'.repeat(5-roteiro.rating) : 'N/A'}</p>
                <p><strong>Localização:</strong> ${roteiro.location || 'N/A'}</p>
                <p><strong>Categoria:</strong> ${roteiro.category || 'N/A'}</p>
                <p><strong>Orçamento:</strong> ${roteiro.orcamento || 'N/A'}</p>
                <div class="description-content"><strong>Descrição:</strong><br>${roteiro.description || 'Sem descrição.'}</div>
            `;
        } else {
            roteiroDetalheContent.innerHTML = '<p>Roteiro não encontrado.</p>';
        }
    } else {
        roteiroDetalheContent.innerHTML = '<p>ID do roteiro inválido.</p>';
    }
});
</script>
@endpush
--}}
