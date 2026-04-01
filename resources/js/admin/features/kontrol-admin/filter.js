export class AdminFilter {
    constructor() {
        this.searchInput = null;
        this.filterStatus = null;
        this.filterTanggal = null;
        
        this.initElements();
        this.setFilterValuesFromUrl();
        this.attachEvents();
    }

    initElements() {
        this.searchInput = document.querySelector('input[type="search"], input[name="search"], .search-input, #topbarSearch');
        this.filterStatus = document.getElementById('filterStatus');
        this.filterTanggal = document.getElementById('filterTanggal');
    }

    setFilterValuesFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);

        if (this.filterStatus) {
            this.filterStatus.value = urlParams.get('status') || 'all';
        }

        if (this.filterTanggal) {
            this.filterTanggal.value = urlParams.get('tanggal') || 'semua';
        }

        if (this.searchInput) {
            this.searchInput.value = urlParams.get('search') || '';
        }
    }

    attachEvents() {
        // Search with debounce
        if (this.searchInput) {
            let searchTimeout;
            this.searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => this.applyFilters(), 800);
            });
        }

        if (this.filterStatus) {
            this.filterStatus.addEventListener('change', () => this.applyFilters());
        }

        if (this.filterTanggal) {
            this.filterTanggal.addEventListener('change', () => this.applyFilters());
        }
    }

    applyFilters() {
        const params = new URLSearchParams();

        const searchValue = this.searchInput ? this.searchInput.value.trim() : '';

        if (this.filterStatus && this.filterStatus.value !== 'all') {
            params.append('status', this.filterStatus.value);
        }

        if (this.filterTanggal && this.filterTanggal.value !== 'semua') {
            params.append('tanggal', this.filterTanggal.value);
        }

        if (searchValue) {
            params.append('search', searchValue);
        }

        // Preserve current page
        const currentPage = new URLSearchParams(window.location.search).get('page');
        if (currentPage) {
            params.append('page', currentPage);
        }

        const basePath = window.location.pathname;
        const queryString = params.toString();

        window.location.href = `${basePath}${queryString ? '?' + queryString : ''}`;
    }
}