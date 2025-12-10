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
        
        <button id="manage-data" class="bg-[#022C55] rounded-lg py-2 px-4">
            <span class="text-white text-base">Kelola Data</span>
        </button>
    </div>
    
    <!-- BUTTON DELETE -->
    <div class="action-buttons hidden" id="global-actions">
        <button id="cancel-action" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 mr-2">
            Batal
        </button>
        <div class="relative inline-block">
            <button id="delete-options-btn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center">
                Hapus <i class="fas fa-chevron-down ml-2"></i>
            </button>
            <div id="delete-options" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                <button class="w-full text-left px-4 py-3 hover:bg-gray-50 text-yellow-600 delete-option" data-type="soft">
                    <i class="fas fa-archive mr-3"></i> Arsipkan (Soft Delete)
                </button>
                <button class="w-full text-left px-4 py-3 hover:bg-gray-50 text-red-600 delete-option" data-type="hard">
                    <i class="fas fa-trash-alt mr-3"></i> Hapus Permanen
                </button>
            </div>
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
                        <!-- Action Column (Visible by default) -->
                        <th class="action-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
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
                        <!-- Checkbox Cell (Hidden by default) -->
                        <td class="checkbox-cell hidden px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" value="{{ $report['id'] }}" class="report-checkbox rounded border-gray-300">
                        </td>
                        
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
                        <td class="action-cell px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50 view-detail" title="Lihat Detail" data-id="{{ $report['id'] }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
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

</script>
@endpush