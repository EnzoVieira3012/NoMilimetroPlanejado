document.addEventListener("DOMContentLoaded", function () {
    const verticalHeader = document.querySelector(".dashboard-header-vertical");
    const extendedHeader = document.querySelector(".dashboard-header-extended");
    const backButton = document.querySelector(".dashboard-header-voltar"); // Seleciona o botão de voltar

    // Inicialmente, só o vertical-header está visível, mas fora da tela
    setTimeout(() => {
        verticalHeader.classList.add("visible"); // Adiciona a classe para iniciar a animação
    }, 100); // Pequeno atraso para garantir a animação ao carregar a página

    // Ao clicar no Vertical Header, exibe o Extended Header
    verticalHeader.addEventListener("click", () => {
        verticalHeader.classList.remove("visible"); // Oculta o Vertical Header
        extendedHeader.classList.add("visible"); // Exibe o Extended Header
    });

    // Ao clicar no botão de voltar, volta para o Vertical Header
    backButton.addEventListener("click", () => {
        extendedHeader.classList.remove("visible"); // Oculta o Extended Header
        verticalHeader.classList.add("visible"); // Exibe o Vertical Header
    });
});