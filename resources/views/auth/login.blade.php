@extends('layouts.app')

@section('title', 'Laporan Perbaikan Sarpras FT UNNES')

@section('content')

    <div class="mt-1 mb-10 grid max-w-7xl mx-auto md:grid-cols-2 md:flex">
    
        <div class="md:px-10 max-w-xl mx-auto w-full">
            <div class="flex justify-between items-center w-full">
                <img src="{{ asset('img/unnes-logo-horizontal.png') }}" 
                     alt="Logo Unnes Horizontal" 
                     class="h-10 w-auto">
    
                <a href="#">
                    <img src="{{ asset('icon/arrow-left.png') }}"
                         alt="Profile Icon"
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
                        <input type="password"
                               name="password"
                               placeholder="min. 10 karakter"
                               class="w-full rounded-lg border border-[#DDDDDD] px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]">

                    <!-- Button eye slash dan open belum dibenarkan -->
                            <button type="button" 
                                    id="togglePassword"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-500">

                                    <img id="eyeClosed" src="{{ asset('icon/eye-slash.png') }}" alt="" class="w-6 h-6">
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
                <img src="{{ asset('img/unnes-image.png') }}"
                    alt="Unnes Form Image"
                    class="h-[110vh] max-w-2xl object-contain rounded-xl">
            </div>

    </div>
@endsection
