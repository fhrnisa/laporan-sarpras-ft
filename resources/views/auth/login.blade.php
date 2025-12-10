@extends('layouts.app')

@section('title', 'Laporan Perbaikan Sarpras FT UNNES')

@section('content')

    <div class="mt-1 mb-10 grid max-w-7xl mx-auto lg:grid-cols-2 lg:flex">

        <div class="lg:px-10 max-w-xl mx-auto w-full">
            <div class="flex justify-between items-center w-full">
                <img src="{{ asset('img/unnes-logo-horizontal.webp') }}"
                     alt="Logo Unnes Horizontal"
                     class="h-10 w-auto">

                <a href="{{ route('home') }}">
                    <img src="{{ asset('icon/arrow-left.svg') }}"
                         alt="Back Icon"
                         class="h-6 w-6">
                </a>
            </div>
            <div class="mt-5 md:p-8">
                <!-- TITLE -->
                <h1 class="text-3xl md:text-4xl font-semibold text-[#002D56]">
                    Masuk sebagai <span class="text-[#F36A00]">Admin</span>
                </h1>

                <!-- DESCRIPTION -->
                <p class="text-sm md:text-base text-[#002D56] mt-5">
                    Sistem pelaporan kerusakan sarana dan prasarana Fakultas
                    Teknik UNNES untuk mendukung kenyamanan, keamanan,
                    dan kelancaran kegiatan akademik.
                </p>

                <!-- FORM -->
                <form id="loginForm" class="mt-5 space-y-3">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-[#002D56] mb-1">Email</label>
                        <input type="email"
                               name="email"
                               placeholder="Contoh: user123@gmail.com"
                               class="w-full rounded-lg border border-[#DDDDDD] px-3 py-3 text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#002D56]">
                               <p id="emailError" class="error-text hidden"></p>
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-[#002D56] mb-1">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="min. 10 karakter"
                            class="w-full rounded-lg border border-[#DDDDDD] px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]">

                            <button type="button"
                                    onclick="togglePassword()"
                                    class="absolute mt-6 -translate-y-1/2 right-3">
                                    <!-- Eye Closed -->
                                    <img id="eyeSlash" src="{{ asset('icon/eye-slash.svg') }}" alt="" class="w-6 h-6">

                                    <!-- Eye Open -->
                                    <img id="eyeOpen" src="{{ asset('icon/eye-open.svg') }}" alt="" class="w-6 h-6 hidden">

                            </button>
                            <p id="passwordError" class="error-text hidden"></p>
                    </div>

                   <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="size-4 rounded border-[#DDDDDD] text-blue-600 focus:ring-[#002D56]" />

                        <span class="text-sm text-[#959595]">Ingat saya</span>
                    </label>


                    <!-- Button Masuk -->
                    <button type="submit"
                            class="w-full py-3 rounded-lg bg-[#002D56] text-white font-semibold hover:bg-[#001F3B] transition">
                            Masuk
                    </button>
                </form>
            </div>

            </div>

            <div class="hidden md:flex items-center justify-center px-8">
                <img src="{{ asset('img/unnes-image.webp') }}"
                    alt="Unnes Form Image"
                    class="h-[110vh] max-w-2xl object-contain rounded-xl">
            </div>

    </div>


<!-- MODAL LIMIT ACCESS -->
<!-- MODAL LIMIT ACCESS -->
<div id="limitModal" class="hidden fixed inset-0 justify-center items-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white p-6 rounded-2xl text-center max-w-md mx-4 space-y-4">
        <h2 class="text-[#002D56] font-bold text-lg lg:text-2xl">
            Akses Sementara <span class="text-[#F36A00]">Diblokir</span>
        </h2>

        <p class="text-[#002D56]">
            Sistem mendeteksi percobaan masuk yang tidak valid sebanyak 5 kali.
            Silakan menunggu hingga periode pemblokiran berakhir.
        </p>

        <p id="limitMessage" class="text-[#002D56] font-bold text-5xl tracking-wide"></p>

        <button id="closeLimitModal"
                disabled
                class="w-full py-3 rounded-lg text-white font-semibold text-lg lg:text-xl
                       bg-gray-400 cursor-not-allowed transition">
            Tutup
        </button>
    </div>
</div>



<script>
/* ============================================
   TOGGLE PASSWORD
============================================ */
function togglePassword() {
    const input = document.getElementById('password');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeSlash = document.getElementById('eyeSlash');

    input.type = input.type === "password" ? "text" : "password";
    eyeOpen.classList.toggle("hidden");
    eyeSlash.classList.toggle("hidden");
}

/* ============================================
   MODAL CONTROL
============================================ */
function showLimitModal(message) {
    document.getElementById("limitMessage").innerText = message;
    document.getElementById("limitModal").classList.remove("hidden");
    document.getElementById("limitModal").classList.add("flex");
}

function closeLimitModal() {
    document.getElementById("limitModal").classList.add("hidden");
    document.getElementById("limitModal").classList.remove("flex");
}

function setButtonDisabled(disabled) {
    const btn = document.getElementById("closeLimitModal");
    btn.disabled = disabled;

    if (disabled) {
        btn.classList.remove("bg-[#002D56]");
        btn.classList.add("bg-gray-400", "cursor-not-allowed");
    } else {
        btn.classList.remove("bg-gray-400", "cursor-not-allowed");
        btn.classList.add("bg-[#002D56]");
    }
}

/* ============================================
   COUNTDOWN SYSTEM
============================================ */
function startModalCountdown() {
    const msg = document.getElementById("limitMessage");
    const interval = setInterval(() => {
        const until = localStorage.getItem("blocked_until");

        // Tidak ada blokir → stop
        if (!until) {
            clearInterval(interval);
            return;
        }

        const diff = until - Date.now();

        // Waktu habis
        if (diff <= 0) {
            clearInterval(interval);
            msg.innerText = "00:00";
            localStorage.removeItem("blocked_until");
            setButtonDisabled(false);
            return;
        }

        // Update display
        const m = Math.floor(diff / 60000);
        const s = Math.floor((diff % 60000) / 1000);
        msg.innerText = `${m}:${s.toString().padStart(2, '0')}`;

        // Selama masih blokir → tetap disable
        setButtonDisabled(true);
    }, 1000);
}

/* ============================================
   CLOSE BUTTON CLICK
============================================ */
document.getElementById("closeLimitModal").addEventListener("click", () => {
    if (!localStorage.getItem("blocked_until")) {
        closeLimitModal();
    }
});

/* ============================================
   LOGIN HANDLER
============================================ */
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('loginForm');
    if (!form) return;

    const emailInput = document.querySelector("[name='email']");
    const passwordInput = document.querySelector("[name='password']");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");

    // Jika halaman direfresh saat masih diblokir
    if (localStorage.getItem("blocked_until")) {
        showLimitModal("10:00");
        startModalCountdown();
    }

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        // Reset error state
        emailError.classList.add("hidden");
        passwordError.classList.add("hidden");

        emailInput.classList.remove("border-red-500");
        passwordInput.classList.remove("border-red-500");

        emailInput.classList.add("border-[#DDDDDD]");
        passwordInput.classList.add("border-[#DDDDDD]");

        const email = emailInput.value;
        const password = passwordInput.value;

        try {
            const response = await fetch("http://localhost:8001/api/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            // Terlalu banyak percobaan
            if (response.status === 429) {
                const unblockTime = Date.now() + 10 * 60 * 1000;
                localStorage.setItem("blocked_until", unblockTime);

                showLimitModal("10:00");
                startModalCountdown();
                return;
            }

            // Login gagal
            if (!response.ok) {
                emailError.innerText = "Email atau password salah.";
                passwordError.innerText = "Email atau password salah.";

                emailError.classList.remove("hidden");
                passwordError.classList.remove("hidden");

                // Tambahkan border merah
                emailInput.classList.remove("border-[#DDDDDD]");
                emailInput.classList.add("border-red-500");

                passwordInput.classList.remove("border-[#DDDDDD]");
                passwordInput.classList.add("border-red-500");

                return;
            }

            // Login sukses
            localStorage.setItem("token", data.token);
            window.location.href = "/admin/dashboard";

        } catch (err) {
            alert("Error: " + err.message);
        }
    });
});
</script>


@endsection
