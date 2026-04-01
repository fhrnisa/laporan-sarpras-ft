let confirmResolve = null;

const getElements = () => ({
    modal: document.getElementById('confirmModal'), // Pastikan ID ini ada di Blade
    message: document.getElementById('confirmMessage'),
    title: document.getElementById('confirmTitle'),
    okBtn: document.getElementById('confirmOk'),
    cancelBtn: document.getElementById('confirmCancel')
});

export const showConfirmAdmin = (options = {}) => {
    const { 
        title = 'Konfirmasi', 
        message = 'Apakah Anda yakin?', 
        confirmText = 'Ya, Lanjutkan',
        type = 'danger' // danger, primary, warning
    } = options;

    return new Promise((resolve) => {
        const { modal, message: msgEl, title: titleEl, okBtn, cancelBtn } = getElements();

        if (!modal) return resolve(false);

        // Reset & Set Content
        titleEl.textContent = title;
        msgEl.textContent = message;
        okBtn.textContent = confirmText;

        // Atur Warna berdasarkan Type
        okBtn.className = 'px-6 py-2 rounded-lg text-white font-medium transition-all shadow-sm';
        if (type === 'danger') {
            okBtn.classList.add('bg-red-600', 'hover:bg-red-700', 'shadow-red-200');
        } else if (type === 'warning') {
            okBtn.classList.add('bg-[#F36A00]', 'hover:bg-[#d45d00]', 'shadow-orange-200');
        } else {
            okBtn.classList.add('bg-[#002C55]', 'hover:bg-[#001f3d]', 'shadow-blue-200');
        }

        modal.classList.remove('hidden');
        confirmResolve = resolve;

        // Event Listeners (Sekali pakai)
        const handleAction = (result) => {
            modal.classList.add('hidden');
            confirmResolve = null;
            resolve(result);
        };

        okBtn.onclick = () => handleAction(true);
        cancelBtn.onclick = () => handleAction(false);
    });
};