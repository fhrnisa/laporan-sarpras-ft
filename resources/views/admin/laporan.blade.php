@extends('layouts.admin')

@section('title', 'Laporan')

@section('page-title', 'Laporan')

@section('content')
<div class="space-y-6">

    <!-- FILTER SECTION -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="flex flex-col md:flex-row gap-4">

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
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                    // Data dummy sesuai gambar
                    $reports = [
                        [
                            'id' => 1,
                            'nama' => 'Sang Bimo Raharjoning Leksono',
                            'no_wa' => '+628123456789',
                            'tanggal' => '05 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                        [
                            'id' => 2,
                            'nama' => 'Fahrunnisa Kusumawardani',
                            'no_wa' => '+628123456789',
                            'tanggal' => '05 Des 2025',
                            'lokasi' => 'Kursi dekanat FT lantai 2',
                            'status' => 'diproses',
                            'status_text' => 'Diproses'
                        ],
                        [
                            'id' => 3,
                            'nama' => 'Saiful Jamil',
                            'no_wa' => '+628123456789',
                            'tanggal' => '04 Des 2025',
                            'lokasi' => 'Tempat tidur UKS',
                            'status' => 'menunggu',
                            'status_text' => 'Menunggu'
                        ],
                        [
                            'id' => 4,
                            'nama' => 'Jablay',
                            'no_wa' => '+628123456789',
                            'tanggal' => '04 Des 2025',
                            'lokasi' => 'WC E6 yang pojok bawah dekanat...',
                            'status' => 'terselesaikan',
                            'status_text' => 'Terselesaikan'
                        ],
                        [
                            'id' => 5,
                            'nama' => 'Wriothesley',
                            'no_wa' => '+628123456789',
                            'tanggal' => '04 Des 2025',
                            'lokasi' => 'Meja kelas banyak yang rusak...',
                            'status' => 'terselesaikan',
                            'status_text' => 'Terselesaikan'
                        ],
                        [
                            'id' => 6,
                            'nama' => 'Jule',
                            'no_wa' => '+628123456789',
                            'tanggal' => '03 Des 2025',
                            'lokasi' => 'Piring buat makan jule di kantin...',
                            'status' => 'diproses',
                            'status_text' => 'Diproses'
                        ],
                        [
                            'id' => 7,
                            'nama' => 'Sang Bimo Raha...',
                            'no_wa' => '+628123456789',
                            'tanggal' => '03 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                        [
                            'id' => 8,
                            'nama' => 'Sang Bimo Raha...',
                            'no_wa' => '+628123456789',
                            'tanggal' => '02 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                        [
                            'id' => 9,
                            'nama' => 'Sang Bimo Raha...',
                            'no_wa' => '+628123456789',
                            'tanggal' => '02 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                        [
                            'id' => 10,
                            'nama' => 'Sang Bimo Raha...',
                            'no_wa' => '+628123456789',
                            'tanggal' => '01 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                        [
                            'id' => 11,
                            'nama' => 'Sang Bimo Raha...',
                            'no_wa' => '+628123456789',
                            'tanggal' => '01 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                    ];
                    @endphp

                    @foreach($reports as $report)
                    <tr class="hover:bg-gray-50 transition-colors report-row" data-id="{{ $report['id'] }}">

                        <!-- ID -->
                        <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                            #{{ $report['id'] }}
                        </td>

                        <!-- Nama -->
                        <td class="max-w-[200px] px-6 py-4 text-base text-[#002C55]">
                            {{ $report['nama'] }}
                        </td>

                        <!-- Nomor WhatsApp -->
                        <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                            {{ $report['no_wa'] }}
                        </td>

                        <!-- Tanggal -->
                        <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                            {{ $report['tanggal'] }}
                        </td>

                        <!-- Lokasi -->
                        <td class="max-w-[200px] px-6 py-4">
                            <div class="text-sm text-[#002C55] max-w-xs truncate" title="{{ $report['lokasi'] }}">
                                {{ $report['lokasi'] }}
                            </div>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'menunggu' => 'text-lg bg-[#E1E7E9] rounded-sm text-[#022C55]',
                                    'diproses' => 'bg-[#FEEF94] rounded-sm text-[#022C55]',
                                    'terselesaikan' => 'bg-[#A0F1B5] rounded-sm text-[#022C55]',
                                    'ditolak' => 'bg-[#FF7A7E] rounded-sm text-[#022C55]'
                                ];
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$report['status']] }}">
                                {{ $report['status_text'] }}
                            </span>
                        </td>

                        <!-- ACTION CELL -->
                        <td class="text-center action-cell">
                            <button class="aksiBtn" data-id="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12C18 12.5523 18.4477 13 19 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </td>

                        <!-- Checkbox muncul saat mode kelola -->
                        <td class="checkbox-cell hidden px-6 py-4">
                            <input type="checkbox" class="report-checkbox">
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>


