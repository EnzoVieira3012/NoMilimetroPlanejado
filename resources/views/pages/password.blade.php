<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudar Senha</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login {{ request()->get('step') == 2 ? 'phase-2' : 'phase-1' }}">
    <div class="login__image"></div>

    @if (!request()->has('step') || request()->get('step') == 1)
        <div class="login__modal">
            <a href="{{ route('home') }}" class="login__modal__close" aria-label="Fechar">&times;</a>
            <h2 class="login__modal__titulo">Mudar Senha</h2>

            <!-- Mensagens de sucesso ou erro dentro do modal -->
            @if (session('success'))
                <p style="color: green; text-align: center;">{{ session('success') }}</p>
            @endif

            @if ($errors->any())
                <p style="color: red; text-align: center;">{{ $errors->first() }}</p>
            @endif

            <form class="login__modal__form" action="{{ route('password.email') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Digite seu email" required>
                <button type="submit" class="login__modal__botao login__modal__botao--cinza">Enviar</button>
            </form>
            <p class="login__modal__texto">
                Lembrou a senha? <a href="{{ route('login') }}" class="login__modal__link">Faça Login</a>
            </p>
        </div>
    @endif

    @if (request()->has('step') && request()->get('step') == 2)
        <div class="login__modal">
            <a href="{{ route('home') }}" class="login__modal__close" aria-label="Fechar">&times;</a>
            <h2 class="login__modal__titulo">Mudar Senha</h2>

            <!-- Mensagens de sucesso ou erro dentro do modal -->
            @if (session('success'))
                <p style="color: green; text-align: center;">{{ session('success') }}</p>
            @endif

            @if ($errors->any())
                <p style="color: red; text-align: center;">{{ $errors->first() }}</p>
            @endif

            <form class="login__modal__form" action="{{ route('password.reset') }}" method="POST">
                @csrf
                <input type="text" name="codigo" placeholder="Digite o código" required>
                <input type="password" name="nova_senha" placeholder="Digite sua nova senha" required>
                <button type="submit" class="login__modal__botao login__modal__botao--cinza">Atualizar Senha</button>
            </form>
            <p class="login__modal__texto">
                Lembrou a senha? <a href="{{ route('login') }}" class="login__modal__link">Faça Login</a>
            </p>
        </div>
    @endif
</body>

</html>
