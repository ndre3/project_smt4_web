@extends('layouts.app')

@section('content')
<div class="font-sans text-xs text-[#5a6570]">

    <h4 class="fw-bold mb-4 px-3">Visualisasi Data Sampah</h4>

    <div class="bg-white px-5 py-4 rounded shadow mb-6" style="width: 100%; min-height: 500px; margin-left: 0; margin-right: 0;">
        {{-- Dropdown Pilihan Periode --}}
        <div class="mb-4 text-left">
            <label for="filterPeriode">Pilih Periode:</label>
            <select id="filterPeriode" 
                    class="ml-2 px-3 py-1 border border-gray-300 rounded"
                    onchange="updateChart(this.value)">
                <option value="harian">Harian</option>
                <option value="mingguan">Mingguan</option>
                <option value="bulanan">Bulanan</option>
                <option value="tahunan">Tahunan</option>
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

        {{-- Chart --}}
        <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
            <div style="width: 600px; height: 350px;" class="text-center">
                <canvas id="sampahChart"></canvas>
            </div>
        </div>
        
        {{-- Informasi total sampah --}}
        <div class="mt-2 text-center">
            <div class="p-3 rounded" style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
                <span class="fw-bold">Total Sampah:</span>
                <span id="totalSampah">{{ $totalSampah ?? '0' }} kg</span>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('sampahChart').getContext('2d');
    let currentChart;

    // Warna untuk setiap periode
    const colorPalette = {
        harian: '#4CAF50',    // Hijau
        mingguan: '#FFC107',  // Kuning
        bulanan: '#8BC34A',   // Hijau muda
        tahunan: '#CDDC39'    // Hijau kekuningan
    };

    const sampahData = {
        harian: {
            labels: {!! json_encode($labels['harian'] ?? []) !!},
            data: {!! json_encode($data['harian'] ?? []) !!}
        },
        mingguan: {
            labels: {!! json_encode($labels['mingguan'] ?? []) !!},
            data: {!! json_encode($data['mingguan'] ?? []) !!}
        },
        bulanan: {
            labels: {!! json_encode($labels['bulanan'] ?? []) !!},
            data: {!! json_encode($data['bulanan'] ?? []) !!}
        },
        tahunan: {
            labels: {!! json_encode($labels['tahunan'] ?? []) !!},
            data: {!! json_encode($data['tahunan'] ?? []) !!}
        }
    };

    function renderChart(periode) {
        if (currentChart) currentChart.destroy();
        
        const chartData = sampahData[periode];
        const color = colorPalette[periode];
        
        currentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Jumlah Sampah (kg)',
                    data: chartData.data,
                    backgroundColor: color,
                    borderColor: shadeColor(color, -20),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Berat Sampah (kg)',
                            color: '#5a6570',
                            font: { size: 12 }
                        },
                        ticks: {
                            color: '#5a6570',
                            font: { size: 10 }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: getPeriodeTitle(periode),
                            color: '#5a6570',
                            font: { size: 12 }
                        },
                        ticks: {
                            color: '#5a6570',
                            font: { size: 10 }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#5a6570',
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.parsed.y} kg`;
                            }
                        }
                    }
                }
            }
        });

        updateTotalSampah(chartData.data);
    }

    function shadeColor(color, percent) {
        let R = parseInt(color.substring(1,3), 16);
        let G = parseInt(color.substring(3,5), 16);
        let B = parseInt(color.substring(5,7), 16);

        R = parseInt(R * (100 + percent) / 100);
        G = parseInt(G * (100 + percent) / 100);
        B = parseInt(B * (100 + percent) / 100);

        R = (R<255)?R:255;  
        G = (G<255)?G:255;  
        B = (B<255)?B:255;  

        R = Math.round(R);
        G = Math.round(G);
        B = Math.round(B);

        const RR = ((R.toString(16).length==1)?"0"+R.toString(16):R.toString(16));
        const GG = ((G.toString(16).length==1)?"0"+G.toString(16):G.toString(16));
        const BB = ((B.toString(16).length==1)?"0"+B.toString(16):B.toString(16));

        return "#"+RR+GG+BB;
    }

    function updateTotalSampah(data) {
        const total = data.reduce((sum, value) => sum + Number(value), 0);
        document.getElementById('totalSampah').textContent = `${total.toLocaleString()} kg`;
    }

    function getPeriodeTitle(periode) {
        switch(periode) {
            case 'harian': return 'Tanggal';
            case 'mingguan': return 'Minggu';
            case 'bulanan': return 'Bulan';
            case 'tahunan': return 'Tahun';
            default: return 'Periode';
        }
    }

    function updateChart(periode) {
        renderChart(periode);
    }

    document.addEventListener('DOMContentLoaded', function() {
        renderChart('harian'); // Default
    });
</script>
@endsection