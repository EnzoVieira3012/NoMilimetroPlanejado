<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuário</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Adicionada a meta tag CSRF -->
</head>

<body class="dashboard-layout user-profile-layout"> <!-- Adicionada a classe user-profile-layout -->
    <!-- Header Container -->
    <div class="dashboard-header-container">
        @include('pages.components.vertical-header') <!-- Vertical Header -->
        @include('pages.components.extended-header') <!-- Extended Header -->
    </div>

    <!-- Título da Página -->
    <div class="user-profile-title">
        Perfil de Usuário
    </div>

    <!-- Conteúdo Principal -->
    <div class="dashboard-content">
        <div class="dashboard-content__image"></div>
    </div>

    <!-- Modais -->
    <!-- Primeiro Modal -->
    <div class="user-profile-modal">
        <div class="modal-content">
            <!-- Título do Modal -->
            <h2 class="modal-title">Informações</h2>

            <!-- Seção da Esquerda -->
            <div class="modal-section modal-section-left">
                <div class="profile-image-container">
                    <img id="profile-image" src="{{ Auth::user()->profile_image ? asset('uploads/profile_images/' . Auth::user()->profile_image) : 'https://via.placeholder.com/150' }}" alt="Perfil do usuário" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;"> <!-- Corrigido o texto do alt -->
                </div>
                <input type="file" id="upload-input" style="display: none;"> <!-- Input de arquivo oculto -->
                <button class="upload-button" id="upload-button">Upload Imagem</button>
            </div>

            <!-- Seção do Meio -->
            <div class="modal-section modal-section-middle">
                <input type="text" id="name" class="editable-field" value="{{ Auth::user()->name }}" placeholder="Nome do Usuário">
                <input type="email" id="email" class="editable-field" value="{{ Auth::user()->email }}" placeholder="Email">
            </div>

            <!-- Seção da Direita -->
            <div class="modal-section modal-section-right">
                <button class="modal-button" id="change-password-button">Alterar Senha</button>
                <button class="modal-button" id="delete-account-button">Deletar Conta</button>
                <button class="modal-button modal-save-button" id="save-profile-button">Salvar</button>
            </div>
        </div>
    </div>

    <!-- Segundo Modal -->
    <div class="user-profile-modal-secondary" style="display: none;">
        <div class="modal-content-secondary">
            <!-- Título do Modal -->
            <h2 class="modal-title-secondary" id="secondary-modal-title">Alterar Senha</h2> <!-- Título dinâmico -->

            <!-- Seção da Esquerda -->
            <div class="modal-section modal-section-left">
                <!-- Campo dinâmico da esquerda -->
                <input type="password" id="left-input" class="editable-field" placeholder="Nova Senha">
            </div>

            <!-- Seção do Meio -->
            <div class="modal-section modal-section-middle">
                <!-- Campo dinâmico do meio -->
                <input type="password" id="middle-input" class="editable-field" placeholder="Senha Atual">
            </div>

            <!-- Seção da Direita -->
            <div class="modal-section modal-section-right">
                <!-- Botões dinâmicos -->
                <button class="modal-button" id="cancel-button">Cancelar</button>
                <button class="modal-button modal-save-button" id="action-button">Salvar</button>
            </div>
        </div>
    </div>

    <!-- Script de Controle -->
    <script src="{{ asset('js/user-profile.js') }}"></script> <!-- Carrega o JS específico da página -->
</body>

</html>
