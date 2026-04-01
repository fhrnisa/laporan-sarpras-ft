document.addEventListener("DOMContentLoaded", () => {
    // === VARIABLES ===
    let currentReportId = null;
    let toastTimer = null;
    let confirmResolve = null;

    // === ELEMEN UTAMA ===
    const kelolaBtn = document.getElementById("kelolaBtn");
    const batalBtn = document.getElementById("batalBtn");
    const pulihkanBtn = document.getElementById("pulihkanBtn");
    const hapusPermanenBtn = document.getElementById("hapusPermanenBtn");
    const manageOptions = document.getElementById("manageOptions");
    const actionCells = document.querySelectorAll(".action-cell");
    const checkboxCells = document.querySelectorAll(".checkbox-cell");
    const reportCheckboxes = document.querySelectorAll(".report-checkbox");
    const selectAll = document.getElementById("select-all");
    const overlay = document.getElementById("detailOverlay");
    const closeBtn = document.getElementById("closeDetail");
    const filterStatus = document.getElementById("filterStatus");
    const filterTanggal = document.getElementById("filterTanggal");

    // === ELEMEN CONFIRM MODAL ===
    const confirmModal = document.getElementById('confirmModal');
    const confirmMessage = document.getElementById('confirmMessage');
    const confirmOkBtn = document.getElementById('confirmOk');
    const confirmCancelBtn = document.getElementById('confirmCancel');

    // === INIT CONFIRM MODAL ===
    function initConfirmModal() {
        if (confirmOkBtn && confirmCancelBtn) {
            // Setup event listener permanen
            confirmOkBtn.addEventListener('click', () => {
                if (confirmResolve) {
                    confirmResolve(true);
                    hideConfirmModal();
                }
            });

            confirmCancelBtn.addEventListener('click', () => {
                if (confirmResolve) {
                    confirmResolve(false);
                    hideConfirmModal();
                }
            });

            // Close modal ketika klik di luar
            confirmModal.addEventListener('click', (e) => {
                if (e.target === confirmModal && confirmResolve) {
                    confirmResolve(false);
                    hideConfirmModal();
                }
            });
        }
    }

    function hideConfirmModal() {
        confirmModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        confirmResolve = null;
    }

    // === FILTER FUNCTIONS ===
    // Set initial filter values from URL params
    const urlParams = new URLSearchParams(window.location.search);
    const statusParam = urlParams.get('status');
    const tanggalParam = urlParams.get('tanggal');

    if (statusParam && filterStatus) filterStatus.value = statusParam;
    if (tanggalParam && filterTanggal) filterTanggal.value = tanggalParam;

    if (filterStatus) {
        filterStatus.addEventListener('change', applyFilters);
    }

    if (filterTanggal) {
        filterTanggal.addEventListener('change', applyFilters);
    }

    function applyFilters() {
        const params = new URLSearchParams();
        const searchInput = document.querySelector('input[name="search"]') || document.querySelector('.search-input');
        const searchValue = searchInput ? searchInput.value.trim() : '';

        if (filterStatus && filterStatus.value !== 'all') {
            params.append('status', filterStatus.value);
        }

        if (filterTanggal && filterTanggal.value !== 'semua') {
            params.append('tanggal', filterTanggal.value);
        }

        if (searchValue) {
            params.append('search', searchValue);
        }

        const currentPage = new URLSearchParams(window.location.search).get('page');
        if (currentPage) {
            params.append('page', currentPage);
        }

        const queryString = params.toString();
        window.location.href = `/admin/arsip${queryString ? '?' + queryString : ''}`;
    }

    /* ========================= TOAST CONFIG ========================= */
    const TOAST_STYLES = {
        success: {
            bg: 'bg-green-100',
            border: 'border-green-500',
            text: 'text-green-800',
            iconBg: 'bg-green-500',
            iconColor: 'text-white',
            icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                   </svg>`
        },
        error: {
            bg: 'bg-red-100',
            border: 'border-red-500',
            text: 'text-red-800',
            iconBg: 'bg-red-500',
            iconColor: 'text-white',
            icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>`
        },
        info: {
            bg: 'bg-blue-100',
            border: 'border-blue-500',
            text: 'text-blue-800',
            iconBg: 'bg-blue-500',
            iconColor: 'text-white',
            icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                   </svg>`
        }
    };

    /* ========================= TOAST FUNCTION - POSISI TENGAH DENGAN ANIMASI ========================= */
    function showToast(message, type = 'success', duration = 3000) {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');
        const toastIcon = document.getElementById('toastIcon');
        const toastInner = document.getElementById('toastInner');

        if (!toast || !toastMessage || !toastIcon || !toastInner) {
            console.error('Toast elements not found');
            return;
        }

        // Clear previous timer
        if (toastTimer) {
            clearTimeout(toastTimer);
            // Remove animation classes
            toastInner.classList.remove('toast-enter', 'toast-exit');
        }

        const style = TOAST_STYLES[type] || TOAST_STYLES.success;

        // Reset classes
        toastInner.className = 'flex items-center gap-3 px-6 py-4 rounded-lg border shadow-lg min-w-[300px] max-w-[500px] backdrop-blur-sm transform -translate-y-10 opacity-0';
        toastIcon.className = 'w-10 h-10 flex items-center justify-center rounded-full shrink-0';
        toastMessage.className = 'text-base font-medium grow';

        // Apply colors
        toastInner.classList.add(style.bg, style.border);
        toastIcon.classList.add(style.iconBg, style.iconColor);
        toastMessage.classList.add(style.text);

        // Set content
        toastMessage.textContent = message;
        toastIcon.innerHTML = style.icon;

        // Show toast
        toast.classList.remove('hidden');

        // Trigger animation
        setTimeout(() => {
            toastInner.classList.add('toast-enter');
            toastInner.classList.remove('-translate-y-10', 'opacity-0');
        }, 10);

        // Auto hide
        toastTimer = setTimeout(() => {
            toastInner.classList.remove('toast-enter');
            toastInner.classList.add('toast-exit');

            setTimeout(() => {
                toast.classList.add('hidden');
                toastInner.classList.remove('toast-exit');
            }, 300);
        }, duration);
    }

    /* ========================= CONFIRM FUNCTION UNTUK ARSIP ========================= */
    function showConfirm(message, actionType = 'restore') {
        return new Promise(resolve => {
            if (!confirmModal || !confirmMessage || !confirmOkBtn || !confirmCancelBtn) {
                console.error('Confirm modal elements not found');
                resolve(false);
                return;
            }

            // Reset tombol OK
            confirmOkBtn.classList.remove(
                'bg-[#002C55]',
                'hover:bg-[#001f3f]',
                'bg-red-600',
                'hover:bg-red-700',
                'bg-yellow-500',
                'hover:bg-yellow-600'
            );

            // Set warna berdasarkan actionType
            if (actionType === 'delete') {
                confirmOkBtn.classList.add('bg-red-600', 'hover:bg-red-700');
                confirmOkBtn.textContent = 'Ya, Hapus Permanen';
            } else {
                confirmOkBtn.classList.add('bg-[#002C55]', 'hover:bg-[#001f3f]');
                confirmOkBtn.textContent = 'Ya, Pulihkan';
            }

            confirmMessage.textContent = message;
            confirmModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            // Simpan resolve function
            confirmResolve = resolve;
        });
    }

    // === DETAIL MODAL FUNCTIONS ===
    async function loadReportDetail(id) {
        try {
            currentReportId = id;
            const detailLoading = document.getElementById('detailLoading');
            const detailContent = document.getElementById('detailContent');
            const detailError = document.getElementById('detailError');
            const detailActions = document.getElementById('detailActions');

            if (detailLoading) detailLoading.classList.remove('hidden');
            if (detailContent) detailContent.classList.add('hidden');
            if (detailError) detailError.classList.add('hidden');
            if (detailActions) detailActions.classList.add('hidden');

            const response = await fetch(`http://localhost:8001/api/admin/arsip/${id}`);
            const data = await response.json();

            if (data.success) {
                const report = data.data;
                displayReportDetail(report);
            } else {
                throw new Error(data.message || 'Gagal memuat detail');
            }
        } catch (error) {
            console.error('Error loading report detail:', error);
            const detailLoading = document.getElementById('detailLoading');
            const detailError = document.getElementById('detailError');
            const errorMessage = document.getElementById('errorMessage');

            if (detailLoading) detailLoading.classList.add('hidden');
            if (detailError) detailError.classList.remove('hidden');
            if (errorMessage) errorMessage.textContent = error.message;
        }
    }

    function displayReportDetail(report) {
        const detailLoading = document.getElementById('detailLoading');
        const detailContent = document.getElementById('detailContent');
        const detailActions = document.getElementById('detailActions');

        if (detailLoading) detailLoading.classList.add('hidden');
        if (detailContent) detailContent.classList.remove('hidden');
        if (detailActions) detailActions.classList.remove('hidden');

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
            detailDate.textContent = report.created_at ? new Date(report.created_at).toLocaleDateString('id-ID', {
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

        // Set status dengan warna yang benar
        const statusElement = document.getElementById('detailStatus');
        const status = report.status_laporan || 'menunggu';

        // Konfigurasi status
        const STATUS_CONFIG = {
            menunggu: { text: 'Menunggu', bg: 'bg-[#E1E7E9]', textColor: 'text-[#022C55]' },
            diproses: { text: 'Diproses', bg: 'bg-[#FEEF94]', textColor: 'text-[#022C55]' },
            terselesaikan: { text: 'Terselesaikan', bg: 'bg-[#A0F1B5]', textColor: 'text-[#022C55]' },
            ditolak: { text: 'Ditolak', bg: 'bg-[#FF7A7E]', textColor: 'text-[#022C55]' }
        };

        const config = STATUS_CONFIG[status] || STATUS_CONFIG.menunggu;

        if (statusElement) {
            statusElement.textContent = config.text;
            statusElement.className = `inline-flex px-3 py-1 text-sm font-semibold rounded-md ${config.bg} ${config.textColor}`;
        }

        // Set foto
        const fotoElement = document.getElementById('detailFoto');
        const noFotoMessage = document.getElementById('noFotoMessage');

        if (fotoElement && noFotoMessage) {
            if (report.foto_kerusakan && report.foto_kerusakan !== 'default.jpg') {
                fotoElement.src = `http://localhost:8001/storage/${report.foto_kerusakan}`;
                fotoElement.classList.remove('hidden');
                noFotoMessage.classList.add('hidden');
            } else {
                fotoElement.classList.add('hidden');
                noFotoMessage.classList.remove('hidden');
            }
        }

        // Set timestamps
        const detailCreatedAt = document.getElementById('detailCreatedAt');
        const detailUpdatedAt = document.getElementById('detailUpdatedAt');

        if (detailCreatedAt) {
            detailCreatedAt.textContent = report.created_at ? new Date(report.created_at).toLocaleString('id-ID') : '-';
        }
        if (detailUpdatedAt) {
            detailUpdatedAt.textContent = report.updated_at ? new Date(report.updated_at).toLocaleString('id-ID') : '-';
        }

        // Show rejected info if status is ditolak
        const rejectedInfo = document.getElementById('rejectedInfo');
        if (rejectedInfo) {
            if (status === 'ditolak') {
                rejectedInfo.classList.remove('hidden');
                document.getElementById('detailAlasan').textContent = report.alasan_ditolak || '-';
                document.getElementById('detailWaktuDitolak').textContent = report.ditolak_pada ? new Date(report.ditolak_pada).toLocaleString('id-ID') : '-';
                document.getElementById('detailAdmin').textContent = report.ditolak_oleh || '-';
            } else {
                rejectedInfo.classList.add('hidden');
            }
        }
    }

    function getStatusText(status) {
        const statusMap = {
            'menunggu': 'Menunggu',
            'diproses': 'Diproses',
            'terselesaikan': 'Terselesaikan',
            'ditolak': 'Ditolak'
        };
        return statusMap[status] || status;
    }

    function closeDetailModal() {
        if (overlay) overlay.classList.add('hidden');
        currentReportId = null;
    }

    function openDetailModal() {
        if (overlay) overlay.classList.remove('hidden');
    }

    // === EVENT LISTENERS FOR DETAIL BUTTONS ===
    document.querySelectorAll(".aksiBtn").forEach(btn => {
        btn.addEventListener("click", function() {
            const id = this.dataset.id;
            currentReportId = id;
            openDetailModal();
            loadReportDetail(id);
        });
    });

    // Close modal
    if (closeBtn) {
        closeBtn.addEventListener("click", closeDetailModal);
    }

    // Click outside to close
    if (overlay) {
        overlay.addEventListener("click", (e) => {
            if (e.target === overlay) closeDetailModal();
        });
    }

    // === MODE KELOLA ===
    if (kelolaBtn) {
        kelolaBtn.addEventListener("click", () => {
            kelolaBtn.classList.add("hidden");
            if (manageOptions) manageOptions.classList.remove("hidden");

            // Tampilkan checkbox, sembunyikan action cell
            actionCells.forEach(cell => cell.classList.add("hidden"));
            checkboxCells.forEach(cell => cell.classList.remove("hidden"));
        });
    }

    // === BATAL MODE KELOLA ===
    if (batalBtn) {
        batalBtn.addEventListener("click", () => {
            if (kelolaBtn) kelolaBtn.classList.remove("hidden");
            if (manageOptions) manageOptions.classList.add("hidden");

            // Sembunyikan checkbox, tampilkan action cell
            checkboxCells.forEach(cell => cell.classList.add("hidden"));
            actionCells.forEach(cell => cell.classList.remove("hidden"));

            // Uncheck semua checkbox
            reportCheckboxes.forEach(ch => ch.checked = false);
            if (selectAll) selectAll.checked = false;
        });
    }

    // === SELECT ALL CHECKBOX ===
    if (selectAll) {
        selectAll.addEventListener("change", function() {
            reportCheckboxes.forEach(ch => ch.checked = selectAll.checked);
        });
    }

    // === ACTION FUNCTIONS UNTUK ARSIP ===
    async function restoreReports() {
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
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                showToast('Token CSRF tidak ditemukan', 'error');
                return;
            }

            const response = await fetch("http://localhost:8001/api/admin/arsip/restore", {
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

    async function deletePermanent() {
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
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                showToast('Token CSRF tidak ditemukan', 'error');
                return;
            }

            const response = await fetch("http://localhost:8001/api/admin/arsip/destroy", {
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

    // === BUTTON EVENT LISTENERS UNTUK ARSIP ===
    if (pulihkanBtn) {
        pulihkanBtn.addEventListener('click', restoreReports);
    }

    if (hapusPermanenBtn) {
        hapusPermanenBtn.addEventListener('click', deletePermanent);
    }

    // === UPDATE STATUS FUNCTION (UNTUK MODAL) ===
    // Di halaman arsip, tombol update status di modal sebaiknya dihapus
    // Karena data arsip sudah final
    function updateStatus(status) {
        showToast('Data arsip tidak dapat diubah statusnya', 'error');
        closeDetailModal();
    }

    // === INITIALIZATION ===
    initConfirmModal();

    // Expose functions to global scope
    window.updateStatus = updateStatus;
    window.closeDetailModal = closeDetailModal;
    window.showToast = showToast;
});