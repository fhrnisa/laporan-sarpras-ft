<div id="adminModal" class="hidden fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 backdrop-blur-sm transition-all duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg flex flex-col overflow-hidden transform transition-all">
        
        <div class="flex justify-between items-center p-5 border-b border-gray-100 bg-gray-50/50">
            <h2 id="modalTitle" class="text-lg font-bold text-[#002C55]">
                Tambah <span class="text-[#F36A00]">Admin Baru</span>
            </h2>
            <button type="button" id="closeModal" class="text-gray-400 hover:text-red-500 transition-colors">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        
        <div class="p-6">
            <form id="adminForm" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="adminId">

                <div>
                    <label class="block text-sm font-semibold text-[#002D56] mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="adminName" placeholder="Masukkan nama" 
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#002D56]/10 focus:border-[#002D56] outline-none transition-all" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-[#002D56] mb-1">Email</label>
                        <input type="email" name="email" id="adminEmail" placeholder="email@fakultas.com" 
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#002D56]/10 focus:border-[#002D56] outline-none transition-all" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-[#002D56] mb-1">WhatsApp</label>
                        <div class="flex rounded-lg border border-gray-300 overflow-hidden focus-within:ring-2 focus-within:ring-[#002D56]/10 focus-within:border-[#002D56]">
                            <span class="bg-gray-50 px-3 py-2.5 text-gray-500 text-sm border-r border-gray-300">+62</span>
                            <input type="text" name="nomor_telepon" id="adminPhone" placeholder="8123..." 
                                class="flex-1 px-4 py-2.5 text-sm outline-none" required>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[#002D56] mb-1">Role</label>
                    <select name="role" id="adminRole" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#002D56]/10 focus:border-[#002D56] outline-none transition-all" required>
                        <option value="admin">Admin</option>
                        <option value="viewer">Viewer</option>
                        <option value="super_admin">Super Admin</option>
                    </select>
                </div>

                <div id="passwordWrapper">
                    <label class="block text-sm font-semibold text-[#002D56] mb-1">Password</label>
                    <input type="password" name="password" id="adminPassword" placeholder="••••••••" 
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#002D56]/10 focus:border-[#002D56] outline-none transition-all">
                    <p id="passwordNote" class="text-[10px] text-gray-400 mt-1 italic hidden">*Kosongkan jika tidak ingin mengubah password</p>
                </div>
            </form>
        </div>

        <div class="p-5 border-t border-gray-100 bg-gray-50 flex justify-between items-center">
            <div>
                <button type="button" id="deleteAdminBtn" class="hidden px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Admin
                </button>
            </div>

            <div class="flex gap-3">
                <button type="button" id="cancelAdminBtn" class="px-4 py-2 text-sm font-medium text-gray-600 hover:underline">
                    Batal
                </button>
                <button type="submit" form="adminForm" id="submitAdminBtn" class="px-6 py-2 bg-[#002C55] text-white text-sm font-medium rounded-lg hover:bg-[#001f3d] shadow-md transition-all">
                    Simpan Data
                </button>
            </div>
        </div>
    </div>
</div>