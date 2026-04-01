import { showToast } from '../../utils/toast.js';
import { showConfirm } from '../../utils/confirm.js';
import { loadReportDetail, displayReportDetail } from './detailModal.js';
import { updateStatus, archiveReports, updateBulkStatus } from './actions.js';

// Variabel lokal (scoping dalam modul, lebih aman dari window)
let currentSelectedIds = [];

/**
 * Export Utama untuk Halaman Laporan
 */
export const initLaporanPage = () => {
    console.log('Halaman Laporan siap (Arrow Function)');
    initActionButtons();
    initDetailButtons();
    initBulkActions();

    const arsipBtn = document.getElementById("arsipBtn");
    const hapusBtn = document.getElementById("hapusPermanenBtn");
    const aksiButtons = document.querySelectorAll('.aksiBtn');
    const overlay = document.getElementById('detailOverlay');

    if (arsipBtn) {
        arsipBtn.addEventListener("click", (e) => {
            console.log("Tombol Arsip diklik");
            archiveReports(e);
        });
    }

    if (hapusBtn) {
        hapusBtn.addEventListener("click", (e) => {
            console.log("Tombol Hapus diklik");
            deletePermanent(e);
        });
    }

    aksiButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const reportId = e.currentTarget.dataset.id;
            
            if (reportId) {
                console.log("Membuka detail untuk ID:", reportId);
                
                // 2. Panggil fungsi loadReportDetail dari detailModal.js
                loadReportDetail(reportId);

                // 3. Tampilkan Modal secara manual (Jika menggunakan Tailwind/Flowbite)
                // Pastikan ID modal Anda benar, misal: 'detailLaporanModal'
                const modal = document.getElementById('detailLaporanModal');
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex'); // Sesuaikan dengan kelas display modal Anda
                }
            }

            // 3. Klik di luar modal (area hitam/overlay) untuk menutup
            if (overlay) {
                // CARA AGRESIF: Hapus hidden dan paksa display block
                overlay.classList.remove('hidden');
                overlay.style.display = 'block'; 
                document.body.style.overflow = 'hidden';
                
                // Baru panggil fungsi isi data
                loadReportDetail(reportId);
            } else {
                console.error("Elemen #detailOverlay tidak ditemukan di DOM!");
            }
        });
    });

    const closeBtn = document.getElementById('closeDetail');
    if (closeBtn) {
        closeBtn.onclick = () => {
            overlay.classList.add('hidden');
            overlay.style.display = 'none';
            document.body.style.overflow = 'auto';
        };
    }
};

window.closeDetailModal = () => {
    const overlay = document.getElementById('detailOverlay');
    if (overlay) {
        overlay.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
};

/**
 * Mengambil ID yang dipilih dari checkbox
*/
const getSelectedIds = () => {
    return Array.from(
        document.querySelectorAll('.report-checkbox:checked')
    ).map(cb => cb.value);
};

/**
 * Buka modal untuk memilih status
 */
const openStatusModal = (ids) => {
    const modal = document.getElementById('statusModal');
    if (modal) {
        modal.classList.remove('hidden');
        
        // Gunakan variabel lokal atau dataset untuk passing ID
        const statusButtons = document.querySelectorAll('.status-option');
        statusButtons.forEach(btn => {
            btn.onclick = async () => { // Menggunakan onclick agar listener tidak menumpuk saat modal buka-tutup
                const status = btn.dataset.status;
                await updateBulkStatus(ids, status);
                modal.classList.add('hidden');
            };
        });
    }
};

/**
 * Inisialisasi tombol aksi
 */
const initActionButtons = () => {
    const setorProsesBtn = document.getElementById('setorProsesBtn');
    if (setorProsesBtn) {
        setorProsesBtn.addEventListener('click', () => updateStatus('diproses'));
    }

    const selesaiBtn = document.getElementById('selesaiBtn');
    if (selesaiBtn) {
        selesaiBtn.addEventListener('click', () => updateStatus('terselesaikan'));
    }

    const arsipkanBtn = document.getElementById('arsipkanBtn');
    if (arsipkanBtn) {
        arsipkanBtn.addEventListener('click', async () => {
            // Asumsi: ID disimpan di dataset atau variabel modul
            if (!window.currentReportId) return; 
            
            const confirmed = await showConfirm('Arsipkan laporan ini?');
            if (confirmed) {
                await archiveReports([window.currentReportId]);
            }
        });
    }
};

/**
 * Inisialisasi tombol detail
 */
const initDetailButtons = () => {
    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const id = btn.dataset.id;
            if (id) {
                displayReportDetail();
                loadReportDetail(id);
            }
        });
    });
};

/**
 * Inisialisasi aksi massal
 */
const initBulkActions = () => {
    const arsipMassalBtn = document.getElementById('arsipMassalBtn');
    if (arsipMassalBtn) {
        arsipMassalBtn.addEventListener('click', async () => {
            const selectedIds = getSelectedIds();
            if (selectedIds.length === 0) {
                showToast('Pilih laporan yang akan diarsipkan', 'error');
                return;
            }
            
            const confirmed = await showConfirm(`Arsipkan ${selectedIds.length} laporan?`);
            if (confirmed) {
                await archiveReports(selectedIds);
            }
        });
    }

    const updateStatusBtn = document.getElementById('updateStatusBtn');
    if (updateStatusBtn) {
        updateStatusBtn.addEventListener('click', () => {
            const selectedIds = getSelectedIds();
            if (selectedIds.length === 0) {
                showToast('Pilih laporan yang akan diupdate', 'error');
                return;
            }
            openStatusModal(selectedIds);
        });
    }
};
