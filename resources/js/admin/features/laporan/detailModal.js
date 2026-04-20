// Local state untuk menyimpan data laporan yang sedang aktif
const state = {
    currentReportId: null,
    currentReport: null
};

/**
 * Konfigurasi Warna dan Teks Status
 */
const STATUS_CONFIG = {
    menunggu: { text: 'Menunggu', class: 'bg-[#E1E7E9] text-[#022C55]' },
    diproses: { text: 'Diproses', class: 'bg-[#FEEF94] text-[#022C55]' },
    terselesaikan: { text: 'Terselesaikan', class: 'bg-[#A0F1B5] text-[#022C55]' },
    ditolak: { text: 'Ditolak', class: 'bg-[#FF7A7E] text-[#022C55]' }
};

/**
 * Mengupdate status laporan
 */
const updateStatus = async (newStatus, additionalData = {}) => {
    const currentReportId = state.currentReportId;
    
    if (!currentReportId) {
        console.error("Tidak ada laporan yang sedang aktif");
        showNotification('error', 'Tidak ada laporan yang sedang aktif');
        return;
    }

    // Untuk status ditolak, tampilkan modal alasan penolakan
    if (newStatus === 'ditolak') {
        showRejectionModal(currentReportId);
        return;
    }

    if (newStatus === 'terselesaikan') {
        showCompletionModal(currentReportId);
        return;
    }

    try {
        console.log('Updating status:', { currentReportId, newStatus, additionalData });
        
        const token = localStorage.getItem('token'); // Ambil token jika pakai auth

        const response = await fetch(`http://localhost:8001/api/admin/laporan/${currentReportId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`, // Sertakan token jika diperlukan
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                status: newStatus,
                ...additionalData
            })
        });

        const responseText = await response.text();
        const data = JSON.parse(responseText);

        if (response.ok && data.success) {
            await loadReportDetail(currentReportId);
            if (window.loadReports) await window.loadReports();
            
            const statusText = STATUS_CONFIG[newStatus]?.text || newStatus;
            showNotification('success', `Status berhasil diubah menjadi ${statusText}`);
        } else {
            throw new Error(data.message || 'Gagal mengupdate status');
        }
    } catch (error) {
        console.error("Error updating status:", error);
        showNotification('error', error.message);
    }
};

/**
 * Menampilkan modal alasan penolakan
 */
const showRejectionModal = (reportId) => {
    // Hapus modal yang sudah ada jika ada
    const existingModal = document.querySelector('.rejection-modal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Buat modal dialog untuk alasan penolakan
    const modal = document.createElement('div');
    modal.className = 'rejection-modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
    modal.innerHTML = `
        <div class="bg-white rounded-lg p-6 w-96 max-w-md">
            <h3 class="text-lg font-semibold mb-4">Tolak Laporan</h3>
            <p class="text-gray-600 mb-3">Masukkan alasan penolakan:</p>
            <textarea id="rejectionReason" class="w-full border rounded-lg p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" rows="4" placeholder="Alasan penolakan..."></textarea>
            <div class="flex justify-end gap-2">
                <button onclick="closeRejectionModal()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</button>
                <button onclick="submitRejection('${reportId}')" class="px-4 py-2 bg-[#ED3237] text-white rounded-lg hover:bg-red-700 transition">Tolak</button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
    
    // Auto focus ke textarea
    setTimeout(() => {
        const textarea = document.getElementById('rejectionReason');
        if (textarea) textarea.focus();
    }, 100);
};

// Fungsi untuk menutup modal
window.closeRejectionModal = () => {
    const modal = document.querySelector('.rejection-modal');
    if (modal) modal.remove();
};

/**
 * Submit penolakan dengan alasan
 */
window.submitRejection = async (reportId) => {
    const modal = document.querySelector('.rejection-modal');
    const reasonTextarea = document.getElementById('rejectionReason');
    const alasan = reasonTextarea?.value.trim();
    
    if (!alasan) {
        showNotification('error', 'Alasan penolakan harus diisi!');
        return;
    }
    
    // Tampilkan loading state
    const submitButton = modal?.querySelector('button[onclick*="submitRejection"]');
    const originalText = submitButton?.textContent;
    if (submitButton) {
        submitButton.textContent = 'Menyimpan...';
        submitButton.disabled = true;
    }
    
    try {
        console.log('Submitting rejection:', { reportId, alasan });
        
        const response = await fetch(`http://localhost:8001/api/admin/laporan/${reportId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                status: 'ditolak',
                alasan_ditolak: alasan
            })
        });
        
        console.log('Response status:', response.status);
        
        // Coba parse response
        const responseText = await response.text();
        console.log('Raw response:', responseText);
        
        let data;
        try {
            data = JSON.parse(responseText);
        } catch (e) {
            console.error('Failed to parse JSON:', e);
            throw new Error(`Server returned invalid JSON: ${responseText.substring(0, 200)}`);
        }
        
        if (response.ok && data.success) {
            modal?.remove();
            await loadReportDetail(reportId);
            if (window.loadReports) await window.loadReports();
            showNotification('success', 'Laporan berhasil ditolak');
        } else {
            throw new Error(data.message || data.error || 'Gagal menolak laporan');
        }
    } catch (error) {
        console.error("Error rejecting report:", error);
        showNotification('error', error.message || 'Gagal menolak laporan');
    } finally {
        if (submitButton) {
            submitButton.textContent = originalText;
            submitButton.disabled = false;
        }
    }
};


