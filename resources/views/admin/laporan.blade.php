@extends('layouts.admin')

@section('title', 'Laporan')
@section('page-title', 'Laporan')
@section('showSearch', true)  <!-- SHOW SEARCH BAR -->
@section('search-placeholder', 'Cari nama, email, atau lokasi laporan')
@section('search-mode', 'laporan')  <!-- SET MODE LAPORAN -->

@section('content')
<div class="space-y-6">

    <!-- FILTER SECTION -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="flex flex-col md:flex-row gap-4 w-full">

            <!-- Filter Status -->
            <div class="flex items-center gap-3">
                <span class="text-[#002C55] font-medium">Status</span>
                <select id="filterStatus" class="border border-[#DDDDDD] rounded-lg text-sm text-[#002C55] max-w-[140px] py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                    <option value="all">Semua Status</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="diproses">Diproses</option>
                    <option value="terselesaikan">Terselesaikan</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>

            <!-- Filter Tanggal -->
            <div class="flex items-center gap-3">
                <span class="text-[#002C55] font-medium">Tanggal</span>
                <select id="filterTanggal" class="border border-[#DDDDDD] rounded-lg text-sm text-[#002C55] max-w-[140px] py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                    <option value="7hari">7 Hari Terakhir</option>
                    <option value="30hari">30 Hari Terakhir</option>
                    <option value="bulan">Bulan Ini</option>
                </select>
            </div>
        </div>

        <!-- BUTTONS -->
        <div class="flex gap-3 items-center">
            <button id="kelolaBtn"
                    class="bg-[#022C55] text-white text-base rounded-lg py-2 px-4">
                Kelola Data
            </button>

            <!-- Hidden buttons -->
            <div id="manageOptions" class="hidden gap-2 items-center ml-2">
                <button class="px-4 py-2 bg-[#ED3237] text-white rounded-lg flex gap-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.0002 6.72998C20.9802 6.72998 20.9502 6.72998 20.9202 6.72998C15.6302 6.19998 10.3502 5.99998 5.12016 6.52998L3.08016 6.72998C2.66016 6.76998 2.29016 6.46998 2.25016 6.04998C2.21016 5.62998 2.51016 5.26998 2.92016 5.22998L4.96016 5.02998C10.2802 4.48998 15.6702 4.69998 21.0702 5.22998C21.4802 5.26998 21.7802 5.63998 21.7402 6.04998C21.7102 6.43998 21.3802 6.72998 21.0002 6.72998Z" fill="white"/>
                        <path d="M8.49977 5.72C8.45977 5.72 8.41977 5.72 8.36977 5.71C7.96977 5.64 7.68977 5.25 7.75977 4.85L7.97977 3.54C8.13977 2.58 8.35977 1.25 10.6898 1.25H13.3098C15.6498 1.25 15.8698 2.63 16.0198 3.55L16.2398 4.85C16.3098 5.26 16.0298 5.65 15.6298 5.71C15.2198 5.78 14.8298 5.5 14.7698 5.1L14.5498 3.8C14.4098 2.93 14.3798 2.76 13.3198 2.76H10.6998C9.63977 2.76 9.61977 2.9 9.46977 3.79L9.23977 5.09C9.17977 5.46 8.85977 5.72 8.49977 5.72Z" fill="white"/>
                        <path d="M15.2099 22.75H8.7899C5.2999 22.75 5.1599 20.82 5.0499 19.26L4.3999 9.18995C4.3699 8.77995 4.6899 8.41995 5.0999 8.38995C5.5199 8.36995 5.8699 8.67995 5.8999 9.08995L6.5499 19.16C6.6599 20.68 6.6999 21.25 8.7899 21.25H15.2099C17.3099 21.25 17.3499 20.68 17.4499 19.16L18.0999 9.08995C18.1299 8.67995 18.4899 8.36995 18.8999 8.38995C19.3099 8.41995 19.6299 8.76995 19.5999 9.18995L18.9499 19.26C18.8399 20.82 18.6999 22.75 15.2099 22.75Z" fill="white"/>
                        <path d="M13.6601 17.25H10.3301C9.92008 17.25 9.58008 16.91 9.58008 16.5C9.58008 16.09 9.92008 15.75 10.3301 15.75H13.6601C14.0701 15.75 14.4101 16.09 14.4101 16.5C14.4101 16.91 14.0701 17.25 13.6601 17.25Z" fill="white"/>
                        <path d="M14.5 13.25H9.5C9.09 13.25 8.75 12.91 8.75 12.5C8.75 12.09 9.09 11.75 9.5 11.75H14.5C14.91 11.75 15.25 12.09 15.25 12.5C15.25 12.91 14.91 13.25 14.5 13.25Z" fill="white"/>
                    </svg>
                    Hapus Permanen
                </button>
                <button class="px-4 py-2 bg-[#FED43E] text-white rounded-lg flex gap-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 22.75H8C4.35 22.75 2.25 20.65 2.25 17V7C2.25 3.35 4.35 1.25 8 1.25H16C19.65 1.25 21.75 3.35 21.75 7V17C21.75 20.65 19.65 22.75 16 22.75ZM8 2.75C5.14 2.75 3.75 4.14 3.75 7V17C3.75 19.86 5.14 21.25 8 21.25H16C18.86 21.25 20.25 19.86 20.25 17V7C20.25 4.14 18.86 2.75 16 2.75H8Z" fill="white"/>
                        <path d="M9 11.11C8.83 11.11 8.66 11.08 8.5 11.01C8.04 10.81 7.75 10.36 7.75 9.87V2C7.75 1.59 8.09 1.25 8.5 1.25H15.5C15.91 1.25 16.25 1.59 16.25 2V9.85999C16.25 10.36 15.96 10.81 15.5 11C15.05 11.2 14.52 11.11 14.15 10.77L12 8.79999L9.84998 10.78C9.60998 11 9.31 11.11 9 11.11ZM12 7.21002C12.3 7.21002 12.61 7.31998 12.85 7.53998L14.75 9.28998V2.75H9.25V9.28998L11.15 7.53998C11.39 7.31998 11.7 7.21002 12 7.21002Z" fill="white"/>
                        <path d="M17.5 14.75H13.25C12.84 14.75 12.5 14.41 12.5 14C12.5 13.59 12.84 13.25 13.25 13.25H17.5C17.91 13.25 18.25 13.59 18.25 14C18.25 14.41 17.91 14.75 17.5 14.75Z" fill="white"/>
                        <path d="M17.5 18.75H9C8.59 18.75 8.25 18.41 8.25 18C8.25 17.59 8.59 17.25 9 17.25H17.5C17.91 17.25 18.25 17.59 18.25 18C18.25 18.41 17.91 18.75 17.5 18.75Z" fill="white"/>
                    </svg>
                Arsipkan
                </button>
                <button id="batalBtn" class="px-4 py-2 bg-gray-600 text-white rounded flex gap-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.00098 5L19 18.9991" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.99996 18.9991L18.999 5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Batal
                </button>
            </div>
        </div>
    </div>

    <!-- INFO MESSAGE -->
    @if(isset($error))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        {{ $error }}
    </div>
    @endif

    <!-- TABLE SECTION -->
    <div class="bg-white border border-[#DDDDDD] rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- HEADER -->
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">Nama Pengusul</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">Nomor WhatsApp</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">Lokasi Kerusakan</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">Status</th>

                        <!-- Aksi -->
                        <th class="action-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                        </th>

                        <!-- Checkbox Column (Hidden by default) -->
                        <th class="checkbox-cell hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" id="select-all" class="rounded border-gray-300">
                        </th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="bg-white divide-y divide-gray-200" id="laporanTableBody">
                    @forelse($laporan as $report)
                    <tr class="hover:bg-gray-50 transition-colors report-row" data-id="{{ $report['id'] }}">

                        <!-- ID -->
                        <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                            #{{ $report['id'] }}
                        </td>

                        <!-- Nama -->
                        <td class="max-w-[200px] px-6 py-4 text-base text-[#002C55]">
                            {{ $report['nama_pengusul'] ?? 'N/A' }}
                        </td>

                        <!-- Nomor WhatsApp -->
                        <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                            {{ $report['nomor_telepon'] ?? 'N/A' }}
                        </td>

                        <!-- Tanggal -->
                        <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                            @if(isset($report['created_at']))
                                {{ \Carbon\Carbon::parse($report['created_at'])->format('d M Y') }}
                            @else
                                N/A
                            @endif
                        </td>

                        <!-- Lokasi -->
                        <td class="max-w-[200px] px-6 py-4">
                            <div class="text-sm text-[#002C55] max-w-xs truncate" title="{{ $report['lokasi_kerusakan'] ?? '' }}">
                                {{ $report['lokasi_kerusakan'] ?? 'N/A' }}
                            </div>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $status = $report['status_laporan'] ?? 'menunggu';
                                $statusColors = [
                                    'menunggu' => 'bg-[#E1E7E9] text-[#022C55]',
                                    'diproses' => 'bg-[#FEEF94] text-[#022C55]',
                                    'terselesaikan' => 'bg-[#A0F1B5] text-[#022C55]',
                                    'ditolak' => 'bg-[#FF7A7E] text-[#022C55]'
                                ];
                                $statusText = [
                                    'menunggu' => 'Menunggu',
                                    'diproses' => 'Diproses',
                                    'terselesaikan' => 'Terselesaikan',
                                    'ditolak' => 'Ditolak'
                                ];
                            @endphp
                            <span class="px-4 py-2 text-sm font-medium rounded-sm {{ $statusColors[$status] ?? 'bg-gray-200' }}">
                                {{ $statusText[$status] ?? 'Unknown' }}
                            </span>
                        </td>

                        <!-- ACTION CELL -->
                        <td class="text-center action-cell">
                            <button class="aksiBtn"
                                    data-id="{{ $report['id'] }}"
                                    data-nama="{{ $report['nama_pengusul'] ?? '' }}"
                                    data-email="{{ $report['email'] ?? '' }}"
                                    data-telp="{{ $report['nomor_telepon'] ?? '' }}"
                                    data-lokasi="{{ $report['lokasi_kerusakan'] ?? '' }}"
                                    data-deskripsi="{{ $report['deskripsi_kerusakan'] ?? '' }}"
                                    data-status="{{ $status }}"
                                    data-tanggal="{{ isset($report['created_at']) ? \Carbon\Carbon::parse($report['created_at'])->format('d F Y') : '' }}"
                                    data-foto="{{ $report['foto_kerusakan'] ? 'http://localhost:8001/storage/' . $report['foto_kerusakan'] : '' }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12C18 12.5523 18.4477 13 19 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </td>

                        <!-- Checkbox muncul saat mode kelola -->
                        <td class="checkbox-cell hidden px-6 py-4">
                            <input type="checkbox" class="report-checkbox" value="{{ $report['id'] }}">
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                            @if(isset($error))
                                {{ $error }}
                            @else
                                Tidak ada data laporan
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination/Info -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-700">
                    Menampilkan <span class="font-medium">{{ count($laporan) }}</span> dari <span class="font-medium">{{ $total }}</span> laporan
                </div>
            </div>
        </div>
    </div>
