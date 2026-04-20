// actions.js
import { api } from '../../utils/api.js';
import { showToast } from '../../utils/toast.js';
import { showConfirm } from '../../utils/confirm.js';

export const restoreReports = async () => {
    console.log("Fungsi restoreReports terpanggil!");

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
        // Pastikan URL benar - cek di route list Anda
        const response = await fetch('http://localhost:8001/api/admin/arsip/restore', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                // Tambahkan token jika pakai authentication
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            },
            body: JSON.stringify({ ids: selectedIds })
        });

        // Debug: Log response status
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            const errorText = await response.text();
            console.error('Error response:', errorText);
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }

        const data = await response.json();
        console.log('Response data:', data);

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

export const deletePermanent = async () => {
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
        const response = await fetch('http://localhost:8001/api/admin/arsip/destroy', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            },
            body: JSON.stringify({ ids: selectedIds })
        });

        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }

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