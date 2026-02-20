@extends('layouts.app')

@section('title', 'Laporan Perbaikan Sarpras FT UNNES')

@section('content')
<div class="p-6 mt-1 mb-10 grid max-w-7xl mx-auto lg:grid-cols-2 lg:flex">
    <div class="lg:px-10 max-w-xl mx-auto w-full">
        <div class="flex justify-between items-center w-full">
            <img src="{{ asset('img/unnes-logo-horizontal.webp') }}"
                 alt="Logo Unnes Horizontal"
                 class="h-10 w-auto">
            <a href="{{ route('home') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.56994 18.82C9.37994 18.82 9.18994 18.75 9.03994 18.6L2.96994 12.53C2.67994 12.24 2.67994 11.76 2.96994 11.47L9.03994 5.4C9.32994 5.11 9.80994 5.11 10.0999 5.4C10.3899 5.69 10.3899 6.17 10.0999 6.46L4.55994 12L10.0999 17.54C10.3899 17.83 10.3899 18.31 10.0999 18.6C9.95994 18.75 9.75994 18.82 9.56994 18.82Z" fill="#002C55"/>
                <path d="M20.4999 12.75H3.66992C3.25992 12.75 2.91992 12.41 2.91992 12C2.91992 11.59 3.25992 11.25 3.66992 11.25H20.4999C20.9099 11.25 21.2499 11.59 21.2499 12C21.2499 12.41 20.9099 12.75 20.4999 12.75Z" fill="#002C55"/>
                </svg>
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
            <form id="loginForm" method="POST" action="{{ route('auth.login.submit') }}" class="mt-5 space-y-3">
                @csrf

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-[#002D56] mb-1">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Contoh: user123@gmail.com"
                           class="w-full rounded-lg border border-[#DDDDDD] px-3 py-3 text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#002D56]">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                            <svg id="eyeSlash" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.46992 15.28C9.27992 15.28 9.08992 15.21 8.93992 15.06C8.11992 14.24 7.66992 13.15 7.66992 12C7.66992 9.61 9.60992 7.67 11.9999 7.67C13.1499 7.67 14.2399 8.12 15.0599 8.94C15.1999 9.08 15.2799 9.27 15.2799 9.47C15.2799 9.67 15.1999 9.86 15.0599 10L9.99992 15.06C9.84992 15.21 9.65992 15.28 9.46992 15.28ZM11.9999 9.17C10.4399 9.17 9.16992 10.44 9.16992 12C9.16992 12.5 9.29992 12.98 9.53992 13.4L13.3999 9.54C12.9799 9.3 12.4999 9.17 11.9999 9.17Z" fill="#959595"/>
                                <path d="M5.60009 18.51C5.43009 18.51 5.25009 18.45 5.11009 18.33C4.04009 17.42 3.08009 16.3 2.26009 15C1.20009 13.35 1.20009 10.66 2.26009 9C4.70009 5.18 8.25009 2.98 12.0001 2.98C14.2001 2.98 16.3701 3.74 18.2701 5.17C18.6001 5.42 18.6701 5.89 18.4201 6.22C18.1701 6.55 17.7001 6.62 17.3701 6.37C15.7301 5.13 13.8701 4.48 12.0001 4.48C8.77009 4.48 5.68009 6.42 3.52009 9.81C2.77009 10.98 2.77009 13.02 3.52009 14.19C4.27009 15.36 5.13009 16.37 6.08009 17.19C6.39009 17.46 6.43009 17.93 6.16009 18.25C6.02009 18.42 5.81009 18.51 5.60009 18.51Z" fill="#959595"/>
                                <path d="M12.0001 21.02C10.6701 21.02 9.37006 20.75 8.12006 20.22C7.74006 20.06 7.56006 19.62 7.72006 19.24C7.88006 18.86 8.32006 18.68 8.70006 18.84C9.76006 19.29 10.8701 19.52 11.9901 19.52C15.2201 19.52 18.3101 17.58 20.4701 14.19C21.2201 13.02 21.2201 10.98 20.4701 9.81C20.1601 9.32 19.8201 8.85 19.4601 8.41C19.2001 8.09 19.2501 7.62 19.5701 7.35C19.8901 7.09 20.3601 7.13 20.6301 7.46C21.0201 7.94 21.4001 8.46 21.7401 9C22.8001 10.65 22.8001 13.34 21.7401 15C19.3001 18.82 15.7501 21.02 12.0001 21.02Z" fill="#959595"/>
                                <path d="M12.6901 16.27C12.3401 16.27 12.0201 16.02 11.9501 15.66C11.8701 15.25 12.1401 14.86 12.5501 14.79C13.6501 14.59 14.5701 13.67 14.7701 12.57C14.8501 12.16 15.2401 11.9 15.6501 11.97C16.0601 12.05 16.3301 12.44 16.2501 12.85C15.9301 14.58 14.5501 15.95 12.8301 16.27C12.7801 16.26 12.7401 16.27 12.6901 16.27Z" fill="#959595"/>
                                <path d="M1.99994 22.75C1.80994 22.75 1.61994 22.68 1.46994 22.53C1.17994 22.24 1.17994 21.76 1.46994 21.47L8.93994 14C9.22994 13.71 9.70994 13.71 9.99994 14C10.2899 14.29 10.2899 14.77 9.99994 15.06L2.52994 22.53C2.37994 22.68 2.18994 22.75 1.99994 22.75Z" fill="#959595"/>
                                <path d="M14.53 10.22C14.34 10.22 14.15 10.15 14 10C13.71 9.71 13.71 9.23 14 8.94L21.47 1.47C21.76 1.18 22.24 1.18 22.53 1.47C22.82 1.76 22.82 2.24 22.53 2.53L15.06 10C14.91 10.15 14.72 10.22 14.53 10.22Z" fill="#959595"/>
                            </svg>

                            <!-- Eye Open -->
                            <svg id="eyeOpen" width="24" height="24" 
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="hidden">
                                <path d="M11.9999 16.33C9.60992 16.33 7.66992 14.39 7.66992 12C7.66992 9.61 9.60992 7.67 11.9999 7.67C14.3899 7.67 16.3299 9.61 16.3299 12C16.3299 14.39 14.3899 16.33 11.9999 16.33ZM11.9999 9.17C10.4399 9.17 9.16992 10.44 9.16992 12C9.16992 13.56 10.4399 14.83 11.9999 14.83C13.5599 14.83 14.8299 13.56 14.8299 12C14.8299 10.44 13.5599 9.17 11.9999 9.17Z" fill="#959595"/>
                                <path d="M12.0001 21.02C8.24008 21.02 4.69008 18.82 2.25008 15C1.19008 13.35 1.19008 10.66 2.25008 9C4.70008 5.18 8.25008 2.98 12.0001 2.98C15.7501 2.98 19.3001 5.18 21.7401 9C22.8001 10.65 22.8001 13.34 21.7401 15C19.3001 18.82 15.7501 21.02 12.0001 21.02ZM12.0001 4.48C8.77008 4.48 5.68008 6.42 3.52008 9.81C2.77008 10.98 2.77008 13.02 3.52008 14.19C5.68008 17.58 8.77008 19.52 12.0001 19.52C15.2301 19.52 18.3201 17.58 20.4801 14.19C21.2301 13.02 21.2301 10.98 20.4801 9.81C18.3201 6.42 15.2301 4.48 12.0001 4.48Z" fill="#959595"/>
                            </svg>

                    </button>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeSlash = document.getElementById('eyeSlash');

    input.type = input.type === "password" ? "text" : "password";
    eyeOpen.classList.toggle("hidden");
    eyeSlash.classList.toggle("hidden");
}
</script>
@endsection
