import { api } from '../utils/api.js';
import { showToast } from '../utils/toast.js';
import { initConfirmModal } from '../utils/confirm.js';
import { createAdmin, updateAdmin, deleteAdmin, updateStatus} from '../features/kontrol-admin/actions.js'; 
import { initAdminModal } from '../features/kontrol-admin/detailModal.js';
import { KelolaMode } from '../features/kontrol-admin/kelolaMode.js';
import { TableActions } from '../features/kontrol-admin/tableAction.js';
import { AdminFilter } from '../features/kontrol-admin/filter.js';

export function initAdminPage(baseUrl, csrfToken) {
    // 1. Initialize API
    api.init(`${baseUrl}/admin`, csrfToken);
    
    // 2. Initialize Utilities
   initConfirmModal();
    
    // 3. Initialize Admin Actions (Logika kirim data)
    const adminActions = {
        createAdmin: createAdmin,
        updateAdmin: updateAdmin,
        deleteAdmin: deleteAdmin,
        updateStatus: updateStatus
    };
    
    // 4. Initialize detail modal (UI Modal)
    const { openModal } = initAdminModal(adminActions);
    
    // 5. Initialize Fitur Lainnya
    const adminFilter = new AdminFilter();
    const kelolaMode = new KelolaMode(openModal);

    // 6. Event Listener Tombol Tambah Admin
    const addBtn = document.getElementById('addadminBtn');
    if (addBtn) {
        addBtn.onclick = (e) => {
            e.preventDefault();
            openModal(); // Buka modal mode tambah
        };
    } else {
        console.warn("Tombol #addadminBtn tidak ditemukan.");
    }
    
    // Return instances agar bisa diakses jika dibutuhkan secara global (debug)
    return { adminActions, openModal, adminFilter };
}