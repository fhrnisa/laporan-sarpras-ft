@extends('layouts.admin')

@section('title', 'Tambah Admin')

@section('hideTopbar', true)

@section('content')

<div class="bg-white shadow-lg m-4">
    <div class="mt-5 md:mt-0 md:p-12 items-center justify-center">
        <div class="items-center">
            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-semibold text-[#002D56]">
                Tambah
                <span class="text-[#F36A00]">Admin</span>
            </h1>

        </div>

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
                    name="nama_lengkap"
                    placeholder="Masukkan nama lengkap"
                    class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                    required>
                </div>
                
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

                <!-- Role -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Role
                    </label>
                    <div class="flex items-center gap-3">
                        <select id="roleOption" class="border border-[#DDDDDD] w-full px-3 py-3 rounded-lg text-base text-gray-500 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                            <option value="" disabled selected hidden>Pilih role</option>
                            <option value="Admin" class="text-[#002C55]">Admin</option>
                            <option value="Viewer" class="text-[#002C55]">Viewer</option>
                        </select>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm md:text-base font-semibold text-[#002D56] mb-1">
                        Password
                    </label>
                    <input type="password"
                           name="password"
                           placeholder="Masukkan password"
                           class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                           required>
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

@endsection