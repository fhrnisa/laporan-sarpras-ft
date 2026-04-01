import { showToast } from '../../utils/toast.js';
import { TOAST_STYLES } from '../../config/constants.js';

let currentReportId = null;

// === FUNGSI LOAD DETAIL ===
export async function loadReportDetail(id) {
    try {
        currentReportId = id;
        
        const detailLoading = document.getElementById('detailLoading');
        const detailContent = document.getElementById('detailContent');
        const detailError = document.getElementById('detailError');

        if (detailLoading) detailLoading.classList.remove('hidden');
        if (detailContent) detailContent.classList.add('hidden');
        if (detailError) detailError.classList.add('hidden');

        const response = await fetch(`/admin/api/arsip/${id}`);
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}`);
        }
        
        const data = await response.json();

        if (data.success) {
            displayReportDetail(data.data);
        } else {
            throw new Error(data.message || 'Gagal memuat detail');
        }
    } catch (error) {
        console.error('Error loading detail:', error);
        
        const detailLoading = document.getElementById('detailLoading');
        const detailError = document.getElementById('detailError');
        const errorMessage = document.getElementById('errorMessage');

        if (detailLoading) detailLoading.classList.add('hidden');
        if (detailError) detailError.classList.remove('hidden');
        if (errorMessage) errorMessage.textContent = error.message;
    }
}

// === FUNGSI DISPLAY DETAIL ===
export function displayReportDetail(report) {
    const detailLoading = document.getElementById('detailLoading');
    const detailContent = document.getElementById('detailContent');

    if (detailLoading) detailLoading.classList.add('hidden');
    if (detailContent) detailContent.classList.remove('hidden');

    // Set basic info
    const detailTitle = document.getElementById('detailTitle');
    const detailDate = document.getElementById('detailDate');
    const detailNama = document.getElementById('detailNama');
    const detailEmail = document.getElementById('detailEmail');
    const detailTelp = document.getElementById('detailTelp');
    const detailLokasi = document.getElementById('detailLokasi');
    const detailDeskripsi = document.getElementById('detailDeskripsi');

    if (detailTitle) detailTitle.textContent = `Laporan #${report.id}`;
    if (detailDate) {
        detailDate.textContent = report.created_at ? 
            new Date(report.created_at).toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            }) : '-';
    }
    if (detailNama) detailNama.textContent = report.nama_pengusul || '-';
    if (detailEmail) detailEmail.textContent = report.email || '-';
    if (detailTelp) detailTelp.textContent = report.nomor_telepon || '-';
    if (detailLokasi) detailLokasi.textContent = report.lokasi_kerusakan || '-';
    if (detailDeskripsi) detailDeskripsi.textContent = report.deskripsi_kerusakan || '-';

    // Set status
    const statusElement = document.getElementById('detailStatus');
    const status = report.status_laporan || 'menunggu';
    const config = TOAST_STYLES[status] || TOAST_STYLES.menunggu;

    if (statusElement) {
        statusElement.textContent = config.text;
        statusElement.className = `inline-flex px-3 py-1 text-sm font-semibold rounded-md ${config.bg} ${config.textColor}`;
    }

    // Set foto
    const fotoElement = document.getElementById('detailFoto');
    const noFotoMessage = document.getElementById('noFotoMessage');

    if (fotoElement && noFotoMessage) {
        if (report.foto_kerusakan && report.foto_kerusakan !== 'default.jpg') {
            fotoElement.src = `/storage/${report.foto_kerusakan}`;
            fotoElement.classList.remove('hidden');
            noFotoMessage.classList.add('hidden');
        } else {
            fotoElement.classList.add('hidden');
            noFotoMessage.classList.remove('hidden');
        }
    }

    // Sembunyikan tombol aksi di arsip (karena tidak perlu)
    const detailActions = document.getElementById('detailActions');
    if (detailActions) {
        detailActions.classList.add('hidden');
    }

    // Tampilkan info rejected jika ada
    const rejectedInfo = document.getElementById('rejectedInfo');
    if (rejectedInfo && status === 'ditolak') {
        rejectedInfo.classList.remove('hidden');
        const alasan = document.getElementById('detailAlasan');
        const waktu = document.getElementById('detailWaktuDitolak');
        const admin = document.getElementById('detailAdmin');
        
        if (alasan) alasan.textContent = report.alasan_ditolak || '-';
        if (waktu) waktu.textContent = report.ditolak_pada ? 
            new Date(report.ditolak_pada).toLocaleString('id-ID') : '-';
        if (admin) admin.textContent = report.ditolak_oleh || '-';
    }
}

// === FUNGSI MODAL ===
export function openDetailModal() {
    const overlay = document.getElementById('detailOverlay');
    if (overlay) overlay.classList.remove('hidden');
}

export function closeDetailModal() {
    const overlay = document.getElementById('detailOverlay');
    if (overlay) overlay.classList.add('hidden');
    currentReportId = null;
}

// === UPDATE STATUS (TIDAK DIGUNAKAN DI ARSIP) ===
export function updateStatus(status) {
    showToast('Data arsip tidak dapat diubah statusnya', 'error');
    closeDetailModal();
}