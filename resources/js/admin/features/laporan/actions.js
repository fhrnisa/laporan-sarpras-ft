import { showConfirm, initConfirmModal } from "../../utils/confirm.js";
import { showToast } from "../../utils/toast.js";

// Inisialisasi modal konfirmasi sekali saja
initConfirmModal();

/**
 * Helper untuk mengambil CSRF Token
 */
const getCsrfToken = () => document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

/**
 * Helper untuk menangani Fetch Request
 */
const sendRequest = async (url, payload) => {
    const csrfToken = getCsrfToken();
    if (!csrfToken) {
        showToast('Token CSRF tidak ditemukan', 'error');
        return null;
    }

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(payload)
    });

    return await response.json();
};

/**
 * Mengarsipkan Laporan (Bulk/Single)
 */
export const archiveReports = async (e) => {
    const routeArchive = e.currentTarget.dataset.url;
    const selectedIds = Array.from(document.querySelectorAll('.report-checkbox:checked')).map(cb => cb.value);

    if (selectedIds.length === 0) {
        showToast('Pilih laporan yang akan diarsipkan', 'error');
        return;
    }

    const confirmed = await showConfirm(`Arsipkan ${selectedIds.length} laporan?`, 'archive');
    if (!confirmed) return;

    try {
        const data = await sendRequest(routeArchive, { ids: selectedIds });
        if (data?.success) {
            showToast(data.message || 'Laporan berhasil diarsipkan', 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data?.message || 'Gagal mengarsipkan laporan', 'error');
        }
    } catch (err) {
        console.error('Archive error:', err);
        showToast('Terjadi kesalahan sistem', 'error');
    }
};

/**
 * Menghapus Laporan Permanen
 */
export const deletePermanent = async (e) => {
    const routeDelete = e.currentTarget.dataset.url;
    const selectedIds = Array.from(document.querySelectorAll('.report-checkbox:checked')).map(cb => cb.value);

    if (selectedIds.length === 0) {
        showToast('Pilih laporan yang akan dihapus permanen', 'error');
        return;
    }

    const confirmed = await showConfirm(`Hapus permanen ${selectedIds.length} laporan? Tindakan ini tidak dapat dibatalkan.`, 'delete');
    if (!confirmed) return;

    try {
        const data = await sendRequest(routeDelete, { ids: selectedIds });
        if (data?.success) {
            showToast(data.message || 'Laporan berhasil dihapus', 'success');
            setTimeout(() => location.reload(), 1500);
        }
    } catch (err) {
        console.error('Delete error:', err);
        showToast('Terjadi kesalahan sistem', 'error');
    }
};

/**
 * Update Status Laporan Tunggal (Dari Detail Modal)
 */
export const updateStatus = async (e) => {
    // Jika e bukan event tapi langsung string status (dari onclick manual)
    const isEvent = e && e.currentTarget;
    const routeUpdate = isEvent ? e.currentTarget.dataset.url : document.getElementById('setorProsesBtn')?.dataset.url;
    const newStatus = isEvent ? e.currentTarget.dataset.status : e;
    const reportId = isEvent ? e.currentTarget.dataset.id : window.currentReportId;

    if (!reportId) {
        showToast('ID laporan tidak ditemukan', 'error');
        return;
    }

    const confirmed = await showConfirm(`Ubah status laporan ini menjadi "${newStatus}"?`);
    if (!confirmed) return;

    try {
        const data = await sendRequest(routeUpdate, { id: reportId, status: newStatus });
        if (data?.success) {
            showToast(data.message || 'Status berhasil diupdate', 'success');
            setTimeout(() => location.reload(), 1500);
        }
    } catch (err) {
        console.error('Update status error:', err);
        showToast('Terjadi kesalahan sistem', 'error');
    }
};

/**
 * Update Status Masal (Bulk Update)
 */
export const updateBulkStatus = async (e) => {
    const routeUpdate = e.currentTarget?.dataset.url;
    const newStatus = e.currentTarget?.dataset.status;
    const selectedIds = Array.from(document.querySelectorAll('.report-checkbox:checked')).map(cb => cb.value);

    if (selectedIds.length === 0) {
        showToast('Pilih laporan terlebih dahulu', 'error');
        return;
    }

    const confirmed = await showConfirm(`Ubah status ${selectedIds.length} laporan menjadi "${newStatus}"?`);
    if (!confirmed) return;

    try {
        const data = await sendRequest(routeUpdate, { ids: selectedIds, status: newStatus });
        if (data?.success) {
            showToast(data.message || 'Status masal berhasil diupdate', 'success');
            setTimeout(() => location.reload(), 1500);
        }
    } catch (err) {
        console.error('Bulk update error:', err);
        showToast('Terjadi kesalahan sistem', 'error');
    }
};

window.archiveReports = archiveReports;
window.deletePermanent = deletePermanent;
window.updateStatus = updateStatus;
window.updateBulkStatus = updateBulkStatus;