@extends('layouts.admin')

@section('title', 'Kontrol Admin')
@section('page-title', 'Kontrol Admin')
@section('showSearch', true)

@section('search-placeholder', 'Cari admin')
@section('search-mode', 'admin')

@section('content')
<div class="space-y-6">

    <!-- FILTER SECTION -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Filter Status -->
            <div class="flex items-center gap-3">
                <span class="text-[#002C55] font-medium">Status</span>
                <select id="filterStatus" class="border border-[#DDDDDD] rounded-lg text-sm text-[#002C55] py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                    <option value="all">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="tidak_aktif">Tidak Aktif</option>
                </select>
            </div>

            <!-- Filter Tanggal -->
            <div class="flex items-center gap-3">
                <span class="text-[#002C55] font-medium">Tanggal</span>
                <select id="filterTanggal" class="border border-[#DDDDDD] rounded-lg text-sm text-[#002C55] py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                    <option value="semua">Semua</option>
                    <option value="7hari">7 Hari Terakhir</option>
                    <option value="30hari">30 Hari Terakhir</option>
                    <option value="bulan">Bulan Ini</option>
                </select>
            </div>
        </div>

        <!-- BUTTONS -->
        @if(session('user.role') === 'admin')
        <div class="flex gap-3 items-center">
            <button id="addadminBtn"
                class="bg-[#022C55] text-white text-base rounded-lg py-2 px-4 flex gap-2 items-center hover:bg-[#01408C] transition-colors">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12.75C8.83 12.75 6.25 10.17 6.25 7C6.25 3.83 8.83 1.25 12 1.25C15.17 1.25 17.75 3.83 17.75 7C17.75 10.17 15.17 12.75 12 12.75ZM12 2.75C9.66 2.75 7.75 4.66 7.75 7C7.75 9.34 9.66 11.25 12 11.25C14.34 11.25 16.25 9.34 16.25 7C16.25 4.66 14.34 2.75 12 2.75Z" fill="white"/>
                    <path d="M3.41016 22.75C3.00016 22.75 2.66016 22.41 2.66016 22C2.66016 17.73 6.85015 14.25 12.0002 14.25C13.0102 14.25 14.0001 14.38 14.9601 14.65C15.3601 14.76 15.5902 15.17 15.4802 15.57C15.3702 15.97 14.9601 16.2 14.5602 16.09C13.7402 15.86 12.8802 15.75 12.0002 15.75C7.68015 15.75 4.16016 18.55 4.16016 22C4.16016 22.41 3.82016 22.75 3.41016 22.75Z" fill="white"/>
                    <path d="M18 22.75C16.82 22.75 15.7 22.31 14.83 21.52C14.48 21.22 14.17 20.85 13.93 20.44C13.49 19.72 13.25 18.87 13.25 18C13.25 16.75 13.73 15.58 14.59 14.69C15.49 13.76 16.7 13.25 18 13.25C19.36 13.25 20.65 13.83 21.53 14.83C22.31 15.7 22.75 16.82 22.75 18C22.75 18.38 22.7 18.76 22.6 19.12C22.5 19.57 22.31 20.04 22.05 20.45C21.22 21.87 19.66 22.75 18 22.75ZM18 14.75C17.11 14.75 16.29 15.1 15.67 15.73C15.08 16.34 14.75 17.14 14.75 18C14.75 18.59 14.91 19.17 15.22 19.67C15.38 19.95 15.59 20.2 15.83 20.41C16.43 20.96 17.2 21.26 18 21.26C19.13 21.26 20.2 20.66 20.78 19.69C20.95 19.41 21.08 19.09 21.15 18.78C21.22 18.52 21.25 18.27 21.25 18.01C21.25 17.21 20.95 16.44 20.41 15.84C19.81 15.14 18.93 14.75 18 14.75Z" fill="white"/>
                    <path d="M19.4998 18.73H16.5098C16.0998 18.73 15.7598 18.39 15.7598 17.98C15.7598 17.57 16.0998 17.23 16.5098 17.23H19.4998C19.9098 17.23 20.2498 17.57 20.2498 17.98C20.2498 18.39 19.9098 18.73 19.4998 18.73Z" fill="white"/>
                    <path d="M18 20.26C17.59 20.26 17.25 19.92 17.25 19.51V16.52C17.25 16.11 17.59 15.77 18 15.77C18.41 15.77 18.75 16.11 18.75 16.52V19.51C18.75 19.93 18.41 20.26 18 20.26Z" fill="white"/>
                </svg>
                Tambah Admin
            </button>
            @endif
        </div>
    </div>


    <!-- TABLE SECTION -->
    <div class="bg-white border border-[#DDDDDD] rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- HEADER -->
                <thead class="bg-[#002C55]">
                    <tr>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Nama Admin</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Nomor WhatsApp</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Dibuat</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-base font-medium text-white tracking-wider">Waktu Aktif</th>
                        <!-- Aksi -->
                        <th class="action-cell px-6 py-3 text-left text-base font-medium text-white tracking-wider">
                            Aksi
                        </th>

                        <!-- Checkbox Column (Hidden by default) -->
                        <th class="checkbox-cell hidden px-6 py-3 text-left text-base font-medium text-gray-500 tracking-wider">
                            <input type="checkbox" id="select-all" class="rounded border-gray-300">
                        </th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="bg-white divide-y divide-gray-200" id="adminTableBody">
                    @if(isset($admins) && count($admins) > 0)
                        @foreach($admins as $admin)
                        <tr class="hover:bg-gray-50 transition-colors admin-row" data-id="{{ $admin->id }}">
                            <!-- ID -->
                            <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                                {{ $admin->kode ?? '#' . $admin->id }}
                            </td>

                            <!-- Nama -->
                            <td class="max-w-[200px] px-6 py-4 text-base text-[#002C55]">
                                {{ $admin->name }}
                            </td>

                            <!-- Email -->
                            <td class="max-w-[200px] px-6 py-4 text-base text-[#002C55]">
                                {{ $admin->email }}
                            </td>

                            <!-- Nomor WhatsApp -->
                            <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                                @php
                                    // Pastikan nomor sudah ada 0 di depan
                                    $nomor = $admin->nomor_telepon ?? '';
                                    if ($nomor && $nomor[0] !== '0') {
                                        $nomor = '0' . $nomor;
                                    }
                                    $whatsappLink = $nomor ? 'https://wa.me/62' . substr($nomor, 1) : '#';
                                @endphp

                                @if($nomor)
                                    <a href="{{ $whatsappLink }}"
                                    target="_blank"
                                    class="flex items-center gap-2 text-blue-600 hover:text-blue-800 hover:underline">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.76.982.998-3.675-.236-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.9 6.994c-.004 5.45-4.438 9.88-9.888 9.88m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.333.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.333 11.893-11.893 0-3.18-1.24-6.162-3.495-8.411"/>
                                        </svg>
                                        {{ $nomor }}
                                    </a>
                                @else
                                    N/A
                                @endif
                            </td>

                            <!-- Tanggal Dibuat -->
                            <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                                {{ \Carbon\Carbon::parse($admin->created_at)->translatedFormat('d M Y') }}
                            </td>

                            <!-- Role -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $roleColors = [
                                        'viewer' => 'bg-[#DDDDDD] text-[#022C55]',
                                        'admin' => 'bg-blue-100 text-[#022C55]'
                                    ];
                                @endphp
                                <span class="px-4 py-2 text-sm font-medium rounded-sm {{ $roleColors[$admin->role] ?? 'bg-gray-200' }}">
                                    {{ ucfirst($admin->role) }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'aktif' => 'bg-green-100 text-green-800',
                                        'tidak_aktif' => 'bg-red-100 text-red-800'
                                    ];
                                @endphp
                                <span class="px-4 py-2 text-sm font-medium rounded-sm {{ $statusColors[$admin->status] ?? 'bg-gray-200' }}">
                                    {{ ucfirst($admin->status) }}
                                </span>
                            </td>

                            <!-- Waktu Aktif -->
                            <td class="px-6 py-4 whitespace-nowrap text-base text-[#002C55]">
                                @php
                                    // Mengambil log terbaru dari relasi logs
                                    $latestLog = $admin->logs->first(); 
                                @endphp

                                @if($latestLog)
                                    <div class="flex flex-col">
                                        <span class="font-medium">
                                            {{ \Carbon\Carbon::parse($latestLog->created_at)->translatedFormat('d M Y, H:i') }}
                                        </span>
                                        <span class="text-xs text-blue-500 italic">
                                            {{ $latestLog->activity }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-gray-400 italic text-sm">Belum pernah aktif</span>
                                @endif
                            </td>

                            <!-- ACTION CELL -->
                            <td class="text-center action-cell px-6 py-4">
                                <div class="relative inline-block">
                                    <button class="aksiBtn p-1 hover:bg-gray-100 rounded">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12C18 12.5523 18.4477 13 19 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13Z" stroke="#002C55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div class="aksiDropdown absolute right-0 mt-1 w-48 bg-white rounded-md shadow-lg border z-10 hidden">
                                        <button class="editAdminBtn w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                data-id="{{ $admin->id }}"
                                                data-name="{{ $admin->name }}"
                                                data-email="{{ $admin->email }}"
                                                data-phone="{{ $admin->nomor_telepon }}"
                                                data-role="{{ $admin->role }}"
                                                data-status="{{ $admin->status }}">
                                            <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit Admin
                                        </button>
                                        <button class="changeStatusBtn w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                data-id="{{ $admin->id }}"
                                                data-status="{{ $admin->status }}">
                                            <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Ubah Status
                                        </button>
                                        <button class="deleteAdminBtn w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                                                data-id="{{ $admin->id }}">
                                            <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus Admin
                                        </button>
                                    </div>
                                </div>
                            </td>

                            <!-- Checkbox muncul saat mode kelola -->
                            <td class="checkbox-cell hidden px-6 py-4">
                                <input type="checkbox" class="admin-checkbox" value="{{ $admin->id }}">
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                                Tidak ada data admin
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Menampilkan <span id="fromCount">1</span> sampai <span id="toCount">10</span> dari <span id="totalCount">{{ $total ?? 0 }}</span> data
                </div>
            </div>
        </div>
    </div>
</div>


<!-- === MODAL TAMBAH/EDIT ADMIN === -->
<div id="adminModal" class="hidden fixed inset-0 bg-black/40 z-50">
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-[100vh] max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="flex justify-between items-center p-5 border-b border-[#DDDDDD]">
                <h2 id="modalTitle" class="text-2xl font-semibold text-[#002C55]">Tambah <span class="text-[#F36A00]">Admin Baru</span></h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-2xl">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.00098 5L19 18.9991" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.99996 18.9991L18.999 5" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                </button>
            </div>

            <!-- Form -->
            <form id="adminForm" class="p-5 space-y-4"
            action="/admin" method="POST">
                <input type="hidden" id="adminId">

                <div>
                    <label for="name" class="block text-base font-medium text-[#002D56] mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text"
                    name="name"
                    id="name"
                    placeholder="Contoh: Budi Santoso"
                    class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                    required>
                    <div class="text-red-500 text-sm mt-1 error-name hidden"></div>
                </div>

                <div>
                    <label for="email" class="block text-base font-medium text-[#002D56] mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email"
                           name="email"
                           id="email"
                           placeholder="Contoh: user123@gmail.com"
                           class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                           required>
                    <div class="text-red-500 text-sm mt-1 error-email hidden"></div>
                </div>

                <div>
                    <label class="block text-base font-medium text-[#002D56] mb-1">Nomor WhatsApp <span class="text-red-500">*</span></label>
                    <div class="flex items-center rounded-lg border border-[#DDDDDD] overflow-hidden">
                        <span class="px-3 py-3 bg-gray-100 text-gray-700">+62</span>
                        <input type="text" name="nomor_telepon" id="nomor_telepon"
                               placeholder="Contoh: 8123456789"
                               class="flex-1 px-3 py-3 text-sm md:text-base focus:ring-[#002D56]"
                               required>
                    </div>
                    <div class="text-red-500 text-sm mt-1 error-nomor_telepon hidden"></div>
                </div>

                <div>
                    <label for="role" class="block text-base font-medium text-[#002D56] mb-1">Role <span class="text-red-500">*</span></label>
                    <select name="role" id="role" class="border border-[#DDDDDD] w-full px-3 py-3 rounded-lg text-base text-gray-500 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                        <option value="" disabled selected hidden>Pilih role</option>
                        <option value="admin">Admin</option>
                        <option value="viewer">Viewer</option>
                    </select>
                    <div class="text-red-500 text-sm mt-1 error-role hidden"></div>
                    <p id="roleHelper" class="text-sm text-gray-500 mt-1"></p>
                </div>

                <div id="passwordFields" class="space-y-4">
                    <div>
                        <label for="password" class="block text-base font-medium text-[#002D56] mb-1">Password <span class="text-red-500">*</span></label>
                        <input type="password"
                            name="password"
                            id="password"
                            placeholder="Masukkan password"
                            class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                            required>
                            <div class="text-red-500 text-sm mt-1 error-password hidden"></div>
                        <p id="passwordMessage" class="text-sm text-gray-500 mt-1">
                            Minimal 6 karakter
                        </p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-base font-medium text-[#002D56] mb-1">Konfirmasi Password <span class="text-red-500">*</span></label>
                        <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           placeholder="Masukkan kembali password"
                           class="w-full rounded-lg border border-[#DDDDDD] text-sm md:text-base px-3 py-3 focus:outline-none focus:ring-1 focus:ring-[#002D56]"
                           required>
                    <div class="text-red-500 text-sm mt-1 error-password_confirmation hidden"></div>
                    </div>
                </div>

                <!-- Error Messages -->
                <div id="formErrors" class="hidden p-3 bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm"></div>
            </form>

            <!-- Footer -->
            <div class="p-5 border-t border-[#DDDDDD] flex justify-end gap-3">
                <button id="cancelBtn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Batal
                </button>
                <button id="submitBtn" class="px-4 py-2 bg-[#002C55] text-white rounded-lg hover:bg-[#01408C]">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>


<!-- TOAST NOTIFICATION -->
<div id="toast"
     role="status"
     aria-live="polite"
     class="fixed top-20 left-1/2 -translate-x-1/2 z-50 hidden pointer-events-none">
    <div id="toastInner" 
         class="flex items-center gap-3 px-6 py-4 rounded-lg border shadow-lg min-w-[320px] max-w-md transform -translate-y-10 opacity-0 transition-all duration-300 ease-out pointer-events-auto">
        <div id="toastIcon" class="w-10 h-10 flex items-center justify-center rounded-full shrink-0">
            <!-- Icon akan diisi via JS -->
        </div>
        <span id="toastMessage" class="text-base font-medium grow text-center"></span>
    </div>
</div>


<!-- CONFIRM MODAL -->
<div id="confirmModal"
     class="fixed inset-0 bg-black/40 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl w-full max-w-md p-6">
            <h3 id="confirmTitle"
                class="text-xl font-semibold text-[#002C55] mb-2">
                Konfirmasi
            </h3>
    
            <p id="confirmMessage"
               class="text-gray-600 mb-6">
            </p>
    
            <div class="flex gap-3">
                <button id="confirmCancel"
                        class="flex-1 px-4 py-2 border rounded-lg">
                    Batal
                </button>
                <button id="confirmOk"
                        class="flex-1 px-4 py-2 rounded-lg text-white">
                    Ya
                </button>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
document.addEventListener("DOMContentLoaded", () => {
    const baseUrl = '{{ env("BE_API_URL") }}/admin/admins';
    const csrfToken = '{{ csrf_token() }}';

    // Elements
    const addAdminBtn = document.getElementById("addadminBtn");
    const kelolaBtn = document.getElementById("kelolaBtn");
    const batalBtn = document.getElementById("batalBtn");
    const manageOptions = document.getElementById("manageOptions");
    const hapusBtn = document.querySelector("hapusBtn");

    const actionCells = document.querySelectorAll(".action-cell");
    const checkboxCells = document.querySelectorAll(".checkbox-cell");
    const adminCheckboxes = document.querySelectorAll(".admin-checkbox");
    const selectAll = document.getElementById("select-all");

    // Modal elements
    const adminModal = document.getElementById("adminModal");
    const confirmModal = document.getElementById("confirmModal");
    const successToast = document.getElementById("successToast");

    // Filter elements - FIXED SELECTORS
    const searchInput = document.querySelector('input[type="search"], input[name="search"], .search-input, #topbarSearch');
    const filterStatus = document.getElementById("filterStatus");
    const filterTanggal = document.getElementById("filterTanggal");

    // === SET FILTER VALUES FROM URL ===
    function setFilterValuesFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);

        // Set filter status
        if (filterStatus) {
            const statusParam = urlParams.get('status');
            if (statusParam) {
                filterStatus.value = statusParam;
            } else {
                filterStatus.value = 'all';
            }
        }

        // Set filter tanggal
        if (filterTanggal) {
            const tanggalParam = urlParams.get('tanggal');
            if (tanggalParam) {
                filterTanggal.value = tanggalParam;
            } else {
                filterTanggal.value = 'semua';
            }
        }

        // Set search input
        if (searchInput) {
            const searchParam = urlParams.get('search');
            if (searchParam) {
                searchInput.value = searchParam;
            }
        }
    }

    function applyFilters() {
        const params = new URLSearchParams();

        const searchValue = searchInput ? searchInput.value.trim() : '';

        if (filterStatus && filterStatus.value !== 'all') {
            params.append('status', filterStatus.value);
        }

        if (filterTanggal && filterTanggal.value !== 'semua') {
            params.append('tanggal', filterTanggal.value);
        }

        if (searchValue) {
            params.append('search', searchValue);
        }

        const currentPage = new URLSearchParams(window.location.search).get('page');
        if (currentPage) {
            params.append('page', currentPage);
        }

        const basePath = window.location.pathname;
        const queryString = params.toString();

        window.location.href = `${basePath}${queryString ? '?' + queryString : ''}`;
    }

    // === EVENT LISTENERS ===

    // Initialize filter values from URL
    setFilterValuesFromUrl();

    // Search input dengan debounce
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                applyFilters();
            }, 800);
        });
    }

    // Filter change events
    if (filterStatus) {
        filterStatus.addEventListener('change', function() {
            applyFilters();
        });
    }

    if (filterTanggal) {
        filterTanggal.addEventListener('change', function() {
            applyFilters();
        });
    }

    // === MODE KELOLA ===
    if (kelolaBtn) {
        kelolaBtn.addEventListener("click", () => {
            kelolaBtn.classList.add("hidden");
            if (manageOptions) manageOptions.classList.remove("hidden");

            // Tampilkan checkbox, sembunyikan action cell
            actionCells.forEach(cell => cell.classList.add("hidden"));
            checkboxCells.forEach(cell => cell.classList.remove("hidden"));
        });
    }

    // Hapus multiple (tombol hapus di mode kelola)
    if (hapusBtn) {
        hapusBtn.addEventListener("click", () => {
            const selectedIds = getSelectedAdminIds();
            if (selectedIds.length === 0) {
                showToast('Pilih admin terlebih dahulu', 'error');
                return;
            }

            showConfirmModal(
                'Hapus Admin Terpilih',
                `Apakah Anda yakin ingin menghapus ${selectedIds.length} admin terpilih?`,
                () => deleteMultipleAdmins(selectedIds)
            );
        });
    }

    // === MODAL FUNCTIONS ===

    // Tambah Admin button
    if (addAdminBtn) {
        addAdminBtn.addEventListener("click", (e) => {
            e.preventDefault();
            openAdminModal('add');
        });
    }

    // Close modal buttons
    if (document.getElementById("closeModal")) {
        document.getElementById("closeModal").addEventListener("click", () => adminModal.classList.add("hidden"));
    }
    if (document.getElementById("cancelBtn")) {
        document.getElementById("cancelBtn").addEventListener("click", () => adminModal.classList.add("hidden"));
    }

    // Submit form
    if (document.getElementById("submitBtn")) {
        document.getElementById("submitBtn").addEventListener("click", submitAdminForm);
    }

    // Confirm modal buttons
    if (document.getElementById("cancelConfirm")) {
        document.getElementById("cancelConfirm").addEventListener("click", () => confirmModal.classList.add("hidden"));
    }

    // === UTILITY FUNCTIONS ===

    function getSelectedAdminIds() {
        const checkboxes = document.querySelectorAll('.admin-checkbox:checked');
        return Array.from(checkboxes).map(cb => cb.value);
    }

    function openAdminModal(action, data = null) {
        const modalTitle = document.getElementById('modalTitle');
        const form = document.getElementById('adminForm');
        const passwordFields = document.getElementById('passwordFields');

        if (action === 'add') {
            modalTitle.innerHTML = 'Tambah <span class="text-[#F36A00]">Admin Baru</span>';
            if (form) form.reset();
            if (document.getElementById('adminId')) document.getElementById('adminId').value = '';
            if (passwordFields) passwordFields.style.display = 'block';
            if (document.getElementById('password')) document.getElementById('password').required = true;
            if (document.getElementById('password_confirmation')) document.getElementById('password_confirmation').required = true;
        } else if (action === 'edit' && data) {
            modalTitle.innerHTML = 'Edit <span class="text-[#F36A00]">Admin</span>';
            if (document.getElementById('adminId')) document.getElementById('adminId').value = data.id;
            if (document.getElementById('name')) document.getElementById('name').value = data.name;
            if (document.getElementById('email')) document.getElementById('email').value = data.email;
            if (document.getElementById('nomor_telepon')) document.getElementById('nomor_telepon').value = data.phone;
            if (document.getElementById('role')) document.getElementById('role').value = data.role;
            if (document.getElementById('status')) document.getElementById('status').value = data.status;
            if (passwordFields) passwordFields.style.display = 'none';
            if (document.getElementById('password')) document.getElementById('password').required = false;
            if (document.getElementById('password_confirmation')) document.getElementById('password_confirmation').required = false;
        }

        if (adminModal) adminModal.classList.remove('hidden');
    }

    function submitAdminForm() {
        const form = document.getElementById('adminForm');
        if (!form) return;

        const formData = new FormData(form);
        const adminId = document.getElementById('adminId') ? document.getElementById('adminId').value : '';
        const isEdit = !!adminId;

        const data = {
            name: formData.get('name'),
            email: formData.get('email'),
            nomor_telepon: formData.get('nomor_telepon'),
            role: formData.get('role'),
            status: formData.get('status')
        };

        // Add password for new admin
        if (!isEdit) {
            data.password = formData.get('password');
            data.password_confirmation = formData.get('password_confirmation');
        }

        const url = isEdit ? `${baseUrl}/${adminId}` : baseUrl;
        const method = isEdit ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                if (adminModal) adminModal.classList.add('hidden');
                showToast(result.message || (isEdit ? 'Admin berhasil diperbarui' : 'Admin berhasil ditambahkan'));
                // Reload page untuk update data
                setTimeout(() => window.location.reload(), 1500);
            } else {
                showFormErrors(result.errors || { message: result.message });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'error');
        });
    }

    function updateAdminStatus(adminId, status) {
        fetch(`${baseUrl}/${adminId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                if (confirmModal) confirmModal.classList.add('hidden');
                showToast(result.message || 'Status berhasil diperbarui');
                setTimeout(() => window.location.reload(), 1500);
            } else {
                showToast(result.message || 'Gagal memperbarui status', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'error');
        });
    }

    function deleteAdmin(adminId) {
        fetch(`${baseUrl}/${adminId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                if (confirmModal) confirmModal.classList.add('hidden');
                showToast(result.message || 'Admin berhasil dihapus');
                setTimeout(() => window.location.reload(), 1500);
            } else {
                showToast(result.message || 'Gagal menghapus admin', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'error');
        });
    }

    function deleteMultipleAdmins(ids) {
        fetch(`${baseUrl}/delete-multiple`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ ids })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                if (confirmModal) confirmModal.classList.add('hidden');
                showToast(result.message || 'Admin berhasil dihapus');
                setTimeout(() => window.location.reload(), 1500);
            } else {
                showToast(result.message || 'Gagal menghapus admin', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'error');
        });
    }

    function showConfirmModal(title, message, callback) {
        const confirmTitle = document.getElementById('confirmTitle');
        const confirmMessage = document.getElementById('confirmMessage');

        if (confirmTitle) confirmTitle.textContent = title;
        if (confirmMessage) confirmMessage.textContent = message;

        if (confirmModal) {
            confirmModal.classList.remove('hidden');

            const confirmBtn = document.getElementById('confirmAction');
            if (confirmBtn) {
                confirmBtn.onclick = callback;
            }
        }
    }

    function showFormErrors(errors) {
        const errorDiv = document.getElementById('formErrors');
        if (!errorDiv) return;

        if (typeof errors === 'object') {
            let html = '<ul class="list-disc pl-4">';
            Object.values(errors).forEach(error => {
                html += `<li>${error}</li>`;
            });
            html += '</ul>';
            errorDiv.innerHTML = html;
        } else {
            errorDiv.textContent = errors;
        }
        errorDiv.classList.remove('hidden');
    }

    function showToast(message, type = 'success') {
        const toast = document.getElementById('successToast');
        const toastMessage = document.getElementById('toastMessage');

        if (!toast || !toastMessage) return;

        toastMessage.textContent = message;

        if (type === 'error') {
            toast.className = 'hidden fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg z-50 flex items-center';
        } else {
            toast.className = 'hidden fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg z-50 flex items-center';
        }

        toast.classList.remove('hidden');

        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000);
    }

    // === ATTACH ACTION LISTENERS ===
    function attachActionListeners() {
        // Aksi dropdown
        document.querySelectorAll('.aksiBtn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.nextElementSibling;
                document.querySelectorAll('.aksiDropdown').forEach(d => {
                    if (d !== dropdown) d.classList.add('hidden');
                });
                dropdown.classList.toggle('hidden');
            });
        });

        // Edit admin
        document.querySelectorAll('.editAdminBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                openAdminModal('edit', this.dataset);
            });
        });

        // Change status
        document.querySelectorAll('.changeStatusBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                const newStatus = this.dataset.status === 'aktif' ? 'tidak_aktif' : 'aktif';
                showConfirmModal(
                    'Ubah Status Admin',
                    `Apakah Anda yakin ingin mengubah status admin menjadi ${newStatus}?`,
                    () => updateAdminStatus(this.dataset.id, newStatus)
                );
            });
        });

        // Delete admin
        document.querySelectorAll('.deleteAdminBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                showConfirmModal(
                    'Hapus Admin',
                    'Apakah Anda yakin ingin menghapus admin ini?',
                    () => deleteAdmin(this.dataset.id)
                );
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.aksiDropdown').forEach(d => d.classList.add('hidden'));
        });
    }

    // Initial attachment of event listeners
    attachActionListeners();
});
</script>
