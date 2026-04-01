// resources/js/features/arsip/index.js
import { loadReportDetail, openDetailModal, closeDetailModal } from './detailModal.js';

export function initArsipPage() {
    // Event listener untuk tombol detail
    document.querySelectorAll(".aksiBtn").forEach(btn => {
        btn.addEventListener("click", function() {
            const id = this.dataset.id;
            openDetailModal();
            loadReportDetail(id);
        });
    });

    // Close modal
    const closeBtn = document.getElementById("closeDetail");
    const overlay = document.getElementById("detailOverlay");
    
    if (closeBtn) {
        closeBtn.addEventListener("click", closeDetailModal);
    }
    
    if (overlay) {
        overlay.addEventListener("click", (e) => {
            if (e.target === overlay) closeDetailModal();
        });
    }
}