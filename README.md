![image](https://github.com/user-attachments/assets/63ace03b-39d6-46ed-8ee0-c4a520bd628a)🏖️ Cariocando.com - Plataforma de Roteiros Turísticos do Rio de Janeiro

Conectando pessoas através de experiências únicas no Rio de Janeiro
Uma plataforma web completa para compartilhamento e descoberta de roteiros turísticos no Rio de Janeiro, desenvolvida como projeto final do curso Técnico em Informática.

O Cariocando.com é uma solução inovadora que permite aos usuários:

🗺️ Criar e compartilhar roteiros turísticos personalizados
⭐ Avaliar e descobrir experiências através de um sistema de rating
🎯 Encontrar roteiros ideais usando nosso Quiz de Preferências
👥 Conectar-se com uma comunidade ativa de exploradores locais
📱 Navegar com interface responsiva e moderna

🚀 Funcionalidades Principais
🔐 Sistema de Autenticação Completo

Registro e login de usuários
Recuperação de senha via email
Perfis personalizáveis com avatar e informações
Proteção de rotas sensíveis

📝 Gestão de Conteúdo

CRUD Completo para categorias e postagens
Rich Text Editor para descrições detalhadas
Upload de múltiplas imagens com preview
Sistema de categorização avançado
Validações robustas server-side e client-side

🎯 Recursos Inteligentes

Quiz de Preferências personalizado
Sistema de avaliação por estrelas
Filtros dinâmicos por categoria, orçamento e rating
Paginação otimizada para performance
Busca inteligente de roteiros

👤 Área do Usuário

Dashboard administrativo com AdminLTE
Perfil público personalizável
Gestão de roteiros próprios
Histórico de atividades

🛠️ Tecnologias Utilizadas
Backend

PHP 8.1+ - Linguagem principal
Laravel 10 - Framework MVC robusto
MySQL - Banco de dados relacional
Eloquent ORM - Para modelagem de dados
Laravel UI - Sistema de autenticação

Frontend

HTML5 & CSS3 - Estrutura e estilização
JavaScript ES6+ - Interatividade
Bootstrap - Framework CSS responsivo
AdminLTE - Interface administrativa
Rich Text Editor - Editor de texto avançado

Ferramentas & Recursos

Laravel Migrations - Versionamento do banco
Blade Templates - Sistema de templates
Middleware - Proteção e autenticação
Form Validation - Validação de formulários
File Upload - Gerenciamento de arquivos

📁 Estrutura do Projeto
cariocando/
├── app/
│   ├── Http/Controllers/     # Controladores da aplicação
│   ├── Models/              # Modelos Eloquent
│   └── Providers/           # Service Providers
├── database/
│   ├── migrations/          # Migrations do banco
│   └── seeders/            # Dados de exemplo
├── public/
│   └── cariocando_assets/   # Assets estáticos
├── resources/
│   ├── views/              # Templates Blade
│   ├── css/                # Estilos customizados
│   └── js/                 # Scripts JavaScript
└── routes/
    └── web.php             # Definição de rotas
🗄️ Modelagem do Banco de Dados
Entidades Principais

Users - Sistema completo de usuários
Categorias - Classificação de roteiros
Postagens - Roteiros compartilhados
Audits - Log de atividades do sistema

Relacionamentos

User 1:N Postagens (Um usuário pode ter várias postagens)
Categoria 1:N Postagens (Uma categoria pode ter várias postagens)
Sistema de auditoria completo para rastreabilidade

🚀 Como Executar
Pré-requisitos

PHP 8.1 ou superior
Composer
MySQL 5.7+
Node.js (opcional, para assets)

Instalação
bash# Clone o repositório
git clone https://github.com/seu-usuario/cariocando.git
cd cariocando

# Instale as dependências
composer install

# Configure o ambiente
cp .env.example .env
php artisan key:generate

# Configure o banco de dados no .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cariocando
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

# Execute as migrations
php artisan migrate

# (Opcional) Execute os seeders para dados de exemplo
php artisan db:seed

# Crie o link simbólico para storage
php artisan storage:link

# Inicie o servidor
php artisan serve
Acesse: http://localhost:8000
📱 Screenshots
Página Inicial
Interface moderna e atrativa com hero section e cards de roteiros em destaque.
Sistema de Roteiros
CRUD completo com rich text editor, upload de imagens e sistema de categorização.
Quiz de Preferências
Algoritmo inteligente que sugere roteiros baseado nas preferências do usuário.
Dashboard Administrativo
Interface AdminLTE para gestão completa do sistema.
🎯 Diferenciais Técnicos
🔒 Segurança

Validação robusta de dados
Proteção CSRF
Sanitização de inputs
Middleware de autenticação

⚡ Performance

Eager loading para otimização de queries
Paginação eficiente
Cache de configurações
Otimização de assets

🎨 UX/UI

Design responsivo mobile-first
Interface intuitiva e moderna
Feedback visual em tempo real
Navegação fluida

🌟 Próximas Implementações

 API RESTful para integração mobile
 Sistema de comentários nos roteiros
 Geolocalização com mapas interativos
 Sistema de seguir usuários
 Notificações push
 Integração com redes sociais
 Sistema de favoritos
 Chat em tempo real

👨‍💻 Sobre o Desenvolvedor
**Desenvolvido por: Henrique de Jesus Freitas Pereira** recém-formado em Técnico em Informática pelo Colégio Santo Inácio, atualmente cursando Engenharia de Software na Estácio de Sá.
**Colaboradores: Mateus José Rodrigues, Josiele Alves Antunes , Ana Clara Rodrigues de Sá** recém-formados em Técnico em Informática pelo Colégio Santo Inácio

*Projeto final do curso Técnico em Informática - Colégio Santo Inácio*
🚀 Competências Demonstradas

Desenvolvimento Full-Stack com Laravel
Arquitetura MVC e boas práticas
Banco de dados relacionais e modelagem
Interface responsiva e experiência do usuário
Uso estratégico de IA como ferramenta de desenvolvimento
Gestão de projetos e trabalho em equipe

🎯 Objetivo Profissional
Busco oportunidades de estágio ou posição júnior em desenvolvimento web para aplicar conhecimentos técnicos e continuar evoluindo na área de tecnologia.
📞 Contato

📧 Email: Henrique.jfp@outlook.com
💼 LinkedIn: https://www.linkedin.com/in/henrique-jfp/
🐙 GitHub: https://github.com/rikeffc
📱 WhatsApp: (21) 98528-7511

📄 Licença
Este projeto foi desenvolvido para fins educacionais como projeto final do curso Técnico em Informática.


"A tecnologia sozinha não basta. É a tecnologia casada com as artes liberais, casada com as humanidades, que nos traz o resultado que faz nosso coração cantar." - Steve Jobs
