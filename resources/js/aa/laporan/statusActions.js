import { state } from "./state";

export function updateStatus(status) {
        if (!state.currentReportId) {
            showToast('Tidak ada laporan yang dipilih', 'error');
            return;
        }

        switch(status) {
            case 'diproses':
                openProcessModal();
                break;
            case 'ditolak':
                openRejectModal();
                break;
            case 'terselesaikan':
                openCompleteModal();
                break;
            default:
                sendStatusUpdate(status);
        }
    }

export async function sendStatusUpdate(status, additionalData = null) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                showToast('Token CSRF tidak ditemukan', 'error');
                return;
            }

            const data = { status };
            if (additionalData) {
                Object.assign(data, additionalData);
            }

            const response = await fetch(`http://localhost:8001/api/admin/laporan/${state.currentReportId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                showToast(`Status berhasil diubah menjadi ${getStatusText(status)}`);
                closeAllModals();
                setTimeout(() => location.reload(), 1000);
            } else {
                showToast(result.message || 'Gagal mengubah status', 'error');
            }
        } catch (error) {
            showToast('Terjadi kesalahan: ' + error.message, 'error');
        }
    }

export function submitProcess() {
        sendStatusUpdate('diproses');
    }

export function submitReject() {
        const reason = document.getElementById('rejectReason').value.trim();
        if (!reason) {
            showToast('Harap isi alasan penolakan', 'error');
            return;
        }
        sendStatusUpdate('ditolak', { alasan_ditolak: reason });
    }

export async function submitComplete() {
        const fileInput = document.getElementById('buktiFile');
        const file = fileInput.files[0];

        if (!file) {
            showToast('Harap pilih file bukti penyelesaian', 'error');
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            showToast('Token CSRF tidak ditemukan', 'error');
            return;
        }

        const formData = new FormData();
        formData.append('bukti_penyelesaian', file);
        formData.append('status', 'terselesaikan');
        formData.append('_token', csrfToken);

        try {
            const response = await fetch(`http://localhost:8001/api/admin/laporan/${state.currentReportId}/status`, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (result.success) {
                showToast('Laporan berhasil diselesaikan');
                closeAllModals();
                setTimeout(() => location.reload(), 1000);
            } else {
                showToast(result.message || 'Gagal menyelesaikan laporan', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Terjadi kesalahan: ' + error.message, 'error');
        }
    }
