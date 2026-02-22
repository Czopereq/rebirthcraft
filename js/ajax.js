function refreshStats() {
    fetch('get_stats.php')
        .then(response => response.text())
        .then(data => {
            const tableBody = document.getElementById('stats-body');
            if (tableBody) {
                tableBody.innerHTML = data;
            }
            const updateTime = document.getElementById('last-update');
            if (updateTime) {
                const now = new Date();
                updateTime.innerText = now.toLocaleTimeString();
            }
        })
        .catch(error => console.error('Błąd pobierania statystyk:', error));
}
document.addEventListener("DOMContentLoaded", refreshStats);
setInterval(refreshStats, 30000);