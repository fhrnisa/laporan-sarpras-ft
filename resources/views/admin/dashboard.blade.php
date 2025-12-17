@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('showSearch', 'false')  <!-- DISABLE SEARCH BAR -->

@section('content')

        <!-- INFO PANEL -->
    <div id="infoPanel" class="bg-white border-2 border-blue-600 p-4 rounded-lg mb-4">

        <!-- Header Info Panel -->
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 rounded-full p-2 pulsating-circle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20C14.1217 20 16.1566 19.1571 17.6569 17.6569C19.1571 16.1566 20 14.1217 20 12C20 9.87827 19.1571 7.84344 17.6569 6.34315C16.1566 4.84285 14.1217 4 12 4C9.87827 4 7.84344 4.84285 6.34315 6.34315C4.84285 7.84344 4 9.87827 4 12C4 14.1217 4.84285 16.1566 6.34315 17.6569C7.84344 19.1571 9.87827 20 12 20ZM12 7C12.2652 7 12.5196 7.10536 12.7071 7.29289C12.8946 7.48043 13 7.73478 13 8V13C13 13.2652 12.8946 13.5196 12.7071 13.7071C12.5196 13.8946 12.2652 14 12 14C11.7348 14 11.4804 13.8946 11.2929 13.7071C11.1054 13.5196 11 13.2652 11 13V8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7ZM12 17C11.7348 17 11.4804 16.8946 11.2929 16.7071C11.1054 16.5196 11 16.2652 11 16C11 15.7348 11.1054 15.4804 11.2929 15.2929C11.4804 15.1054 11.7348 15 12 15C12.2652 15 12.5196 15.1054 12.7071 15.2929C12.8946 15.4804 13 15.7348 13 16C13 16.2652 12.8946 16.5196 12.7071 16.7071C12.5196 16.8946 12.2652 17 12 17Z" fill="white"/>
                    </svg>
                </div>
                
                <h3 class="text-2xl font-semibold text-[#002C55] flex gap-2 mb-2">
                    Informasi Dashboard
                </h3>
            </div>

            <button id="closeInfo" class="p-1 hover:bg-blue-50 rounded flex items-center justify-center">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.00098 5L19 18.9991" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.99996 18.9991L18.999 5" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <!-- Content Info Panel -->
        <div class="flex gap-2 bg-blue-50 mb-2">
            <div class="border-2 border-blue-600 w-1 h-auto rounded-sm"></div>
            <div class="bg-blue-50 p-3">
                <p class="text-base text-[#002C55]"><strong>4 Cards di bawah:</strong> Menampilkan total akumulasi <strong>semua laporan</strong> dari awal sistem sampai sekarang.</p>
            </div>
        </div>

        <div class="flex gap-2 bg-blue-50 mb-4">
            <div class="border-2 border-blue-600 w-1 h-auto"></div>
            <div class="bg-blue-50 p-3">
                <p class="text-base text-[#002C55]"><strong>Grafik di bawah:</strong> Menampilkan data dalam <strong>rentang waktu yang dipilih</strong> (7 hari, 30 hari, atau bulan ini).</p>
            </div>
        </div>

        <div class="bg-blue-600 p-2 rounded-lg">
            <p class="text-base text-white mt-1">Gunakan filter di bagian grafik untuk mengubah periode tampilan grafik.</p>
        </div>
    </div>

    <!-- SUMMARY CARDS (TOTAL AKUMULASI SEMUA LAPORAN) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-7">
        <!-- Card Laporan Masuk -->
        <div class="bg-[#C5CAFF] p-4 rounded-lg">
            <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="40" height="40" rx="20" stroke="#002C55"/>
                <path d="M20.5 10.5V16.5L22.5 14.5" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M20.5 16.5L18.5 14.5" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15.5 20.5C11.5 20.5 11.5 22.29 11.5 24.5V25.5C11.5 28.26 11.5 30.5 16.5 30.5H24.5C28.5 30.5 29.5 28.26 29.5 25.5V24.5C29.5 22.29 29.5 20.5 25.5 20.5C24.5 20.5 24.22 20.71 23.7 21.1L22.68 22.18C21.5 23.44 19.5 23.44 18.31 22.18L17.3 21.1C16.78 20.71 16.5 20.5 15.5 20.5Z" stroke="#002C55" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M13.5 20.5V16.5C13.5 14.49 13.5 12.83 16.5 12.54" stroke="#002C55" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M27.5 20.5V16.5C27.5 14.49 27.5 12.83 24.5 12.54" stroke="#002C55" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Masuk</h2>
            <div class="flex items-center gap-2 mt-2">
                <p id="totalLaporan" class="text-5xl font-bold text-[#002C55]">{{ $totalLaporan }}</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>

        <!-- Card Laporan Menunggu -->
        <div class="bg-[#E1E7E9] p-4 rounded-lg">
            <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="40" height="40" rx="20" stroke="#002C55"/>
                <path d="M30.5 20.5C30.5 26.02 26.02 30.5 20.5 30.5C14.98 30.5 10.5 26.02 10.5 20.5C10.5 14.98 14.98 10.5 20.5 10.5C26.02 10.5 30.5 14.98 30.5 20.5Z" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M24.2099 23.68L21.1099 21.83C20.5699 21.51 20.1299 20.74 20.1299 20.11V16.01" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Menunggu</h2>
            <div class="flex items-center gap-2 mt-2">
                <p id="laporanMenunggu" class="text-5xl font-bold text-[#002C55]">{{ $laporanMenunggu }}</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>

        <!-- Card Laporan Diproses -->
        <div class="bg-[#FEEF94] p-4 rounded-lg">
            <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="40" height="40" rx="20" stroke="#002C55"/>
                <path d="M11.3042 23.8951C11.3042 23.8951 11.4462 25.5922 11.4792 26.1273C11.5232 26.845 11.8072 27.6466 12.2812 28.2032C12.9502 28.9922 13.7382 29.2705 14.7902 29.2724C16.0272 29.2744 25.0222 29.2744 26.2592 29.2724C27.3112 29.2705 28.0992 28.9922 28.7682 28.2032C29.2422 27.6466 29.5262 26.845 29.5712 26.1273C29.6032 25.5922 29.7452 23.8951 29.7452 23.8951" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M16.9961 13.9866V13.6243C16.9961 12.4331 17.9841 11.4683 19.2041 11.4683H21.7861C23.0051 11.4683 23.9941 12.4331 23.9941 13.6243L23.9951 13.9866" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M20.4951 25.068V23.8045" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.25 16.9741V20.3595C13.168 21.5947 15.466 22.4598 17.988 22.8026C18.29 21.7275 19.283 20.9395 20.49 20.9395C21.678 20.9395 22.691 21.7275 22.973 22.8123C25.505 22.4696 27.812 21.6045 29.74 20.3595V16.9741C29.74 15.32 28.377 13.9882 26.683 13.9882H14.317C12.623 13.9882 11.25 15.32 11.25 16.9741Z" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Diproses</h2>
            <div class="flex items-center gap-2 mt-2">
                <p id="laporanDiproses" class="text-5xl font-bold text-[#002C55]">{{ $laporanDiproses }}</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>

        <!-- Card Laporan Terselesaikan -->
        <div class="bg-[#A0F1B5] p-4 rounded-lg">
            <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="40" height="40" rx="20" stroke="#002C55"/>
                <path d="M28.5 14.5L17.5 25.5L12.5 20.5" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Terselesaikan</h2>
            <div class="flex items-center gap-2 mt-2">
                <p id="laporanSelesai" class="text-5xl font-bold text-[#002C55]">{{ $laporanSelesai }}</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>
    </div>


    <!-- GRAFIK LAPORAN (HANYA RENTANG WAKTU TERTENTU) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="bg-white border border-[#DDDDDD] rounded-xl p-6 w-full mb-8">
        <h2 class="text-2xl text-[#002C55] font-semibold mb-6">Grafik Laporan</h2>

        <!-- Filter Section (HANYA UNTUK CHART) -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">
            <div class="flex gap-6">
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
                    <span class="text-[#002C55]">Periode</span>
                    <select id="filterTanggal" class="border border-gray-300 rounded-lg text-sm text-[#002C55] py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                        <option value="7hari">7 Hari Terakhir</option>
                        <option value="30hari">30 Hari Terakhir</option>
                        <option value="bulan">Bulan Ini</option>
                    </select>
                </div>
            </div>

            <!-- Legenda (TIDAK BISA DIKLIK) -->
            <div class="flex flex-wrap gap-5">
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
        <div class="w-full">
            <div class="relative h-[350px]">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- BUG REPORT -->
    <div class="flex bg-[#FED43E] rounded-lg items-center justify-between p-6">
        <h2 class="text-2xl text-[#002C55] font-semibold">Menemukan bug?</h2>
        <a href="#" class="bg-[#002C55] rounded-lg flex text-white py-2 px-4 gap-2 items-center">
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

    // Data dari controller (dari API BE)
    const chartData = {
        labels: @json($chartData['labels']),
        datasets: [
            {
                label: 'Menunggu',
                data: @json($chartData['menunggu']),
                backgroundColor: '#E1E7E9',
                borderColor: '#E1E7E9',
                borderWidth: 1,
                barPercentage: 0.8,
                categoryPercentage: 0.8
            },
            {
                label: 'Diproses',
                data: @json($chartData['diproses']),
                backgroundColor: '#FEEF94',
                borderColor: '#FEEF94',
                borderWidth: 1,
                barPercentage: 0.8,
                categoryPercentage: 0.8
            },
            {
                label: 'Terselesaikan',
                data: @json($chartData['terselesaikan']),
                backgroundColor: '#A0F1B5',
                borderColor: '#A0F1B5',
                borderWidth: 1,
                barPercentage: 0.8,
                categoryPercentage: 0.8
            },
            {
                label: 'Ditolak',
                data: @json($chartData['ditolak']),
                backgroundColor: '#FF7A7E',
                borderColor: '#FF7A7E',
                borderWidth: 1,
                barPercentage: 0.8,
                categoryPercentage: 0.8
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
            devicePixelRatio: window.devicePixelRatio || 1,
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
                        stepSize: 1,
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
                    titleColor: '#002C55',
                    bodyColor: '#002C55',
                    borderColor: '#DDDDDD',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 6,
                    displayColors: true,
                    usePointStyle: true,
                    pointStyle: 'circle',
                    boxWidth: 10,
                    boxHeight: 10,
                    titleFont: {
                        size: 14,
                        weight: '600'
                    },
                    bodyFont: {
                        size: 13,
                        weight: '500',
                    },
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.raw} laporan`;
                        }
                    }
                }
            },
            layout: {
                padding: {
                    top: 20,
                    right: 10,
                    bottom: 10,
                    left: 10
                }
            },
            elements: {
                bar: {
                    borderRadius: 4,
                    borderSkipped: false,
                }
            }
        }
    });

    // Event Listeners untuk Filter (HANYA UNTUK CHART)
    document.getElementById('filterStatus').addEventListener('change', function(e) {
        filterChart();
    });

    document.getElementById('filterTanggal').addEventListener('change', function(e) {
        filterChart();
    });

function filterChart() {
    const status = document.getElementById('filterStatus').value;
    const tanggal = document.getElementById('filterTanggal').value;

    // Show loading state
    const chartContainer = document.querySelector('#statusChart').parentElement;
    chartContainer.classList.add('opacity-50');

    // Kirim request AJAX untuk filter
    fetch(`/admin/dashboard/filter?status=${status}&tanggal=${tanggal}`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        // Update chart data
        if (data.labels && data.datasets) {
            laporanChart.data.labels = data.labels;
            laporanChart.data.datasets[0].data = data.datasets.menunggu;
            laporanChart.data.datasets[1].data = data.datasets.diproses;
            laporanChart.data.datasets[2].data = data.datasets.terselesaikan;
            laporanChart.data.datasets[3].data = data.datasets.ditolak;

            laporanChart.update();
        } else {
            console.error('Invalid data structure:', data);
            alert('Data format tidak valid.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memfilter data grafik. Silakan coba lagi.');
    })
    .finally(() => {
        chartContainer.classList.remove('opacity-50');
    });
}

    // Responsive chart
    window.addEventListener('resize', function() {
        laporanChart.resize();
    });


    // KODE CLOSE INFO PANEL
    const infoPanel = document.getElementById("infoPanel");
    const closeInfo = document.getElementById("closeInfo");

    if (closeInfo && infoPanel) {
    closeInfo.addEventListener("click", () => {
        infoPanel.classList.add("hidden");
    });
}

});
</script>

<style>
/* Custom styles untuk chart */
#statusChart {
    width: 100% !important;
    height: 100% !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #statusChart {
        height: 250px !important;
    }

    .flex-wrap.gap-5 {
        gap: 10px !important;
        flex-wrap: wrap !important;
    }
}

.pulsating-circle {
    animation: pulse 2s infinite ease-in-out;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(0, 44, 85, 0.7);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 0 0 10px rgba(0, 44, 85, 0);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(0, 44, 85, 0);
    }
}
</style>
@endsection
