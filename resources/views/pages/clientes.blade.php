<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-layout clientes-layout"> <!-- Adicionada a classe clientes-layout -->
    <!-- Header Container -->
    <div class="dashboard-header-container">
        @include('pages.components.vertical-header') <!-- Vertical Header -->
        @include('pages.components.extended-header') <!-- Extended Header -->
    </div>

    <!-- Título da Página -->
    <div class="clientes-title">
        Lista de Clientes
    </div>

    <!-- Conteúdo Principal -->
    <div class="dashboard-content">
        <div class="dashboard-content__image"></div> <!-- Adicionada a imagem de fundo -->
    </div>

    <!-- Filtro e Tabela -->
    <div class="clientes-content">
        <!-- Campo de Filtro e Botões -->
        <div class="clientes-filter">
            <!-- Campo de Filtro -->
            <input type="text" id="filterInput" placeholder="Pesquise por Nome, Email ou Telefone">

            <!-- Botões -->
            <div class="clientes-buttons">
                <a href="{{ route('clientes.pdf') }}" class="pdf-button">PDF</a>
                <a href="{{ route('clientes.create') }}" class="new-client-button">+ Novo Cliente</a>
            </div>
        </div>

        <!-- Tabela de Clientes -->
        <div class="clientes-table-container">
            <table class="clientes-table">
                <thead>
                    <tr>
                        <th data-column="nome" class="sortable">Nome</th>
                        <th data-column="email" class="sortable">Email</th>
                        <th data-column="telefone" class="sortable">Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                    <tr data-id="{{ $cliente->id }}" tabindex="0">
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->telefone }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="no-clients">Sem clientes registrados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="clientes-pagination">
            <button id="prevPage" disabled>Anterior</button>
            <span id="pageNumber">Página 1</span>
            <button id="nextPage">Próxima</button>
        </div>
    </div>

    <!-- Script de Controle -->
    <script src="{{ asset('js/clientes.js') }}"></script>
</body>

</html>
