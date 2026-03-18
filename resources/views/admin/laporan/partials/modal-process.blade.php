<!-- MODAL DIPROSES -->
<div id="processModal" class="hidden fixed inset-0 bg-black/50 z-50 items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
        <div class="p-6">
            <h3 class="text-xl font-semibold text-[#002C55] mb-4">Set Diproses</h3>
            <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menyetujui dan memproses laporan ini?</p>

            <div class="flex gap-3">
                <button onclick="closeProcessModal()"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Batal
                </button>
                <button onclick="submitProcess()"
                        class="flex-1 px-4 py-2 bg-[#FED43E] text-[#002C55] rounded-lg hover:bg-yellow-500">
                    Ya, Set Diproses
                </button>
            </div>
        </div>
    </div>
</div>