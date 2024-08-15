document.getElementById("medalForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const country = document.getElementById("country").value;
    const gold = parseInt(document.getElementById("gold").value);
    const silver = parseInt(document.getElementById("silver").value);
    const bronze = parseInt(document.getElementById("bronze").value);
    const total = gold + silver + bronze;

    const tableBody = document.getElementById("medalTableBody");
    const newRow = tableBody.insertRow();

    newRow.innerHTML = `
        <td>${country}</td>
        <td>${gold}</td>
        <td>${silver}</td>
        <td>${bronze}</td>
        <td>${total}</td>
    `;

    // Limpiar formulario
    document.getElementById("medalForm").reset();
});