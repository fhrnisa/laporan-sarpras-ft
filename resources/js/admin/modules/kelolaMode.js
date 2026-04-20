export const initKelolaMode = (options = {}) => {
    const kelolaBtn = document.getElementById("kelolaBtn");
    const batalBtn = document.getElementById("batalBtn");
    const manageOptions = document.getElementById("manageOptions");
    const selectAll = document.getElementById("select-all");

    const pulihkanBtn = document.getElementById("pulihkanBtn");
    const arsipBtn = document.getElementById("arsipBtn");
    const hapusBtn = document.getElementById("hapusPermanenBtn");
    
    const getCells = () => ({
        actionCells: document.querySelectorAll(".action-cell"),
        checkboxCells: document.querySelectorAll(".checkbox-cell"),
        reportCheckboxes: document.querySelectorAll(".report-checkbox")
    });



    // === EVENT LISTENERS ===
    if (pulihkanBtn && options.onRestore) {
        console.log("Event listener Pulihkan BERHASIL dipasang");
        pulihkanBtn.addEventListener('click', options.onRestore);
    }   else {
        console.log("Gagal memasang listener Pulihkan. Elemen:", pulihkanBtn, "Fungsi:", options.onRestore);
    }
    
    if (arsipBtn && options.onArchive) {
        console.log("Event listener Arsip BERHASIL dipasang");
        arsipBtn.addEventListener('click', options.onArchive);
    }   else {
        console.log("Gagal memasang listener Arsip. Elemen:", arsipBtn, "Fungsi:", options.onArchive);
    }
    
    if (hapusBtn && options.onDelete) {
        hapusBtn.addEventListener('click', options.onDelete);
    }

        const enableKelolaMode = () => {
        const { actionCells, checkboxCells } = getCells();
        
        if (kelolaBtn) kelolaBtn.classList.add("hidden");
        if (manageOptions) manageOptions.classList.remove("hidden");
        
        actionCells.forEach(cell => cell.classList.add("hidden"));
        checkboxCells.forEach(cell => cell.classList.remove("hidden"));
    };

    const disableKelolaMode = () => {
        const { actionCells, checkboxCells, reportCheckboxes } = getCells();
        
        if (kelolaBtn) kelolaBtn.classList.remove("hidden");
        if (manageOptions) manageOptions.classList.add("hidden");
        
        checkboxCells.forEach(cell => cell.classList.add("hidden"));
        actionCells.forEach(cell => cell.classList.remove("hidden"));
        
        reportCheckboxes.forEach(ch => ch.checked = false);
        if (selectAll) selectAll.checked = false;
    };

    if (kelolaBtn) {
        kelolaBtn.addEventListener("click", enableKelolaMode);
    }

    if (batalBtn) {
        batalBtn.addEventListener("click", disableKelolaMode);
    }

    if (selectAll) {
        selectAll.addEventListener("change", () => {
            const currentCheckboxes = document.querySelectorAll(".report-checkbox");
            currentCheckboxes.forEach(ch => ch.checked = selectAll.checked);
        });
    }

    // Penting: Ekspos ke window jika tombol di HTML Anda masih pakai onclick=""
    window.enableKelolaMode = enableKelolaMode;
    window.disableKelolaMode = disableKelolaMode;

    return { enableKelolaMode, disableKelolaMode };
};