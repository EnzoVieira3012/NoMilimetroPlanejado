document.addEventListener("DOMContentLoaded", function () {
    const verticalHeader = document.querySelector(".dashboard-header-vertical");
    const extendedHeader = document.querySelector(".dashboard-header-extended");
    const backButton = document.querySelector(".dashboard-header-voltar");

    // Exibe imediatamente o Vertical Header sem animação
    verticalHeader.classList.add("visible");

    // Exibe o Extended Header ao clicar no Vertical Header
    verticalHeader.addEventListener("click", () => {
        verticalHeader.classList.remove("visible"); // Oculta o Vertical Header
        extendedHeader.classList.add("visible"); // Exibe o Extended Header
    });

    // Retorna ao Vertical Header ao clicar no botão voltar
    backButton.addEventListener("click", () => {
        extendedHeader.classList.remove("visible"); // Oculta o Extended Header
        verticalHeader.classList.add("visible"); // Exibe o Vertical Header
    });
});