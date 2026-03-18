<!-- MODAL SELESAIKAN LAPORAN -->
<div id="completeModal" class="hidden fixed inset-0 bg-black/50 z-50 p-4">
    <div class="flex">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-[#002C55] mb-4">Selesaikan Laporan</h3>
                <p class="text-gray-600 mb-4">Upload bukti foto penyelesaian:</p>
    
                <!-- File Upload dengan Preview -->
                <div class="mb-4">
                    <input type="file"
                           id="buktiFile"
                           accept="image/*"
                           class="hidden"
                           onchange="previewImage(this)">
    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 cursor-pointer"
                         onclick="document.getElementById('buktiFile').click()">
                        <div id="uploadArea" class="space-y-2">
                            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="text-sm text-gray-600">Klik untuk upload foto</p>
                            <p class="text-xs text-gray-500">Format: JPG, PNG (max 5MB)</p>
                        </div>
    
                        <!-- Preview Image -->
                        <div id="imagePreview" class="hidden mt-4">
                            <img id="previewImage"
                                 class="w-full h-48 object-cover rounded-lg border border-gray-300">
                            <button type="button"
                                    onclick="removeImage()"
                                    class="mt-2 text-sm text-red-600 hover:text-red-800">
                                Hapus foto
                            </button>
                        </div>
                    </div>
                </div>
    
                <div class="flex gap-3 mt-6">
                    <button onclick="closeCompleteModal()"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <button onclick="submitComplete()"
                            id="submitCompleteBtn"
                            class="flex-1 px-4 py-2 bg-[#002C55] text-white rounded-lg hover:bg-[#01408C] disabled:opacity-50 disabled:cursor-not-allowed">
                        Selesaikan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>