@extends('layouts.admin')

@section('title', 'Arsip')

@section('page-title', 'Arsip')
@section('showSearch', true)

@section('search-placeholder', 'Cari data di arsip')
@section('search-mode', 'arsip')

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

        <!-- BUTTONS SECTION -->
        <div class="flex gap-3 items-center">
            <button id="kelolaBtn"
                    class="bg-[#022C55] text-white text-base rounded-lg py-2 px-4 flex gap-2 items-center hover:bg-[#01408C] transition-colors">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.2633 5.43908L5.05327 14.1291C4.74327 14.4591 4.44327 15.1091 4.38327 15.5591L4.01327 18.7991C3.88327 19.9691 4.72327 20.7691 5.88327 20.5691L9.10327 20.0191C9.55327 19.9391 10.1833 19.6091 10.4933 19.2691L18.7033 10.5791C20.1233 9.07908 20.7633 7.36908 18.5533 5.27908C16.3533 3.20908 14.6833 3.93908 13.2633 5.43908Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.8926 6.88916C12.3226 9.64916 14.5626 11.7592 17.3426 12.0392" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Kelola
            </button>


            <!-- Hidden buttons -->
            <div id="manageOptions" class="hidden gap-2 items-center">
                <div class="flex gap-4">

                    <button id="arsipBtn" class="px-4 py-2 bg-[#FED43E] text-white rounded-lg flex gap-2 items-center hover:bg-yellow-600">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 3.11 16.44 3.11 16.44M3.11 16.44H7.63M3.11 16.44V21.44M2 12C2 6.48 6.44 2 12 2C18.67 2 22 7.56 22 7.56M22 7.56V2.56M22 7.56H17.56" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Pulihkan
                    </button>

                    <button id="hapusPermanenBtn" class="px-4 py-2 bg-[#ED3237] text-white rounded-lg flex gap-2 items-center hover:bg-red-600">
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
                        onerror="this.onerror=null; this.src='#'; this.style.display='none';">
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

    /* Status colors */
    .status-menunggu { background-color: #E1E7E9; color: #022C55; }
    .status-diproses { background-color: #FEEF94; color: #022C55; }
    .status-terselesaikan { background-color: #A0F1B5; color: #022C55; }
    .status-ditolak { background-color: #FF7A7E; color: #022C55; }
</style>
@endpush

<script>
document.addEventListener("DOMContentLoaded", () => {
    // === ELEMEN UTAMA ===
    const kelolaBtn = document.getElementById("kelolaBtn");
    const batalBtn = document.getElementById("batalBtn");
    const pulihkanBtn = document.getElementById("pulihkanBtn");
    const hapusPermanenBtn = document.getElementById("hapusPermanenBtn");
    const manageOptions = document.getElementById("manageOptions");
    const actionCells = document.querySelectorAll(".action-cell");
    const checkboxCells = document.querySelectorAll(".checkbox-cell");
    const reportCheckboxes = document.querySelectorAll(".report-checkbox");
    const selectAll = document.getElementById("select-all");
    const overlay = document.getElementById("detailOverlay");
    const closeBtn = document.getElementById("closeDetail");
    const filterStatus = document.getElementById("filterStatus");
    const filterTanggal = document.getElementById("filterTanggal");

    // === FILTER FUNCTIONS ===
    // Set initial filter values from URL params
    const urlParams = new URLSearchParams(window.location.search);
    const statusParam = urlParams.get('status');
    const tanggalParam = urlParams.get('tanggal');

    if (statusParam && filterStatus) filterStatus.value = statusParam;
    if (tanggalParam && filterTanggal) filterTanggal.value = tanggalParam;

    // Filter change event - hanya jika elemen ada
    if (filterStatus) {
        filterStatus.addEventListener('change', applyFilters);
    }
    if (filterTanggal) {
        filterTanggal.addEventListener('change', applyFilters);
    }

    function applyFilters() {
        const params = new URLSearchParams();

        // Get search value from topbar search (untuk arsip)
        const searchInput = document.querySelector('input[name="search"]') || document.getElementById('topbarSearch');
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
        window.location.href = `/admin/arsip${queryString ? '?' + queryString : ''}`;
    }

    // === TOAST FUNCTION ===
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

    // === DETAIL MODAL FUNCTIONS ===
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

    // === EVENT LISTENERS FOR DETAIL BUTTONS ===
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

    // === MODE KELOLA ===
    if (kelolaBtn) {
        kelolaBtn.addEventListener("click", () => {
            kelolaBtn.classList.add("hidden");
            if (manageOptions) manageOptions.classList.remove("hidden");

            // Tampilkan checkbox, sembunyikan action cell
            actionCells.forEach(cell => cell.classList.add("hidden"));
            checkboxCells.forEach(cell => cell.classList.remove("hidden"));
        });
    }

    // === BATAL MODE KELOLA ===
    if (batalBtn) {
        batalBtn.addEventListener("click", () => {
            if (kelolaBtn) kelolaBtn.classList.remove("hidden");
            if (manageOptions) manageOptions.classList.add("hidden");

            // Sembunyikan checkbox, tampilkan action cell
            checkboxCells.forEach(cell => cell.classList.add("hidden"));
            actionCells.forEach(cell => cell.classList.remove("hidden"));

            // Uncheck semua checkbox
            reportCheckboxes.forEach(ch => ch.checked = false);
            if (selectAll) selectAll.checked = false;
        });
    }

    // === SELECT ALL CHECKBOX ===
    if (selectAll) {
        selectAll.addEventListener("change", function() {
            reportCheckboxes.forEach(ch => ch.checked = selectAll.checked);
        });
    }

    // === ACTION FUNCTIONS UNTUK ARSIP ===

    // Function untuk memulihkan data dari arsip
    async function restoreReports() {
        const selectedIds = Array.from(document.querySelectorAll('.report-checkbox:checked'))
            .map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            showToast('Pilih laporan yang akan dipulihkan', 'error');
            return;
        }

        if (!confirm(`Pulihkan ${selectedIds.length} laporan dari arsip?`)) return;

        try {
            const response = await fetch("{{ route('admin.arsip.restore') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ ids: selectedIds })
            });

            const data = await response.json();

            if (data.success) {
                showToast(data.message);
                setTimeout(() => location.reload(), 1500);
            } else {
                showToast(data.message, 'error');
            }
        } catch (error) {
            showToast('Terjadi kesalahan: ' + error.message, 'error');
        }
    }

    // Function untuk menghapus permanen dari arsip
    async function deletePermanent() {
        const selectedIds = Array.from(document.querySelectorAll('.report-checkbox:checked'))
            .map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            showToast('Pilih laporan yang akan dihapus permanen', 'error');
            return;
        }

        if (!confirm(`Hapus permanen ${selectedIds.length} laporan? Tindakan ini tidak dapat dibatalkan!`)) return;

        try {
            const response = await fetch("{{ route('admin.arsip.destroy') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ ids: selectedIds })
            });

            const data = await response.json();

            if (data.success) {
                showToast(data.message);
                setTimeout(() => location.reload(), 1500);
            } else {
                showToast(data.message, 'error');
            }
        } catch (error) {
            showToast('Terjadi kesalahan: ' + error.message, 'error');
        }
    }

    // === BUTTON EVENT LISTENERS UNTUK ARSIP ===
    if (pulihkanBtn) {
        pulihkanBtn.addEventListener('click', restoreReports);
    }

    if (hapusPermanenBtn) {
        hapusPermanenBtn.addEventListener('click', deletePermanent);
    }

    // === UPDATE STATUS FUNCTION (UNTUK MODAL) ===
    // Di halaman arsip, tombol update status di modal sebaiknya dihapus
    // Karena data arsip sudah final
    function updateStatus(status) {
        showToast('Data arsip tidak dapat diubah statusnya', 'error');
        closeDetailModal();
    }

    // Expose updateStatus ke global scope untuk modal
    window.updateStatus = updateStatus;
    window.closeDetailModal = closeDetailModal;
    window.showToast = showToast;
});
</script>
