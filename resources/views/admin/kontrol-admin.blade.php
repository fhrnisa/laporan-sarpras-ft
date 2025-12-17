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
        <div class="flex gap-3 items-center">
            <a id="addadminBtn"
                href="{{ route('admin.tambah') }}"
                class="bg-[#022C55] text-white text-base rounded-lg py-2 px-4 flex gap-2 items-center hover:bg-[#01408C] transition-colors">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12.75C8.83 12.75 6.25 10.17 6.25 7C6.25 3.83 8.83 1.25 12 1.25C15.17 1.25 17.75 3.83 17.75 7C17.75 10.17 15.17 12.75 12 12.75ZM12 2.75C9.66 2.75 7.75 4.66 7.75 7C7.75 9.34 9.66 11.25 12 11.25C14.34 11.25 16.25 9.34 16.25 7C16.25 4.66 14.34 2.75 12 2.75Z" fill="white"/>
                    <path d="M3.41016 22.75C3.00016 22.75 2.66016 22.41 2.66016 22C2.66016 17.73 6.85015 14.25 12.0002 14.25C13.0102 14.25 14.0001 14.38 14.9601 14.65C15.3601 14.76 15.5902 15.17 15.4802 15.57C15.3702 15.97 14.9601 16.2 14.5602 16.09C13.7402 15.86 12.8802 15.75 12.0002 15.75C7.68015 15.75 4.16016 18.55 4.16016 22C4.16016 22.41 3.82016 22.75 3.41016 22.75Z" fill="white"/>
                    <path d="M18 22.75C16.82 22.75 15.7 22.31 14.83 21.52C14.48 21.22 14.17 20.85 13.93 20.44C13.49 19.72 13.25 18.87 13.25 18C13.25 16.75 13.73 15.58 14.59 14.69C15.49 13.76 16.7 13.25 18 13.25C19.36 13.25 20.65 13.83 21.53 14.83C22.31 15.7 22.75 16.82 22.75 18C22.75 18.38 22.7 18.76 22.6 19.12C22.5 19.57 22.31 20.04 22.05 20.45C21.22 21.87 19.66 22.75 18 22.75ZM18 14.75C17.11 14.75 16.29 15.1 15.67 15.73C15.08 16.34 14.75 17.14 14.75 18C14.75 18.59 14.91 19.17 15.22 19.67C15.38 19.95 15.59 20.2 15.83 20.41C16.43 20.96 17.2 21.26 18 21.26C19.13 21.26 20.2 20.66 20.78 19.69C20.95 19.41 21.08 19.09 21.15 18.78C21.22 18.52 21.25 18.27 21.25 18.01C21.25 17.21 20.95 16.44 20.41 15.84C19.81 15.14 18.93 14.75 18 14.75Z" fill="white"/>
                    <path d="M19.4998 18.73H16.5098C16.0998 18.73 15.7598 18.39 15.7598 17.98C15.7598 17.57 16.0998 17.23 16.5098 17.23H19.4998C19.9098 17.23 20.2498 17.57 20.2498 17.98C20.2498 18.39 19.9098 18.73 19.4998 18.73Z" fill="white"/>
                    <path d="M18 20.26C17.59 20.26 17.25 19.92 17.25 19.51V16.52C17.25 16.11 17.59 15.77 18 15.77C18.41 15.77 18.75 16.11 18.75 16.52V19.51C18.75 19.93 18.41 20.26 18 20.26Z" fill="white"/>
                </svg>
                Tambah Admin
            </a>

            <!-- BUTTONS -->
            <div class="flex gap-3 items-center">
                <button id="kelolaBtn"
                        class="bg-[#022C55] text-white text-base rounded-lg py-2 px-4 flex gap-2 hover:bg-[#01408C]">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.2633 5.43908L5.05327 14.1291C4.74327 14.4591 4.44327 15.1091 4.38327 15.5591L4.01327 18.7991C3.88327 19.9691 4.72327 20.7691 5.88327 20.5691L9.10327 20.0191C9.55327 19.9391 10.1833 19.6091 10.4933 19.2691L18.7033 10.5791C20.1233 9.07908 20.7633 7.36908 18.5533 5.27908C16.3533 3.20908 14.6833 3.93908 13.2633 5.43908Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.8931 6.88916C12.3231 9.64916 14.5631 11.7592 17.3431 12.0392" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Kelola
                </button>

                <!-- Hidden buttons -->
                <div id="manageOptions" class="hidden gap-2 items-center ml-2">
                    <div class="flex gap-4">
                        <button id="hapusBtn" class="px-4 py-2 bg-[#ED3237] text-white rounded-lg flex gap-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.0002 6.72998C20.9802 6.72998 20.9502 6.72998 20.9202 6.72998C15.6302 6.19998 10.3502 5.99998 5.12016 6.52998L3.08016 6.72998C2.66016 6.76998 2.29016 6.46998 2.25016 6.04998C2.21016 5.62998 2.51016 5.26998 2.92016 5.22998L4.96016 5.02998C10.2802 4.48998 15.6702 4.69998 21.0702 5.22998C21.4802 5.26998 21.7802 5.63998 21.7402 6.04998C21.7102 6.43998 21.3802 6.72998 21.0002 6.72998Z" fill="white"/>
                                <path d="M8.49977 5.72C8.45977 5.72 8.41977 5.72 8.36977 5.71C7.96977 5.64 7.68977 5.25 7.75977 4.85L7.97977 3.54C8.13977 2.58 8.35977 1.25 10.6898 1.25H13.3098C15.6498 1.25 15.8698 2.63 16.0198 3.55L16.2398 4.85C16.3098 5.26 16.0298 5.65 15.6298 5.71C15.2198 5.78 14.8298 5.5 14.7698 5.1L14.5498 3.8C14.4098 2.93 14.3798 2.76 13.3198 2.76H10.6998C9.63977 2.76 9.61977 2.9 9.46977 3.79L9.23977 5.09C9.17977 5.46 8.85977 5.72 8.49977 5.72Z" fill="white"/>
                                <path d="M15.2099 22.75H8.7899C5.2999 22.75 5.1599 20.82 5.0499 19.26L4.3999 9.18995C4.3699 8.77995 4.6899 8.41995 5.0999 8.38995C5.5199 8.36995 5.8699 8.67995 5.8999 9.08995L6.5499 19.16C6.6599 20.68 6.6999 21.25 8.7899 21.25H15.2099C17.3099 21.25 17.3499 20.68 17.4499 19.16L18.0999 9.08995C18.1299 8.67995 18.4899 8.36995 18.8999 8.38995C19.3099 8.41995 19.6299 8.76995 19.5999 9.18995L18.9499 19.26C18.8399 20.82 18.6999 22.75 15.2099 22.75Z" fill="white"/>
                                <path d="M13.6601 17.25H10.3301C9.92008 17.25 9.58008 16.91 9.58008 16.5C9.58008 16.09 9.92008 15.75 10.3301 15.75H13.6601C14.0701 15.75 14.4101 16.09 14.4101 16.5C14.4101 16.91 14.0701 17.25 13.6601 17.25Z" fill="white"/>
                                <path d="M14.5 13.25H9.5C9.09 13.25 8.75 12.91 8.75 12.5C8.75 12.09 9.09 11.75 9.5 11.75H14.5C14.91 11.75 15.25 12.09 15.25 12.5C15.25 12.91 14.91 13.25 14.5 13.25Z" fill="white"/>
                            </svg>
                            Hapus
                        </button>

                        <button id="batalBtn" class="px-4 py-2 bg-gray-600 text-white rounded flex gap-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.00098 5L19 18.9991" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.99996 18.9991L18.999 5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Batal
                        </button>
                    </div>
                </div>
            </div>
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
                                {{ $admin->nomor_telepon }}
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
                                        'admin' => 'bg-[#A0F1B5] text-[#022C55]'
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
                                @if($admin->last_active_at)
                                    {{ \Carbon\Carbon::parse($admin->last_active_at)->translatedFormat('d M Y H:i:s') }}
                                @else
                                    Belum pernah
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
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="flex justify-between items-center p-5 border-b">
                <h2 id="modalTitle" class="text-xl font-semibold text-gray-800">Tambah Admin Baru</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-2xl">
                    &times;
                </button>
            </div>

            <!-- Form -->
            <form id="adminForm" class="p-5 space-y-4">
                <input type="hidden" id="adminId">

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                    <input type="text" id="name" name="name" required
                           class="w-full border border-[#DDDDDD] rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" id="email" name="email" required
                           class="w-full border border-[#DDDDDD] rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                </div>

                <div>
                    <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp *</label>
                    <input type="tel" id="nomor_telepon" name="nomor_telepon" required
                           class="w-full border border-[#DDDDDD] rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                    <select id="role" name="role" required
                            class="w-full border border-[#DDDDDD] rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                        <option value="admin">Admin</option>
                        <option value="viewer">Viewer</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                    <select id="status" name="status" required
                            class="w-full border border-[#DDDDDD] rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                        <option value="aktif">Aktif</option>
                        <option value="tidak_aktif">Tidak Aktif</option>
                    </select>
                </div>

                <div id="passwordFields">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                        <input type="password" id="password" name="password"
                               class="w-full border border-[#DDDDDD] rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="w-full border border-[#DDDDDD] rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                    </div>
                </div>

                <!-- Error Messages -->
                <div id="formErrors" class="hidden p-3 bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm"></div>
            </form>

            <!-- Footer -->
            <div class="p-5 border-t flex justify-end gap-3">
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

<!-- === MODAL KONFIRMASI === -->
<div id="confirmModal" class="hidden fixed inset-0 bg-black/40 z-50">
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
            <div class="p-5">
                <h3 id="confirmTitle" class="text-lg font-semibold text-gray-800 mb-2"></h3>
                <p id="confirmMessage" class="text-gray-600 mb-4"></p>

                <div class="flex justify-end gap-3">
                    <button id="cancelConfirm" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <button id="confirmAction" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Konfirmasi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Toast -->
<div id="successToast" class="hidden fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg z-50">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span id="toastMessage"></span>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const baseUrl = '{{ url("/admin/api/admins") }}';
    const csrfToken = '{{ csrf_token() }}';

    // Elements
    const addAdminBtn = document.getElementById("addadminBtn");
    const kelolaBtn = document.getElementById("kelolaBtn");
    const batalBtn = document.getElementById("batalBtn");
    const manageOptions = document.getElementById("manageOptions");
    const hapusBtn = document.querySelector("#manageOptions button:first-child"); // Tombol hapus pertama

    const actionCells = document.querySelectorAll(".action-cell");
    const checkboxCells = document.querySelectorAll(".checkbox-cell");
    const adminCheckboxes = document.querySelectorAll(".admin-checkbox");
    const selectAll = document.getElementById("select-all");

    // Modal elements
    const adminModal = document.getElementById("adminModal");
    const confirmModal = document.getElementById("confirmModal");
    const successToast = document.getElementById("successToast");

    // Filter elements
    const searchInput = document.getElementById("searchInput") || document.querySelector('input[name="search"]');
    const filterStatus = document.getElementById("filterStatus");
    const filterTanggal = document.getElementById("filterTanggal");

    // === EVENT LISTENERS ===

    // Search input dengan debounce
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                loadAdmins();
            }, 500);
        });
    }

    // Filter change - reload page dengan filter baru
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

    function applyFilters() {
        const params = new URLSearchParams();

        // Get search value
        const searchValue = searchInput ? searchInput.value.trim() : '';

        // Add filters
        if (filterStatus && filterStatus.value !== 'all') {
            params.append('status', filterStatus.value);
        }

        if (filterTanggal && filterTanggal.value !== 'semua') {
            params.append('tanggal', filterTanggal.value);
        }

        if (searchValue) {
            params.append('search', searchValue);
        }

        const queryString = params.toString();
        window.location.href = `/admin/kontrol-admin${queryString ? '?' + queryString : ''}`;
    }

        // MODE KELOLA
    if (kelolaBtn) {
        kelolaBtn.addEventListener("click", () => {
            console.log("Kelola button clicked"); // Debug log
            kelolaBtn.classList.add("hidden");
            if (manageOptions) manageOptions.classList.remove("hidden");

            // Tampilkan checkbox, sembunyikan action cell
            actionCells.forEach(cell => cell.classList.add("hidden"));
            checkboxCells.forEach(cell => cell.classList.remove("hidden"));
        });
    }

    // BATAL MODE KELOLA
    if (batalBtn) {
        batalBtn.addEventListener("click", () => {
            console.log("Batal button clicked"); // Debug log
            if (kelolaBtn) kelolaBtn.classList.remove("hidden");
            if (manageOptions) manageOptions.classList.add("hidden");

            // Sembunyikan checkbox, tampilkan action cell
            checkboxCells.forEach(cell => cell.classList.add("hidden"));
            actionCells.forEach(cell => cell.classList.remove("hidden"));

            // Uncheck semua checkbox
            adminCheckboxes.forEach(ch => ch.checked = false); // Perbaikan: dari reportCheckboxes ke adminCheckboxes
            if (selectAll) selectAll.checked = false;
        });
    }

    // SELECT ALL CHECKBOX
    if (selectAll) {
        selectAll.addEventListener("change", function() {
            adminCheckboxes.forEach(ch => ch.checked = selectAll.checked); // Perbaikan: dari reportCheckboxes ke adminCheckboxes
        });
    }

    // HAPUS MULTIPLE BUTTON
    if (hapusBtn) {
        hapusBtn.addEventListener("click", () => {
            console.log("Hapus button clicked"); // Debug log
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

    // Tambah Admin button
    if (addAdminBtn) {
        addAdminBtn.addEventListener("click", () => {
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

    // === FUNCTIONS ===

    // Function untuk load admins dari API (jika menggunakan AJAX)
    function loadAdmins() {
        const params = new URLSearchParams({
            status: filterStatus ? filterStatus.value : 'all',
            tanggal: filterTanggal ? filterTanggal.value : 'semua',
            search: searchInput ? searchInput.value : ''
        });

        fetch(`${baseUrl}?${params}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateTable(data.data);
                }
            })
            .catch(error => {
                console.error('Error loading admins:', error);
                showToast('Gagal memuat data admin', 'error');
            });
    }

    // Function untuk update table dengan AJAX (opsional)
    function updateTable(admins) {
        // Implementasi jika ingin menggunakan AJAX untuk update table
        // Tapi di sini kita sudah menggunakan server-side rendering
        console.log('Admins loaded:', admins);
    }

    // Function untuk attach action listeners ke baris tabel
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

    function openAdminModal(action, data = null) {
        const modalTitle = document.getElementById('modalTitle');
        const form = document.getElementById('adminForm');
        const passwordFields = document.getElementById('passwordFields');

        if (action === 'add') {
            modalTitle.textContent = 'Tambah Admin Baru';
            if (form) form.reset();
            if (document.getElementById('adminId')) document.getElementById('adminId').value = '';
            if (passwordFields) passwordFields.style.display = 'block';
            if (document.getElementById('password')) document.getElementById('password').required = true;
            if (document.getElementById('password_confirmation')) document.getElementById('password_confirmation').required = true;
        } else if (action === 'edit' && data) {
            modalTitle.textContent = 'Edit Admin';
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
                // Reload page untuk update data
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
                // Reload page untuk update data
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
                // Reload page untuk update data dan keluar mode kelola
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

    function getSelectedAdminIds() {
        const checkboxes = document.querySelectorAll('.admin-checkbox:checked');
        return Array.from(checkboxes).map(cb => cb.value);
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
            toast.className = toast.className.replace('bg-green-100 border-green-400 text-green-700',
                                                     'bg-red-100 border-red-400 text-red-700');
        } else {
            toast.className = toast.className.replace('bg-red-100 border-red-400 text-red-700',
                                                     'bg-green-100 border-green-400 text-green-700');
        }

        toast.classList.remove('hidden');

        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000);
    }

    // Initial attachment of event listeners
    attachActionListeners();
});
</script>
@endpush
