export const initFilters = () => {
    const filterStatus = document.getElementById("filterStatus");
    const filterTanggal = document.getElementById("filterTanggal");
    // Ambil search input secara dinamis agar tidak null
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
        window.location.href = `/admin/laporan${queryString ? '?' + queryString : ''}`;
    };

    // Pasang listener
    if (filterStatus) {
        filterStatus.onchange = applyFilters;
    }

    if (filterTanggal) {
        filterTanggal.onchange = applyFilters;
    }
};