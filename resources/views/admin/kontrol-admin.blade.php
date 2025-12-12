@extends('layouts.admin')

@section('title', 'Kontrol Admin')

@section('page-title', 'Kontrol Admin')

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
                    <option value="menunggu">Aktif</option>
                    <option value="diproses">Tidak Aktif</option>
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
            <button id="addadminBtn"
                    class="bg-[#022C55] text-white text-base rounded-lg py-2 px-4 flex gap-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12.75C8.83 12.75 6.25 10.17 6.25 7C6.25 3.83 8.83 1.25 12 1.25C15.17 1.25 17.75 3.83 17.75 7C17.75 10.17 15.17 12.75 12 12.75ZM12 2.75C9.66 2.75 7.75 4.66 7.75 7C7.75 9.34 9.66 11.25 12 11.25C14.34 11.25 16.25 9.34 16.25 7C16.25 4.66 14.34 2.75 12 2.75Z" fill="white"/>
                        <path d="M3.41016 22.75C3.00016 22.75 2.66016 22.41 2.66016 22C2.66016 17.73 6.85015 14.25 12.0002 14.25C13.0102 14.25 14.0001 14.38 14.9601 14.65C15.3601 14.76 15.5902 15.17 15.4802 15.57C15.3702 15.97 14.9601 16.2 14.5602 16.09C13.7402 15.86 12.8802 15.75 12.0002 15.75C7.68015 15.75 4.16016 18.55 4.16016 22C4.16016 22.41 3.82016 22.75 3.41016 22.75Z" fill="white"/>
                        <path d="M18 22.75C16.82 22.75 15.7 22.31 14.83 21.52C14.48 21.22 14.17 20.85 13.93 20.44C13.49 19.72 13.25 18.87 13.25 18C13.25 16.75 13.73 15.58 14.59 14.69C15.49 13.76 16.7 13.25 18 13.25C19.36 13.25 20.65 13.83 21.53 14.83C22.31 15.7 22.75 16.82 22.75 18C22.75 18.38 22.7 18.76 22.6 19.12C22.5 19.57 22.31 20.04 22.05 20.45C21.22 21.87 19.66 22.75 18 22.75ZM18 14.75C17.11 14.75 16.29 15.1 15.67 15.73C15.08 16.34 14.75 17.14 14.75 18C14.75 18.59 14.91 19.17 15.22 19.67C15.38 19.95 15.59 20.2 15.83 20.41C16.43 20.96 17.2 21.26 18 21.26C19.13 21.26 20.2 20.66 20.78 19.69C20.95 19.41 21.08 19.09 21.15 18.78C21.22 18.52 21.25 18.27 21.25 18.01C21.25 17.21 20.95 16.44 20.41 15.84C19.81 15.14 18.93 14.75 18 14.75Z" fill="white"/>
                        <path d="M19.4998 18.73H16.5098C16.0998 18.73 15.7598 18.39 15.7598 17.98C15.7598 17.57 16.0998 17.23 16.5098 17.23H19.4998C19.9098 17.23 20.2498 17.57 20.2498 17.98C20.2498 18.39 19.9098 18.73 19.4998 18.73Z" fill="white"/>
                        <path d="M18 20.26C17.59 20.26 17.25 19.92 17.25 19.51V16.52C17.25 16.11 17.59 15.77 18 15.77C18.41 15.77 18.75 16.11 18.75 16.52V19.51C18.75 19.93 18.41 20.26 18 20.26Z" fill="white"/>
                    </svg>
                    Tambahkan Admin
            </button>

            <button id="addadminBtn"
                    class="bg-[#022C55] text-white text-base rounded-lg py-2 px-4 flex gap-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.0002 6.72998C20.9802 6.72998 20.9502 6.72998 20.9202 6.72998C15.6302 6.19998 10.3502 5.99998 5.12016 6.52998L3.08016 6.72998C2.66016 6.76998 2.29016 6.46998 2.25016 6.04998C2.21016 5.62998 2.51016 5.26998 2.92016 5.22998L4.96016 5.02998C10.2802 4.48998 15.6702 4.69998 21.0702 5.22998C21.4802 5.26998 21.7802 5.63998 21.7402 6.04998C21.7102 6.43998 21.3802 6.72998 21.0002 6.72998Z" fill="white"/>
                        <path d="M8.49977 5.72C8.45977 5.72 8.41977 5.72 8.36977 5.71C7.96977 5.64 7.68977 5.25 7.75977 4.85L7.97977 3.54C8.13977 2.58 8.35977 1.25 10.6898 1.25H13.3098C15.6498 1.25 15.8698 2.63 16.0198 3.55L16.2398 4.85C16.3098 5.26 16.0298 5.65 15.6298 5.71C15.2198 5.78 14.8298 5.5 14.7698 5.1L14.5498 3.8C14.4098 2.93 14.3798 2.76 13.3198 2.76H10.6998C9.63977 2.76 9.61977 2.9 9.46977 3.79L9.23977 5.09C9.17977 5.46 8.85977 5.72 8.49977 5.72Z" fill="white"/>
                        <path d="M15.2099 22.7501H8.7899C5.2999 22.7501 5.1599 20.8201 5.0499 19.2601L4.3999 9.19007C4.3699 8.78007 4.6899 8.42008 5.0999 8.39008C5.5199 8.37008 5.8699 8.68008 5.8999 9.09008L6.5499 19.1601C6.6599 20.6801 6.6999 21.2501 8.7899 21.2501H15.2099C17.3099 21.2501 17.3499 20.6801 17.4499 19.1601L18.0999 9.09008C18.1299 8.68008 18.4899 8.37008 18.8999 8.39008C19.3099 8.42008 19.6299 8.77007 19.5999 9.19007L18.9499 19.2601C18.8399 20.8201 18.6999 22.7501 15.2099 22.7501Z" fill="white"/>
                        <path d="M13.6601 17.25H10.3301C9.92008 17.25 9.58008 16.91 9.58008 16.5C9.58008 16.09 9.92008 15.75 10.3301 15.75H13.6601C14.0701 15.75 14.4101 16.09 14.4101 16.5C14.4101 16.91 14.0701 17.25 13.6601 17.25Z" fill="white"/>
                        <path d="M14.5 13.25H9.5C9.09 13.25 8.75 12.91 8.75 12.5C8.75 12.09 9.09 11.75 9.5 11.75H14.5C14.91 11.75 15.25 12.09 15.25 12.5C15.25 12.91 14.91 13.25 14.5 13.25Z" fill="white"/>
                    </svg>
                    Hapus
            </button>
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
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">Nama Admin</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">Nomor WhatsApp</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">Dibuat</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">Waktu Aktif</th>
                        
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
                            'nama' => 'Iwan Nafi Budi Prayitno',
                            'email' => 'admin123@gmail.com',
                            'no_wa' => '+628123456789',
                            'createdAt' => '01 Des 2025',
                            'status' => 'Admin',
                            'activeTime' => '04 Des 2025 17:00:06'
                        ],
                        [
                            'id' => 2,
                            'nama' => 'Iwan Nafi Budi Prayitno',
                            'email' => 'admin123@gmail.com',
                            'no_wa' => '+628123456789',
                            'createdAt' => '01 Des 2025',
                            'status' => 'Admin',
                            'activeTime' => '04 Des 2025 17:00:06'
                        ],
                        [
                            'id' => 3,
                            'nama' => 'Iwan Nafi Budi Prayitno',
                            'email' => 'admin123@gmail.com',
                            'no_wa' => '+628123456789',
                            'createdAt' => '01 Des 2025',
                            'status' => 'Admin',
                            'activeTime' => '04 Des 2025 17:00:06'
                        ],
                        [
                            'id' => 4,
                            'nama' => 'Iwan Nafi Budi Prayitno',
                            'email' => 'admin123@gmail.com',
                            'no_wa' => '+628123456789',
                            'createdAt' => '01 Des 2025',
                            'status' => 'Admin',
                            'activeTime' => '04 Des 2025 17:00:06'
                        ],
                        [
                            'id' => 5,
                            'nama' => 'Admin',
                            'email' => 'admin123@gmail.com',
                            'no_wa' => '+628123456789',
                            'createdAt' => '01 Des 2025',
                            'status' => 'Viewer',
                            'activeTime' => '04 Des 2025 17:00:06'
                        ],
                        [
                            'id' => 6,
                            'nama' => 'Iwan Nafi Budi Prayitno',
                            'email' => 'admin123@gmail.com',
                            'no_wa' => '+628123456789',
                            'createdAt' => '01 Des 2025',
                            'status' => 'Admin',
                            'activeTime' => '04 Des 2025 17:00:06'
                        ],
                        [
                            'id' => 7,
                            'nama' => 'Iwan Nafi Budi Prayitno',
                            'email' => 'admin123@gmail.com',
                            'no_wa' => '+628123456789',
                            'createdAt' => '01 Des 2025',
                            'status' => 'Admin',
                            'activeTime' => '04 Des 2025 17:00:06'
                        ],
                        [
                            'id' => 8,
                            'nama' => 'Iwan Nafi Budi Prayitno',
                            'email' => 'admin123@gmail.com',
                            'no_wa' => '+628123456789',
                            'createdAt' => '01 Des 2025',
                            'status' => 'Viewer',
                            'activeTime' => '04 Des 2025 17:00:06'
                        ],
                        [
                            'id' => 9,
                            'nama' => 'Admin',
                            'email' => 'admin123@gmail.com',
                            'no_wa' => '+628123456789',
                            'createdAt' => '01 Des 2025',
                            'status' => 'Viewer',
                            'activeTime' => '04 Des 2025 17:00:06'
                        ],
                        [
                            'id' => 10,
                            'nama' => 'Admin',
                            'email' => 'admin123@gmail.com',
                            'no_wa' => '+628123456789',
                            'createdAt' => '01 Des 2025',
                            'status' => 'Viewer',
                            'activeTime' => '04 Des 2025 17:00:06'
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

                        <!-- Email -->
                        <td class="max-w-[200px] px-6 py-4 text-base text-[#002C55]">
                            {{ $report['email'] }}
                        </td>

                        <!-- Nomor WhatsApp -->
                        <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                            {{ $report['no_wa'] }}
                        </td>

                        <!-- Tanggal Dibuat -->
                        <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                            {{ $report['createdAt'] }}
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'Viewer' => 'bg-[#DDDDDD] rounded-sm text-[#022C55]',
                                    'Admin' => 'bg-[#A0F1B5] rounded-sm text-[#022C55]'
                                ];
                            @endphp
                            <span class="px-4 py-2 text-sm font-medium rounded-full {{ $statusColors[$report['status']] }}">
                                {{ $report['status'] }}
                            </span>
                        </td>

                        <!-- Waktu Aktif -->
                        <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                            {{ $report['activeTime'] }}
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
