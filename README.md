# Cariocando.com - Descrição

Plataforma web desenvolvida para ser um guia colaborativo de roteiros e passeios no Rio de Janeiro. A aplicação foi construída utilizando PHP com o framework Laravel, seguindo a arquitetura MVC.

Principais funcionalidades:

Sistema completo de autenticação de usuários (login, cadastro e perfil).
CRUD (Criação, Leitura, Atualização e Deleção) de roteiros turísticos.
Páginas de conteúdo como "Quem Somos" e "Contato".

# Nome dos intregrantes:

Henrique de Jesus Freitas Pereira   
Mateus José Rodrigues
Josiele Alves Antunes
Ana Clara Rodrigues de Sá


# Cariocando.com - Guia de Configuração

Este guia detalha os passos para configurar e executar o projeto Cariocando.com em um ambiente de desenvolvimento local após cloná-lo do GitHub ou recebê-lo como um arquivo ZIP.

## Pré-requisitos

Antes de começar, certifique-se de que você tem os seguintes softwares instalados em sua máquina:

1.  **PHP:** Versão 8.1 ou superior (verifique a compatibilidade com a versão do Laravel do projeto, que é Laravel 10+, então PHP >= 8.1).
2.  **Composer:** Gerenciador de dependências para PHP.
3.  **Node.js e NPM:** (Opcional, mas recomendado se o projeto utilizar para compilação de assets frontend).
4.  **Servidor de Banco de Dados:** MySQL (ou MariaDB) é o utilizado neste projeto.
5.  **Git:** (Se estiver clonando do GitHub).

## Passos para Configuração

### 1. Obter os Arquivos do Projeto

*   **Opção A: Clonar do GitHub**
    ```bash
    git clone <URL_DO_SEU_REPOSITORIO_GIT> cariocando
    cd cariocando
    ```
*   **Opção B: Arquivo ZIP**
    1.  Extraia o conteúdo do arquivo ZIP para uma pasta de sua escolha (ex: `cariocando`).
    2.  Abra o terminal ou prompt de comando e navegue até essa pasta.
        ```bash
        cd caminho/para/cariocando
        ```

### 2. Instalar Dependências do PHP

Use o Composer para instalar todas as dependências PHP definidas no arquivo `composer.json`.
```bash
composer install
3. Configurar o Arquivo de Ambiente (.env)
Copie o arquivo de exemplo .env.example para um novo arquivo chamado .env. Este arquivo conterá suas 
configurações de ambiente locais.
copy .env.example .env

Gere uma chave de aplicação única para o seu projeto.
php artisan key:generate

Abra o arquivo .env em um editor de texto e configure as credenciais do seu banco de dados. Você precisará ajustar as seguintes variáveis (exemplo para MySQL):

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cariocando_db  
DB_USERNAME=root           
DB_PASSWORD=             


4. Criar o Banco de Dados
Crie manualmente o banco de dados no seu servidor MySQL com o nome que você especificou em DB_DATABASE no arquivo .env (ex: cariocando_db). Você pode usar uma ferramenta como phpMyAdmin, DBeaver, MySQL Workbench, ou o cliente de linha de comando do MySQL.

5. Executar as Migrações do Banco de Dados
As migrações criam as tabelas no seu banco de dados.
php artisan migrate
Opcional: Popular o Banco de Dados (Seeders) Se o projeto tiver "seeders" para popular o banco com dados iniciais (como categorias padrão, usuários administradores, etc.), execute:
php artisan db:seed


6. Criar o Link Simbólico para Armazenamento Público
Para que os arquivos enviados (como avatares, imagens de postagens) que são armazenados em storage/app/public fiquem acessíveis publicamente, crie um link simbólico.
php artisan storage:link


7. (Opcional) Instalar Dependências Frontend e Compilar Assets
Se o seu projeto utiliza Node.js para gerenciar assets frontend (CSS, JavaScript) e tem um arquivo package.json:

Instale as dependências Node:
bash
npm install
Compile os assets:
Para desenvolvimento (com observação de arquivos):

npm run build
Nota: Pelos arquivos fornecidos, parece que os assets CSS e JS (como o RickEditor) estão diretamente na pasta public. Se for esse o caso, este passo pode não ser estritamente necessário, a menos que haja um processo de compilação para outros assets não mencionados.


8. Iniciar o Servidor de Desenvolvimento
Agora você pode iniciar o servidor de desenvolvimento embutido do Laravel:
php artisan serve

9. Acessar a Aplicação
Abra seu navegador e acesse o endereço fornecido pelo comando php artisan serve (geralmente http://127.0.0.1:8000 ou http://localhost:8000).


========================================================================================================================================================================================================================





Solução de Problemas Comuns
Erro "No application encryption key has been specified.": Execute php artisan key:generate.

Erro de Permissão em storage ou bootstrap/cache: Em ambientes Linux/macOS, você pode precisar ajustar as permissões:

bash
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache # Ajuste 'www-data' para o usuário do seu servidor web
Rotas não encontradas ou Views não encontradas: Tente limpar os caches do Laravel:

bas
php artisan route:clear
php artisan config:clear
php artisan view:clear
php artisan cache:clear
Problemas com assets (CSS/JS não carregando):

Verifique se o link simbólico do storage foi criado corretamente (php artisan storage:link).
Se estiver usando npm, certifique-se de que os assets foram compilados (npm run dev ou npm run build).
Verifique os caminhos nos seus arquivos Blade (asset('...')).
Considerações Adicionais
AdminLTE: O projeto utiliza AdminLTE para a área administrativa. As rotas de autenticação (/login, /register) e o dashboard (/home) devem funcionar após a configuração.
RickEditor: Certifique-se de que os assets do RickEditor (CSS e JS) estão presentes na pasta public/RickEditor.
Variáveis de Ambiente Específicas: Se o projeto utiliza outras APIs ou serviços externos, pode haver outras variáveis no .env que precisam ser configuradas (ex: chaves de API para e-mail, etc.).
