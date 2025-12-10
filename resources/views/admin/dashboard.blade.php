@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <!-- Top Search -->
    <div class="flex justify-between items-center mb-6 gap-5">

        <h1 class="text-3xl font-semibold text-[#002C55]">Dashboard</h1>

        <!-- Search Bar -->
        <div class="relative w-full">
            <input 
                type="text"
                placeholder="Cari Laporan" 
                class="w-full pl-4 pr-12 py-2 rounded-lg border border-[#DDDDDD] 
                    focus:ring-1 focus:ring-[#002C55]"
            >

            <button class="absolute right-3 top-1/2 -translate-y-1/2">
                <img src="{{ asset('icon/search-icon.svg') }}" class="h-5 w-5">
            </button>
        </div>

        <!-- Notification Button -->
        <button class="p-2 border border-[#DDDDDD] rounded-lg hover:bg-gray-100">
            <img src="{{ asset('icon/notif-icon.svg') }}" class="h-6 w-6" alt="">
        </button>

    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-7">

        <div class="bg-[#C5CAFF] p-4 rounded-lg">
            <img src="{{ asset('icon/receive-icon.svg') }}" alt="" class="h-10">
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Masuk</h2>
            <div class="flex items-center gap-2 mt-2">
                <p class="text-5xl font-bold text-[#002C55]">32</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>

        <div class="bg-[#E1E7E9] p-4 rounded-lg">
            <img src="{{ asset('icon/clock-icon.svg') }}" alt="" class="h-10">
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Menunggu</h2>
            <div class="flex items-center gap-2 mt-2">
                <p class="text-5xl font-bold text-[#002C55]">12</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>

        <div class="bg-[#FEEF94] p-4 rounded-lg">
            <img src="{{ asset('icon/process-icon.svg') }}" alt="" class="h-10">
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Diproses</h2>
            <div class="flex items-center gap-2 mt-2">
                <p class="text-5xl font-bold text-[#002C55]">9</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>

        <div class="bg-[#A0F1B5] p-4 rounded-lg">
            <img src="{{ asset('icon/check-icon.svg') }}" alt="" class="h-10">
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Terselesaikan</h2>
            <div class="flex items-center gap-2 mt-2">
                <p class="text-5xl font-bold text-[#002C55]">11</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>

    </div>

 <!-- Grafik Laporan -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="bg-white border border-[#DDDDDD] rounded-xl p-6 w-full mb-8">
    <h2 class="text-2xl text-[#002C55] font-semibold mb-6">Grafik Laporan</h2>
    
    <!-- Filter Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">
        <!-- Filter Status -->
        <div class="flex items-center gap-3">
            <span class="text-[#002C55]">Status</span>
            <select id="filterStatus" class="border border-[#DDDDDD] rounded-lg text-sm text-[#002C55] py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                <option value="all">Semua Status</option>
                <option value="menunggu">Menunggu</option>
                <option value="diproses">Diproses</option>
                <option value="terselesaikan">Terselesaikan</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>
        
        <!-- Filter Tanggal -->
        <div class="flex items-center gap-3">
            <span class="text-[#002C55]">Tanggal</span>
            <select id="filterTanggal" class="border border-gray-300 rounded-lg text-sm py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                <option value="7hari">7 Hari Terakhir</option>
                <option value="30hari">30 Hari Terakhir</option>
                <option value="bulan">Bulan Ini</option>
            </select>
        </div>
        
        <div class="flex gap-5">
            <div class="flex gap-2 items-center">
                <div class="flex w-4 h-4 rounded-full bg-[#E1E7E9]"></div>
                <span class="text-gray-800">Menunggu</span>
            </div>

            <div class="flex gap-2 items-center">
                <div class="flex w-4 h-4 rounded-full bg-[#FEEF94]"></div>
                <span class="text-gray-800">Diproses</span>
            </div>

            <div class="flex gap-2 items-center">
                <div class="flex w-4 h-4 rounded-full bg-[#A0F1B5]"></div>
                <span class="text-gray-800">Terselesaikan</span>
            </div>

            <div class="flex gap-2 items-center">
                <div class="flex w-4 h-4 rounded-full bg-[#FF7A7E]"></div>
                <span class="text-gray-800">Ditolak</span>
            </div>
        </div>
    </div>
    
    <!-- Chart Container -->
    <div class="flex flex-col gap-8">
        
        <!-- Chart -->
        <div class="w-full">
            <div class="relative h-[350px]">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
</div>

    <!--  -->
    <div class="flex bg-[#FED43E] rounded-lg items-center justify-between p-6">
        <h2 class="text-2xl text-[#002C55] font-semibold">Menemukan bug?</h2>
        <a href="#" class="bg-[#002C55] rounded-lg flex text-white py-2 px-4 gap-2">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.2633 5.43908L5.05327 14.1291C4.74327 14.4591 4.44327 15.1091 4.38327 15.5591L4.01327 18.7991C3.88327 19.9691 4.72327 20.7691 5.88327 20.5691L9.10327 20.0191C9.55327 19.9391 10.1833 19.6091 10.4933 19.2691L18.7033 10.5791C20.1233 9.07908 20.7633 7.36908 18.5533 5.27908C16.3533 3.20908 14.6833 3.93908 13.2633 5.43908Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11.8931 6.8891C12.3231 9.6491 14.5631 11.7591 17.3431 12.0391" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            </svg> 
            Beritahu kami
        </a>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('statusChart').getContext('2d');
    
    // Data dummy sesuai gambar
    const chartData = {
        labels: ['30 Nov', '1 Des', '2 Des', '3 Des', '4 Des', '5 Des'],
        datasets: [
            {
                label: 'Menunggu',
                data: [6, 3, 10, 5, 4, 6],
                backgroundColor: '#E1E7E9',
                borderRadius: 4,
                borderSkipped: false,
                categoryPercentage: 0.7,
                barPercentage: 0.9
            },
            {
                label: 'Diproses',
                data: [16, 10, 7, 20, 17, 18],
                backgroundColor: '#FEEF94',
                borderRadius: 4,
                borderSkipped: false,
                categoryPercentage: 0.7,
                barPercentage: 0.9
            },
            {
                label: 'Terselesaikan',
                data: [11, 15, 17, 20, 15, 11],
                backgroundColor: '#A0F1B5',
                borderRadius: 4,
                borderSkipped: false,
                categoryPercentage: 0.7,
                barPercentage: 0.9
            },
            {
                label: 'Ditolak',
                data: [0, 3, 8, 5, 7, 1],
                backgroundColor: '#FF7A7E',
                borderRadius: 4,
                borderSkipped: false,
                categoryPercentage: 0.7,
                barPercentage: 0.9
            }
        ]
    };

    // Inisialisasi Chart
    const laporanChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            devicePixelRatio: window.devicePixelRatio,
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: '#666',
                        font: {
                            size: 12
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#F0F0F0',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#666',
                        stepSize: 5,
                        callback: function(value) {
                            return value;
                        },
                        font: {
                            size: 11
                        }
                    },
                    border: {
                        dash: [4, 4]
                    }
                }
            },
            plugins: {
                legend: {
                    display: false // Hide default legend
                },
                tooltip: {
                    backgroundColor: '#FFFFFF',
                    titleColor: '#022C55',
                    bodyColor: '#fff',
                    borderColor: '#DDDDDD',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 6,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.raw} laporan`;
                        }
                    }
                }
            },
            layout: {
                padding: {
                    top: 20
                }
            }
        }
    });

    // Fungsi untuk update total status
    function updateStatusTotals() {
        const totals = {
            'menunggu': 0,
            'diproses': 0,
            'terselesaikan': 0,
            'ditolak': 0
        };
        
        // Hitung total dari data chart
        chartData.datasets.forEach((dataset, index) => {
            const status = dataset.label.toLowerCase();
            totals[status] = dataset.data.reduce((a, b) => a + b, 0);
        });
        
        // Update HTML
        document.querySelectorAll('.status-legend').forEach(legend => {
            const status = legend.dataset.status;
            const countSpan = legend.querySelector('.ml-auto');
            countSpan.textContent = totals[status];
        });
        
        // Update total laporan
        const totalAll = Object.values(totals).reduce((a, b) => a + b, 0);
        document.querySelector('.text-2xl.font-bold.text-\\[\\#002C55\\]').textContent = totalAll;
    }

    // Inisialisasi total
    updateStatusTotals();

    // Event Listeners untuk Filter
    document.getElementById('filterStatus').addEventListener('change', function(e) {
        console.log('Filter Status:', e.target.value);
        // Implement filter logic here
        // For demo, we'll just show a message
        if (e.target.value !== 'all') {
            alert(`Filter status "${e.target.value}" diterapkan. (Fitur filter akan diimplementasikan dengan data real)`);
        }
    });

    document.getElementById('filterTanggal').addEventListener('change', function(e) {
        console.log('Filter Tanggal:', e.target.value);
        // Implement date filter logic here
        // For demo, we'll just show a message
        alert(`Filter tanggal "${e.target.value}" diterapkan. (Fitur filter akan diimplementasikan dengan data real)`);
    });

    document.getElementById('filterBulan').addEventListener('change', function(e) {
        console.log('Filter Bulan:', e.target.value);
        
        // Simulasi perubahan data berdasarkan bulan
        const monthData = {
            'nov': {
                labels: ['24 Nov', '25 Nov', '26 Nov', '27 Nov', '28 Nov', '29 Nov', '30 Nov'],
                menunggu: [5, 4, 6, 3, 7, 5, 6],
                diproses: [12, 15, 10, 14, 11, 13, 16],
                terselesaikan: [10, 12, 9, 11, 13, 10, 11],
                ditolak: [1, 2, 1, 0, 2, 1, 0]
            },
            'des': {
                labels: ['30 Nov', '1 Des', '2 Des', '3 Des', '4 Des', '5 Des'],
                menunggu: [6, 3, 10, 5, 4, 6],
                diproses: [16, 10, 7, 20, 17, 18],
                terselesaikan: [11, 15, 17, 20, 15, 11],
                ditolak: [0, 3, 8, 5, 7, 1]
            },
            'jan': {
                labels: ['1 Jan', '2 Jan', '3 Jan', '4 Jan', '5 Jan', '6 Jan', '7 Jan'],
                menunggu: [4, 5, 3, 6, 4, 5, 3],
                diproses: [14, 12, 15, 11, 13, 14, 12],
                terselesaikan: [12, 10, 13, 11, 14, 12, 13],
                ditolak: [2, 1, 0, 2, 1, 0, 2]
            }
        };
        
        const selectedMonth = e.target.value;
        const data = monthData[selectedMonth];
        
        if (data) {
            // Update chart data
            laporanChart.data.labels = data.labels;
            laporanChart.data.datasets[0].data = data.menunggu;
            laporanChart.data.datasets[1].data = data.diproses;
            laporanChart.data.datasets[2].data = data.terselesaikan;
            laporanChart.data.datasets[3].data = data.ditolak;
            
            // Update chart
            laporanChart.update();
            
            // Update totals
            updateStatusTotals();
        }
    });

    // Event Listeners untuk Legend (toggle visibility dataset)
    document.querySelectorAll('.status-legend').forEach(legend => {
        legend.addEventListener('click', function() {
            const status = this.dataset.status;
            const datasetIndex = chartData.datasets.findIndex(ds => ds.label.toLowerCase() === status);
            
            if (datasetIndex !== -1) {
                const meta = laporanChart.getDatasetMeta(datasetIndex);
                meta.hidden = meta.hidden === null ? true : !meta.hidden;
                laporanChart.update();
                
                // Toggle visual state legend
                this.classList.toggle('opacity-50');
                this.classList.toggle('bg-gray-100');
            }
        });
    });
});
</script>

<style>
/* Custom styles untuk chart */
#statusChart {
    width: 100% !important;
    height: auto !important;
}

.status-legend.active {
    background-color: #f3f4f6;
    border-color: #3b82f6;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #statusChart {
        height: 250px !important;
    }
}
</style>
@endsection
