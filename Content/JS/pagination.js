let currentPage = 1;
    const rowsPerPage = 5;
    const table = document.getElementById("topic-table");
    const rows = [...table.getElementsByTagName("tr")].slice(1); // Skip header row

    function displayTable() {
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? "" : "none";
        });

        updatePagination();
    }

    function updatePagination() {
        const totalPages = Math.ceil(rows.length / rowsPerPage);
        const pageNumbers = document.getElementById("page-numbers");
        pageNumbers.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.innerText = i;
            btn.onclick = () => goToPage(i);
            btn.style.fontWeight = i === currentPage ? "bold" : "normal";
            pageNumbers.appendChild(btn);
        }

        document.getElementById("prev-btn").disabled = currentPage === 1;
        document.getElementById("next-btn").disabled = currentPage === totalPages;
    }

    function changePage(step) {
        currentPage += step;
        displayTable();
    }

    function goToPage(page) {
        currentPage = page;
        displayTable();
    }

    function searchTable() {
        const query = document.getElementById("search-input").value.toLowerCase();
        localStorage.setItem("searchQuery", query);

        rows.forEach(row => {
            const username = row.cells[1].innerText.toLowerCase();
            const title = row.cells[3].innerText.toLowerCase();
            row.style.display = (username.includes(query) || title.includes(query)) ? "" : "none";
        });

        document.getElementById("pagination").style.display = query ? "none" : "block";
    }

    function restoreSearch() {
        const savedQuery = localStorage.getItem("searchQuery");
        if (savedQuery) {
            document.getElementById("search-input").value = savedQuery;
            searchTable();
        }
    }

    window.onload = () => {
        displayTable();
        restoreSearch();
    };

    //user table
    document.addEventListener("DOMContentLoaded", function () {
        let rowsPerPage = 5;
        let table = document.getElementById("user-table");
        let tbody = table.getElementsByTagName("tbody")[0] || table;
        let rows = Array.from(tbody.getElementsByTagName("tr"));
        let headerRow = rows.shift(); // Remove header row from pagination
        let totalRows = rows.length;
        let currentPage = 1;
        let totalPages = Math.ceil(totalRows / rowsPerPage);
        let filteredRows = [...rows]; // Clone array for search filtering
    
        // Load last page from localStorage
        let savedPage = localStorage.getItem("userTablePage");
        if (savedPage) {
            currentPage = parseInt(savedPage);
        }
    
        function showPage(page) {
            let start = (page - 1) * rowsPerPage;
            let end = start + rowsPerPage;
    
            // Keep the header row always visible
            headerRow.style.display = "";
    
            // Hide all rows first
            rows.forEach(row => row.style.display = "none");
    
            // Show only the rows for the current page
            for (let i = start; i < end && i < filteredRows.length; i++) {
                filteredRows[i].style.display = "";
            }
    
            currentPage = page;
            localStorage.setItem("userTablePage", currentPage);
            updatePaginationButtons();
        }
    
        function updatePaginationButtons() {
            let pageNumbersDiv = document.getElementById("page-numbers1");
            pageNumbersDiv.innerHTML = "";
    
            for (let i = 1; i <= totalPages; i++) {
                let btn = document.createElement("button");
                btn.textContent = i;
                btn.onclick = function () {
                    showPage(i);
                };
                if (i === currentPage) {
                    btn.style.fontWeight = "bold";
                }
                pageNumbersDiv.appendChild(btn);
            }
    
            // Disable buttons if necessary
            document.getElementById("prev-btn1").disabled = currentPage === 1;
            document.getElementById("next-btn1").disabled = currentPage === totalPages;
        }
    
        document.getElementById("prev-btn1").addEventListener("click", function () {
            if (currentPage > 1) {
                showPage(currentPage - 1);
            }
        });
    
        document.getElementById("next-btn1").addEventListener("click", function () {
            if (currentPage < totalPages) {
                showPage(currentPage + 1);
            }
        });
    
        // Search function
        document.getElementById("search-input1").addEventListener("keyup", function () {
            let filter = this.value.toLowerCase();
            filteredRows = rows.filter(row => {
                let usernameCell = row.getElementsByTagName("td")[1];
                return usernameCell && usernameCell.textContent.toLowerCase().includes(filter);
            });
    
            totalPages = Math.ceil(filteredRows.length / rowsPerPage) || 1;
            showPage(1);
        });
    
        showPage(currentPage);
    });

//for community table
document.addEventListener("DOMContentLoaded", function () {
    let rowsPerPage = 5;
    let table = document.getElementById("comm-table");
    let tbody = table.getElementsByTagName("tbody")[0] || table;
    let rows = Array.from(tbody.getElementsByTagName("tr"));
    let headerRow = rows.shift(); // Remove header row from pagination
    let totalRows = rows.length;
    let currentPage = 1;
    let totalPages = Math.ceil(totalRows / rowsPerPage);
    let filteredRows = [...rows]; // Clone array for search filtering

    // Load last page from localStorage
    let savedPage = localStorage.getItem("commTablePage");
    if (savedPage) {
        currentPage = parseInt(savedPage);
    }

    function showPage(page) {
        let start = (page - 1) * rowsPerPage;
        let end = start + rowsPerPage;

        // Keep the header row always visible
        headerRow.style.display = "";

        // Hide all rows first
        rows.forEach(row => row.style.display = "none");

        // Show only the rows for the current page
        for (let i = start; i < end && i < filteredRows.length; i++) {
            filteredRows[i].style.display = "";
        }

        currentPage = page;
        localStorage.setItem("commTablePage", currentPage);
        updatePaginationButtons();
    }

    function updatePaginationButtons() {
        let pageNumbersDiv = document.getElementById("page-numbers_comm");
        pageNumbersDiv.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            let btn = document.createElement("button");
            btn.textContent = i;
            btn.onclick = function () {
                showPage(i);
            };
            if (i === currentPage) {
                btn.style.fontWeight = "bold";
            }
            pageNumbersDiv.appendChild(btn);
        }

        // Disable buttons if necessary
        document.getElementById("prev-btn2").disabled = currentPage === 1;
        document.getElementById("next-btn2").disabled = currentPage === totalPages;
    }

    document.getElementById("prev-btn2").addEventListener("click", function () {
        if (currentPage > 1) {
            showPage(currentPage - 1);
        }
    });

    document.getElementById("next-btn2").addEventListener("click", function () {
        if (currentPage < totalPages) {
            showPage(currentPage + 1);
        }
    });

    // Search function
    document.getElementById("search-input-comm").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        filteredRows = rows.filter(row => {
            let communityNameCell = row.getElementsByTagName("td")[1];
            return communityNameCell && communityNameCell.textContent.toLowerCase().includes(filter);
        });

        totalPages = Math.ceil(filteredRows.length / rowsPerPage) || 1;
        showPage(1);
    });

    showPage(currentPage);
});
