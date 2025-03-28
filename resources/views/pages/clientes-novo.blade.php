<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Cliente</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-layout clientes-novo-layout"> <!-- Classe específica para a página -->
    <!-- Header Container -->
    <div class="dashboard-header-container">
        @include('pages.components.vertical-header') <!-- Vertical Header -->
        @include('pages.components.extended-header') <!-- Extended Header -->
    </div>

    <!-- Título da Página -->
    <div class="clientes-title">
        Novo Cliente
    </div>

    <!-- Conteúdo Principal -->
    <div class="dashboard-content">
        <div class="dashboard-content__image"></div> <!-- Imagem de fundo -->
    </div>

    <!-- Botões de Ação (Salvar e Cancelar) -->
    <div class="clientes-save-button-container">
        <!-- Botão de Cancelar -->
        <a href="{{ route('clientes') }}" class="clientes-cancel-button" style="text-decoration: none;">
            Cancelar
        </a>

        <!-- Botão de Salvar -->
        <button type="submit" form="novoClienteForm" class="clientes-save-button">Salvar</button>
    </div>

    <!-- Modais -->
    <div class="clientes-modais">
        <!-- Modal Superior -->
        <div class="modal modal-top">
            <h2 class="modal-title">Informações</h2>
            <!-- Formulário conectado ao endpoint -->
            <form class="modal-content" id="novoClienteForm" action="{{ route('clientes.store') }}" method="POST">
                @csrf <!-- Inclui o token CSRF para segurança -->

                <!-- Nome e Telefone -->
                <div class="modal-fields">
                    <!-- Nome -->
                    <div class="modal-section modal-section-left">
                        <input
                            type="text"
                            name="nome"
                            id="nome"
                            class="editable-field"
                            placeholder="Digite o Nome"
                            required>
                    </div>

                    <!-- Telefone -->
                    <div class="modal-section modal-section-right">
                        <input
                            type="tel"
                            name="telefone"
                            id="telefone"
                            class="editable-field"
                            placeholder="Digite o Telefone"
                            required>
                    </div>
                </div>

                <!-- Email -->
                <div class="modal-section modal-section-center">
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="editable-field"
                        placeholder="Digite o Email">
                </div>
            </form>
        </div>

        <!-- Modal Inferior -->
        <div class="modal modal-bottom">
            <h2 class="modal-title">Comentários</h2>
            <div class="modal-content">
                <!-- Campo de Comentários -->
                <textarea
                    name="comentarios"
                    id="comentarios"
                    class="editable-field comentarios-field"
                    placeholder="Escreva os comentários aqui..."></textarea>
            </div>
        </div>
    </div>

    <!-- Script de Controle -->
    <script src="{{ asset('js/clientes-novo.js') }}"></script> <!-- JS específico da página -->
</body>

</html>
