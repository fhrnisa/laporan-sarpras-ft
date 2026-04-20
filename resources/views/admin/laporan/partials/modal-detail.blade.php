<div id="detailOverlay" class="hidden overflow-y-auto fixed inset-0 bg-black/40 z-50">
    <div id="detailModal" class="absolute right-0 top-0 h-auto w-full max-w-md bg-white mt-6 mr-6 shadow-xl rounded-xl overflow-y-auto">

        <!-- Header -->
        <div class="sticky top-0 bg-white z-10 flex justify-between items-start p-5 border-b">
            <div>
                <h2 id="detailTitle" class="text-3xl font-semibold text-[#002C55]">Detail Laporan</h2>
                <div class="flex gap-4 mt-2">
                    <div>
                        <span id="detailStatus" class="inline-flex px-3 py-1 text-lg font-semibold rounded-md">
                        </span>
                    </div>
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
                    <p class="text-base text-[#002C55] mb-1 font-semibold">Kode Laporan:</p>
                    <p id="detailKodeLaporan" class="text-base text-[#002C55]">-</p>
                </div>

                <div id="rowWaktuDiterima">
                    <p class="text-base font-semibold text-[#002C55]">Waktu Diterima:</p>
                    <p id="detailCreatedAt" class="text-base text-[#002C55]">-</p>
                </div>

                <div>
                    <p class="text-base text-[#002C55] mb-1 font-semibold">Nama Pengusul:</p>
                    <p id="detailNama" class="text-base text-[#002C55]"></p>
                </div>

                <div>
                    <p class="text-base text-[#002C55] mb-1 font-semibold">Email:</p>
                    <p id="detailEmail" class="text-base text-[#002C55]"></p>
                </div>

                <div>
                    <p class="text-base font-semibold text-[#002C55] mb-1 font-semibold">Nomor Telepon:</p>
                    <p id="detailTelp" class="text-base text-[#002C55]"></p>
                </div>

                <div>
                    <p class="text-base text-[#002C55] mb-1 font-semibold">Lokasi Kerusakan:</p>
                    <p id="detailLokasi" class="text-base text-[#002C55]"></p>
                </div>

                <div>
                    <p class="text-base text-[#002C55] mb-1 font-semibold">Laporan Kerusakan:</p>
                    <div id="detailDeskripsi" class="mt-1 text-base text-[#002C55] whitespace-pre-line"></div>
                </div>
            </div>

            <div>
                <p class="text-base text-[#002C55] font-semibold">Foto Kerusakan:</p>
                <div id="detailFotoContainer" class="mt-2">
                    <img id="detailFoto" class="w-full h-auto rounded-md border border-gray-300"
                        src="" alt="Foto kerusakan">
                </div>
                <p id="noFotoMessage" class="text-gray-500 italic mt-2 hidden">Tidak ada foto</p>
            </div>

            <!-- Additional Info for Approved Reports -->
            <div id="approvedInfo" class="hidden mt-4 p-4 bg-blue-50 rounded-lg">
                <h3 class="text-base font-semibold text-blue-800 mb-2">Informasi Persetujuan</h3>
                <div class="space-y-2">
                    <div>
                        <p class="font-semibold text-blue-700">Disetujui oleh:</p>
                        <p id="detailDisetujuiOleh" class="text-blue-600">-</p>
                    </div>
                    <div>
                        <p class="font-semibold text-blue-700">Waktu Disetujui:</p>
                        <p id="detailWaktuDisetujui" class="text-blue-600">-</p>
                    </div>
                </div>
            </div>

            <!-- Additional Info for Rejected Reports -->
            <div id="rejectedInfo" class="hidden mt-4 p-4 bg-red-50 rounded-lg">
                <h3 class="text-base font-semibold text-red-800 mb-2">Informasi Penolakan</h3>
                <div class="space-y-2">
                    <div>
                        <p class="font-semibold text-red-700">Alasan Ditolak:</p>
                        <p id="detailAlasan" class="text-red-600">-</p>
                    </div>
                    <div>
                        <p class="font-semibold text-red-700">Waktu Ditolak:</p>
                        <p id="detailWaktuDitolak" class="text-red-600">-</p>
                    </div>
                    <div>
                        <p class="font-semibold text-red-700">Ditolak oleh:</p>
                        <p id="detailDitolakOleh" class="text-red-600">-</p>
                    </div>
                </div>
            </div>

            <!-- Additional Info for Completed Reports -->
            <div id="completedInfo" class="hidden mt-4 p-4 bg-green-50 rounded-lg">
                <h3 class="text-base font-semibold text-green-800 mb-2">Informasi Penyelesaian</h3>
                <div class="space-y-2">
                    <div>
                        <p class="font-semibold text-green-700">Diselesaikan oleh:</p>
                        <p id="detailDiselesaikanOleh" class="text-green-600">-</p>
                    </div>
                    <div>
                        <p class="font-semibold text-green-700">Waktu Selesai:</p>
                        <p id="detailWaktuSelesai" class="text-green-600">-</p>
                    </div>
                    <div>
                        <p class="font-semibold text-green-700">Bukti Penyelesaian:</p>
                        <div id="detailBuktiContainer" class="mt-2">
                            <img id="detailBukti"
                                class="w-full rounded-lg border hidden object-cover max-h-72" />
                        </div>
                        <p id="noBuktiMessage" class="text-gray-500 italic mt-2 hidden">Tidak ada bukti</p>
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
        @if(session('user.role') === 'admin' || session('user.role') === 'super_admin')
        <div id="detailActions" class="hidden p-5 border-t border-gray-200">
            <div class="grid grid-cols-2 gap-3" id="actionButtonsContainer"></div>
        </div>
        @endif
    </div>
</div>