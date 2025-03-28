document.addEventListener("DOMContentLoaded", () => {
    const header = document.querySelector(".header");

    // Detecta o movimento do mouse para exibir/ocultar o cabeçalho
    document.addEventListener("mousemove", (event) => {
        if (event.clientY <= 60) {
            // Se o mouse estiver na área do topo (primeiros 60px), mostra o cabeçalho
            header.classList.add("header--visible");
        } else {
            // Caso contrário, oculta o cabeçalho
            header.classList.remove("header--visible");
        }
    });

    // Scroll suave ao clicar nos links do cabeçalho
    document.querySelectorAll(".header__link").forEach((link) => {
        link.addEventListener("click", function (e) {
            const targetId = this.getAttribute("href");

            // Verifica se o href é um identificador de seção (começa com #)
            if (targetId.startsWith("#")) {
                e.preventDefault(); // Evita o comportamento padrão do link

                const targetSection = document.querySelector(targetId);

                if (targetSection) {
                    // Faz o scroll suave para a seção correspondente
                    targetSection.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                }
            } else {
                // Se não for um identificador de seção, deixa o redirecionamento padrão acontecer
                return true;
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const title = document.querySelector('.inicio__esquerda h1'); // Seleciona o título
    const modal = document.querySelector('.inicio__direita .modal'); // Seleciona o modal
    const inicioSection = document.querySelector('.inicio'); // Seleciona a seção inicial

    if (!title || !modal || !inicioSection) {
        console.error('Erro: Elementos da seção inicial não foram encontrados.');
        return;
    }

    // Função para adicionar as classes de animação
    const startAnimations = () => {
        title.classList.add('animate-title');
        modal.classList.add('animate-modal');
    };

    // Função para remover as classes de animação
    const resetAnimations = () => {
        title.classList.remove('animate-title');
        modal.classList.remove('animate-modal');
    };

    // Configuração do Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // Quando a seção "Início" entra na tela, inicia as animações
                startAnimations();
            } else {
                // Quando a seção "Início" sai da tela, reinicia as animações
                resetAnimations();
            }
        });
    });

    // Observar a seção "Início"
    observer.observe(inicioSection);

    // Garantir que as animações sejam exibidas ao carregar a página (se a seção já estiver visível)
    if (inicioSection.getBoundingClientRect().top >= 0 && inicioSection.getBoundingClientRect().bottom <= window.innerHeight) {
        startAnimations();
    }

    console.log('JavaScript para animações da seção inicial configurado com sucesso.');

    // Formulário de Cliente
    const clientForm = document.getElementById('clientForm');
    const successMessage = document.getElementById('successMessage');

    if (clientForm) {
        clientForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Impedir o envio padrão do formulário

            // Criar o objeto FormData
            const formData = new FormData(clientForm);

            // Enviar os dados via fetch (AJAX)
            fetch(clientForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // Indica que é uma requisição AJAX
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao enviar os dados');
                    }
                    return response.json();
                })
                .then(data => {
                    // Exibir a mensagem de sucesso dentro do modal
                    successMessage.style.display = 'block';
                    successMessage.textContent = data.message;

                    // Limpar o formulário
                    clientForm.reset();

                    // Esconder a mensagem após 3 segundos (opcional)
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 3000);
                })
                .catch(error => {
                    console.error(error);
                    successMessage.style.display = 'block';
                    successMessage.textContent = 'Erro ao enviar o formulário. Tente novamente.';
                    successMessage.style.color = 'red'; // Exibir mensagem de erro em vermelho

                    // Esconder a mensagem após 5 segundos (opcional)
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 5000);
                });
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Seleciona o conteúdo interno da seção de galeria
    const galeriaContent = document.querySelector('.galeria__conteudo');

    if (!galeriaContent) {
        console.error('Erro: Conteúdo da "galeria" não encontrado.');
        return;
    }

    // Função para adicionar a classe "visible" quando o conteúdo entrar na tela
    const handleIntersection = (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                galeriaContent.classList.add('visible'); // Adiciona a classe visível
                galeriaContent.classList.remove('hidden'); // Remove o estado inicial invisível
            } else {
                galeriaContent.classList.remove('visible'); // Remove a classe visível
                galeriaContent.classList.add('hidden'); // Torna invisível novamente
            }
        });
    };

    // Configuração do Intersection Observer
    const observer = new IntersectionObserver(handleIntersection, {
        threshold: 0.2, // 20% do conteúdo precisa estar visível para ativar
    });

    // Adiciona a classe "hidden" no estado inicial
    galeriaContent.classList.add('hidden');

    // Observa o conteúdo da galeria
    observer.observe(galeriaContent);
});

