export function initFilters() {

    const filterStatus = document.getElementById("filterStatus");
    const filterTanggal = document.getElementById("filterTanggal");

    if (filterStatus) {
        filterStatus.addEventListener('change', applyFilters);
    }

    if (filterTanggal) {
        filterTanggal.addEventListener('change', applyFilters);
    }

    function applyFilters() {

        const params = new URLSearchParams();

        const searchInput =
            document.querySelector('input[name="search"]') ||
            document.querySelector('.search-input');

        const searchValue = searchInput ? searchInput.value.trim() : '';

        if (filterStatus) {
            params.append('status', filterStatus.value);
        }

        if (filterTanggal) {
            params.append('tanggal', filterTanggal.value);
        }

        if (searchValue) {
            params.append('search', searchValue);
        }

        window.location.href =
            `/admin/laporan${params.toString() ? '?' + params.toString() : ''}`;
    }
}