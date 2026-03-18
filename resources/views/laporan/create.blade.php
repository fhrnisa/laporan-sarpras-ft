@extends('layouts.app')

@section('title', 'Laporan Perbaikan Sarpras FT UNNES')

@section('content')
<div class="px-6 md:px-0 mt-6 md:mt-10 mb-10 grid max-w-7xl mx-auto lg:grid-cols-2 lg:flex">
    <!-- Form Section -->
    <div class="lg:px-10 max-w-xl mx-auto w-full">
        <div class="flex justify-between items-center w-full">
            <img src="{{ asset('img/unnes-logo-horizontal.webp') }}"
                 alt="Logo Unnes Horizontal"
                 class="h-10 md:h-12 w-auto">
            <a href="{{ route('auth.login') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.1596 11.62C12.1296 11.62 12.1096 11.62 12.0796 11.62C12.0296 11.61 11.9596 11.61 11.8996 11.62C8.9996 11.53 6.8096 9.25 6.8096 6.44C6.8096 3.58 9.1396 1.25 11.9996 1.25C14.8596 1.25 17.1896 3.58 17.1896 6.44C17.1796 9.25 14.9796 11.53 12.1896 11.62C12.1796 11.62 12.1696 11.62 12.1596 11.62ZM11.9996 2.75C9.9696 2.75 8.3096 4.41 8.3096 6.44C8.3096 8.44 9.8696 10.05 11.8596 10.12C11.9096 10.11 12.0496 10.11 12.1796 10.12C14.1396 10.03 15.6796 8.42 15.6896 6.44C15.6896 4.41 14.0296 2.75 11.9996 2.75Z" fill="#002C55"/>
                <path d="M12.1696 22.55C10.2096 22.55 8.23961 22.05 6.74961 21.05C5.35961 20.13 4.59961 18.87 4.59961 17.5C4.59961 16.13 5.35961 14.86 6.74961 13.93C9.74961 11.94 14.6096 11.94 17.5896 13.93C18.9696 14.85 19.7396 16.11 19.7396 17.48C19.7396 18.85 18.9796 20.12 17.5896 21.05C16.0896 22.05 14.1296 22.55 12.1696 22.55ZM7.57961 15.19C6.61961 15.83 6.09961 16.65 6.09961 17.51C6.09961 18.36 6.62961 19.18 7.57961 19.81C10.0696 21.48 14.2696 21.48 16.7596 19.81C17.7196 19.17 18.2396 18.35 18.2396 17.49C18.2396 16.64 17.7096 15.82 16.7596 15.19C14.2696 13.53 10.0696 13.53 7.57961 15.19Z" fill="#002C55"/>
                </svg>
            </a>
        </div>

        <div class="mt-5 md:mt-0 md:p-8">
            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-semibold text-[#002D56]">
                Laporan Perbaikan Sarana Prasarana
                <span class="text-[#F36A00]">Fakultas Teknik</span> UNNES
            </h1>

            <!-- Description -->
            <p class="text-sm md:text-base text-[#002D56] mt-5">
                Sistem pelaporan kerusakan sarana dan prasarana Fakultas
                Teknik UNNES untuk mendukung kenyamanan, keamanan,
                dan kelancaran kegiatan akademik.
            </p>

            <!-- Form -->
            <form id="laporanForm" class="mt-5 space-y-3">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Email
                    </label>
                    <input type="email"
                           name="email"
                           placeholder="Contoh: user123@gmail.com"
                           class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                           required>
                </div>

                <!-- Nama Pengusul -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Nama Pengusul
                    </label>
                    <input type="text"
                           name="nama_pengusul"
                           placeholder="Gunakan nama lengkap"
                           class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                           required>
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
                               placeholder="Contoh: 8123456789"
                               class="flex-1 px-3 py-3 text-sm md:text-base focus:ring-[#002D56]"
                               required>
                    </div>
                </div>

                <!-- Lokasi Kerusakan -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Lokasi Kerusakan
                    </label>
                    <input type="text"
                           name="lokasi_kerusakan"
                           placeholder="Deskripsi lokasi kerusakan"
                           class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                           required>
                </div>

                <!-- Kerusakan yang Dilaporkan -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Kerusakan yang Dilaporkan
                    </label>
                    <input type="text"
                           name="deskripsi_kerusakan"
                           placeholder="Deskripsi kerusakan"
                           class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                           required>
                </div>

                <!-- Unggah Foto -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Unggah Foto Kerusakan
                    </label>
                    <label class="flex items-center gap-3 w-full px-4 py-3 text-sm md:text-base border border-[#DDDDDD] rounded-lg cursor-pointer hover:bg-gray-50 transition">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15" stroke="#959595" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 8L12 3L7 8" stroke="#959595" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 3V15" stroke="#959595" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <span class="text-[#959595]" id="filePlaceholder">Tambahkan foto. Hanya bisa .jpeg, .png, .jpg (max 2MB)</span>
                        <input type="file"
                               name="foto_kerusakan"
                               class="hidden"
                               accept="image/*">
                    </label>
                    <!-- Preview -->
                    <img id="previewImage" class="mt-3 rounded-lg hidden max-h-48 border w-full object-cover" />
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full mt-4 py-3 rounded-lg bg-[#002D56] text-sm md:text-base text-white font-semibold hover:bg-[#001F3B] transition flex items-center justify-center gap-2">
                    <span id="submitText">Kirim</span>
                    <svg id="loadingSpinner" class="hidden w-5 h-5 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Image Section -->
    <div class="hidden md:flex items-center justify-center px-8">
        <img src="{{ asset('img/unnes-image.webp') }}"
             alt="Unnes Form Image"
             class="h-[110vh] max-w-2xl object-contain rounded-xl">
    </div>
</div>

<!-- MODAL SUCCESS -->
<div id="successModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50">
    <div class="min-h-screen justify-center items-center flex">
        <div class="bg-white p-6 rounded-2xl text-center max-w-md mx-4 space-y-4">
            <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-[#002D56] font-bold text-lg lg:text-2xl">
                Laporan <span class="text-green-600">Berhasil Dikirim!</span>
            </h2>
            <p class="text-[#002D56] text-sm">
                Laporan Anda telah diterima. Kami akan memproses laporan ini secepatnya.
            </p>
            <div class="text-left bg-gray-50 p-3 rounded-lg">
                <p class="text-sm text-gray-600">Kode Laporan: <span id="laporanId" class="font-semibold"></span></p>
                <p class="text-sm text-gray-600">Waktu: <span id="laporanTime" class="font-semibold"></span></p>
                <p class="text-sm text-gray-600">Status: <span class="font-semibold text-yellow-600">Menunggu</span></p>
            </div>
            <p class="text-sm text-gray-500">
                Anda dapat mengirim laporan berikutnya dalam <span class="font-semibold">10 menit</span>
            </p>
            <button id="closeSuccessModal"
                    class="w-full py-3 rounded-lg text-white font-semibold text-lg lg:text-xl bg-[#002D56] hover:bg-[#001F3B] transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- MODAL RATE LIMIT -->
<div id="rateLimitModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50">
    <div class="min-h-screen justify-center items-center flex">
        <div class="bg-white p-6 rounded-2xl text-center max-w-md mx-4 space-y-4">
            <div class="mx-auto w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-[#002D56] font-bold text-lg lg:text-2xl">
                Tunggu Sebentar <span class="text-yellow-600">😊</span>
            </h2>
            <p class="text-[#002D56]">
                Anda baru saja mengirim laporan. Sistem membutuhkan waktu untuk memproses laporan sebelumnya.
            </p>
            <p class="text-[#002D56] font-bold text-5xl tracking-wide">
                <span id="countdownTimer">10:00</span>
            </p>
            <p class="text-sm text-gray-500">
                Anda dapat mengirim laporan berikutnya setelah timer mencapai 00:00
            </p>
            <button id="closeRateLimitModal"
                    disabled
                    class="w-full py-3 rounded-lg text-white font-semibold text-lg lg:text-xl bg-gray-400 cursor-not-allowed transition">
                Tunggu...
            </button>
        </div>
    </div>
</div>

<!-- MODAL ERROR -->
<div id="errorModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50">
    <div class="min-h-screen justify-center items-center flex">
        <div class="bg-white p-6 rounded-2xl text-center max-w-md mx-4 space-y-4">
            <div class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 36.6666C29.2048 36.6666 36.6667 29.2047 36.6667 19.9999C36.6667 10.7952 29.2048 3.33325 20 3.33325C10.7953 3.33325 3.33334 10.7952 3.33334 19.9999C3.33334 29.2047 10.7953 36.6666 20 36.6666Z" stroke="#ED3237" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M20 26.6667H20.0167" stroke="#ED3237" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M20 13.3333V19.9999" stroke="#ED3237" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h2 class="text-[#002D56] font-semibold text-lg lg:text-2xl">
                <span class="text-red-600">Terjadi kegagalan </span> dalam pemrosesan data. 
            </h2>
            <p id="errorMessage" class="text-base text-[#002D56]">
                Sistem tidak dapat menyimpan laporan Anda ke dalam database. Silakan melakukan pengiriman ulang atau mencoba kembali nanti.
            </p>
            <button id="closeErrorModal"
                    class="w-full py-3 rounded-lg text-white font-semibold text-lg lg:text-xl bg-[#002D56] hover:bg-[#001F3B] transition">
                Coba Lagi
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Element references
    const form = document.getElementById('laporanForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    const submitText = document.getElementById('submitText');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const successModal = document.getElementById('successModal');
    const rateLimitModal = document.getElementById('rateLimitModal');
    const errorModal = document.getElementById('errorModal');
    const countdownTimer = document.getElementById('countdownTimer');
    const fileInput = document.querySelector("input[name='foto_kerusakan']");
    const filePlaceholder = document.getElementById('filePlaceholder');
    const previewImage = document.getElementById('previewImage');

    // Modal close buttons
    const closeSuccessModal = document.getElementById('closeSuccessModal');
    const closeRateLimitModal = document.getElementById('closeRateLimitModal');
    const closeErrorModal = document.getElementById('closeErrorModal');

    // Countdown interval
    let countdownInterval = null;

    // Loading state functions
    function showLoading() {
        submitBtn.disabled = true;
        submitText.textContent = 'Mengirim...';
        loadingSpinner.classList.remove('hidden');
    }

    function hideLoading() {
        submitBtn.disabled = false;
        submitText.textContent = 'Kirim';
        loadingSpinner.classList.add('hidden');
    }

    // Modal functions
    function showSuccessModal(data) {
        document.getElementById('laporanId').textContent =
            data.kode_laporan || data.laporan_id || 'N/A';

        document.getElementById('laporanTime').textContent =
            data.timestamp || new Date().toLocaleString('id-ID');

        successModal.classList.remove('hidden');
    }

    function showRateLimitModal() {
        rateLimitModal.classList.remove('hidden');
    }

    function showErrorModal(message) {
        document.getElementById('errorMessage').textContent = message;
        errorModal.classList.remove('hidden');
    }

    function hideAllModals() {
        successModal.classList.add('hidden');
        rateLimitModal.classList.add('hidden');
        errorModal.classList.add('hidden');
    }

    // Close modal handlers
    closeSuccessModal.addEventListener('click', () => {
        successModal.classList.add('hidden');
    });

    closeErrorModal.addEventListener('click', () => {
        errorModal.classList.add('hidden');
    });

    // Rate limit functions
    function checkRateLimit() {
        const rateLimit = localStorage.getItem('laporan_rate_limit');
        if (rateLimit) {
            const limitTime = parseInt(rateLimit);
            const now = Date.now();
            if (now < limitTime) {
                const remaining = Math.ceil((limitTime - now) / 1000);
                startCountdown(remaining);
                showRateLimitModal();
                return true;
            } else {
                localStorage.removeItem('laporan_rate_limit');
            }
        }
        return false;
    }

    function startCountdown(seconds) {
        if (countdownInterval) clearInterval(countdownInterval);

        function updateTimer() {
            const mins = Math.floor(seconds / 60);
            const secs = seconds % 60;
            countdownTimer.textContent = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;

            if (seconds <= 0) {
                clearInterval(countdownInterval);
                closeRateLimitModal.disabled = false;
                closeRateLimitModal.textContent = 'Tutup';
                closeRateLimitModal.classList.remove('bg-gray-400', 'cursor-not-allowed');
                closeRateLimitModal.classList.add('bg-[#002D56]', 'hover:bg-[#001F3B]');
                localStorage.removeItem('laporan_rate_limit');
            } else {
                seconds--;
            }
        }

        updateTimer();
        countdownInterval = setInterval(updateTimer, 1000);
    }

    closeRateLimitModal.addEventListener('click', function() {
        if (!this.disabled) {
            rateLimitModal.classList.add('hidden');
            this.disabled = true;
            this.textContent = 'Tunggu...';
            this.classList.remove('bg-[#002D56]', 'hover:bg-[#001F3B]');
            this.classList.add('bg-gray-400', 'cursor-not-allowed');
        }
    });

    // Image preview handler
    fileInput.addEventListener("change", function(event) {
        const file = event.target.files[0];

        if (file) {
            // File size validation (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                showErrorModal('Ukuran file maksimal 2MB');
                this.value = '';
                return;
            }

            // File type validation
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                showErrorModal('Format file harus JPEG, PNG, JPG, atau GIF');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove("hidden");
            };
            reader.readAsDataURL(file);

            filePlaceholder.textContent = file.name;
        } else {
            previewImage.classList.add("hidden");
            filePlaceholder.textContent = "Tambahkan foto. Hanya bisa .jpeg, .png, .jpg (max 2MB)";
        }
    });

// Tambahkan validasi sebelum submit form
form.addEventListener('submit', async function(e) {
    e.preventDefault();

    if (checkRateLimit()) {
        return;
    }

    showLoading();

    // Validasi lengkap
    const namaInput = document.querySelector("input[name='nama_pengusul']");
    const emailInput = document.querySelector("input[name='email']");
    const teleponInput = document.querySelector("input[name='nomor_telepon']");
    const lokasiInput = document.querySelector("input[name='lokasi_kerusakan']");
    const deskripsiInput = document.querySelector("input[name='deskripsi_kerusakan']");

    // Reset error border
    [namaInput, emailInput, teleponInput, lokasiInput, deskripsiInput].forEach(input => {
        input.classList.remove('border-red-500');
    });

    let isValid = true;
    let errorMessage = '';

    // Validasi nama
    if (!namaInput.value.trim()) {
        namaInput.classList.add('border-red-500');
        isValid = false;
        errorMessage = 'Nama Pengusul harus diisi';
    }

    // Validasi email
    if (!emailInput.value.trim()) {
        emailInput.classList.add('border-red-500');
        isValid = false;
        errorMessage = 'Email harus diisi';
    } else if (!emailInput.value.includes('@') || !emailInput.value.includes('.')) {
        emailInput.classList.add('border-red-500');
        isValid = false;
        errorMessage = 'Format email tidak valid';
    }

    // Validasi nomor telepon
    if (!teleponInput.value.trim()) {
        teleponInput.parentElement.classList.add('border-red-500');
        isValid = false;
        errorMessage = 'Nomor WhatsApp harus diisi';
    } else {
        // Hilangkan karakter selain angka
        const cleanNumber = teleponInput.value.replace(/\D/g, '');

        // Validasi: tidak boleh diawali 0, hanya angka
        if (cleanNumber.charAt(0) === '0') {
            teleponInput.parentElement.classList.add('border-red-500');
            isValid = false;
            errorMessage = 'Nomor tidak boleh diawali dengan 0';
        } else if (cleanNumber.length < 9 || cleanNumber.length > 13) {
            teleponInput.parentElement.classList.add('border-red-500');
            isValid = false;
            errorMessage = 'Nomor harus 9-13 digit';
        } else if (!/^\d+$/.test(cleanNumber)) {
            teleponInput.parentElement.classList.add('border-red-500');
            isValid = false;
            errorMessage = 'Nomor harus berupa angka';
        }

        // Format nomor untuk database (tambah 0 di depan)
        teleponInput.value = '0' + cleanNumber;
    }

    // Validasi lokasi
    if (!lokasiInput.value.trim()) {
        lokasiInput.classList.add('border-red-500');
        isValid = false;
        errorMessage = 'Lokasi Kerusakan harus diisi';
    }

    // Validasi deskripsi
    if (!deskripsiInput.value.trim()) {
        deskripsiInput.classList.add('border-red-500');
        isValid = false;
        errorMessage = 'Deskripsi Kerusakan harus diisi';
    }

    if (!isValid) {
        showErrorModal(errorMessage);
        hideLoading();
        return;
    }

    // Prepare form data
    const formData = new FormData();

    // Tambahkan semua data
    formData.append('nama_pengusul', namaInput.value.trim());
    formData.append('email', emailInput.value.trim());
    formData.append('nomor_telepon', teleponInput.value); // Sudah ada 0 di depan
    formData.append('lokasi_kerusakan', lokasiInput.value.trim());
    formData.append('deskripsi_kerusakan', deskripsiInput.value.trim());

    if (fileInput.files[0]) {
        formData.append('foto_kerusakan', fileInput.files[0]);
    }

    try {
        console.log('Sending request to BE API...');

        const response = await fetch("http://localhost:8001/api/laporan", {
            method: "POST",
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        console.log('Response status:', response.status);

        // Get response as text first
        const responseText = await response.text();
        console.log('Raw response (first 500 chars):', responseText.substring(0, 500));

        let data;
        try {
            data = JSON.parse(responseText);
        } catch (jsonError) {
            console.error('JSON parse error:', jsonError);

            // Check if it's HTML error page
            if (responseText.includes('<!DOCTYPE') || responseText.includes('<html')) {
                showErrorModal('Server mengalami error internal. Cek log server.');
            } else {
                showErrorModal('Format response tidak valid.');
            }
            return;
        }

        if (response.ok && data.success) {
            showSuccessModal(data);

            // Set rate limit
            localStorage.setItem('laporan_rate_limit', (Date.now() + 600000).toString());

            // Reset form
            form.reset();
            previewImage.classList.add('hidden');
            filePlaceholder.textContent = "Tambahkan foto. Hanya bisa .jpeg, .png, .jpg (max 2MB)";

        } else if (response.status === 429) {
            const waitTime = data.wait_time || 600;
            startCountdown(waitTime);
            showRateLimitModal();

            localStorage.setItem('laporan_rate_limit', (Date.now() + waitTime * 1000).toString());

        } else if (response.status === 422) {
            const errors = data.errors || {};
            const errorMessages = Object.values(errors).flat().join(', ');
            showErrorModal(`Validasi gagal: ${errorMessages || data.message}`);

        } else {
            showErrorModal(data.message || `Error ${response.status}: Gagal mengirim laporan`);
        }

    } catch (err) {
        console.error('Network error:', err);

        if (err.message.includes('Failed to fetch')) {
            showErrorModal('Tidak dapat terhubung ke server. Pastikan BE API berjalan di port 8001.');
        } else {
            showErrorModal('Error jaringan: ' + err.message);
        }
    } finally {
        hideLoading();
    }
});

// Tambahkan fungsi ini di script
function showFieldError(field, message) {
    const input = document.querySelector(`[name="${field}"]`);
    const label = document.querySelector(`label[for="${field}"]`);

    if (input) {
        input.classList.add('border-red-500', 'shake');
        input.focus();

        // Tambahkan pesan error
        let errorDiv = input.parentElement.querySelector('.error-message');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'error-message text-red-500 text-xs mt-1';
            input.parentElement.appendChild(errorDiv);
        }
        errorDiv.textContent = message;

        // Hapus setelah 3 detik
        setTimeout(() => {
            input.classList.remove('border-red-500', 'shake');
            if (errorDiv) errorDiv.remove();
        }, 3000);
    }
}

// Panggil di validasi
if (!emailInput.value.includes('@')) {
    showFieldError('email', 'Email harus mengandung @');
    isValid = false;
}
});
</script>

<style>
/* Modal animations */
#successModal > div,
#rateLimitModal > div,
#errorModal > div {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Countdown animation */
#countdownTimer {
    font-family: monospace;
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    padding: 10px 20px;
    border-radius: 10px;
    display: inline-block;
}

/* Loading spinner animation */
.animate-spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* Button loading state */
button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Tambahkan di style section */
.border-red-500 {
    border-color: #ef4444 !important;
    border-width: 2px !important;
}

/* Animasi untuk error */
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.shake {
    animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
}
</style>
@endsection