</div>

<!-- === MODAL DETAIL LAPORAN === -->
<div id="detailOverlay" class="hidden fixed inset-0 bg-black/40 z-50">
    <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-xl rounded-l-xl overflow-y-auto">

        <!-- Header -->
        <div class="flex justify-between items-start p-5 border-b">
            <div>
                <h2 id="detailTitle" class="text-xl font-semibold text-gray-800">Detail Laporan</h2>
                <p id="detailDate" class="text-sm text-gray-500">-</p>
            </div>
            <button id="closeDetail" class="text-gray-500 hover:text-gray-700 text-2xl">
                ✕
            </button>
        </div>

        <!-- Loading -->
        <div id="detailLoading" class="hidden p-8 text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto"></div>
            <p class="mt-4 text-gray-600">Memuat detail laporan...</p>
        </div>

        <!-- Content -->
        <div id="detailContent" class="hidden p-5 space-y-4 text-sm text-gray-700">

            <!-- Badge Status -->
            <div>
                <span id="detailStatus" class="px-3 py-1 text-sm rounded-md font-medium">
                    -
                </span>
            </div>

            <div>
                <p class="font-semibold text-gray-800">Nama Pengusul:</p>
                <p id="detailNama" class="mt-1 text-gray-600">-</p>
            </div>

            <div>
                <p class="font-semibold text-gray-800">Email:</p>
                <p id="detailEmail" class="mt-1 text-gray-600">-</p>
            </div>

            <div>
                <p class="font-semibold text-gray-800">Nomor Telepon:</p>
                <p id="detailTelp" class="mt-1 text-gray-600">-</p>
            </div>

            <div>
                <p class="font-semibold text-gray-800">Lokasi Kerusakan:</p>
                <p id="detailLokasi" class="mt-1 text-gray-600">-</p>
            </div>

            <div>
                <p class="font-semibold text-gray-800">Deskripsi Kerusakan:</p>
                <p id="detailDeskripsi" class="mt-1 text-gray-600 whitespace-pre-line">-</p>
            </div>

            <div>
                <p class="font-semibold text-gray-800">Foto Kerusakan:</p>
                <div id="detailFotoContainer" class="mt-2">
                    <img id="detailFoto" class="w-full h-auto rounded-md border border-gray-300"
                         src="" alt="Foto kerusakan"
                         onerror="this.onerror=null; this.src='https://via.placeholder.com/400x300?text=Tidak+ada+foto';">
                </div>
                <p id="noFotoMessage" class="text-gray-500 italic mt-2 hidden">Tidak ada foto</p>
            </div>

            <!-- Additional Info for Rejected Reports -->
            <div id="rejectedInfo" class="hidden mt-4 p-4 bg-red-50 rounded-lg">
                <h3 class="font-semibold text-red-800 mb-2">Informasi Penolakan</h3>
                <div class="space-y-2">
                    <div>
                        <p class="font-medium text-red-700">Alasan Ditolak:</p>
                        <p id="detailAlasan" class="text-red-600">-</p>
                    </div>
                    <div>
                        <p class="font-medium text-red-700">Waktu Ditolak:</p>
                        <p id="detailWaktuDitolak" class="text-red-600">-</p>
                    </div>
                    <div>
                        <p class="font-medium text-red-700">Ditolak oleh:</p>
                        <p id="detailAdmin" class="text-red-600">-</p>
                    </div>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="pt-4 border-t border-gray-200">
                <div class="grid grid-cols-2 gap-4 text-xs text-gray-500">
                    <div>
                        <p class="font-medium">Dibuat:</p>
                        <p id="detailCreatedAt">-</p>
                    </div>
                    <div>
                        <p class="font-medium">Diperbarui:</p>
                        <p id="detailUpdatedAt">-</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Error Message -->
        <div id="detailError" class="hidden p-8 text-center">
            <div class="text-red-500 mb-4">
                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-gray-700" id="errorMessage">Gagal memuat detail laporan</p>
            <button onclick="closeDetailModal()" class="mt-4 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                Tutup
            </button>
        </div>

        <!-- Footer Actions -->
        <div id="detailActions" class="hidden p-5 border-t border-gray-200">
            <div class="grid grid-cols-2 gap-3">
                <button onclick="updateStatus('diproses')" class="py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                    Set Diproses
                </button>
                <button onclick="updateStatus('terselesaikan')" class="py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                    Set Selesai
                </button>
                <button onclick="updateStatus('ditolak')" class="py-2 bg-red-500 text-white rounded-md hover:bg-red-600 col-span-2">
                    Tolak Laporan
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="hidden fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
    <div class="flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span id="toastMessage"></span>
    </div>
