<div class="dashboard-header-extended">
    <!-- Topo do Extended Header -->
    <div class="dashboard-header-extended__top">
        <div class="dashboard-header-extended-icon dashboard-header-voltar"></div> <!-- Ícone de Voltar -->
        <div class="dashboard-header-extended-icon dashboard-header-logo-extended"></div> <!-- Logo Extended -->
        <div class="dashboard-header-extended-icon dashboard-header-divisor-extended"></div> <!-- Divisor Extended -->

        <!-- Item de Perfil de Usuário com link -->
        <div class="dashboard-header-extended-item">
            <a href="{{ route('user-profile') }}" class="dashboard-header-extended-link" style="display: flex; align-items: center; text-decoration: none;">
                <div class="dashboard-header-extended-icon dashboard-header-user" style="margin-right: 8px;"></div> <!-- Ícone de Usuário -->
                <span class="dashboard-header-extended-text">Perfil de Usuário</span>
            </a>
        </div>

        <!-- Item de Lista de Clientes com link -->
        <div class="dashboard-header-extended-item">
            <a href="{{ route('clientes') }}" class="dashboard-header-extended-link" style="display: flex; align-items: center; text-decoration: none;">
                <div class="dashboard-header-extended-icon dashboard-header-clientes"></div> <!-- Ícone de Clientes -->
                <span class="dashboard-header-extended-text">Lista de Clientes</span>
            </a>
        </div>
    </div>

    <!-- Base do Extended Header -->
    <div class="dashboard-header-extended__bottom">
        <div class="dashboard-header-extended-icon dashboard-header-divisor-extended-bottom"></div> <!-- Divisor Extended Bottom -->

        <!-- Botão de Logout -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; cursor: pointer; display: flex; align-items: center;">
                <div class="dashboard-header-extended-item">
                    <div class="dashboard-header-extended-icon dashboard-header-sair"></div> <!-- Ícone de Sair -->
                    <span class="dashboard-header-extended-text">Encerrar Sessão</span> <!-- Texto -->
                </div>
            </button>
        </form>
    </div>
</div>
