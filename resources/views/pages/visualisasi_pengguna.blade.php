@extends('layouts.app')

@section('content')
<div class="font-sans text-xs text-[#5a6570]">

    <h4 class="fw-bold mb-4 px-3">Visualisasi Data Pengguna</h4>

    <div class="bg-white px-5 py-4 rounded shadow mb-6" style="width: 100%; min-height: 500px; margin-left: 0; margin-right: 0;">
        {{-- Dropdown Pilihan Visualisasi --}}
        <div class="mb-4 text-left">
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
        <div class="mb-4 text-left">
            <a href="{{ route('visualisasi') }}" 
               class="text-white px-4 py-2 rounded shadow"
               style="background-color: #ffc107; transition: background-color 0.3s;"
               onmouseover="this.style.backgroundColor='#f9e79f'"
               onmouseout="this.style.backgroundColor='#ffc107'">
                ← Kembali
            </a>
        </div>

        {{-- Chart perfectly centered horizontally --}}
        <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
            <div style="width: 500px; height: 400px;" class="text-center">
                <canvas id="userChart"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userChart').getContext('2d');

    const userData = {
        labels: ['Admin', 'Sopir', 'Masyarakat'],
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
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#5a6570',
                            font: {
                                size: 10
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
            labels = ['Masyarakat'];
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
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#5a6570',
                            stepSize: 1,
                            font: { size: 10 }
                        }
                    },
                    x: {
                        ticks: {
                            color: '#5a6570',
                            font: { size: 10 }
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