/**
 * Menampilkan modal bukti penyelesaian laporan
 */
const showCompletionModal = (reportId) => {
    const existingModal = document.querySelector('.completion-modal');
    if (existingModal) existingModal.remove();
    
    const modal = document.createElement('div');
    modal.className = 'completion-modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
    modal.innerHTML = `
        <div class="bg-white rounded-lg p-6 w-96 max-w-md shadow-xl">
            <h3 class="text-lg font-semibold mb-4 text-[#002C55]">Selesaikan Laporan</h3>
            <p class="text-gray-600 mb-3 text-sm">Silakan unggah foto bukti perbaikan/penyelesaian:</p>
            
            <input type="file" id="completionPhoto" accept="image/*" 
                class="w-full border rounded-lg p-2 mb-4 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            
            <div class="flex justify-end gap-2">
                <button onclick="document.querySelector('.completion-modal').remove()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition text-sm">Batal</button>
                <button onclick="window.submitCompletion('${reportId}')" class="px-4 py-2 bg-[#00EA00] text-white rounded-lg hover:bg-green-600 transition text-sm font-bold">Kirim & Selesai</button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
};

/** 
 * Submit terselesaikan dengan bukti 
*/
window.submitCompletion = async (reportId) => {
    const fileInput = document.getElementById('completionPhoto');
    const file = fileInput?.files[0];
    
    if (!file) {
        showNotification('error', 'Harap unggah foto bukti penyelesaian!');
        return;
    }

    const formData = new FormData();
    formData.append('status', 'terselesaikan');
    formData.append('foto_selesai', file); // Sesuaikan nama field dengan di Controller
    formData.append('_method', 'PUT'); // Penting: Laravel butuh ini untuk spoofing method PUT pada FormData

    try {
        const token = localStorage.getItem('token');
        const response = await fetch(`http://localhost:8001/api/admin/laporan/${reportId}/status`, {
            method: 'POST', // Gunakan POST karena FormData tidak stabil di PUT murni
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        });

        const data = await response.json();

        if (response.ok && data.success) {
            document.querySelector('.completion-modal').remove();
            await loadReportDetail(reportId);
            if (window.loadReports) await window.loadReports();
            showNotification('success', 'Laporan telah diselesaikan!');
        } else {
            throw new Error(data.message || 'Gagal mengunggah bukti');
        }
    } catch (error) {
        showNotification('error', error.message);
    }
};

/**
 * Menampilkan notifikasi
 */
const showNotification = (type, message) => {
    // Cek apakah ada elemen notifikasi di DOM
    let notificationContainer = document.getElementById('notificationContainer');
    
    if (!notificationContainer) {
        notificationContainer = document.createElement('div');
        notificationContainer.id = 'notificationContainer';
        notificationContainer.className = 'fixed top-4 right-4 z-50 space-y-2';
        document.body.appendChild(notificationContainer);
    }
    
    const notification = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
    const icon = type === 'success' ? '✓' : '✗';
    
    notification.className = `${bgColor} text-white px-4 py-3 rounded-lg shadow-lg flex items-center justify-between min-w-[300px] animate-slide-in`;
    notification.innerHTML = `
        <div class="flex items-center gap-2">
            <span class="font-bold">${icon}</span>
            <span>${message}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">×</button>
    `;
    
    notificationContainer.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 3000);
};

/**
 * Menampilkan detail laporan ke DOM
 */
