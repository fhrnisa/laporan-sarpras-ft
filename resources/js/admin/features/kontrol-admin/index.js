import { initFormAdmin } from './formAdmin';
import { AdminActions } from './actions';

export const initKontrolAdmin = () => {
    initFormAdmin();

    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('adminForm');

    if (submitBtn) {
        submitBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                await AdminActions.store(data);
                alert('Admin Berhasil Ditambah');
                window.location.reload();
            } catch (err) {
                if (err.status === 422) {
                    // Tampilkan error validasi Laravel ke input masing-masing
                    console.log('Error Validasi:', err.errors);
                    // Anda bisa memanggil fungsi untuk menampilkan error di bawah input di sini
                } else {
                    alert(err.message);
                }
            }
        });
    }
};