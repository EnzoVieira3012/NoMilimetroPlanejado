document.addEventListener("DOMContentLoaded", function () {
    // Header e Extended Header
    const verticalHeader = document.querySelector(".dashboard-header-vertical");
    const extendedHeader = document.querySelector(".dashboard-header-extended");
    const backButton = document.querySelector(".dashboard-header-voltar");

    const filterInput = document.getElementById("filterInput");
    const table = document.querySelector(".clientes-table tbody");
    const headers = document.querySelectorAll(".clientes-table th.sortable");
    const prevPageButton = document.getElementById("prevPage");
    const nextPageButton = document.getElementById("nextPage");
    const pageNumber = document.getElementById("pageNumber");

    let rows = Array.from(table.querySelectorAll("tr:not(.no-clients)")); // Captura as linhas originais
    const rowsPerPage = 5; // Número de linhas por página
    let currentPage = 1;
    let filteredRows = rows;
    let currentSort = { column: null, direction: null };

    // Função para alternar entre Vertical e Extended Header
    function initializeHeaders() {
        verticalHeader.classList.add("visible");

        verticalHeader.addEventListener("click", () => {
            verticalHeader.classList.remove("visible");
            extendedHeader.classList.add("visible");
        });

        backButton.addEventListener("click", () => {
            extendedHeader.classList.remove("visible");
            verticalHeader.classList.add("visible");
        });
    }

    // Atualiza a exibição da tabela com base na paginação
    function updatePagination() {
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach(row => (row.style.display = "none"));
        filteredRows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? "" : "none";
        });

        prevPageButton.disabled = currentPage === 1;
        nextPageButton.disabled = end >= filteredRows.length;
        pageNumber.textContent = `Página ${currentPage}`;
    }

    // Aplica o filtro às linhas da tabela
    function applyFilter() {
        const filterValue = filterInput.value.toLowerCase();

        filteredRows = rows.filter(row => {
            const nome = row.cells[0]?.textContent.toLowerCase() || "";
            const email = row.cells[1]?.textContent.toLowerCase() || "";
            const telefone = row.cells[2]?.textContent.toLowerCase() || "";

            return nome.includes(filterValue) || email.includes(filterValue) || telefone.includes(filterValue);
        });

        currentPage = 1;
        updatePagination();
    }

    // Função para ordenar os dados
    function sortTable(column, type) {
        const isReversed = currentSort.column === column && currentSort.direction === "asc";
        const direction = isReversed ? "desc" : "asc";

        rows.sort((a, b) => {
            const aValue = a.querySelector(`td:nth-child(${column})`).textContent.trim().toLowerCase();
            const bValue = b.querySelector(`td:nth-child(${column})`).textContent.trim().toLowerCase();

            if (type === "string") {
                if (aValue < bValue) return direction === "asc" ? -1 : 1;
                if (aValue > bValue) return direction === "asc" ? 1 : -1;
                return 0;
            } else if (type === "number") {
                const aNum = parseFloat(aValue.replace(/[^\d]/g, "")) || 0;
                const bNum = parseFloat(bValue.replace(/[^\d]/g, "")) || 0;

                return direction === "asc" ? aNum - bNum : bNum - aNum;
            }
        });

        rows.forEach(row => table.appendChild(row));
        currentSort = { column, direction };

        applyFilter();
    }

    // Adiciona eventos de clique nos cabeçalhos
    function initializeSorting() {
        headers.forEach((header, index) => {
            header.addEventListener("click", () => {
                const column = index + 1;
                const type = header.getAttribute("data-column") === "telefone" ? "number" : "string";
                sortTable(column, type);
            });
        });
    }

    // Redireciona para o perfil do cliente ao clicar em uma linha da tabela
    function initializeRowClick() {
        rows.forEach(row => {
            row.addEventListener("click", () => {
                const clientId = row.getAttribute("data-id");
                if (clientId) {
                    const profileUrl = `/clientes/perfil/${clientId}`;
                    window.location.href = profileUrl;
                }
            });
        });
    }

    // Função para atualizar automaticamente os dados da tabela
    async function atualizarTabela() {
        try {
            const response = await fetch("/clientes", { headers: { "X-Requested-With": "XMLHttpRequest" } });
            if (!response.ok) throw new Error("Erro ao buscar os dados da tabela.");

            const data = await response.json();
            table.innerHTML = data.html;

            rows = Array.from(table.querySelectorAll("tr:not(.no-clients)"));
            filteredRows = rows;

            initializeRowClick(); // Reaplica o evento de clique nas linhas
            updatePagination();
        } catch (error) {
            console.error("Erro ao atualizar a tabela:", error);
        }
    }

    // Configura eventos de paginação
    function initializePagination() {
        prevPageButton.addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                updatePagination();
            }
        });

        nextPageButton.addEventListener("click", () => {
            if (currentPage * rowsPerPage < filteredRows.length) {
                currentPage++;
                updatePagination();
            }
        });
    }

    // Inicializa todas as funcionalidades
    function initialize() {
        initializeHeaders();
        initializeSorting();
        initializeRowClick();
        initializePagination();

        filterInput.addEventListener("input", applyFilter);

        setInterval(atualizarTabela, 60000); // Atualiza a tabela automaticamente a cada 60 segundos
        atualizarTabela(); // Atualiza a tabela ao carregar a página
    }

    initialize();
});