</div>
@endsection

@push('styles')
<style>
    .checkbox-cell { width: 60px; }
    .action-cell { width: 100px; }
    .status-menunggu { background-color: #E1E7E9; color: #022C55; }
    .status-diproses { background-color: #FEEF94; color: #022C55; }
    .status-terselesaikan { background-color: #A0F1B5; color: #022C55; }
    .status-ditolak { background-color: #FF7A7E; color: #022C55; }
</style>
@endpush

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Pastikan elemen ada sebelum menambahkan event listener
    const kelolaBtn = document.getElementById("kelolaBtn");
    const batalBtn = document.getElementById("batalBtn");
    const manageOptions = document.getElementById("manageOptions");
    const actionCells = document.querySelectorAll(".action-cell");
    const checkboxCells = document.querySelectorAll(".checkbox-cell");
    const reportCheckboxes = document.querySelectorAll(".report-checkbox");
    const selectAll = document.getElementById("select-all");
    const overlay = document.getElementById("detailOverlay");
    const closeBtn = document.getElementById("closeDetail");
    const filterStatus = document.getElementById("filterStatus");
    const filterTanggal = document.getElementById("filterTanggal");

    // Filter change event - hanya jika elemen ada
    if (filterStatus) {
        filterStatus.addEventListener('change', applyFilters);
    }
    if (filterTanggal) {
        filterTanggal.addEventListener('change', applyFilters);
    }

    // === SET FILTER VALUE DARI URL ===
    const urlParams = new URLSearchParams(window.location.search);

    // Status
    if (filterStatus && urlParams.has('status')) {
        filterStatus.value = urlParams.get('status');
    }

    // Tanggal
    if (filterTanggal && urlParams.has('tanggal')) {
        filterTanggal.value = urlParams.get('tanggal');
    }

    function applyFilters() {
        const params = new URLSearchParams();

        // Get search value from topbar search
        const searchInput = document.getElementById('topbarSearch');
        const searchValue = searchInput ? searchInput.value.trim() : '';

        // Add filters
        if (filterStatus && filterStatus.value !== 'all') {
            params.append('status', filterStatus.value);
        }

        if (filterTanggal && filterTanggal.value !== '7hari') {
            params.append('tanggal', filterTanggal.value);
        }

        if (searchValue) {
            params.append('search', searchValue);
        }

        const queryString = params.toString();
        window.location.href = `/admin/laporan${queryString ? '?' + queryString : ''}`;
    }

    // Detail modal functions
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');

        if (!toast || !toastMessage) return;

        toastMessage.textContent = message;
        toast.className = `fixed top-4 right-4 px-4 py-2 rounded-lg shadow-lg z-50 flex items-center gap-2 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
        toast.classList.remove('hidden');

        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000);
    }

    async function loadReportDetail(id) {
        try {
            const detailLoading = document.getElementById('detailLoading');
            const detailContent = document.getElementById('detailContent');
            const detailError = document.getElementById('detailError');
            const detailActions = document.getElementById('detailActions');

            if (detailLoading) detailLoading.classList.remove('hidden');
            if (detailContent) detailContent.classList.add('hidden');
            if (detailError) detailError.classList.add('hidden');
            if (detailActions) detailActions.classList.add('hidden');

            const response = await fetch(`http://localhost:8001/api/admin/laporan/${id}`);
            const data = await response.json();

            if (data.success) {
                const report = data.data;
                displayReportDetail(report);
            } else {
                throw new Error(data.message || 'Gagal memuat detail');
            }
        } catch (error) {
            console.error('Error loading report detail:', error);
            const detailLoading = document.getElementById('detailLoading');
            const detailError = document.getElementById('detailError');
            const errorMessage = document.getElementById('errorMessage');

            if (detailLoading) detailLoading.classList.add('hidden');
            if (detailError) detailError.classList.remove('hidden');
            if (errorMessage) errorMessage.textContent = error.message;
        }
    }

    function displayReportDetail(report) {
        const detailLoading = document.getElementById('detailLoading');
        const detailContent = document.getElementById('detailContent');
        const detailActions = document.getElementById('detailActions');

        if (detailLoading) detailLoading.classList.add('hidden');
        if (detailContent) detailContent.classList.remove('hidden');
        if (detailActions) detailActions.classList.remove('hidden');

        // Set basic info
        const detailTitle = document.getElementById('detailTitle');
        const detailDate = document.getElementById('detailDate');
        const detailNama = document.getElementById('detailNama');
        const detailEmail = document.getElementById('detailEmail');
        const detailTelp = document.getElementById('detailTelp');
        const detailLokasi = document.getElementById('detailLokasi');
        const detailDeskripsi = document.getElementById('detailDeskripsi');

        if (detailTitle) detailTitle.textContent = `Laporan #${report.id}`;
        if (detailDate) {
            detailDate.textContent = report.created_at ?
                new Date(report.created_at).toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                }) : '-';
        }
        if (detailNama) detailNama.textContent = report.nama_pengusul || '-';
        if (detailEmail) detailEmail.textContent = report.email || '-';
        if (detailTelp) detailTelp.textContent = report.nomor_telepon || '-';
        if (detailLokasi) detailLokasi.textContent = report.lokasi_kerusakan || '-';
        if (detailDeskripsi) detailDeskripsi.textContent = report.deskripsi_kerusakan || '-';

        // Set status
        const statusElement = document.getElementById('detailStatus');
        const status = report.status_laporan || 'menunggu';
        if (statusElement) {
            statusElement.textContent = getStatusText(status);
            statusElement.className = `px-3 py-1 text-sm rounded-md font-medium status-${status}`;
        }

        // Set foto
        const fotoElement = document.getElementById('detailFoto');
        const noFotoMessage = document.getElementById('noFotoMessage');

        if (fotoElement && noFotoMessage) {
            if (report.foto_kerusakan && report.foto_kerusakan !== 'default.jpg') {
                fotoElement.src = `http://localhost:8001/storage/${report.foto_kerusakan}`;
                fotoElement.classList.remove('hidden');
                noFotoMessage.classList.add('hidden');
            } else {
                fotoElement.classList.add('hidden');
                noFotoMessage.classList.remove('hidden');
            }
        }

        // Set timestamps
        const detailCreatedAt = document.getElementById('detailCreatedAt');
        const detailUpdatedAt = document.getElementById('detailUpdatedAt');

        if (detailCreatedAt) {
            detailCreatedAt.textContent = report.created_at ?
                new Date(report.created_at).toLocaleString('id-ID') : '-';
        }
        if (detailUpdatedAt) {
            detailUpdatedAt.textContent = report.updated_at ?
                new Date(report.updated_at).toLocaleString('id-ID') : '-';
        }

        // Show rejected info if status is ditolak
        const rejectedInfo = document.getElementById('rejectedInfo');
        if (rejectedInfo) {
            if (status === 'ditolak') {
                rejectedInfo.classList.remove('hidden');
            } else {
                rejectedInfo.classList.add('hidden');
            }
        }
    }

    function getStatusText(status) {
        const statusMap = {
            'menunggu': 'Menunggu',
            'diproses': 'Diproses',
            'terselesaikan': 'Terselesaikan',
            'ditolak': 'Ditolak'
        };
        return statusMap[status] || status;
    }

    function closeDetailModal() {
        if (overlay) overlay.classList.add('hidden');
    }

    function openDetailModal() {
        if (overlay) overlay.classList.remove('hidden');
    }

    // Event listeners for detail buttons
    document.querySelectorAll(".aksiBtn").forEach(btn => {
        btn.addEventListener("click", function() {
            const id = this.dataset.id;
            openDetailModal();
            loadReportDetail(id);
        });
    });

    // Close modal
    if (closeBtn) {
        closeBtn.addEventListener("click", closeDetailModal);
    }

    // Click outside to close
    if (overlay) {
        overlay.addEventListener("click", (e) => {
            if (e.target === overlay) closeDetailModal();
        });
    }

    // MODE KELOLA - hanya jika tombol ada
    if (kelolaBtn) {
        kelolaBtn.addEventListener("click", () => {
            kelolaBtn.classList.add("hidden");
            if (manageOptions) manageOptions.classList.remove("hidden");
            actionCells.forEach(btn => btn.classList.add("hidden"));
            checkboxCells.forEach(cell => cell.classList.remove("hidden"));
        });
    }

    // BATAL MODE KELOLA - hanya jika tombol ada
    if (batalBtn) {
        batalBtn.addEventListener("click", () => {
            if (kelolaBtn) kelolaBtn.classList.remove("hidden");
            if (manageOptions) manageOptions.classList.add("hidden");
            checkboxCells.forEach(cell => cell.classList.add("hidden"));
            actionCells.forEach(btn => btn.classList.remove("hidden"));
            reportCheckboxes.forEach(ch => ch.checked = false);
            if (selectAll) selectAll.checked = false;
        });
    }

    // Select All checkbox - hanya jika ada
    if (selectAll) {
        selectAll.addEventListener("change", function() {
            reportCheckboxes.forEach(ch => ch.checked = selectAll.checked);
        });
    }

    // Update status function (for demo)
    function updateStatus(status) {
        showToast(`Status laporan berhasil diubah menjadi ${getStatusText(status)}`);
        // In real implementation, you would make an API call here
        fetch(`/api/admin/laporan/${currentReportId}/status`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ status: status })
        })
    }
});
</script>
