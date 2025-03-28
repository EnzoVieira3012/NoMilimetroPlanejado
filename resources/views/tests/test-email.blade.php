<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Envio de E-mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        input {
            padding: 10px;
            width: 300px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .success {
            color: green;
            margin-top: 20px;
            font-size: 18px;
        }

        .error {
            color: red;
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <h1>Teste de Envio de E-mail</h1>
    <p>Insira um e-mail para testar o envio de um e-mail de redefinição de senha:</p>

    <form action="/test-email" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Digite o e-mail" required>
        <button type="submit">Enviar E-mail</button>
    </form>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <p class="error">{{ $errors->first('email') }}</p>
    @endif
</body>

</html>
