<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Milímetro Planejados</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__left">
            <a href="#inicio" class="header__link">Início</a>
            <a href="#galeria" class="header__link">Galeria</a>
            <a href="#sobre" class="header__link">Sobre</a>
        </div>
        <div class="header__right">
            <a href="{{ route('login') }}" class="header__link">Área do Funcionário</a>
        </div>
    </header>

    <section id="inicio" class="inicio">
        <div class="inicio__esquerda">
            <h1>No Milímetro Planejados</h1>
        </div>
        <div class="inicio__direita">
            <div class="modal">
                <h2 class="modal__titulo">Entre em Contato</h2>
                <form class="modal__form" id="clientForm" action="{{ route('clients.store') }}" method="POST">
                    @csrf
                    <input type="text" name="nome" placeholder="Nome *" required>
                    <input type="email" name="email" placeholder="Email">
                    <input type="tel" name="telefone" placeholder="Telefone *" required>
                    <textarea name="comentarios" placeholder="Comentários"></textarea>
                    <button type="submit" class="modal__botao modal__botao--cinza">Enviar</button>
                    <a href="https://wa.me/5511945104855" target="_blank" class="modal__botao modal__botao--verde">Whatsapp</a>
                    <p class="modal__mensagem" id="successMessage" style="display: none; color: green;">Informações enviadas com sucesso!</p>
                </form>
            </div>
        </div>
    </section>

    <section id="galeria" class="galeria">
        <div class="galeria__conteudo">
            <h2 class="galeria__titulo">Galeria</h2>
            <p class="galeria__texto">
                Por que escolher a No Milímetro Planejados?<br>
                ✔️ <strong>Qualidade e Personalização:</strong> Projetos feitos sob medida para você.<br>
                ✔️ <strong>Preço Justo:</strong> Transforme seu espaço sem gastar mais do que precisa.<br>
                ✔️ <strong>Atendimento Próximo:</strong> Cuidamos de tudo com atenção e transparência.
            </p>
            <div class="galeria__modal">
                <div class="galeria__grid">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <div class="lightbox hidden">
            <div class="lightbox__content">
                <button class="lightbox__close" aria-label="Fechar">&times;</button>
                <img src="" alt="Ampliada" class="lightbox__image">
                <button class="lightbox__prev" aria-label="Imagem anterior">&lt;</button>
                <button class="lightbox__next" aria-label="Próxima imagem">&gt;</button>
            </div>
        </div>
    </section>

    <footer id="sobre" class="footer">
        <div class="footer__content">
            <div class="footer__left">
                <!-- 
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.938587062347!2d-46.485997524572245!3d-23.570315667306705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce5e9e1c2b2d1f%3A0x4a5b3b7eae7f6442!2sR.%20Acuru%C3%AD%2C%20560%20-%20Vila%20Formosa%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2003310-030!5e0!3m2!1spt-BR!2sbr!4v1698257313462!5m2!1spt-BR!2sbr"
                    width="100%" height="200" style="border:0;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    title="Localização no Google Maps">
                </iframe>
                -->
            </div>

            <div class="footer__center">
                <h3>Higor Leal</h3>
                <p>
                    📞 <a href="https://wa.me/5511945104855" target="_blank" style="text-decoration: none; color: inherit;">
                        <strong>(11) 94510-4855</strong>
                    </a>
                </p>
                <p>
                    📧 <strong>nomilimetroplanejados@gmail.com</strong>
                </p>
                <!-- 
                <p>
                    📍 <a href="https://www.google.com/maps?sca_esv=c9370329d8b01a80&rlz=1C1VDKB_enBR1135BR1135&output=search&q=rua+acuri+560&source=lnms&fbs=ABzOT_BYhiZpMrUAF0c9tORwPGlssxTeO7BMOlalbdyQXag72r1qnNd-MghSp-MLF7ZupKKAqc3LDF8eqeAFk8ltK6KhRwCC5Rq3QhHrAs5nGdeHlNpbuZPkU5eQDB-Aw1vmZrlmquKzvyWTxT7k_4KEY-lGPtRaM4UjF0AwQCPDnpd8SyhzckiUu7WNOpGejFjs2bb0jCApxbg2zDFbnJRcMkjV2n1HqA&entry=mc&ved=1t:200715&ictx=111"
                        target="_blank" style="text-decoration: none; color: inherit;">
                        <strong>Rua Acuruí 560</strong>
                    </a>
                </p>
                -->
            </div>

            <div class="footer__right">
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>