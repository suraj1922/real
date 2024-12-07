document.addEventListener('DOMContentLoaded', function () {
    const contractsTable = document.getElementById('contracts-table');
    const rows = contractsTable.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const endDate = row.cells[3].innerText;  // Getting the end date cell

        // Check if the contract is expiring today
        const today = new Date().toISOString().split('T')[0];
        if (endDate === today) {
            alert('A contract is expiring today!');
        }
    });
});
