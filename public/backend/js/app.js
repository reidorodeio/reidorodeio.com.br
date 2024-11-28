
function fetchDashboardData() {
    fetch("{{ route('dashboard.data') }}")
        .then(response => response.json())
        .then(data => {
            document.getElementById('totalUsers').textContent = data.totalUsers;
            document.getElementById('totalAwards').textContent = data.totalAwards;
            document.getElementById('totalBolao').textContent = data.totalBolao;
        })
        .catch(error => console.error('Erro ao buscar dados do dashboard:', error));
}
