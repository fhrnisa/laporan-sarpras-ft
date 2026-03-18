
export function closeDetailModal() {
        const overlay = document.getElementById("detailOverlay");
        const modal = document.getElementById("detailModal");

        if (overlay) overlay.classList.add("hidden");
        if (modal) modal.classList.add("hidden");
    }

export function openDetailModal() {
        const overlay = document.getElementById("detailOverlay");
        const modal = document.getElementById("detailModal");

        if (!overlay || !modal) {
            console.error("Element not found");
            return;
        }

        overlay.classList.remove("hidden");
        modal.classList.remove("hidden");
    }

    // Reject Modal
export function openRejectModal() {
        document.getElementById('rejectModal').classList.remove('hidden');
        document.getElementById('rejectReason').value = '';
    }

export function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }

    // Complete Modal
export function openCompleteModal() {
        document.getElementById('completeModal').classList.remove('hidden');
        document.getElementById('buktiFile').value = '';
        document.getElementById('uploadArea').classList.remove('hidden');
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('submitCompleteBtn').disabled = true;
    }

export function closeCompleteModal() {
        document.getElementById('completeModal').classList.add('hidden');
        document.getElementById('buktiFile').value = '';
    }

// Process Modal
export function openProcessModal() {
        document.getElementById('processModal').classList.remove('hidden');
    }

export function closeProcessModal() {
        document.getElementById('processModal').classList.add('hidden');
    }

export function closeAllModals() {
        closeDetailModal();
        closeRejectModal();
        closeCompleteModal();
        closeProcessModal();
    }