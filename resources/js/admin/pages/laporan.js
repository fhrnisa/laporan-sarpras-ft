import { initFilters } from '../modules/filter.js';
import { initKelolaMode } from '../modules/kelolaMode.js';
import { initLaporanPage as initLaporanFeature } from '../features/laporan/index.js';

export const initLaporanPage = () => {
    console.log("Memulai inisialisasi halaman laporan...");

    initKelolaMode({
        onArchive: archiveReports
    });

    // Gunakan try-catch per blok agar jika satu gagal, yang lain tetap jalan
    try {
        initLaporanFeature();
        console.log("Feature Laporan (Actions & Modal) Load");
    } catch (e) {
        console.error("Gagal load Feature Laporan:", e);
    }

    try {
        initFilters();
        console.log("Filters Load");
    } catch (e) {
        console.error("Gagal load Filters:", e);
    }
};