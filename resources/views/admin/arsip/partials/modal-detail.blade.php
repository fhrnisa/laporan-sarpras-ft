<div id="detailOverlay" class="hidden overflow-y-auto fixed inset-0 bg-black/40 z-50">
    <div class="absolute right-0 top-0 h-auto w-full max-w-md bg-white mt-6 mr-6 shadow-xl rounded-xl overflow-y-auto">

        <!-- Header -->
        <div class="sticky top-0 bg-white z-10 flex justify-between items-start p-5 border-b">
            <div>
                <h2 id="detailTitle" class="text-3xl font-semibold text-[#002C55]">Detail Laporan</h2>
                <div class="flex gap-4 mt-2">
                    <div>
                        <span id="detailStatus" class="inline-flex px-3 py-1 text-lg font-semibold rounded-md">

                        </span>
                    </div>
                    <p id="detailDate" class="text-lg text-[#002C55]">17 Desember 2025</p>
                </div>
            </div>

            <!-- Close Button -->
            <button id="closeDetail"
                    onclick="closeDetailModal()"
                    class="text-gray-500 hover:text-gray-700 text-2xl p-1 hover:bg-gray-100 rounded"
                    aria-label="Tutup modal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.00098 5L19 18.9991" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.99996 18.9991L18.999 5" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
            </button>
        </div>

        <!-- Loading -->
        <div id="detailLoading" class="hidden p-8 text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto"></div>
            <p class="mt-4 text-gray-600">Memuat detail laporan...</p>
        </div>

        <!-- Content -->
        <div id="detailContent" class="hidden p-5 space-y-4 text-sm text-[#002C55]">
            <!-- User Info -->
            <div class="space-y-4">
                <div>
                    <p class="text-base text-[#002C55] mb-1">Nama Pengusul:</p>
                    <p id="detailNama" class="text-base font-semibold text-[#002C55]">Fahrunnisa</p>
                </div>

                <div>
                    <p class="text-base text-[#002C55] mb-1">Email:</p>
                    <p id="detailEmail" class="text-base font-semibold text-[#002C55]">nisa@email.com</p>
                </div>

                <div>
                    <p class="text-base font-semibold text-[#002C55] mb-1">Nomor Telepon:</p>
                    <p id="detailTelp" class="text-base font-semibold text-[#002C55]">08129383641</p>
                </div>

                <div>
                    <p class="text-base text-[#002C55] mb-1">Lokasi Kerusakan:</p>
                    <p id="detailLokasi" class="text-base font-semibold text-[#002C55]">E8</p>
                </div>

                <div>
                    <p class="text-base text-[#002C55] mb-1">Laporan Kerusakan:</p>
                    <div id="detailDeskripsi" class="mt-1 text-base font-semibold text-[#002C55] whitespace-pre-line">Meja rusak</div>
                </div>
            </div>

            <div>
                <p class="text-base text-[#002C55]">Foto Kerusakan:</p>
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

            <!-- Detail Waktu -->
            <div class="pt-4 border-t border-gray-200 space-y-4">
                    <div>
                        <p class="text-base text-[#002C55]">Waktu Diterima:</p>
                        <p id="detailCreatedAt" class="text-base font-semibold text-[#002C55]">-</p>
                    </div>

                    <div>
                        <p class="text-base text-[#002C55]">Diselesaikan oleh:</p>
                        <p id="detailCreatedAt" class="text-base font-semibold text-[#002C55]">-</p>
                    </div>

                    <div>
                        <p class="text-base text-[#002C55]">Waktu Terselesaikan:</p>
                        <p id="detailUpdatedAt" class="text-base font-semibold text-[#002C55]">-</p>
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
        <!-- TIDAK ADA FOOTER ACTION DI ARSIP -->
        <!-- Data arsip tidak bisa diubah status -->
    </div>
</div>