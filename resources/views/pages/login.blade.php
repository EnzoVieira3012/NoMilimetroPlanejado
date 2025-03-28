<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login">
    <div class="login__image"></div>

    <div class="login__modal">
        <a href="{{ route('home') }}" class="login__modal__close" aria-label="Fechar">&times;</a>
        <h2 class="login__modal__titulo">Login</h2>
        <form class="login__modal__form" action="{{ route('login.post') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Senha" autocomplete="current-password" required>
            <input type="text" name="codigo" placeholder="Código MFA (Microsoft Authenticator)" required>

            <!-- Link Esqueceu sua senha -->
            <a href="{{ route('password') }}" class="login__modal__link">Esqueceu sua senha?</a>
            
            <!-- Botão de login -->
            <button type="submit" class="login__modal__botao login__modal__botao--cinza">Entrar</button>
        </form>
        <p class="login__modal__texto">
            Ainda não tem uma conta? <a href="{{ route('register') }}" class="login__modal__link">Registre-se</a>
        </p>
    </div>
</body>

</html>
