export class TableActions {
    constructor(adminActions, confirmModal, adminDetailModal) {
        this.adminActions = adminActions;
        this.confirmModal = confirmModal;
        this.adminDetailModal = adminDetailModal;
        
        this.init();
    }

    init() {
        this.attachDropdownEvents();
        this.attachEditEvents();
        this.attachStatusEvents();
        this.attachDeleteEvents();
        this.attachOutsideClick();
    }

    attachDropdownEvents() {
        document.querySelectorAll('.aksiBtn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const dropdown = btn.nextElementSibling;
                
                // Close all other dropdowns
                document.querySelectorAll('.aksiDropdown').forEach(d => {
                    if (d !== dropdown) d.classList.add('hidden');
                });
                
                dropdown.classList.toggle('hidden');
            });
        });
    }

    attachEditEvents() {
        document.querySelectorAll('.editAdminBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                const data = btn.dataset;
                this.adminDetailModal.openEdit({
                    id: data.id,
                    name: data.name,
                    email: data.email,
                    phone: data.phone,
                    role: data.role,
                    status: data.status
                });
            });
        });
    }

    attachStatusEvents() {
        document.querySelectorAll('.changeStatusBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const currentStatus = btn.dataset.status;
                const newStatus = currentStatus === 'aktif' ? 'tidak_aktif' : 'aktif';
                
                this.confirmModal.show(
                    'Ubah Status Admin',
                    `Apakah Anda yakin ingin mengubah status admin menjadi ${newStatus}?`,
                    () => this.adminActions.updateStatus(id, newStatus)
                );
            });
        });
    }

    attachDeleteEvents() {
        document.querySelectorAll('.deleteAdminBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                
                this.confirmModal.show(
                    'Hapus Admin',
                    'Apakah Anda yakin ingin menghapus admin ini?',
                    () => this.adminActions.deleteAdmin(id)
                );
            });
        });
    }

    attachOutsideClick() {
        document.addEventListener('click', () => {
            document.querySelectorAll('.aksiDropdown').forEach(d => {
                d.classList.add('hidden');
            });
        });
    }

    // Re-initialize setelah konten berubah (misal setelah filter)
    refresh() {
        this.init();
    }
}