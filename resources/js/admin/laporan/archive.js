import { showConfirm } from "./confirm.js";
import { showToast } from "./toast.js";
import { initConfirmModal } from "./confirm.js";

initConfirmModal();

export async function archiveReports(e) {
        const routeArchive = e.currentTarget.dataset.url;
        
        console.log('Archive function called');
        console.log('Target URL:', routeArchive);
        
        const selectedIds = Array.from(
            document.querySelectorAll('.report-checkbox:checked')
        ).map(cb => cb.value);

        console.log('Selected IDs:', selectedIds);

        if (selectedIds.length === 0) {
            showToast('Pilih laporan yang akan diarsipkan', 'error');
            return;
        }

        const confirmed = await showConfirm(
            `Arsipkan ${selectedIds.length} laporan?`,
            'archive'
        );
        
        console.log('User confirmed:', confirmed);
        
        if (!confirmed) {
            showToast('Arsip dibatalkan', 'info');
            return;
        }

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            console.log('CSRF Token:', csrfToken);
            
            if (!csrfToken) {
                showToast('Token CSRF tidak ditemukan', 'error');
                return;
            }

            const response = await fetch(routeArchive, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ ids: selectedIds })
            });

            console.log('Response status:', response.status);
            const data = await response.json();
            console.log('Response data:', data);

            if (data.success) {
                showToast(data.message || 'Laporan berhasil diarsipkan', 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showToast(data.message || 'Gagal mengarsipkan laporan', 'error');
            }
        } catch (err) {
            console.error('Archive error:', err);
            showToast('Terjadi kesalahan sistem', 'error');
        }
    }

export async function deletePermanent(e) {
        const routeDelete = e.currentTarget.dataset.url;
        console.log('Delete function called');
        
        const selectedIds = Array.from(
            document.querySelectorAll('.report-checkbox:checked')
        ).map(cb => cb.value);

        console.log('Selected IDs:', selectedIds);

        if (selectedIds.length === 0) {
            showToast('Pilih laporan yang akan dihapus permanen', 'error');
            return;
        }

        const confirmed = await showConfirm(
            `Hapus permanen ${selectedIds.length} laporan? Tindakan ini tidak dapat dibatalkan.`,
            'delete'
        );
        
        console.log('User confirmed:', confirmed);
        
        if (!confirmed) {
            showToast('Hapus permanen dibatalkan', 'info');
            return;
        }

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            console.log('CSRF Token:', csrfToken);
            
            if (!csrfToken) {
                showToast('Token CSRF tidak ditemukan', 'error');
                return;
            }

            const response = await fetch(routeDelete, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ ids: selectedIds })
            });

            console.log('Response status:', response.status);
            const data = await response.json();
            console.log('Response data:', data);

            if (data.success) {
                showToast(data.message || 'Laporan berhasil dihapus permanen', 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showToast(data.message || 'Gagal menghapus laporan', 'error');
            }
        } catch (err) {
            console.error('Delete error:', err);
            showToast('Terjadi kesalahan sistem', 'error');
        }
    }