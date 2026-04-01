let confirmResolve = null;

// Gunakan fungsi pembantu untuk mengambil elemen agar tidak null di awal
function getElements() {
    return {
        confirmOkBtn: document.getElementById('confirmOk'),
        confirmCancelBtn: document.getElementById('confirmCancel'),
        confirmModal: document.getElementById('confirmModal'),
        confirmMessage: document.getElementById('confirmMessage')
    };
}

export function initConfirmModal() {
    const { confirmOkBtn, confirmCancelBtn, confirmModal } = getElements();

    if (confirmOkBtn && confirmCancelBtn && confirmModal) {
        confirmOkBtn.onclick = () => {
            if (confirmResolve) {
                confirmResolve(true);
                hideConfirmModal();
            }
        };

        confirmCancelBtn.onclick = () => {
            if (confirmResolve) {
                confirmResolve(false);
                hideConfirmModal();
            }
        };

        confirmModal.onclick = (e) => {
            if (e.target === confirmModal && confirmResolve) {
                confirmResolve(false);
                hideConfirmModal();
            }
        };
    }
}

export function hideConfirmModal() {
    const { confirmModal } = getElements();
    if (confirmModal) {
        confirmModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    confirmResolve = null;
}

export function showConfirm(message, actionType = 'archive') {
    return new Promise(resolve => {
        const { confirmModal, confirmMessage, confirmOkBtn, confirmCancelBtn } = getElements();

        if (!confirmModal || !confirmMessage || !confirmOkBtn || !confirmCancelBtn) {
            console.error('Confirm modal elements not found. Cek apakah ID sudah benar di HTML.');
            resolve(false);
            return;
        }

        // Reset warna & text
        confirmOkBtn.className = 'flex-1 px-4 py-2 rounded-lg text-white transition-colors';
        
        if (actionType === 'delete') {
            confirmOkBtn.classList.add('bg-red-600', 'hover:bg-red-700');
            confirmOkBtn.textContent = 'Ya, Hapus Permanen';
        } else {
            confirmOkBtn.classList.add('bg-[#002C55]', 'hover:bg-[#001f3f]');
            confirmOkBtn.textContent = 'Ya, Arsipkan';
        }

        confirmMessage.textContent = message;
        confirmModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        confirmResolve = resolve;
    });
}