<!-- === MODAL DETAIL LAPORAN === -->
<div id="detailOverlay" class="hidden fixed inset-0 bg-black/40 z-50">
    <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-xl rounded-l-xl overflow-y-auto">

        <!-- Header -->
        <div class="flex justify-between items-start p-5 border-b">
            <div>
                <h2 id="detailTitle" class="text-xl font-semibold text-gray-800">Laporan #1</h2>
                <p id="detailDate" class="text-sm text-gray-500">05 Desember 2025</p>
            </div>
            <button id="closeDetail" class="text-gray-500 hover:text-gray-700">
                ✕
            </button>
        </div>

        <!-- Badge Status -->
        <div class="px-5 mt-4">
            <span id="detailStatus" class="px-3 py-1 text-sm rounded-md font-medium bg-red-100 text-red-600">
                Ditolak
            </span>
        </div>

        <!-- Content -->
        <div class="p-5 space-y-4 text-sm text-gray-700">

            <div>
                <p class="font-semibold">Nama Pengusul:</p>
                <p id="detailNama">–</p>
            </div>

            <div>
                <p class="font-semibold">Email:</p>
                <p id="detailEmail">–</p>
            </div>

            <div>
                <p class="font-semibold">Nomor Telp:</p>
                <p id="detailTelp">–</p>
            </div>

            <div>
                <p class="font-semibold">Lokasi Kerusakan:</p>
                <p id="detailLokasi">–</p>
            </div>

            <div>
                <p class="font-semibold">Foto Kerusakan:</p>
                <img id="detailFoto" class="w-full h-auto rounded-md mt-2" src="" alt="">
            </div>

            <div>
                <p class="font-semibold">Laporan Kerusakan:</p>
                <p id="detailDeskripsi">–</p>
            </div>

            <div>
                <p class="font-semibold">Alasan Ditolak:</p>
                <p id="detailAlasan">–</p>
            </div>

            <div>
                <p class="font-semibold">Waktu Ditolak:</p>
                <p id="detailWaktu">–</p>
            </div>

            <div>
                <p class="font-semibold">Ditolak oleh:</p>
                <p id="detailAdmin">–</p>
            </div>

        </div>

        <!-- Footer -->
        <div class="p-5">
            <button class="w-full py-2 bg-[#002C5F] text-white rounded-md hover:bg-[#01408C]">
                Update
            </button>
        </div>

    </div>
</div>
@endsection


@push('styles')
<style>
    .checkbox-cell { width: 60px; }
    .action-cell { width: 100px; }
</style>
@endpush


<script>
document.addEventListener("DOMContentLoaded", () => {
    const kelolaBtn = document.getElementById("kelolaBtn");
    const batalBtn = document.getElementById("batalBtn");
    const manageOptions = document.getElementById("manageOptions");

    const actionCells = document.querySelectorAll(".action-cell");
    const checkboxCells = document.querySelectorAll(".checkbox-cell");
    const reportCheckboxes = document.querySelectorAll(".report-checkbox");
    const selectAll = document.getElementById("select-all");

const overlay = document.getElementById("detailOverlay");
    const closeBtn = document.getElementById("closeDetail");

    // Tombol titik tiga (aksi)
    document.querySelectorAll(".aksiBtn").forEach(btn => {
        btn.addEventListener("click", function () {

            // Ambil data dari atribut tombol
            const data = this.dataset;

            document.getElementById("detailTitle").textContent = "Laporan #" + data.id;
            document.getElementById("detailDate").textContent = data.tanggal;
            document.getElementById("detailStatus").textContent = data.status;
            document.getElementById("detailNama").textContent = data.nama;
            document.getElementById("detailEmail").textContent = data.email;
            document.getElementById("detailTelp").textContent = data.telp;
            document.getElementById("detailLokasi").textContent = data.lokasi;
            document.getElementById("detailDeskripsi").textContent = data.deskripsi;
            document.getElementById("detailAlasan").textContent = data.alasan;
            document.getElementById("detailWaktu").textContent = data.waktu;
            document.getElementById("detailAdmin").textContent = data.admin;
            document.getElementById("detailFoto").src = data.foto;

            overlay.classList.remove("hidden");
        });
    });

    // Tutup modal
    closeBtn.addEventListener("click", () => {
        overlay.classList.add("hidden");
    });

    // Klik di luar panel → tutup
    overlay.addEventListener("click", (e) => {
        if (e.target === overlay) overlay.classList.add("hidden");
    });

    // MODE KELOLA
    kelolaBtn.addEventListener("click", () => {
        kelolaBtn.classList.add("hidden");
        manageOptions.classList.remove("hidden");

        // Sembunyikan tombol titik tiga
        actionCells.forEach(btn => btn.classList.add("hidden"));

        // Tampilkan kolom checkbox
        checkboxCells.forEach(cell => cell.classList.remove("hidden"));

    });

    // BATAL MODE KELOLA
    batalBtn.addEventListener("click", () => {
        kelolaBtn.classList.remove("hidden");
        manageOptions.classList.add("hidden");

        // Sembunyikan kolom checkbox
        checkboxCells.forEach(cell => cell.classList.add("hidden"));

        // Tampilkan tombol titik tiga
        actionCells.forEach(btn => btn.classList.remove("hidden"));

        // Reset checkbox
        reportCheckboxes.forEach(ch => ch.checked = false);
        selectAll.checked = false;
    });

    // Select All checkbox
    selectAll.addEventListener("change", function() {
        reportCheckboxes.forEach(ch => ch.checked = selectAll.checked);
    });
});
</script>
