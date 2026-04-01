import { showConfirmAdmin } from './confirm.js';
import { showToast } from '../../utils/toast.js';

export const initAdminModal = (adminActions) => {
    const modal = document.getElementById('adminModal');
    const form = document.getElementById('adminForm');
    const modalTitle = document.getElementById('modalTitle');
    const passwordNote = document.getElementById('passwordNote');
    const deleteBtn = document.getElementById('deleteAdminBtn');
    const submitBtn = document.getElementById('submitAdminBtn');

    let currentAdminId = null;
    
    if (!modal || !form) {
        console.error('Modal/Form elements not found');
        return { openModal: () => {} };
    }

    const openModal = (data = null) => {
        form.reset();
        modal.classList.remove('hidden');
        
        // Hapus error sebelumnya jika ada
        const existingError = document.getElementById('formErrors');
        if (existingError) existingError.remove();

        if (data && data.id) {
            currentAdminId = data.id;
            if (deleteBtn) deleteBtn.classList.remove('hidden');
            if (modalTitle) modalTitle.innerHTML = 'Edit <span class="text-[#F36A00]">Admin</span>';
            if (passwordNote) passwordNote.classList.remove('hidden');

            // Isi field (Gunakan querySelector agar lebih aman)
            document.getElementById('adminName').value = data.name || '';
            document.getElementById('adminEmail').value = data.email || '';
            document.getElementById('adminPhone').value = data.phone || '';
            document.getElementById('adminRole').value = data.role || '';
            
            const passField = document.getElementById('adminPassword');
            passField.placeholder = 'Kosongkan jika tidak diubah';
            passField.required = false; 
        } else {
            currentAdminId = null;
            if (deleteBtn) deleteBtn.classList.add('hidden');
            if (modalTitle) modalTitle.innerHTML = 'Tambah <span class="text-[#F36A00]">Admin Baru</span>';
            if (passwordNote) passwordNote.classList.add('hidden');
            
            const passField = document.getElementById('adminPassword');
            passField.placeholder = '••••••••';
            passField.required = true;
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        
        const formData = {
            name: document.getElementById('adminName')?.value,
            email: document.getElementById('adminEmail')?.value,
            phone: document.getElementById('adminPhone')?.value,
            role: document.getElementById('adminRole')?.value,
            password: document.getElementById('adminPassword')?.value
        };

        // Validasi Sederhana
        if (!formData.name || !formData.email || (!currentAdminId && !formData.password)) {
            showToast('Lengkapi data yang wajib!', 'error');
            return;
        }

        try {
            // PERHATIKAN: Nama method disesuaikan dengan objek di admin.js
            if (currentAdminId) {
                await adminActions.updateAdmin(currentAdminId, formData);
            } else {
                await adminActions.createAdmin(formData);
            }
            
            // Note: showToast dan reload sudah ditangani di actions.js
            modal.classList.add('hidden');
            
        } catch (error) {
            console.error('Error saving admin:', error);
            // showToast di sini aman karena sudah di-import di atas
            showToast('Gagal memproses data', 'error');
        }
    };

    // Handler Delete
    const handleDelete = async () => {
        if (!currentAdminId) return;

        const confirmed = await showConfirmAdmin({
            title: 'Hapus Admin',
            message: 'Data ini akan dihapus permanen dari sistem.',
            confirmText: 'Ya, Hapus',
            type: 'danger'
        });

        if (confirmed) {
            await adminActions.delete(currentAdminId);
            modal.classList.add('hidden');
        }
    };

    // Listeners
    submitBtn?.addEventListener('click', handleSubmit);
    deleteBtn?.addEventListener('click', handleDelete);

    // Close logic
    const closeModal = () => modal.classList.add('hidden');
    document.querySelectorAll('#cancelBtn, #closeModal').forEach(btn => {
        btn.addEventListener('click', closeModal);
    });

    return { openModal };
};