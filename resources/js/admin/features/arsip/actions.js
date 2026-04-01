import { showToast } from '../../utils/toast.js';
import { showConfirm } from '../../utils/confirm.js';

export async function restoreReports() {
    const selectedIds = Array.from(
        document.querySelectorAll('.report-checkbox:checked')
    ).map(cb => cb.value);

    if (selectedIds.length === 0) {
        showToast('Pilih laporan yang akan dipulihkan', 'error');
        return;
    }

    const confirmed = await showConfirm(
        `Pulihkan ${selectedIds.length} laporan dari arsip?`,
        'restore'
    );

    if (!confirmed) {
        showToast('Pemulihan dibatalkan', 'info');
        return;
    }

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        
        const response = await fetch('/admin/api/arsip/restore', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ ids: selectedIds })
        });

        const data = await response.json();

        if (data.success) {
            showToast(data.message || 'Laporan berhasil dipulihkan', 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.message || 'Gagal memulihkan laporan', 'error');
        }
    } catch (error) {
        console.error('Restore error:', error);
        showToast('Terjadi kesalahan: ' + error.message, 'error');
    }
}

export async function deletePermanent() {
    const selectedIds = Array.from(
        document.querySelectorAll('.report-checkbox:checked')
    ).map(cb => cb.value);

    if (selectedIds.length === 0) {
        showToast('Pilih laporan yang akan dihapus permanen', 'error');
        return;
    }

    const confirmed = await showConfirm(
        `Hapus permanen ${selectedIds.length} laporan? Tindakan ini tidak dapat dibatalkan.`,
        'delete'
    );

    if (!confirmed) {
        showToast('Penghapusan dibatalkan', 'info');
        return;
    }

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        
        const response = await fetch('/admin/api/arsip/destroy', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ ids: selectedIds })
        });

        const data = await response.json();

        if (data.success) {
            showToast(data.message || 'Laporan berhasil dihapus permanen', 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.message || 'Gagal menghapus laporan', 'error');
        }
    } catch (error) {
        console.error('Delete error:', error);
        showToast('Terjadi kesalahan: ' + error.message, 'error');
    }
}