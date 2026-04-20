export const initFilters = () => {
    const filterStatus = document.getElementById("filterStatus");
    const filterTanggal = document.getElementById("filterTanggal");
    const getSearchInput = () => document.querySelector('input[name="search"]') || document.querySelector('.search-input');

    const applyFilters = () => {
        const params = new URLSearchParams();
        const searchInput = getSearchInput();
        const searchValue = searchInput ? searchInput.value.trim() : '';

        if (filterStatus && filterStatus.value) {
            params.append('status', filterStatus.value);
        }

        if (filterTanggal && filterTanggal.value) {
            params.append('tanggal', filterTanggal.value);
        }

        if (searchValue) {
            params.append('search', searchValue);
        }

        const queryString = params.toString();
        
        /** * PERBAIKAN DINAMIS:
         * Kita ambil path halaman saat ini (misal: /admin/arsip atau /admin/laporan)
         * sehingga dia akan me-refresh ke dirinya sendiri dengan query string baru.
         */
        const currentPath = window.location.pathname;
        window.location.href = `${currentPath}${queryString ? '?' + queryString : ''}`;
    };

    // Pasang listener
    if (filterStatus) filterStatus.onchange = applyFilters;
    if (filterTanggal) filterTanggal.onchange = applyFilters;
};