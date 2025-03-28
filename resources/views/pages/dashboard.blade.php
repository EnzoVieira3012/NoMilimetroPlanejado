<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-layout">
    <!-- Header Container -->
    <div class="dashboard-header-container">
        @include('pages.components.vertical-header')

        <!-- Extended Header (inicialmente oculto) -->
        @include('pages.components.extended-header')
    </div>

    <!-- Imagem de Fundo da Dashboard -->
    <div class="dashboard-content">
        <div class="dashboard-content__image"></div>
    </div>

    <!-- Script de Controle -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>
