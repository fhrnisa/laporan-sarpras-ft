@extends('layouts.app')

@section('title', 'Laporan Perbaikan Sarpras FT UNNES')

@section('content')

    <div class="mt-1 mb-10 grid max-w-7xl mx-auto lg:grid-cols-2 lg:flex">
    
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
                <!-- TITLE -->
                <h1 class="text-3xl md:text-4xl font-semibold text-[#002D56]">
                    Laporan Perbaikan Sarana Prasarana <span class="text-[#F36A00]">Fakultas Teknik</span> UNNES
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
                        <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">Email</label>
                        <input type="email"
                               name="email"
                               placeholder="Contoh: user123@gmail.com"
                               class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#002D56]">
                    </div>
        
                    <!-- Nama Pengusul -->
                    <div>
                        <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">Nama Pengusul</label>
                        <input type="text"
                               name="pengusul"
                               placeholder="Gunakan nama lengkap"
                               class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]">
                    </div>
        
                    <!-- Nomor WhatsApp -->
                    <div>
                        <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">Nomor WhatsApp</label>
        
                        <div class="flex items-center rounded-lg border border-[#DDDDDD] overflow-hidden">
                            <span class="px-3 py-3 bg-gray-100 text-gray-700">+62</span>
                            <input type="text"
                                   name="whatsapp"
                                   placeholder="Contoh: 8123456789"
                                   class="flex-1 px-3 py-3 text-sm md:text-base focus:ring-[#002D56]">
                        </div>
                    </div>
        
                    <!-- Lokasi Kerusakan -->
                    <div>
                        <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">Lokasi Kerusakan</label>
                        <input type="text"
                               name="lokasi"
                               placeholder="Deskripsi lokasi kerusakan"
                               class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]">
                    </div>
        
                    <!-- Kerusakan yang Dilaporkan -->
                    <div>
                        <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">Kerusakan yang Dilaporkan</label>
                        <input type="text"
                               name="kerusakan"
                               placeholder="Deskripsi kerusakan"
                               class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]">
                    </div>
        
                    <!-- Unggah Foto -->
                    <div>
                        <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">Unggah Foto Kerusakan</label>
                        <label class="flex items-center gap-3 w-full px-4 py-3 text-sm md:text-base border border-[#DDDDDD] rounded-lg cursor-pointer hover:bg-gray-50 transition">
            
                            <!-- Icon Upload -->
                            <img src="{{ asset('icon/upload-icon.svg') }}" alt="Upload Icon" class="w-6 h-6">
        
                            <!-- Placeholder -->
                            <span class="text-[#959595]">Tambahkan foto</span>
        
                            <!-- Hidden Input -->
                            <input
                                type="file"
                                name="foto"
                                class="hidden"
                                accept="image/*">
                        </label>
                    </div>
        
                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full mt-4 py-3 rounded-lg bg-[#002D56] text-sm md:text-base text-white font-semibold hover:bg-[#001F3B] transition">
                            Kirim
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
@endsection
