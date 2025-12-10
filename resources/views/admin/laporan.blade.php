@extends('layouts.admin')

@section('title', 'Manajemen Laporan')

@section('page-title', 'Laporan')

@section('content')
<div class="space-y-6">
    <!-- Filter Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">

        <div class="">
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

        </div>
        
        <div class="flex items-center space-x-4">
        <!-- Global Action Buttons (visible on report page) -->
        @if(Request::routeIs('admin.reports*'))
        <div class="action-buttons hidden" id="global-actions">
            <button id="cancel-action" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 mr-2">
                Batal
            </button>
            <div class="relative inline-block">
                <button id="delete-options-btn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Hapus <i class="fas fa-chevron-down ml-2"></i>
                </button>

            </a>
        </div>

    <!-- Table Section -->
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <!-- Table Header -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" class="rounded border-gray-300">
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Pengusul
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lokasi Kerusakan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                            'nama' => 'Sang Bimo Raha...',
                            'email' => 'sangleksono4r@gmail.com',
                            'tanggal' => '05 Des 2025',
                            'lokasi' => '10 Lampu pojok belakang E12 R1',
                            'status' => 'ditolak',
                            'status_text' => 'Ditolak'
                        ],
                        [
                            'id' => 2,
                            'nama' => 'Fahrumisa Kus...',
                            'email' => 'abcdrfg@gmail.com',
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
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="rounded border-gray-300">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            #{{ $report['id'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold mr-3">
                                    {{ strtoupper(substr($report['nama'], 0, 1)) }}
                                </div>
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
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $report['lokasi'] }}">
                                {{ $report['lokasi'] }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'menunggu' => 'bg-gray-100 text-gray-800',
                                    'diproses' => 'bg-yellow-100 text-yellow-800',
                                    'terselesaikan' => 'bg-green-100 text-green-800',
                                    'ditolak' => 'bg-red-100 text-red-800'
                                ];
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$report['status']] }}">
                                {{ $report['status_text'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Table Footer: Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="text-sm text-gray-500">
                    Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">11</span> dari <span class="font-medium">265</span> laporan
                </div>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded text-gray-600 hover:bg-gray-50 disabled:opacity-50" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">1</button>
                    <button class="px-3 py-1 border border-gray-300 rounded text-gray-600 hover:bg-gray-50">2</button>
                    <button class="px-3 py-1 border border-gray-300 rounded text-gray-600 hover:bg-gray-50">3</button>
                    <span class="px-2">...</span>
                    <button class="px-3 py-1 border border-gray-300 rounded text-gray-600 hover:bg-gray-50">10</button>
                    <button class="px-3 py-1 border border-gray-300 rounded text-gray-600 hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">Items per page:</span>
                    <select class="border border-gray-300 rounded px-2 py-1 text-sm">
                        <option>10</option>
                        <option selected>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status Filter Buttons
    const statusButtons = document.querySelectorAll('.status-filter');
    
    statusButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            statusButtons.forEach(btn => btn.classList.remove('active', 'ring-2', 'ring-blue-500'));
            
            // Add active class to clicked button
            this.classList.add('active', 'ring-2', 'ring-blue-500');
            
            const status = this.dataset.status;
            console.log('Filter by status:', status);
            
            // Here you would filter the table rows
            // For now, we'll just show an alert
            if (status !== 'all') {
                alert(`Filter status: ${status}. (Akan difilter dengan data real)`);
            }
        });
    });

    // Row selection
    const selectAllCheckbox = document.querySelector('thead input[type="checkbox"]');
    const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');
    
    selectAllCheckbox.addEventListener('change', function() {
        const isChecked = this.checked;
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
    });

    // Individual row click
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
            selectAllCheckbox.checked = allChecked;
        });
    });

    // Row hover actions
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('click', function(e) {
            // Don't trigger if clicking on checkbox or action buttons
            if (e.target.type === 'checkbox' || e.target.closest('button')) {
                return;
            }
            // Here you can add row click functionality
            console.log('Row clicked:', this);
        });
    });
});
</script>
@endpush