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
                <span class="text-[#002C55] font-medium">Tanggal</span>
                <select id="filterTanggal" class="border border-[#DDDDDD] rounded-lg text-sm text-[#002C55] py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                    <option value="7hari">7 Hari Terakhir</option>
                    <option value="30hari">30 Hari Terakhir</option>
                    <option value="bulan">Bulan Ini</option>
                </select>
            </div>
        </div>

        <div class="flex gap-2">
            <button id="kelolaBtn" class="bg-[#022C55] text-white text-base rounded-lg py-2 px-4">
                Kelola Data
            </button>
        </div>

        <!-- Hidden buttons -->
        <div id="manageOptions" class="hidden gap-2 absolute z-50 mt-12">
            <button class="px-4 py-2 bg-red-600 text-white rounded">Hapus Permanen</button>
            <button class="px-4 py-2 bg-yellow-500 text-white rounded">Arsipkan</button>
            <button id="batalBtn" class="px-4 py-2 bg-gray-600 text-white rounded">Batal</button>
        </div>
    </div>
    

    <!-- Table Section -->
    <div class="bg-white border border-[#DDDDDD] rounded-xl overflow-hidden">
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <!-- Checkbox Column (Hidden by default) -->
                        <th class="checkbox-cell hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" id="select-all" class="rounded border-gray-300">
                        </th>
                        
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Pengusul
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lokasi Kerusakan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        
                        <th class="action-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                    // Data dummy sesuai gambar
                    $reports = [
                        [
                            'id' => 1,
                            'nama' => 'Sang Bimo Raharjoning Leksono',
                            'email' => 'sangleksono41@gmail.com',
                            'tanggal' => '05 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                        [
                            'id' => 2,
                            'nama' => 'Fahrunnisa Kusumawardani',
                            'email' => 'kusuma.fahrunnisa@gmail.com',
                            'tanggal' => '05 Des 2025',
                            'lokasi' => 'Kursi dekanat FT lantai 2',
                            'status' => 'diproses',
                            'status_text' => 'Diproses'
                        ],
                        [
                            'id' => 3,
                            'nama' => 'Saiful Jamil',
                            'email' => 'saiful@yahoo.com',
                            'tanggal' => '04 Des 2025',
                            'lokasi' => 'Tempat tidur UKS',
                            'status' => 'menunggu',
                            'status_text' => 'Menunggu'
                        ],
                        [
                            'id' => 4,
                            'nama' => 'Jablay',
                            'email' => 'jablay@gmail.com',
                            'tanggal' => '04 Des 2025',
                            'lokasi' => 'WC E6 yang pojok bawah dekanat...',
                            'status' => 'terselesaikan',
                            'status_text' => 'Terselesaikan'
                        ],
                        [
                            'id' => 5,
                            'nama' => 'Wriothesley',
                            'email' => 'fansberatimotli@gmail.com',
                            'tanggal' => '04 Des 2025',
                            'lokasi' => 'Meja kelas banyak yang rusak...',
                            'status' => 'terselesaikan',
                            'status_text' => 'Terselesaikan'
                        ],
                        [
                            'id' => 6,
                            'nama' => 'Jule',
                            'email' => 'ayomakanjule@gmail.com',
                            'tanggal' => '03 Des 2025',
                            'lokasi' => 'Piring buat makan jule di kantin...',
                            'status' => 'diproses',
                            'status_text' => 'Diproses'
                        ],
                        [
                            'id' => 7,
                            'nama' => 'Sang Bimo Raha...',
                            'email' => 'sangleksono4r@gmail.com',
                            'tanggal' => '03 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                        [
                            'id' => 8,
                            'nama' => 'Sang Bimo Raha...',
                            'email' => 'sangleksono4r@gmail.com',
                            'tanggal' => '02 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                        [
                            'id' => 9,
                            'nama' => 'Sang Bimo Raha...',
                            'email' => 'sangleksono4r@gmail.com',
                            'tanggal' => '02 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                        [
                            'id' => 10,
                            'nama' => 'Sang Bimo Raha...',
                            'email' => 'sangleksono4r@gmail.com',
                            'tanggal' => '01 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                        [
                            'id' => 11,
                            'nama' => 'Sang Bimo Raha...',
                            'email' => 'sangleksono4r@gmail.com',
                            'tanggal' => '01 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                    ];
                    @endphp

                    @foreach($reports as $report)
                    <tr class="hover:bg-gray-50 transition-colors report-row" data-id="{{ $report['id'] }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            #{{ $report['id'] }}
                        </td>
                        <td class="max-w-[200px] px-6 py-4">
                            <div class="flex items-center">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $report['nama'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $report['email'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $report['tanggal'] }}
                        </td>
                        <td class="max-w-[200px] px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $report['lokasi'] }}">
                                {{ $report['lokasi'] }}
                            </div>
                        </td>
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


                        <!-- Action Cell (Visible by default) -->
                        <td class="text-center">
                            <!-- Default: titik tiga -->
                            <button class="aksiBtn" data-id="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12C18 12.5523 18.4477 13 19 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>

                            <!-- Checkbox saat mode kelola aktif -->
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

       
    </div>
</div>


@endsection

@push('styles')
<style>
.checkbox-cell { width: 50px; }
.action-cell { width: 120px; }
#select-all:indeterminate {
    background-color: #3b82f6;
    border-color: #3b82f6;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const kelolaBtn = document.getElementById("kelolaBtn");
    const batalBtn = document.getElementById("batalBtn");
    const manageOptions = document.getElementById("manageOptions");

    const aksiButtons = document.querySelectorAll(".aksiBtn");
    const checkboxCells = document.querySelectorAll(".checkbox-cell");
    const reportCheckboxes = document.querySelectorAll(".report-checkbox");
    const selectAll = document.getElementById("select-all");

    // Mode Kelola
    kelolaBtn.addEventListener("click", () => {
        kelolaBtn.classList.add("hidden");
        manageOptions.classList.remove("hidden");

        // Tampilkan kolom checkbox
        checkboxCells.forEach(cell => cell.classList.remove("hidden"));

        // Sembunyikan tombol titik tiga
        aksiButtons.forEach(btn => btn.classList.add("hidden"));
    });

    // Mode Batal
    batalBtn.addEventListener("click", () => {
        kelolaBtn.classList.remove("hidden");
        manageOptions.classList.add("hidden");

        // Sembunyikan kolom checkbox
        checkboxCells.forEach(cell => cell.classList.add("hidden"));

        // Tampilkan tombol titik tiga
        aksiButtons.forEach(btn => btn.classList.remove("hidden"));

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
@endpush