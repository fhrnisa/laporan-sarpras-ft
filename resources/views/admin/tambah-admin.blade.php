@extends('layouts.admin')

@section('title', 'Tambah Admin')
@section('hideTopbar', true)
@section('content')

<div class="bg-white">
    <div class="mt-5 md:mt-0 md:p-12 items-center justify-center">
        <div class="items-center">
            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-semibold text-[#002D56]">
                Tambah
                <span class="text-[#F36A00]">Admin</span>
            </h1>

            <!-- Description -->
            <p class="text-sm md:text-base text-[#002D56] mt-2">
                Tambahkan akun administrator baru ke sistem
            </p>

            <!-- Form -->
            <form id="tambahAdminForm" class="mt-5 space-y-3">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Nama Lengkap
                    </label>
                    <input type="text"
                    name="name"
                    id="name"
                    placeholder="Masukkan nama lengkap"
                    class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                    required>
                    <div class="text-red-500 text-sm mt-1 error-name hidden"></div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Email
                    </label>
                    <input type="email"
                           name="email"
                           id="email"
                           placeholder="Contoh: user123@gmail.com"
                           class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                           required>
                    <div class="text-red-500 text-sm mt-1 error-email hidden"></div>
                </div>

                <!-- Nomor WhatsApp -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Nomor WhatsApp
                    </label>
                    <div class="flex items-center rounded-lg border border-[#DDDDDD] overflow-hidden">
                        <span class="px-3 py-3 bg-gray-100 text-gray-700">+62</span>
                        <input type="text"
                               name="nomor_telepon"
                               id="nomor_telepon"
                               placeholder="Contoh: 8123456789 (tanpa 0 depan)"
                               class="flex-1 px-3 py-3 text-sm md:text-base focus:ring-[#002D56]"
                               required>
                    </div>
                    <div class="text-red-500 text-sm mt-1 error-nomor_telepon hidden"></div>
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Role
                    </label>
                    <select name="role" id="role" class="border border-[#DDDDDD] w-full px-3 py-3 rounded-lg text-base text-gray-500 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                        <option value="" disabled selected hidden>Pilih role</option>
                        <option value="admin">Admin</option>
                        <option value="viewer">Viewer</option>
                    </select>
                    <div class="text-red-500 text-sm mt-1 error-role hidden"></div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Password
                    </label>
                    <input type="password"
                    name="password"
                    id="password"
                    placeholder="Masukkan password (minimal 6 karakter)"
                    class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                    required>
                    <div class="text-red-500 text-sm mt-1 error-password hidden"></div>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Konfirmasi Password
                    </label>
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           placeholder="Masukkan kembali password"
                           class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                           required>
                    <div class="text-red-500 text-sm mt-1 error-password_confirmation hidden"></div>
                </div>

                <!-- Error Messages Container -->
                <div id="formErrors" class="hidden p-3 bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm"></div>

                <!-- Status (hidden) -->
                <input type="hidden" name="status" value="aktif">

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full mt-4 py-3 rounded-lg bg-[#002D56] text-sm md:text-base text-white font-semibold hover:bg-[#001F3B] transition flex items-center justify-center gap-2">
                    <span id="submitText">Tambah Admin</span>
                    <svg id="loadingSpinner" class="hidden w-5 h-5 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>

                <!-- Cancel Button -->
                <button type="button"
                        onclick="window.location.href='{{ route('admin.kontrol-admin') }}'"
                        class="w-full mt-2 py-3 rounded-lg bg-gray-200 text-sm md:text-base text-gray-700 font-semibold hover:bg-gray-300 transition">
                    Batal
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Success Toast -->
<div id="successToast" class="hidden fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg z-50">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span id="toastMessage"></span>
    </div>
</div>

<!-- Error Toast -->
<div id="errorToast" class="hidden fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg z-50">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span id="errorMessage"></span>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('tambahAdminForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    const submitText = document.getElementById('submitText');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Gunakan route name yang benar
    const apiUrl = '{{ route("admin.api.store") }}';

    console.log('API URL:', apiUrl);
    console.log('CSRF Token:', csrfToken);

    // Fungsi untuk menampilkan toast
    function showToast(message, type = 'success') {
        const toast = type === 'success' ? document.getElementById('successToast') : document.getElementById('errorToast');
        const messageElement = type === 'success' ? document.getElementById('toastMessage') : document.getElementById('errorMessage');

        if (toast && messageElement) {
            messageElement.textContent = message;
            toast.classList.remove('hidden');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }
    }

    // Fungsi untuk menampilkan error
    function showErrors(errors) {
        console.log('Showing errors:', errors);

        // Reset semua error
        document.querySelectorAll('[class^="error-"]').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });

        // Tampilkan error baru
        if (typeof errors === 'object') {
            Object.keys(errors).forEach(key => {
                const errorElement = document.querySelector(`.error-${key}`);
                if (errorElement) {
                    errorElement.textContent = Array.isArray(errors[key]) ? errors[key][0] : errors[key];
                    errorElement.classList.remove('hidden');
                }
            });
        }
    }

    // Event listener untuk form submit
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Konfirmasi sebelum submit
        if (!confirm('Apakah Anda yakin ingin menambahkan admin ini?')) {
            return;
        }

        // Tampilkan loading
        submitText.textContent = 'Memproses...';
        loadingSpinner.classList.remove('hidden');
        submitBtn.disabled = true;

        // Sembunyikan error sebelumnya
        document.querySelectorAll('[class^="error-"]').forEach(el => {
            el.classList.add('hidden');
        });

        // Ambil data dari form
        const formData = new FormData(form);
        const data = {
            name: formData.get('name'),
            email: formData.get('email'),
            nomor_telepon: formData.get('nomor_telepon'),
            role: formData.get('role'),
            status: 'aktif',
            password: formData.get('password'),
            password_confirmation: formData.get('password_confirmation')
        };

        console.log('Sending data:', data);

        try {
            // Kirim data ke backend
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            console.log('Response:', result);

            if (result.success) {
                // Tampilkan pesan sukses
                showToast(result.message || 'Admin berhasil ditambahkan!');

                // Redirect ke halaman kontrol admin setelah 2 detik
                setTimeout(() => {
                    window.location.href = '{{ route("admin.kontrol-admin") }}';
                }, 2000);
            } else {
                // Tampilkan error dari server
                if (result.errors) {
                    showErrors(result.errors);
                    showToast(result.message || 'Terdapat kesalahan dalam pengisian form', 'error');
                } else {
                    showToast(result.message || 'Gagal menambahkan admin', 'error');
                }

                submitText.textContent = 'Tambah Admin';
                loadingSpinner.classList.add('hidden');
                submitBtn.disabled = false;
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Terjadi kesalahan jaringan. Silakan coba lagi.', 'error');

            submitText.textContent = 'Tambah Admin';
            loadingSpinner.classList.add('hidden');
            submitBtn.disabled = false;
        }
    });

    // Format nomor telepon saat input
    const phoneInput = document.getElementById('nomor_telepon');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            // Hapus semua karakter non-digit
            let value = e.target.value.replace(/\D/g, '');

            // Hapus angka 0 di depan jika ada
            if (value.startsWith('0')) {
                value = value.substring(1);
            }

            // Batasi panjang maksimal 13 digit
            if (value.length > 13) {
                value = value.substring(0, 13);
            }

            e.target.value = value;
        });
    }
});
</script>
@endpush
