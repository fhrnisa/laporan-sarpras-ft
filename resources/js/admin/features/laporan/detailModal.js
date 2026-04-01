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

    try {
        console.log('Updating status:', { currentReportId, newStatus, additionalData });
        
        const response = await fetch(`http://localhost:8001/api/admin/laporan/${currentReportId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                status: newStatus,
                ...additionalData
            })
        });

        console.log('Response status:', response.status);
        
        // Coba parse response sebagai text terlebih dahulu untuk debugging
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
            // Refresh detail laporan
            await loadReportDetail(currentReportId);
            
            // Refresh daftar laporan jika perlu
            if (window.loadReports) {
                await window.loadReports();
            }
            
            // Tampilkan notifikasi sukses
            const statusText = STATUS_CONFIG[newStatus]?.text || newStatus;
            showNotification('success', `Status berhasil diubah menjadi ${statusText}`);
        } else {
            throw new Error(data.message || data.error || 'Gagal mengupdate status');
        }
    } catch (error) {
        console.error("Error updating status:", error);
        showNotification('error', error.message || 'Gagal mengupdate status');
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
        detailDate: document.getElementById('detailDate'),
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
    
    if (report.created_at) {
        const date = new Date(report.created_at);
        elements.detailDate.textContent = date.toLocaleDateString("id-ID", {
            weekday: "long", day: "numeric", month: "long", year: "numeric"
        }) + " • " + date.toLocaleTimeString("id-ID", { hour: "2-digit", minute: "2-digit" });
    } else {
        elements.detailDate.textContent = "-";
    }

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

    Object.values(infoBoxes).forEach(box => box?.classList.add('hidden'));

    if (status === 'diproses' && infoBoxes.approved) {
        infoBoxes.approved.classList.remove('hidden');
        const approvedByElement = document.getElementById('detailDisetujuiOleh');
        const approvedAtElement = document.getElementById('detailWaktuDisetujui');
        if (approvedByElement) approvedByElement.textContent = report.disetujui_oleh || '-';
        if (approvedAtElement) approvedAtElement.textContent = report.disetujui_pada ? new Date(report.disetujui_pada).toLocaleString('id-ID') : '-';
    } else if (status === 'ditolak' && infoBoxes.rejected) {
        infoBoxes.rejected.classList.remove('hidden');
        const reasonElement = document.getElementById('detailAlasan');
        const rejectedByElement = document.getElementById('detailDitolakOleh');
        if (reasonElement) reasonElement.textContent = report.alasan_ditolak || '-';
        if (rejectedByElement) rejectedByElement.textContent = report.ditolak_oleh || '-';
    } else if (status === 'terselesaikan' && infoBoxes.completed) {
        infoBoxes.completed.classList.remove('hidden');
        const completedByElement = document.getElementById('detailDiselesaikanOleh');
        if (completedByElement) completedByElement.textContent = report.diselesaikan_oleh || '-';
        
        const buktiElement = document.getElementById('detailBukti');
        const noBuktiMessage = document.getElementById('noBuktiMessage');
        if (buktiElement && noBuktiMessage) {
            if (report.bukti_penyelesaian) {
                const buktiUrl = report.bukti_penyelesaian.startsWith('http') ? report.bukti_penyelesaian : `http://localhost:8001/storage/${report.bukti_penyelesaian}`;
                buktiElement.src = buktiUrl;
                buktiElement.classList.remove('hidden');
                noBuktiMessage.classList.add('hidden');
            } else {
                buktiElement.classList.add('hidden');
                noBuktiMessage.classList.remove('hidden');
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