document.addEventListener('DOMContentLoaded', function () {
    const gridItems = document.querySelectorAll('.galeria__grid > div'); // Seleciona as células do grid
    const lightbox = document.querySelector('.lightbox');
    const lightboxImage = document.querySelector('.lightbox__image');
    const closeButton = document.querySelector('.lightbox__close');
    const prevButton = document.querySelector('.lightbox__prev');
    const nextButton = document.querySelector('.lightbox__next');

    let currentIndex = 0; // Índice da imagem atual

    // Lista das imagens (mesma ordem do SCSS)
    const images = [
        '/images/foto1.jpg',
        '/images/foto2.jpg',
        '/images/foto3.jpg',
        '/images/foto4.jpg',
        '/images/foto5.jpg',
        '/images/foto6.jpg',
        '/images/foto7.jpg',
        '/images/foto8.jpg',
        '/images/foto9.jpg',
    ];

    // Mostrar o lightbox com a imagem clicada
    const showLightbox = (index) => {
        currentIndex = index;
        const imageSrc = images[currentIndex]; // Pega a URL da imagem atual
        lightboxImage.src = imageSrc; // Define a imagem no lightbox
        lightbox.classList.add('visible'); // Mostra o lightbox
        lightbox.classList.remove('hidden'); // Remove a classe "hidden"
    };

    // Fechar o lightbox
    const closeLightbox = () => {
        lightbox.classList.remove('visible'); // Esconde o lightbox
        lightboxImage.src = ''; // Remove a imagem do lightbox
    };

    // Navegar para a próxima imagem
    const showNextImage = () => {
        currentIndex = (currentIndex + 1) % images.length; // Vai para a próxima imagem (circular)
        showLightbox(currentIndex);
    };

    // Navegar para a imagem anterior
    const showPrevImage = () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length; // Vai para a imagem anterior (circular)
        showLightbox(currentIndex);
    };

    // Adicionar eventos às células do grid para abrir o lightbox
    gridItems.forEach((item, index) => {
        item.addEventListener('click', () => showLightbox(index));
    });

    // Fechar o lightbox ao clicar no botão de fechar ou fora da imagem
    closeButton.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    // Navegar entre as imagens
    nextButton.addEventListener("click", showNextImage);
    prevButton.addEventListener("click", showPrevImage);

    // Fechar o lightbox ao pressionar "Esc"
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closeLightbox();
        } else if (e.key === "ArrowRight") {
            showNextImage();
        } else if (e.key === "ArrowLeft") {
            showPrevImage();
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const footerContent = document.querySelector('.footer__content'); // Seleciona o conteúdo interno do rodapé
    const footerSection = document.querySelector('.footer'); // Seleciona a seção do rodapé

    if (!footerContent || !footerSection) {
        console.error('Erro: Elementos do rodapé não foram encontrados.');
        return;
    }

    // Função para adicionar as classes de animação
    const startAnimation = () => {
        footerContent.classList.add('visible'); // Adiciona a classe visível para animar
        footerContent.classList.remove('hidden'); // Remove a classe invisível
    };

    // Função para remover as classes de animação (reset)
    const resetAnimation = () => {
        footerContent.classList.remove("visible"); // Remove a classe visível
        footerContent.classList.add("hidden"); // Adiciona a classe invisível
    };

    // Configuração do Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // Quando o footer entra na tela, inicia a animação
                startAnimation();
            } else {
                // Quando o footer sai da tela, reinicia a animação
                resetAnimation();
            }
        });
    }, {
        threshold: 0.2, // 20% do footer precisa estar visível para ativar
    });

    // Observa a seção do footer
    observer.observe(footerSection);

    // Garantir que a animação seja exibida ao carregar a página (se o footer já estiver visível)
    if (footerSection.getBoundingClientRect().top >= 0 && footerSection.getBoundingClientRect().bottom <= window.innerHeight) {
        startAnimation();
    }
});