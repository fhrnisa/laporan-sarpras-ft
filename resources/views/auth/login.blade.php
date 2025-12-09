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
                <form action="#" method="POST" class="mt-5 space-y-3">
                    @csrf
        
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-[#002D56] mb-1">Email</label>
                        <input type="email"
                               name="email"
                               placeholder="Contoh: user123@gmail.com"
                               class="w-full rounded-lg border border-[#DDDDDD] px-3 py-3 text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#002D56]">
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

        if (input.type === "password") {
            input.type = "text";
            eyeOpen.classList.add("hidden");
            eyeSlash.classList.remove('hidden');
        } else {
            input.type = "password";
            eyeOpen.classList.remove("hidden");
            eyeSlash.classList.add("hidden");
        }
    }
</script>
@endsection
