export class AdminFilter {
    constructor() {
        this.searchInput = null;
        this.filterStatus = null;
        this.filterTanggal = null;
        
        this.initElements();
        // Cek apakah elemen ada sebelum lanjut
        if (this.searchInput || this.filterStatus || this.filterTanggal) {
            this.setFilterValuesFromUrl();
            this.attachEvents();
        }
    }

    initElements() {
        // Gunakan selektor yang lebih spesifik agar tidak salah ambil elemen
        this.searchInput = document.getElementById('topbarSearch') || document.querySelector('.search-input');
        this.filterStatus = document.getElementById('filterStatus');
        this.filterTanggal = document.getElementById('filterTanggal');
    }

    setFilterValuesFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        if (this.filterStatus) this.filterStatus.value = urlParams.get('status') || 'all';
        if (this.filterTanggal) this.filterTanggal.value = urlParams.get('tanggal') || 'semua';
        if (this.searchInput) this.searchInput.value = urlParams.get('search') || '';
    }

    attachEvents() {
        if (this.searchInput) {
            let searchTimeout;
            this.searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => this.applyFilters(true), 800); // true = reset page
            });
        }

        if (this.filterStatus) {
            this.filterStatus.addEventListener('change', () => this.applyFilters(true));
        }

        if (this.filterTanggal) {
            this.filterTanggal.addEventListener('change', () => this.applyFilters(true));
        }
    }

    applyFilters(shouldResetPage = false) {
        const params = new URLSearchParams(window.location.search); // Ambil params yang ada dulu

        // Update atau Hapus params berdasarkan input
        const searchValue = this.searchInput ? this.searchInput.value.trim() : '';
        
        if (searchValue) params.set('search', searchValue);
        else params.delete('search');

        if (this.filterStatus && this.filterStatus.value !== 'all') {
            params.set('status', this.filterStatus.value);
        } else {
            params.delete('status');
        }

        if (this.filterTanggal && this.filterTanggal.value !== 'semua') {
            params.set('tanggal', this.filterTanggal.value);
        } else {
            params.delete('tanggal');
        }

        // KUNCI: Reset halaman ke 1 jika filter berubah
        if (shouldResetPage) {
            params.delete('page');
        }

        const queryString = params.toString();
        window.location.href = `${window.location.pathname}${queryString ? '?' + queryString : ''}`;
    }
}