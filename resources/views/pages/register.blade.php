<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login">
    <div class="login__image"></div>

    <div class="login__modal">
        <a href="{{ route('home') }}" class="login__modal__close" aria-label="Fechar">&times;</a>
        <h2 class="login__modal__titulo">Registrar</h2>
        <form class="login__modal__form" action="{{ route('register.post') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Senha" required>

            <button type="submit" class="login__modal__botao login__modal__botao--cinza">Registrar</button>
        </form>
        <p class="login__modal__texto">
            Já possui uma conta? <a href="{{ route('login') }}" class="login__modal__link">Faça o Login</a>
        </p>
    </div>
</body>

</html>
