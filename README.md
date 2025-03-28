# No Milímetro Planejados

Bem-vindo ao repositório do **No Milímetro Planejados**, uma aplicação desenvolvida para gerenciar clientes, projetos e processos de uma marcenaria. Este sistema combina tecnologias modernas e práticas de desenvolvimento robustas para oferecer uma solução eficiente e intuitiva.

## Sumário
1. [Descrição do Projeto](#descri%C3%A7%C3%A3o-do-projeto)
2. [Funcionalidades](#funcionalidades)
3. [Tecnologias e Ferramentas Utilizadas](#tecnologias-e-ferramentas-utilizadas)
4. [Requisitos do Sistema](#requisitos-do-sistema)
5. [Instalação](#instala%C3%A7%C3%A3o)
6. [Estrutura de Diretórios](#estrutura-de-diret%C3%B3rios)
7. [Endpoints da API](#endpoints-da-api)
8. [Detalhes das Funcionalidades](#detalhes-das-funcionalidades)
9. [Considerações de Segurança](#considera%C3%A7%C3%B5es-de-seguran%C3%A7a)
10. [Contribuindo](#contribuindo)
11. [Licença](#licen%C3%A7a)

---

## Descrição do Projeto
O **No Milímetro Planejados** é uma aplicação desenvolvida para atender às necessidades de gestão de uma marcenaria de móveis planejados. O sistema oferece:

- **Gerenciamento de clientes**
- **Envio de comunicações**
- **Geração de relatórios em PDF**
- **Autenticação segura com MFA** (Autenticação Multifator)
- **Interface amigável e responsiva** para uso em desktops e dispositivos móveis

---

## Funcionalidades
### 1. Gestão de Clientes
- Cadastro, edição e exclusão de clientes
- Exibição de perfil e comentários
- Upload de comentários e relatórios em PDF

### 2. Página Inicial (Landing Page)
- Formulário de cadastro de clientes
- Galeria de imagens interativa
- Contato direto via WhatsApp

### 3. Dashboard
- Navegação interativa
- Acesso rápido a funcionalidades

### 4. Perfil do Usuário
- Upload de imagem de perfil
- Edição de dados
- Alterar senha e excluir conta

### 5. Autenticação
- Login com suporte a MFA
- Registro e redefinição de senha

### 6. Geração de Relatórios
- Exportação de lista de clientes para PDF

### 7. Segurança
- MFA, tokens CSRF e criptografia de senhas

---

## Tecnologias e Ferramentas Utilizadas

### Frameworks e Linguagens
- **Laravel 11** (PHP 8.2)
- **JavaScript (ES6)**
- **SCSS (SASS)**

### Banco de Dados
- **MySQL**

### Front-End
- **Blade** (Laravel)
- **Bootstrap**

### Bibliotecas e Dependências
- **Dompdf** (PDFs)
- **PragmaRX Google2FA** (MFA)
- **MPDF** (PDFs)
- **Axios** (AJAX)

### Outras Ferramentas
- **Vite** (Gerenciamento de assets)
- **Composer** e **NPM**
- **Mailtrap/Gmail SMTP** (E-mails)

---

## Requisitos do Sistema

### Servidor
- **PHP >= 8.2**
- **MySQL >= 5.7**
- **Composer >= 2.0**

### Ambiente de Desenvolvimento
- **Node.js >= 18.0**
- **NPM >= 9.0**
- **Vite >= 1.2**

---

## Instalação
```sh
# 1. Clonar o Repositório
git clone https://github.com/EnzoVieira3012/NoMilimetroPlanejado.git
cd NoMilimetroPlanejado

# 2. Instalar Dependências
git install
composer install
npm install

# 3. Configurar o Arquivo .env
cp .env.example .env

# 4. Configurar a Aplicação
php artisan key:generate
php artisan migrate --seed

# 5. Compilar os Assets
npm run build

# 6. Iniciar o Servidor
php artisan serve
```

---

## Estrutura de Diretórios
```
NoMilimetroPlanejados/
├── app/            # Back-end (Controllers, Models, Middleware)
├── bootstrap/      # Inicialização da aplicação
├── config/         # Configuração do sistema
├── database/       # Migrations e Seeders
├── public/         # Arquivos públicos
├── resources/      # Views, SCSS, JS
├── routes/         # Arquivos de rotas
├── storage/        # Logs e cache
├── tests/          # Testes automatizados
└── vendor/         # Dependências do Composer
```

---

## Endpoints da API

### Autenticação
| Método | Endpoint | Descrição |
|--------|----------|------------|
| GET    | /login   | Página de login |
| POST   | /login   | Realiza login |
| GET    | /register | Página de registro |
| POST   | /register | Registra usuário |
| GET    | /password | Página de redefinição de senha |
| POST   | /password/email | Envia código de redefinição |
| POST   | /password/reset | Redefine senha |

---

## Considerações de Segurança
- **Senhas criptografadas** com bcrypt
- **Uso de variáveis de ambiente** para credenciais
- **Proteção CSRF** em todos os formulários
- **MFA** para login seguro

---

## Contribuindo
1. Faça um fork do repositório.
2. Crie uma branch:
   ```sh
   git checkout -b minha-feature
   ```
3. Envie suas alterações:
   ```sh
   git push origin minha-feature
   ```

---

## Licença
Este projeto é licenciado sob a **MIT License**.

