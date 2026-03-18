<div class="space-y-6">

    <!-- FILTER SECTION -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="flex flex-col md:flex-row gap-4">

            <!-- Filter Status -->
            <div class="flex items-center gap-3">
                <span class="text-[#002C55] font-medium">Status</span>
                <select id="filterStatus" class="border border-[#DDDDDD] rounded-lg text-sm text-[#002C55] max-w-[140px] py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                    <option value="all" {{ request('status','all') == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="terselesaikan" {{ request('status') == 'terselesaikan' ? 'selected' : '' }}>Terselesaikan</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <!-- Filter Tanggal -->
            <div class="flex items-center gap-3">
                <span class="text-[#002C55] font-medium">Tanggal</span>
                <select id="filterTanggal" class="border border-[#DDDDDD] rounded-lg text-sm text-[#002C55] max-w-[140px] py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                    <option value="semua" {{ request('tanggal','semua') == 'semua' ? 'selected' : '' }}>Semua</option>
                    <option value="7hari" {{ request('tanggal') == '7hari' ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="30hari" {{ request('tanggal') == '30hari' ? 'selected' : '' }}>30 Hari Terakhir</option>
                    <option value="bulan" {{ request('tanggal') == 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
                </select>
            </div>
        </div>

        <!-- BUTTONS SECTION -->
        <div class="flex gap-3 items-center">
            <button id="kelolaBtn"
                    class="bg-[#022C55] text-white text-base rounded-lg py-2 px-4 flex gap-2 items-center hover:bg-[#01408C] transition-colors">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.2633 5.43908L5.05327 14.1291C4.74327 14.4591 4.44327 15.1091 4.38327 15.5591L4.01327 18.7991C3.88327 19.9691 4.72327 20.7691 5.88327 20.5691L9.10327 20.0191C9.55327 19.9391 10.1833 19.6091 10.4933 19.2691L18.7033 10.5791C20.1233 9.07908 20.7633 7.36908 18.5533 5.27908C16.3533 3.20908 14.6833 3.93908 13.2633 5.43908Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.8926 6.88916C12.3226 9.64916 14.5626 11.7592 17.3426 12.0392" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Kelola Data
            </button>

            <!-- Hidden buttons -->
            <div id="manageOptions" class="hidden gap-2 items-center">
                <div class="flex gap-4">
                    <button id="arsipBtn" class="px-4 py-2 bg-[#FED43E] text-white rounded-lg flex gap-2 items-center hover:bg-yellow-600"
                            data-url="{{ route('admin.laporan.archive') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 22.75H8C4.35 22.75 2.25 20.65 2.25 17V7C2.25 3.35 4.35 1.25 8 1.25H16C19.65 1.25 21.75 3.35 21.75 7V17C21.75 20.65 19.65 22.75 16 22.75ZM8 2.75C5.14 2.75 3.75 4.14 3.75 7V17C3.75 19.86 5.14 21.25 8 21.25H16C18.86 21.25 20.25 19.86 20.25 17V7C20.25 4.14 18.86 2.75 16 2.75H8Z" fill="currentColor"/>
                            <path d="M9 11.11C8.83 11.11 8.66 11.08 8.5 11.01C8.04 10.81 7.75 10.36 7.75 9.87V2C7.75 1.59 8.09 1.25 8.5 1.25H15.5C15.91 1.25 16.25 1.59 16.25 2V9.85999C16.25 10.36 15.96 10.81 15.5 11C15.05 11.2 14.52 11.11 14.15 10.77L12 8.79999L9.84998 10.78C9.60998 11 9.31 11.11 9 11.11ZM12 7.21002C12.3 7.21002 12.61 7.31998 12.85 7.53998L14.75 9.28998V2.75H9.25V9.28998L11.15 7.53998C11.39 7.31998 11.7 7.21002 12 7.21002Z" fill="currentColor"/>
                            <path d="M17.5 14.75H13.25C12.84 14.75 12.5 14.41 12.5 14C12.5 13.59 12.84 13.25 13.25 13.25H17.5C17.91 13.25 18.25 13.59 18.25 14C18.25 14.41 17.91 14.75 17.5 14.75Z" fill="currentColor"/>
                            <path d="M17.5 18.75H9C8.59 18.75 8.25 18.41 8.25 18C8.25 17.59 8.59 17.25 9 17.25H17.5C17.91 17.25 18.25 17.59 18.25 18C18.25 18.41 17.91 18.75 17.5 18.75Z" fill="currentColor"/>
                        </svg>
                        Arsipkan
                    </button>

                    <button id="hapusPermanenBtn" class="px-4 py-2 bg-[#ED3237] text-white rounded-lg flex gap-2 items-center hover:bg-red-600"
                            data-url="{{ route('admin.laporan.destroy') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.0002 6.72998C20.9802 6.72998 20.9502 6.72998 20.9202 6.72998C15.6302 6.19998 10.3502 5.99998 5.12016 6.52998L3.08016 6.72998C2.66016 6.76998 2.29016 6.46998 2.25016 6.04998C2.21016 5.62998 2.51016 5.26998 2.92016 5.22998L4.96016 5.02998C10.2802 4.48998 15.6702 4.69998 21.0702 5.22998C21.4802 5.26998 21.7802 5.63998 21.7402 6.04998C21.7102 6.43998 21.3802 6.72998 21.0002 6.72998Z" fill="white"/>
                            <path d="M8.49977 5.72C8.45977 5.72 8.41977 5.72 8.36977 5.71C7.96977 5.64 7.68977 5.25 7.75977 4.85L7.97977 3.54C8.13977 2.58 8.35977 1.25 10.6898 1.25H13.3098C15.6498 1.25 15.8698 2.63 16.0198 3.55L16.2398 4.85C16.3098 5.26 16.0298 5.65 15.6298 5.71C15.2198 5.78 14.8298 5.5 14.7698 5.1L14.5498 3.8C14.4098 2.93 14.3798 2.76 13.3198 2.76H10.6998C9.63977 2.76 9.61977 2.9 9.46977 3.79L9.23977 5.09C9.17977 5.46 8.85977 5.72 8.49977 5.72Z" fill="white"/>
                            <path d="M15.2099 22.75H8.7899C5.2999 22.75 5.1599 20.82 5.0499 19.26L4.3999 9.18995C4.3699 8.77995 4.6899 8.41995 5.0999 8.38995C5.5199 8.36995 5.8699 8.67995 5.8999 9.08995L6.5499 19.16C6.6599 20.68 6.6999 21.25 8.7899 21.25H15.2099C17.3099 21.25 17.3499 20.68 17.4499 19.16L18.0999 9.08995C18.1299 8.67995 18.4899 8.36995 18.8999 8.38995C19.3099 8.41995 19.6299 8.76995 19.5999 9.18995L18.9499 19.26C18.8399 20.82 18.6999 22.75 15.2099 22.75Z" fill="white"/>
                            <path d="M13.6601 17.25H10.3301C9.92008 17.25 9.58008 16.91 9.58008 16.5C9.58008 16.09 9.92008 15.75 10.3301 15.75H13.6601C14.0701 15.75 14.4101 16.09 14.4101 16.5C14.4101 16.91 14.0701 17.25 13.6601 17.25Z" fill="white"/>
                            <path d="M14.5 13.25H9.5C9.09 13.25 8.75 12.91 8.75 12.5C8.75 12.09 9.09 11.75 9.5 11.75H14.5C14.91 11.75 15.25 12.09 15.25 12.5C15.25 12.91 14.91 13.25 14.5 13.25Z" fill="white"/>
                        </svg>
                        Hapus Permanen
                    </button>

                    <button id="batalBtn" class="px-4 py-2 bg-gray-600 text-white rounded-lg flex gap-2 items-center hover:bg-gray-700">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.00098 5L19 18.9991" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.99996 18.9991L18.999 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Batal
                    </button>
                </div>
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
                <thead class="bg-[#002C55]">
                    <tr>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Nama Pengusul</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Nomor WhatsApp</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Lokasi Kerusakan</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Status</th>

                        <!-- Aksi -->
                        <th class="action-cell px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">

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
                            @php
                                // Pastikan nomor sudah ada 0 di depan
                                $nomor = $report['nomor_telepon'] ?? '';
                                if ($nomor && $nomor[0] !== '0') {
                                    $nomor = '0' . $nomor;
                                }
                                $whatsappLink = $nomor ? 'https://wa.me/62' . substr($nomor, 1) : '#';
                            @endphp

                            @if($nomor)
                                <a href="{{ $whatsappLink }}"
                                target="_blank"
                                class="flex items-center gap-2 text-blue-600 hover:text-blue-800 hover:underline">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.76.982.998-3.675-.236-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.9 6.994c-.004 5.45-4.438 9.88-9.888 9.88m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.333.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.333 11.893-11.893 0-3.18-1.24-6.162-3.495-8.411"/>
                                    </svg>
                                    {{ $nomor }}
                                </a>
                            @else
                                N/A
                            @endif
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
                            <div class="text-base text-[#002C55] max-w-xs truncate" title="{{ $report['lokasi_kerusakan'] ?? '' }}">
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
                            <span class="px-4 py-2 text-base font-medium rounded-sm {{ $statusColors[$status] ?? 'bg-gray-200' }}">
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