document.addEventListener("DOMContentLoaded", function () {
    const verticalHeader = document.querySelector(".dashboard-header-vertical");
    const extendedHeader = document.querySelector(".dashboard-header-extended");
    const backButton = document.querySelector(".dashboard-header-voltar");
    const clienteModal = document.querySelector(".clientes-modal"); // Seleciona o modal
    const saveButton = document.getElementById("saveButton");
    const deleteButton = document.getElementById("deleteButton"); // Seleciona o botão de exclusão
    const userCommentsContainer = document.getElementById("userCommentsContainer"); // Container para os comentários

    /**
     * Função para carregar comentários do cliente
     * @param {number} clientId - ID do cliente cujos comentários serão carregados
     */
    async function loadUserComments(clientId) {
        try {
            const response = await fetch(`/clientes/${clientId}/comentarios`); // Endpoint para buscar comentários
            if (!response.ok) throw new Error("Erro ao carregar comentários");

            const comentarios = await response.json();

            // Limpar o container antes de recarregar
            if (userCommentsContainer) {
                userCommentsContainer.innerHTML = "";

                // Adicionar cada comentário ao container
                comentarios.forEach((comentario) => {
                    const commentTextarea = document.createElement("textarea"); // Usa textarea para exibir comentários
                    commentTextarea.classList.add("comment-item"); // Adiciona a classe de estilo
                    commentTextarea.setAttribute("readonly", true); // Torna o campo somente leitura
                    commentTextarea.value = comentario.comentario; // Define o texto do comentário
                    userCommentsContainer.appendChild(commentTextarea); // Adiciona o comentário ao container
                });
            }
        } catch (error) {
            console.error("Erro ao carregar comentários:", error);
        }
    }

    // Verifica se o modal está presente
    if (clienteModal) {
        const clienteId = clienteModal.getAttribute("data-cliente-id"); // Obtém o ID do cliente do atributo data
        console.log("ID do cliente encontrado:", clienteId); // Verifica se o ID foi encontrado

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

        // Verifica se o botão Salvar foi encontrado
        if (saveButton) {
            console.log("Botão Salvar encontrado!"); // Verifica se o botão foi encontrado no DOM

            // Lógica para salvar as alterações do cliente
            saveButton.addEventListener("click", () => {
                console.log("Botão Salvar clicado!"); // Verifica se o evento está sendo registrado

                // Captura os valores dos campos
                const nome = document.getElementById("nome").value;
                const telefone = document.getElementById("telefone").value;
                const email = document.getElementById("email").value;

                console.log({ clienteId, nome, telefone, email }); // Verifica os valores capturados

                // Obtém o token CSRF
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');

                if (!csrfTokenMeta) {
                    console.error("CSRF token não encontrado! Adicione a tag <meta name='csrf-token'> no HTML.");
                    return; // Interrompe a execução se o token não for encontrado
                }

                const csrfToken = csrfTokenMeta.getAttribute("content");

                // Envia os dados via fetch para o backend
                fetch(`/clientes/update/${clienteId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken, // Usa o token CSRF obtido
                    },
                    body: JSON.stringify({ nome, telefone, email }),
                })
                    .then((response) => {
                        if (response.ok) {
                            alert("Alterações salvas com sucesso!");
                            location.reload(); // Recarrega a página
                        } else {
                            alert("Erro ao salvar as alterações.");
                        }
                    })
                    .catch((error) => {
                        console.error("Erro:", error);
                    });
            });
        } else {
            console.error("Botão Salvar não encontrado!"); // Log se o botão não for encontrado
        }

        // Verifica se o botão Excluir foi encontrado
        if (deleteButton) {
            deleteButton.addEventListener("click", () => {
                const confirmDelete = confirm(
                    "Tem certeza de que deseja excluir este cliente? Essa ação não pode ser desfeita!"
                );

                if (confirmDelete) {
                    // Obtém o token CSRF
                    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfTokenMeta) {
                        console.error("CSRF token não encontrado! Adicione a tag <meta name='csrf-token'> no HTML.");
                        return; // Interrompe a execução se o token não for encontrado
                    }

                    const csrfToken = csrfTokenMeta.getAttribute("content");

                    // Envia a requisição para excluir o cliente
                    fetch(`/clientes/delete/${clienteId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken, // Usa o token CSRF
                        },
                    })
                        .then((response) => {
                            if (response.ok) {
                                alert("Cliente excluído com sucesso!");
                                window.location.href = "/clientes"; // Redireciona para a lista de clientes
                            } else {
                                alert("Erro ao excluir o cliente.");
                            }
                        })
                        .catch((error) => {
                            console.error("Erro:", error);
                        });
                }
            });
        } else {
            console.error("Botão Excluir não encontrado!"); // Log se o botão não for encontrado
        }

        // Carregar comentários ao abrir o modal, se o container existir
        if (userCommentsContainer) {
            loadUserComments(clienteId);
        }
    } else {
        console.error("Modal não encontrado ou atributo 'data-cliente-id' ausente!"); // Log se o modal não for encontrado
    }
});