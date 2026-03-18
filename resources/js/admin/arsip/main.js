import { initFilters } from './filters.js';
import { initConfirmModal, showConfirm } from './confirm.js';
import { showToast } from './toast.js';
import { loadReportDetail, displayReportDetail } from './detailLaporan.js';
import { closeDetailModal, openDetailModal, openRejectModal, closeRejectModal,openCompleteModal, closeCompleteModal, openProcessModal,closeProcessModal } from './modals.js';
import { previewImage, removeImage } from './utils.js';

// Bungkus semua inisialisasi elemen dan event listener di dalam DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Inisialisasi Modal Konfirmasi (WAJIB di sini)
    initConfirmModal();

    // === ELEMEN UTAMA ===
    const kelolaBtn = document.getElementById("kelolaBtn");
    const batalBtn = document.getElementById("batalBtn");
    const arsipBtn = document.getElementById("arsipBtn");
    const hapusPermanenBtn = document.getElementById("hapusPermanenBtn");
    const manageOptions = document.getElementById("manageOptions");
    const actionCells = document.querySelectorAll(".action-cell");
    const checkboxCells = document.querySelectorAll(".checkbox-cell");
    const reportCheckboxes = document.querySelectorAll(".report-checkbox");
    const selectAll = document.getElementById("select-all");
    const overlay = document.getElementById("detailOverlay");
    const closeBtn = document.getElementById("closeDetail");

    // === EVENT LISTENERS ===
    
    if (closeBtn) closeBtn.addEventListener("click", closeDetailModal);

    if (overlay) {
        overlay.addEventListener("click", (e) => {
            if (e.target === overlay) closeDetailModal();
        });
    }

    if (kelolaBtn) {
        kelolaBtn.addEventListener("click", () => {
            kelolaBtn.classList.add("hidden");
            if (manageOptions) manageOptions.classList.remove("hidden");
            actionCells.forEach(cell => cell.classList.add("hidden"));
            checkboxCells.forEach(cell => cell.classList.remove("hidden"));
        });
    }

    if (batalBtn) {
        batalBtn.addEventListener("click", () => {
            if (kelolaBtn) kelolaBtn.classList.remove("hidden");
            if (manageOptions) manageOptions.classList.add("hidden");
            checkboxCells.forEach(cell => cell.classList.add("hidden"));
            actionCells.forEach(cell => cell.classList.remove("hidden"));
            reportCheckboxes.forEach(ch => ch.checked = false);
            if (selectAll) selectAll.checked = false;
        });
    }

    if (selectAll) {
        selectAll.addEventListener("change", function() {
            // Re-select checkboxes in case the DOM updated
            const currentCheckboxes = document.querySelectorAll(".report-checkbox");
            currentCheckboxes.forEach(ch => ch.checked = selectAll.checked);
        });
    }

    // Event Listeners untuk tombol arsip dan hapus
    if (arsipBtn) arsipBtn.addEventListener('click', archiveReports);
    if (hapusPermanenBtn) hapusPermanenBtn.addEventListener('click', deletePermanent);
});

// === EXPORT GLOBAL (Keep this outside DOMContentLoaded) ===
window.updateStatus = updateStatus;
window.closeDetailModal = closeDetailModal;
window.closeRejectModal = closeRejectModal;
window.closeCompleteModal = closeCompleteModal;
window.closeProcessModal = closeProcessModal;
window.previewImage = previewImage;
window.removeImage = removeImage;
window.submitReject = submitReject;
window.submitComplete = submitComplete;
window.submitProcess = submitProcess;
window.showToast = showToast;