document.addEventListener("DOMContentLoaded", function () {
    // Header e Extended Header
    const verticalHeader = document.querySelector(".dashboard-header-vertical");
    const extendedHeader = document.querySelector(".dashboard-header-extended");
    const backButton = document.querySelector(".dashboard-header-voltar");
    const saveButton = document.querySelector(".modal-save-button");

    // Upload de Imagem
    const uploadButton = document.querySelector("#upload-button");
    const fileInput = document.querySelector("#upload-input");
    const profileImage = document.querySelector("#profile-image");

    // Modal Secundário
    const secondModal = document.querySelector(".user-profile-modal-secondary");
    const modalTitle = document.querySelector("#secondary-modal-title");
    const leftInput = document.querySelector("#left-input");
    const middleInput = document.querySelector("#middle-input");
    const rightSectionSecondary = document.querySelector(".user-profile-modal-secondary .modal-section-right"); // Seção da direita no segundo modal
    const changePasswordButton = document.querySelector("#change-password-button"); // Botão Alterar Senha
    const deleteAccountButton = document.querySelector("#delete-account-button"); // Botão Deletar Conta

    // Exibe o Vertical Header imediatamente
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

    // Salvar Nome e Email
    saveButton.addEventListener("click", function () {
        const name = document.querySelector("#name").value;
        const email = document.querySelector("#email").value;

        // Envia os dados para o back-end
        fetch("/user-profile/update", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({
                name: name,
                email: email,
            }),
        })
            .then((response) => {
                // Verifica se a resposta do servidor foi bem-sucedida
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error("Erro ao salvar os dados");
                }
            })
            .then((data) => {
                // Exibe mensagem de sucesso retornada pelo servidor
                alert(data.message);
            })
            .catch((error) => {
                // Loga o erro no console e exibe uma mensagem ao usuário
                console.error("Erro ao atualizar os dados:", error);
                alert("Erro ao atualizar os dados. Tente novamente.");
            });
    });

    // Abrir o seletor de arquivos ao clicar no botão
    uploadButton.addEventListener("click", function () {
        fileInput.click(); // Simula o clique no input de arquivo
    });

    // Lida com o envio do arquivo selecionado
    fileInput.addEventListener("change", function () {
        const file = fileInput.files[0];

        if (file) {
            const formData = new FormData();
            formData.append("profile_image", file);

            // Faz a requisição AJAX para enviar a imagem
            fetch("/user-profile/upload-image", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: formData,
            })
                .then((response) => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error("Erro ao enviar a imagem");
                    }
                })
                .then((data) => {
                    // Atualiza a imagem no container com a URL retornada
                    alert(data.message);
                    profileImage.src = data.image_url; // Atualiza a exibição da imagem
                })
                .catch((error) => {
                    console.error("Erro:", error);
                    alert("Erro ao enviar a imagem. Tente novamente.");
                });
        }
    });

    // Função para mostrar o modal com configuração dinâmica
    function showModal(title, leftPlaceholder, middlePlaceholder, rightButtonsHTML) {
        modalTitle.textContent = title; // Atualiza o título do modal
        leftInput.placeholder = leftPlaceholder; // Atualiza o placeholder do campo da esquerda
        middleInput.placeholder = middlePlaceholder; // Atualiza o placeholder do campo do meio
        rightSectionSecondary.innerHTML = rightButtonsHTML; // Atualiza apenas os botões da seção direita do segundo modal
        secondModal.style.display = "block"; // Exibe o modal
        secondModal.classList.add("visible"); // Adiciona a classe para animar o modal

        // Adiciona evento "Cancelar" ao botão dinâmico
        document.querySelector("#cancel-button").addEventListener("click", function () {
            hideModal();
        });
    }

    // Função para ocultar o modal
    function hideModal() {
        secondModal.classList.remove("visible"); // Remove a classe de animação
        setTimeout(() => {
            secondModal.style.display = "none"; // Esconde o modal após a animação
        }, 500); // Aguarda a duração da animação
    }

    // Quando clicar em "Alterar Senha"
    changePasswordButton.addEventListener("click", function () {
        showModal(
            "Alterar Senha", // Título
            "Nova Senha", // Placeholder para o campo da esquerda
            "Senha Atual", // Placeholder para o campo do meio
            `
            <button class="modal-button" id="cancel-button">Cancelar</button>
            <button class="modal-button modal-save-button" id="save-password-button">Salvar</button>
            `
        );

        // Evento para o botão "Salvar" ao alterar a senha
        document.querySelector("#save-password-button").addEventListener("click", function () {
            const currentPassword = document.querySelector("#middle-input").value; // Senha Atual
            const newPassword = document.querySelector("#left-input").value; // Nova Senha

            // Envia os dados para o back-end
            fetch("/user-profile/update-password", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify({
                    current_password: currentPassword,
                    new_password: newPassword,
                    new_password_confirmation: newPassword, // Confirmação da nova senha
                }),
            })
                .then((response) => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error("Erro ao alterar a senha.");
                    }
                })
                .then((data) => {
                    alert(data.message); // Exibe mensagem de sucesso
                    hideModal(); // Oculta o modal
                })
                .catch((error) => {
                    console.error("Erro:", error);
                    alert("Erro ao alterar a senha. Verifique se os dados estão corretos.");
                });
        });
    });

    // Quando clicar em "Deletar Conta"
deleteAccountButton.addEventListener("click", function () {
    showModal(
        "Deletar Conta", // Título do modal
        "Digite sua Senha", // Placeholder para o campo da esquerda
        "Confirme sua Senha", // Placeholder para o campo do meio
        `
        <button class="modal-button" id="cancel-button">Cancelar</button>
        <button class="modal-button modal-save-button" id="confirm-delete-account-button">Deletar</button>
        `
    );

    // Remove qualquer evento antigo no botão de confirmação
    const confirmDeleteAccountButton = document.querySelector("#confirm-delete-account-button");
    confirmDeleteAccountButton.removeEventListener("click", handleDeleteAccount);

    // Adiciona o evento de clique ao botão "Deletar"
    confirmDeleteAccountButton.addEventListener("click", handleDeleteAccount);
}); // Fechamento do bloco principal

// Função para lidar com a exclusão da conta
function handleDeleteAccount() {
    const password = document.querySelector("#left-input").value; // Senha
    const confirmPassword = document.querySelector("#middle-input").value; // Confirmação da Senha

    // Verifica se as senhas coincidem
    if (password !== confirmPassword) {
        alert("As senhas não coincidem.");
        return;
    }

    // Envia os dados para o back-end
    fetch("/user-profile/delete-account", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({
            password: password,
        }),
    })
        .then((response) => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error("Erro ao deletar a conta.");
            }
        })
        .then((data) => {
            alert(data.message); // Exibe mensagem de sucesso do back-end
            window.location.href = "/"; // Redireciona para a página inicial
        })
        .catch((error) => {
            console.error("Erro:", error);
            alert("Erro ao deletar a conta. Verifique se os dados estão corretos.");
        });
} // Fechamento da função handleDeleteAccount
}); // Fechamento do document.addEventListener