export const displayReportDetail = (report) => {
    // Simpan currentReportId dan report ke state
    state.currentReportId = report.id;
    state.currentReport = report;
    
    console.log('Displaying report:', report);
    
    // 1. Deklarasikan SEMUA elemen di awal
    const detailLoading = document.getElementById('detailLoading');
    const detailContent = document.getElementById('detailContent');
    const detailActions = document.getElementById('detailActions');
    const actionButtonsContainer = document.getElementById('actionButtonsContainer');
    
    const elements = {
        detailTitle: document.getElementById('detailTitle'),
        detailKode: document.getElementById("detailKodeLaporan"),
        detailNama: document.getElementById('detailNama'),
        detailEmail: document.getElementById('detailEmail'),
        detailTelp: document.getElementById('detailTelp'),
        detailLokasi: document.getElementById('detailLokasi'),
        detailDeskripsi: document.getElementById('detailDeskripsi')
    };

    // 2. UI State
    if (detailLoading) detailLoading.classList.add('hidden');
    if (detailContent) detailContent.classList.remove('hidden');

    // 3. Logika Status
    const currentStatus = report?.status_laporan || 'menunggu';

    // 4. Render Tombol Aksi
    if (actionButtonsContainer) {
        actionButtonsContainer.innerHTML = '';
        const baseClass = "py-2 px-4 text-white rounded-lg transition font-semibold text-center";

        if (currentStatus === 'menunggu') {
            if (detailActions) detailActions.classList.remove('hidden');
            actionButtonsContainer.innerHTML = `
                <button onclick="window.updateStatusHandler('ditolak')" class="${baseClass} bg-[#ED3237] hover:bg-red-700">Tolak</button>
                <button onclick="window.updateStatusHandler('diproses')" class="${baseClass} bg-[#FED43E] hover:bg-yellow-600 text-[#002C55]">Proses</button>
            `;
        } 
        else if (currentStatus === 'diproses') {
            if (detailActions) detailActions.classList.remove('hidden');
            actionButtonsContainer.innerHTML = `
                <button onclick="window.updateStatusHandler('terselesaikan')" class="${baseClass} bg-[#00EA00] hover:bg-green-600">Selesaikan</button>
            `;
        }
        else if (currentStatus === 'terselesaikan' || currentStatus === 'ditolak') {
            if (detailActions) detailActions.classList.add('hidden');
        }
    }

    // 5. Set judul dan data dasar
    if (elements.detailTitle) elements.detailTitle.textContent = `Detail Laporan`;
    if (elements.detailKode) elements.detailKode.textContent = report.kode_laporan || "-";

    if (elements.detailNama) elements.detailNama.textContent = report.nama_pengusul || '-';
    if (elements.detailEmail) elements.detailEmail.textContent = report.email || '-';
    if (elements.detailTelp) elements.detailTelp.textContent = report.nomor_telepon || '-';
    if (elements.detailLokasi) elements.detailLokasi.textContent = report.lokasi_kerusakan || '-';
    if (elements.detailDeskripsi) elements.detailDeskripsi.textContent = report.deskripsi_kerusakan || '-';

    // 6. Set Status Badge
    const statusElement = document.getElementById('detailStatus');
    const status = report.status_laporan || 'menunggu';
    const config = STATUS_CONFIG[status] || STATUS_CONFIG.menunggu;
    
    if (statusElement) {
        statusElement.textContent = config.text;
        statusElement.className = `inline-flex px-3 py-1 text-sm font-semibold rounded-md ${config.class}`;
    }

    
    // 2. Isi "Waktu Diterima" (Selalu diisi karena ini data awal laporan)
    const txtCreatedAt = document.getElementById('detailCreatedAt');

    if (txtCreatedAt) {
        txtCreatedAt.textContent = formatTanggal(report.created_at);
    }

    /**
     * Menampilkan foto bukti penyelesaian laporan
     */
    // Di dalam function displayReportDetail
    const buktiElement = document.getElementById('detailBukti');
    const noBuktiMessage = document.getElementById('noBuktiMessage');

    if (buktiElement && noBuktiMessage) {
        // Pastikan menggunakan foto_selesai (sesuai yang terisi di database kamu)
        if (report.foto_selesai) { 
            const buktiUrl = `http://localhost:8001/storage/${report.foto_selesai}`;
            buktiElement.src = buktiUrl;
            buktiElement.classList.remove('hidden');
            noBuktiMessage.classList.add('hidden');
        } else {
            buktiElement.classList.add('hidden');
            noBuktiMessage.classList.remove('hidden');
        }
    }

    /**
    * Helper function untuk format tanggal
    */
    function formatTanggal(dateString) {
        if (!dateString) return "-";
        try {
            const date = new Date(dateString);
            return date.toLocaleDateString("id-ID", {
                weekday: "long", day: "numeric", month: "long", year: "numeric"
            }) + " • " + date.toLocaleTimeString("id-ID", { hour: "2-digit", minute: "2-digit" }) + " WIB";
        } catch (e) {
            return "-";
        }
    }
    

    // 7. Set Foto Kerusakan
    const fotoElement = document.querySelector('#detailFotoContainer img');
    const noFotoMessage = document.getElementById('noFotoMessage');
    if (fotoElement && noFotoMessage) {
        if (report.foto_kerusakan) {
            fotoElement.src = `http://localhost:8001/storage/${report.foto_kerusakan}`;
            fotoElement.style.display = "block";
            noFotoMessage.classList.add('hidden');
        } else {
            fotoElement.style.display = "none";
            noFotoMessage.classList.remove('hidden');
        }
    }

    // 8. Info Boxes (Approved/Rejected/Completed)
    const infoBoxes = {
        approved: document.getElementById('approvedInfo'),
        rejected: document.getElementById('rejectedInfo'),
        completed: document.getElementById('completedInfo')
    };

    Object.values(infoBoxes).forEach(box => {
        if (box) box.classList.add('hidden');
    });

    if (status === 'diproses' || status === 'terselesaikan') {
        if (infoBoxes.approved) {
            infoBoxes.approved.classList.remove('hidden');
            
            const approvedBy = document.getElementById('detailDisetujuiOleh');
            const approvedAt = document.getElementById('detailWaktuDisetujui');

            if (approvedBy) approvedBy.textContent = report.disetujui_oleh || 'Admin';
            if (approvedAt) {
                // Gunakan formatTanggal yang sudah kita buat sebelumnya
                approvedAt.textContent = report.disetujui_pada 
                    ? formatTanggal(report.disetujui_pada) 
                    : formatTanggal(report.updated_at);
            }
        }
    }

    if (status === 'ditolak') {
        if (infoBoxes.rejected) {
            infoBoxes.rejected.classList.remove('hidden');
            const reasonElement = document.getElementById('detailAlasan');
            const rejectedByElement = document.getElementById('detailDitolakOleh');
            const rejectedAtElement = document.getElementById('detailWaktuDitolak');

            if (rejectedAtElement) rejectedAtElement.textContent = report.ditolak_pada ? new Date(report.ditolak_pada).toLocaleString('id-ID') : '-';
            if (reasonElement) reasonElement.textContent = report.alasan_ditolak || '-';
            if (rejectedByElement) rejectedByElement.textContent = report.ditolak_oleh || '-';
        }
    }

    if (status === 'terselesaikan') {
        if (infoBoxes.completed) {
            infoBoxes.completed.classList.remove('hidden');

            const completedByElement = document.getElementById('detailDiselesaikanOleh');
            const completedAtElement = document.getElementById('detailWaktuSelesai');

            if (completedByElement) completedByElement.textContent = report.diselesaikan_oleh || '-';
            if (completedAtElement) {
                completedAtElement.textContent = report.diselesaikan_pada 
                    ? formatTanggal(report.diselesaikan_pada) 
                    : '-';
            }
            
            // Render Bukti Foto Selesai
            const buktiElement = document.getElementById('detailBukti');
            const noBuktiMessage = document.getElementById('noBuktiMessage');
            
            if (buktiElement && noBuktiMessage) {
                if (report.foto_selesai) {
                    buktiElement.src = `http://localhost:8001/storage/${report.foto_selesai}`;
                    buktiElement.classList.remove('hidden');
                    noBuktiMessage.classList.add('hidden');
                } else {
                    buktiElement.classList.add('hidden');
                    noBuktiMessage.classList.remove('hidden');
                }
            }
        }
    }
};

