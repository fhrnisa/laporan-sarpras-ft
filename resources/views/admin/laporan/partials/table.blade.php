<div class="space-y-6">
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