<!-- MODAL TOLAK LAPORAN -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black/50 z-50 items-center justify-center p-4">
    <div class="flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-[#002C55] mb-4">Tolak Laporan</h3>
                <p class="text-gray-600 mb-4">Silakan berikan alasan penolakan:</p>
                <textarea id="rejectReason"
                         rows="4"
                         class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#002C55]"
                         placeholder="Masukkan alasan penolakan..."></textarea>
                <div class="flex gap-3 mt-6">
                    <button onclick="closeRejectModal()"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <button onclick="submitReject()"
                            class="flex-1 px-4 py-2 bg-[#ED3237] text-white rounded-lg hover:bg-red-600">
                        Tolak Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>