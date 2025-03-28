<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testar Authenticator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        input {
            padding: 10px;
            width: calc(100% - 20px);
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

        .result {
            margin-top: 20px;
            font-size: 18px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Testar Microsoft Authenticator</h1>
        <p>Insira o código gerado pelo aplicativo Authenticator para validar a sincronização:</p>

        <form action="{{ route('test.authenticator.validate') }}" method="POST">
            @csrf
            <input type="text" name="codigo" placeholder="Código MFA" required>
            <button type="submit">Validar Código</button>
        </form>

        @if (isset($isValid))
            <div class="result">
                @if ($isValid)
                    <p class="success"><i class="fas fa-check-circle"></i> O código <strong>{{ $codigo }}</strong> é válido!</p>
                @else
                    <p class="error"><i class="fas fa-times-circle"></i> O código <strong>{{ $codigo }}</strong> é inválido.</p>
                @endif
            </div>
        @endif
    </div>
</body>

</html>
