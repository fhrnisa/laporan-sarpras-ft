@extends('layouts.app')

@section('title', 'Laporan Perbaikan Sarpras FT UNNES')

@section('content')
<div class="mt-1 mb-10 grid max-w-7xl mx-auto lg:grid-cols-2 lg:flex">
    <!-- Form Section -->
    <div class="lg:px-10 max-w-xl mx-auto w-full">
        <div class="flex justify-between items-center w-full">
            <img src="{{ asset('img/unnes-logo-horizontal.webp') }}"
                 alt="Logo Unnes Horizontal"
                 class="h-10 md:h-12 w-auto">
            <a href="{{ route('auth.login') }}">
                <img src="{{ asset('icon/profile-icon.svg') }}"
                     alt="Profile Icon"
                     class="h-6 w-6">
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
                        <img src="{{ asset('icon/upload-icon.svg') }}" alt="Upload Icon" class="w-6 h-6">
                        <span class="text-[#959595]" id="filePlaceholder">Tambahkan foto</span>
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
<div id="successModal" class="hidden fixed inset-0 justify-center items-center bg-black/50 backdrop-blur-sm z-50">
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
            <p class="text-sm text-gray-600">ID Laporan: <span id="laporanId" class="font-semibold"></span></p>
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

<!-- MODAL RATE LIMIT -->
<div id="rateLimitModal" class="hidden fixed inset-0 justify-center items-center bg-black/50 backdrop-blur-sm z-50">
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

<!-- MODAL ERROR -->
<div id="errorModal" class="hidden fixed inset-0 justify-center items-center bg-black/50 backdrop-blur-sm z-50">
    <div class="bg-white p-6 rounded-2xl text-center max-w-md mx-4 space-y-4">
        <div class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <h2 class="text-[#002D56] font-bold text-lg lg:text-2xl">
            Gagal <span class="text-red-600">Mengirim</span>
        </h2>
        <p id="errorMessage" class="text-[#002D56]">
            Terjadi kesalahan saat mengirim laporan.
        </p>
        <button id="closeErrorModal"
                class="w-full py-3 rounded-lg text-white font-semibold text-lg lg:text-xl bg-[#002D56] hover:bg-[#001F3B] transition">
            Coba Lagi
        </button>
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
        document.getElementById('laporanId').textContent = data.laporan_id || 'N/A';
        document.getElementById('laporanTime').textContent = data.timestamp || new Date().toLocaleString('id-ID');
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
            filePlaceholder.textContent = "Tambahkan foto";
        }
    });

// Form submission handler
form.addEventListener('submit', async function(e) {
    e.preventDefault();

    if (checkRateLimit()) {
        return;
    }

    showLoading();

    // Prepare form data
    const formData = new FormData();

    // Validasi form
    const requiredFields = [
        {name: 'nama_pengusul', label: 'Nama Pengusul'},
        {name: 'email', label: 'Email'},
        {name: 'nomor_telepon', label: 'Nomor WhatsApp'},
        {name: 'lokasi_kerusakan', label: 'Lokasi Kerusakan'},
        {name: 'deskripsi_kerusakan', label: 'Deskripsi Kerusakan'}
    ];

    let hasError = false;
    for (const field of requiredFields) {
        const input = document.querySelector(`input[name='${field.name}']`);
        const value = input.value.trim();
        if (!value) {
            showErrorModal(`${field.label} harus diisi`);
            hasError = true;
            break;
        }
        formData.append(field.name, value);
    }

    if (hasError) {
        hideLoading();
        return;
    }

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
            filePlaceholder.textContent = "Tambahkan foto";

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
</style>
@endsection
