// features/control-admin/kelolaMode.js
export class KelolaMode {
    constructor(adminActions, confirmModal) {
        this.adminActions = adminActions;
        this.confirmModal = confirmModal;
        this.isActive = false;
        
        this.initElements();
        this.attachEvents();
    }

    initElements() {
        this.kelolaBtn = document.getElementById('kelolaBtn');
        this.manageOptions = document.getElementById('manageOptions');
        this.hapusBtn = document.getElementById('hapusBtn');
        this.selectAllCheckbox = document.getElementById('select-all');
        
        this.actionCells = document.querySelectorAll('.action-cell');
        this.checkboxCells = document.querySelectorAll('.checkbox-cell');
        this.adminCheckboxes = document.querySelectorAll('.admin-checkbox');
    }

    attachEvents() {
        if (this.kelolaBtn) {
            this.kelolaBtn.addEventListener('click', () => this.activate());
        }
        
        if (this.hapusBtn) {
            this.hapusBtn.addEventListener('click', () => this.handleDeleteMultiple());
        }
        
        if (this.selectAllCheckbox) {
            this.selectAllCheckbox.addEventListener('change', (e) => this.selectAll(e.target.checked));
        }
    }

    activate() {
        this.isActive = true;
        
        if (this.kelolaBtn) this.kelolaBtn.classList.add('hidden');
        if (this.manageOptions) this.manageOptions.classList.remove('hidden');
        
        this.actionCells.forEach(cell => cell.classList.add('hidden'));
        this.checkboxCells.forEach(cell => cell.classList.remove('hidden'));
    }

    deactivate() {
        this.isActive = false;
        
        if (this.kelolaBtn) this.kelolaBtn.classList.remove('hidden');
        if (this.manageOptions) this.manageOptions.classList.add('hidden');
        
        this.actionCells.forEach(cell => cell.classList.remove('hidden'));
        this.checkboxCells.forEach(cell => cell.classList.add('hidden'));
        
        if (this.selectAllCheckbox) this.selectAllCheckbox.checked = false;
    }

    getSelectedIds() {
        const checkboxes = document.querySelectorAll('.admin-checkbox:checked');
        return Array.from(checkboxes).map(cb => cb.value);
    }

    selectAll(checked) {
        this.adminCheckboxes.forEach(cb => {
            cb.checked = checked;
        });
    }

    handleDeleteMultiple() {
        const selectedIds = this.getSelectedIds();
        
        if (selectedIds.length === 0) {
            this.adminActions.toast.error('Pilih admin terlebih dahulu');
            return;
        }
        
        this.confirmModal.show(
            'Hapus Admin Terpilih',
            `Apakah Anda yakin ingin menghapus ${selectedIds.length} admin terpilih?`,
            async () => {
                await this.adminActions.deleteMultipleAdmins(selectedIds);
                this.deactivate();
            }
        );
    }
}