/**
 * Mengambil detail laporan dari API
 */
export const loadReportDetail = async (id) => {
    const ui = {
        loading: document.getElementById('detailLoading'),
        content: document.getElementById('detailContent'),
        overlay: document.getElementById('detailOverlay')
    };

    // Tampilkan loading, sembunyikan konten lama
    if (ui.loading) ui.loading.classList.remove('hidden');
    if (ui.content) ui.content.classList.add('hidden');

    try {
        console.log('Loading report detail for ID:', id);
        
        const response = await fetch(`http://localhost:8001/api/admin/laporan/${id}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        console.log('Response status:', response.status);
        
        const data = await response.json();
        console.log('Report detail response:', data);

        if (data.success) {
            displayReportDetail(data.data);
        } else {
            console.error("API Error:", data.message);
            showNotification('error', data.message || 'Gagal memuat detail laporan');
        }
    } catch (error) {
        console.error("Fetch Error:", error);
        showNotification('error', 'Gagal memuat detail laporan: ' + error.message);
    }
};

// Export fungsi untuk digunakan di global
window.loadReportDetail = loadReportDetail;
window.displayReportDetail = displayReportDetail;
window.updateStatusHandler = updateStatus;
window.submitRejection = submitRejection;
window.closeRejectionModal = closeRejectionModal;