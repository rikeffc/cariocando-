# 🗺️ Cariocando - Portal de Roteiros Turísticos para o Rio de Janeiro

![Capa do Cariocando](https://i.imgur.com/link-para-uma-imagem-do-seu-projeto.png)
*(Dica: Tire um print da sua página principal e suba no site [Imgur](https://imgur.com/upload) para gerar um link e colocar aqui)*

## 🎯 Sobre o Projeto

O **Cariocando** é uma plataforma web completa, desenvolvida como Projeto de Conclusão de Curso (TCC) de Técnico em Informática. A aplicação funciona como um guia colaborativo, permitindo que usuários cadastrados criem, compartilhem e explorem roteiros e passeios turísticos pela cidade do Rio de Janeiro.

O objetivo foi construir uma solução robusta do zero, aplicando conceitos de desenvolvimento back-end e front-end em um projeto real e funcional.

---

## ✨ Principais Funcionalidades

* **Sistema de Autenticação Completo:** Cadastro e login de usuários com sessões seguras.
* **Perfis de Usuário:** Área pessoal onde cada usuário pode gerenciar seus dados e roteiros.
* **CRUD de Roteiros:** Funcionalidade completa para Criar, Ler, Atualizar e Deletar (CRUD) os roteiros turísticos na plataforma.
* **Design Responsivo:** Interface adaptável para uma boa experiência tanto em desktops quanto em dispositivos móveis.
* **Páginas Institucionais:** Seções como "Quem Somos" e "Contato" para apresentar o projeto.

---

## 🛠️ Tecnologias Utilizadas

* **Back-end:** PHP 8.1+
* **Framework:** Laravel 10+ (seguindo a arquitetura MVC)
* **Banco de Dados:** MySQL
* **Front-end:** HTML5, CSS3, JavaScript
* **Gerenciador de Dependências:** Composer

---

## ⚙️ Guia de Instalação e Configuração

Este guia detalha os passos para configurar e executar o projeto em um ambiente de desenvolvimento local.

### **Pré-requisitos**
* PHP >= 8.1
* Composer
* MySQL (ou MariaDB)
* Node.js e NPM (Opcional)
* Git

### **Passos para Configuração**

1.  **Clonar o Repositório**
    ```bash
    git clone [https://github.com/rikeffc/cariocando-.git](https://github.com/rikeffc/cariocando-.git)
    cd cariocando-
    ```

2.  **Instalar Dependências PHP**
    ```bash
    composer install
    ```

3.  **Configurar Arquivo de Ambiente (.env)**
    * Copie o arquivo de exemplo: `copy .env.example .env` (no Windows) ou `cp .env.example .env` (no Linux/Mac).
    * Gere a chave da aplicação: `php artisan key:generate`
    * Abra o arquivo `.env` e configure as credenciais do seu banco de dados:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=cariocando_db
        DB_USERNAME=root
        DB_PASSWORD=
        ```

4.  **Configurar Banco de Dados**
    * Crie um banco de dados no seu MySQL com o nome definido em `DB_DATABASE` (ex: `cariocando_db`).
    * Execute as migrações para criar as tabelas:
        ```bash
        php artisan migrate
        ```
    * (Opcional) Se houver seeders, popule o banco: `php artisan db:seed`

5.  **Criar Link de Armazenamento**
    ```bash
    php artisan storage:link
    ```

6.  **Iniciar o Servidor**
    ```bash
    php artisan serve
    ```
    Acesse a aplicação em `http://localhost:8000`.

---

## 👨‍💻 Equipe do Projeto

Este projeto foi desenvolvido em equipe como TCC por:

* **Henrique de Jesus Freitas Pereira**
* Mateus José Rodrigues
* Josiele Alves Antunes
* Ana Clara Rodrigues de Sá
