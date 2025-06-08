<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cariocando.com')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('cariocando_assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/roteiros-styles.css') }}">
    @stack('styles') {{-- Para estilos específicos de página --}}
</head>
<body>

    <header class="header">
        <a href="{{ route('site.principal') }}" class="logo">CARIOCANDO.COM</a>
        <nav>
            <a href="{{ route('site.principal') }}">INÍCIO</a>
            <a href="{{ route('roteiros.index') }}">ROTEIROS</a>
            <a href="{{ route('site.quem_somos') }}">QUEM SOMOS</a>
            <a href="{{ route('site.contato') }}">CONTATO</a> {{-- Nova rota --}}
        </nav>
        <a href="{{ route('login') }}" class="login-btn" id="roteirosPageAuthLink">
            Entrar
            <img src="{{ asset('cariocando_assets/user-icon.png') }}" alt="User Icon" id="roteirosPageAuthAvatar" style="width: 30px; height: 30px; border-radius: 50%; margin-left: 8px; vertical-align: middle;">
        </a>
    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer class="site-footer-image-style">
        <div class="footer-image-newsletter-section">
            <div class="container">
                <h2>Receba nossas novidades em seu e-mail!</h2>
                <form class="newsletter-form-inline-image">
                    <input type="email" placeholder="Digite seu e-mail" aria-label="Email para newsletter">
                    <button type="submit">Cadastrar</button>
                </form>
                <div class="newsletter-terms-image">
                    <input type="checkbox" id="newsletterAcceptImage" checked aria-labelledby="newsletterAcceptLabel">
                    <label for="newsletterAcceptImage" id="newsletterAcceptLabel">Ao clicar em cadastrar, concordo que li e aceito os
                        <a href="#">Termos de Uso</a>,
                        <a href="#">Condições Gerais do Seguro</a> e
                        <a href="#">Cobertura do produto</a>.
                    </label>
                </div>
            </div>
        </div>

        <div class="footer-image-main-section">
            <div class="container">
                <div class="footer-image-main-grid">
                    <div class="footer-image-logo-area">
                        <a href="{{ route('site.principal') }}" class="site-logo-footer-image">
                            <span class="logo-carioca-img">CARIOCA</span><span class="logo-ndo-com-img">NDO.COM</span>
                        </a>
                    </div>
                    <div class="footer-image-links-column">
                        <h4>QUEM SOMOS</h4>
                        <ul>
                            <li><a href="{{ route('site.principal') }}">Inicio</a></li>
                            <li><a href="{{ route('roteiros.index') }}">Roteiros</a></li>
                            <li><a href="{{ route('site.contato') }}">Contato</a></li>
                            <li><a href="{{ route('site.quem_somos') }}">Quem Somos</a></li>
                            <li><a href="{{ route('login') }}">Entrar</a></li>
                        </ul>
                    </div>
                    <div class="footer-image-contact-column">
                        <h4>ATENDIMENTO:</h4>
                        <p class="phone-number-image">(31) 3290-9066</p>
                        <p><a href="#" class="contact-link-image">Central de Ajuda</a></p>
                        <p><a href="mailto:atendimento@cariocando.com.br" class="contact-link-image">atendimento@cariocando.com.br</a></p>
                    </div>
                    <div class="footer-image-social-icons-area">
                        <a href="#" class="social-icon-image" aria-label="Instagram">
                            <span class="icon-text-img">📷</span>
                        </a>
                        <a href="#" class="social-icon-image" aria-label="WhatsApp">
                            <span class="icon-text-img">💬</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-image-bottom-line">
        </div>
    </footer>

    @stack('scripts')
    <script>
        // JS para o cabeçalho de login/usuário
        document.addEventListener('DOMContentLoaded', function() {
            const roteirosPageAuthLink = document.getElementById('roteirosPageAuthLink');
            const roteirosPageAuthAvatar = document.getElementById('roteirosPageAuthAvatar');
            // Pega o usuário logado do Laravel via Blade
            const loggedInUser = {!! Auth::check() ? json_encode(Auth::user()) : 'null' !!};

            if (loggedInUser) {
                roteirosPageAuthLink.href = '{{ route('user.perfil') }}';
                // Modifica o nó de texto diretamente, pois a tag <a/> pode conter texto e a <img>.
                // O childNodes[0] é o nó de texto "Entrar "
                if (roteirosPageAuthLink.childNodes[0]) {
                    roteirosPageAuthLink.childNodes[0].nodeValue = loggedInUser.nome + " ";
                } else {
                    // Se não houver nó de texto (ex: se o HTML fosse apenas <a href="#"><img.../></a>), adiciona
                    const textNode = document.createTextNode(loggedInUser.nome + " ");
                    roteirosPageAuthLink.prepend(textNode);
                }

                if (loggedInUser.avatar) {
                    roteirosPageAuthAvatar.src = loggedInUser.avatar; // Se guardar Base64 ou URL
                } else if (loggedInUser.nome && loggedInUser.nome.trim() !== "") {
                    roteirosPageAuthAvatar.src = `https://via.placeholder.com/30/F47920/FFFFFF?Text=${loggedInUser.nome.charAt(0).toUpperCase()}`;
                }
                roteirosPageAuthAvatar.alt = loggedInUser.nome;
            } else {
                roteirosPageAuthLink.href = '{{ route('login') }}';
                if (roteirosPageAuthLink.childNodes[0]) {
                    roteirosPageAuthLink.childNodes[0].nodeValue = "Entrar ";
                } else {
                    const textNode = document.createTextNode("Entrar ");
                    roteirosPageAuthLink.prepend(textNode);
                }
                roteirosPageAuthAvatar.src = "{{ asset('cariocando_assets/user-icon.png') }}";
                roteirosPageAuthAvatar.alt = "Ícone de usuário";
            }
        });
    </script>
</body>
</html>
