import { initFilters } from '../modules/filter.js';
import { initKelolaMode } from '../modules/kelolaMode.js';
import { initArsipPage as initArsipFeatures } from '../features/arsip/index.js'; // Kita beri alias agar tidak bentrok namanya
import { restoreReports, deletePermanent } from '../features/arsip/actions.js';

export function initArsipPage() {
    // 1. Inisialisasi filter
    initFilters();

    // 2. Inisialisasi mode kelola (UI checkbox)
    initKelolaMode({
        onRestore: restoreReports,
        onDelete: deletePermanent
    });
    
    console.log("ARSIP PAGE INIT JALAN");
    // 3. Daftarkan event listener untuk tombol aksi
    const hapusPermanenBtn = document.getElementById("hapusPermanenBtn");
    
    if (hapusPermanenBtn) {
        hapusPermanenBtn.addEventListener('click', deletePermanent);
    }
    
    // 4. Inisialisasi fitur arsip lainnya (modal detail)
    initArsipFeatures();
}

