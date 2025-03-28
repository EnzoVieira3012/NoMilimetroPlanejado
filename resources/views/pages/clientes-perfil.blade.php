<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de {{ $cliente->nome }}</title> <!-- Título dinâmico na aba do navegador -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-layout clientes-perfil-layout"> <!-- Classe específica para a página -->
    <!-- Header Container -->
    <div class="dashboard-header-container">
        @include('pages.components.vertical-header') <!-- Vertical Header -->
        @include('pages.components.extended-header') <!-- Extended Header -->
    </div>

    <!-- Título da Página -->
    <div class="clientes-title">
        Perfil de {{ $cliente->nome }} <!-- Título dinâmico na página -->
    </div>

    <!-- Modal de Edição -->
    <div class="clientes-modal" data-cliente-id="{{ $cliente->id }}">
        <div class="modal">
            <div class="modal-content">
                <!-- Primeira linha: Nome e Telefone -->
                <div class="modal-fields">
                    <div class="modal-section">
                        <label for="nome">Nome</label>
                        <input
                            type="text"
                            id="nome"
                            class="editable-field"
                            value="{{ $cliente->nome }}"
                            placeholder="Digite o Nome">
                    </div>

                    <div class="modal-section">
                        <label for="telefone">Telefone</label>
                        <input
                            type="text"
                            id="telefone"
                            class="editable-field"
                            value="{{ $cliente->telefone }}"
                            placeholder="Digite o Telefone">
                    </div>
                </div>

                <!-- Segunda linha: Email -->
                <div class="modal-fields">
                    <div class="modal-section">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            class="editable-field"
                            value="{{ $cliente->email }}"
                            placeholder="Digite o Email">
                    </div>
                </div>

                <!-- Botão de Salvar -->
                <button id="deleteButton" class="clientes-delete-button">Excluir</button>
                <button id="saveButton" class="clientes-save-button">Salvar</button>
            </div>
        </div>
    </div>

    <!-- Segundo Modal -->
    <div class="clientes-modal comentarios-modal">
        <div class="modal">
            <div class="modal-content">
                <!-- Campo de Comentários -->
                <div class="modal-section">
                    <label for="comentarios">Comentários</label>
                    <textarea
                        id="comentarios"
                        class="readonly-field"
                        readonly>{{ $cliente->comentarios }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Terceiro Modal: Adicionar Comentário -->
    <div class="modal modal-bottom modal-add-user-comment">
        <div class="modal-content">
            <!-- Formulário atualizado -->
            <form action="{{ route('clientes.comentarios.store', $cliente->id) }}" method="POST">
                @csrf
                <textarea
                    name="comentario"
                    placeholder="Adicione um comentário..."
                    required></textarea>
                <button type="submit" class="clientes-save-button">Salvar Comentário</button>
            </form>
        </div>
    </div>

    <!-- Quarto Modal: Exibir Comentários do Usuário -->
    <div class="modal modal-bottom modal-user-comments">
        <div class="modal-content" id="userCommentsContainer">
            <!-- Comentários serão carregados aqui -->
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="dashboard-content">
        <div class="dashboard-content__image"></div> <!-- Imagem de fundo -->
    </div>

    <!-- Script de Controle -->
    <script src="{{ asset('js/clientes-perfil.js') }}"></script> <!-- JS específico da página -->
</body>

</html>
