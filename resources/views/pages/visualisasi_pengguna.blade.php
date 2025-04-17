@extends('layouts.app')

@section('content')
<div class="container font-sans text-sm text-[#5a6570]">

    {{-- Judul --}}
    <h1 class="text-lg font-bold text-left mb-2">Visualisasi Data</h1>

    {{-- Dropdown Pilihan Visualisasi --}}
    <div class="mb-2 text-left">
        <label for="filterRole">Pilih Visualisasi:</label>
        <select id="filterRole" 
                class="ml-2 px-3 py-1 border border-gray-300 rounded"
                onchange="updateChart(this.value)">
            <option value="pie">Seluruh Pengguna</option>
            <option value="admin">Visualisasi Data Admin</option>
            <option value="sopir">Visualisasi Data Sopir</option>
            <option value="user">Visualisasi Data Masyarakat</option>
        </select>
    </div>

    {{-- Tombol Kembali --}}
    <div class="mb-6 text-left">
        <a href="{{ route('visualisasi') }}" 
           class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded shadow">
            ← Kembali
        </a>
    </div>

    {{-- Chart di Tengah --}}
    <div class="flex justify-center items-center">
        <div style="width: 100%; max-width: 500px;">
            <canvas id="userChart"></canvas>
        </div>
    </div>

</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userChart').getContext('2d');

    const userData = {
        labels: ['Admin', 'Sopir', 'User'],
        data: [{{ $data['admin'] }}, {{ $data['sopir'] }}, {{ $data['user'] }}],
        colors: ['#28a745', '#ffc107', '#f9e79f']
    };

    let currentChart;

    function renderPieChart() {
        if (currentChart) currentChart.destroy();
        currentChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: userData.labels,
                datasets: [{
                    data: userData.data,
                    backgroundColor: userData.colors
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#5a6570',
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    }

    function renderBarChart(role) {
        if (currentChart) currentChart.destroy();

        let labels = [];
        let data = [];
        let colors = [];

        if (role === 'admin') {
            labels = ['Admin'];
            data = [userData.data[0]];
            colors = [userData.colors[0]];
        } else if (role === 'sopir') {
            labels = ['Sopir'];
            data = [userData.data[1]];
            colors = [userData.colors[1]];
        } else if (role === 'user') {
            labels = ['User'];
            data = [userData.data[2]];
            colors = [userData.colors[2]];
        }

        currentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Pengguna',
                    data: data,
                    backgroundColor: colors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#5a6570',
                            stepSize: 1,
                            font: { size: 12 }
                        }
                    },
                    x: {
                        ticks: {
                            color: '#5a6570',
                            font: { size: 12 }
                        }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    function updateChart(value) {
        if (value === 'pie') {
            renderPieChart();
        } else {
            renderBarChart(value);
        }
    }

    // Render default chart
    renderPieChart();
</script>
@endsection
