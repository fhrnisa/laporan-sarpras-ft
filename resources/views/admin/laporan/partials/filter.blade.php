<!-- FILTER SECTION -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div class="flex flex-col md:flex-row gap-4">

        <!-- Filter Status -->
        <div class="flex items-center gap-3">
            <span class="text-[#002C55] font-medium">Status</span>
            <select id="filterStatus" class="border border-[#DDDDDD] rounded-lg text-sm text-[#002C55] max-w-[140px] py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                <option value="all" {{ request('status','all') == 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="terselesaikan" {{ request('status') == 'terselesaikan' ? 'selected' : '' }}>Terselesaikan</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <!-- Filter Tanggal -->
        <div class="flex items-center gap-3">
            <span class="text-[#002C55] font-medium">Tanggal</span>
            <select id="filterTanggal" class="border border-[#DDDDDD] rounded-lg text-sm text-[#002C55] max-w-[140px] py-2 px-3 w-40 focus:outline-none focus:ring-1 focus:ring-[#002C55] focus:border-[#002C55]">
                <option value="semua" {{ request('tanggal','semua') == 'semua' ? 'selected' : '' }}>Semua</option>
                <option value="7hari" {{ request('tanggal') == '7hari' ? 'selected' : '' }}>7 Hari Terakhir</option>
                <option value="30hari" {{ request('tanggal') == '30hari' ? 'selected' : '' }}>30 Hari Terakhir</option>
                <option value="bulan" {{ request('tanggal') == 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
            </select>
        </div>
    </div>

    <!-- BUTTONS SECTION -->
    @if(Session::get('user.role') === 'admin' || Session::get('user.role') === 'super_admin')
    <div class="flex gap-3 items-center">
        <button id="kelolaBtn"
                class="bg-[#022C55] text-white text-base rounded-lg py-2 px-4 flex gap-2 items-center hover:bg-[#01408C] transition-colors">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.2633 5.43908L5.05327 14.1291C4.74327 14.4591 4.44327 15.1091 4.38327 15.5591L4.01327 18.7991C3.88327 19.9691 4.72327 20.7691 5.88327 20.5691L9.10327 20.0191C9.55327 19.9391 10.1833 19.6091 10.4933 19.2691L18.7033 10.5791C20.1233 9.07908 20.7633 7.36908 18.5533 5.27908C16.3533 3.20908 14.6833 3.93908 13.2633 5.43908Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11.8926 6.88916C12.3226 9.64916 14.5626 11.7592 17.3426 12.0392" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kelola Data
        </button>

        <!-- Hidden buttons -->
        <div id="manageOptions" class="hidden gap-2 items-center">
            <div class="flex gap-4">
                <button id="arsipBtn" class="px-4 py-2 bg-[#FED43E] text-white rounded-lg flex gap-2 items-center hover:bg-yellow-600"
                        data-url="{{ route('admin.laporan.archive') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 22.75H8C4.35 22.75 2.25 20.65 2.25 17V7C2.25 3.35 4.35 1.25 8 1.25H16C19.65 1.25 21.75 3.35 21.75 7V17C21.75 20.65 19.65 22.75 16 22.75ZM8 2.75C5.14 2.75 3.75 4.14 3.75 7V17C3.75 19.86 5.14 21.25 8 21.25H16C18.86 21.25 20.25 19.86 20.25 17V7C20.25 4.14 18.86 2.75 16 2.75H8Z" fill="currentColor"/>
                        <path d="M9 11.11C8.83 11.11 8.66 11.08 8.5 11.01C8.04 10.81 7.75 10.36 7.75 9.87V2C7.75 1.59 8.09 1.25 8.5 1.25H15.5C15.91 1.25 16.25 1.59 16.25 2V9.85999C16.25 10.36 15.96 10.81 15.5 11C15.05 11.2 14.52 11.11 14.15 10.77L12 8.79999L9.84998 10.78C9.60998 11 9.31 11.11 9 11.11ZM12 7.21002C12.3 7.21002 12.61 7.31998 12.85 7.53998L14.75 9.28998V2.75H9.25V9.28998L11.15 7.53998C11.39 7.31998 11.7 7.21002 12 7.21002Z" fill="currentColor"/>
                        <path d="M17.5 14.75H13.25C12.84 14.75 12.5 14.41 12.5 14C12.5 13.59 12.84 13.25 13.25 13.25H17.5C17.91 13.25 18.25 13.59 18.25 14C18.25 14.41 17.91 14.75 17.5 14.75Z" fill="currentColor"/>
                        <path d="M17.5 18.75H9C8.59 18.75 8.25 18.41 8.25 18C8.25 17.59 8.59 17.25 9 17.25H17.5C17.91 17.25 18.25 17.59 18.25 18C18.25 18.41 17.91 18.75 17.5 18.75Z" fill="currentColor"/>
                    </svg>
                    Arsipkan
                </button>

                <button id="hapusPermanenBtn" class="px-4 py-2 bg-[#ED3237] text-white rounded-lg flex gap-2 items-center hover:bg-red-600"
                        data-url="{{ route('admin.laporan.destroy') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.0002 6.72998C20.9802 6.72998 20.9502 6.72998 20.9202 6.72998C15.6302 6.19998 10.3502 5.99998 5.12016 6.52998L3.08016 6.72998C2.66016 6.76998 2.29016 6.46998 2.25016 6.04998C2.21016 5.62998 2.51016 5.26998 2.92016 5.22998L4.96016 5.02998C10.2802 4.48998 15.6702 4.69998 21.0702 5.22998C21.4802 5.26998 21.7802 5.63998 21.7402 6.04998C21.7102 6.43998 21.3802 6.72998 21.0002 6.72998Z" fill="white"/>
                        <path d="M8.49977 5.72C8.45977 5.72 8.41977 5.72 8.36977 5.71C7.96977 5.64 7.68977 5.25 7.75977 4.85L7.97977 3.54C8.13977 2.58 8.35977 1.25 10.6898 1.25H13.3098C15.6498 1.25 15.8698 2.63 16.0198 3.55L16.2398 4.85C16.3098 5.26 16.0298 5.65 15.6298 5.71C15.2198 5.78 14.8298 5.5 14.7698 5.1L14.5498 3.8C14.4098 2.93 14.3798 2.76 13.3198 2.76H10.6998C9.63977 2.76 9.61977 2.9 9.46977 3.79L9.23977 5.09C9.17977 5.46 8.85977 5.72 8.49977 5.72Z" fill="white"/>
                        <path d="M15.2099 22.75H8.7899C5.2999 22.75 5.1599 20.82 5.0499 19.26L4.3999 9.18995C4.3699 8.77995 4.6899 8.41995 5.0999 8.38995C5.5199 8.36995 5.8699 8.67995 5.8999 9.08995L6.5499 19.16C6.6599 20.68 6.6999 21.25 8.7899 21.25H15.2099C17.3099 21.25 17.3499 20.68 17.4499 19.16L18.0999 9.08995C18.1299 8.67995 18.4899 8.36995 18.8999 8.38995C19.3099 8.41995 19.6299 8.76995 19.5999 9.18995L18.9499 19.26C18.8399 20.82 18.6999 22.75 15.2099 22.75Z" fill="white"/>
                        <path d="M13.6601 17.25H10.3301C9.92008 17.25 9.58008 16.91 9.58008 16.5C9.58008 16.09 9.92008 15.75 10.3301 15.75H13.6601C14.0701 15.75 14.4101 16.09 14.4101 16.5C14.4101 16.91 14.0701 17.25 13.6601 17.25Z" fill="white"/>
                        <path d="M14.5 13.25H9.5C9.09 13.25 8.75 12.91 8.75 12.5C8.75 12.09 9.09 11.75 9.5 11.75H14.5C14.91 11.75 15.25 12.09 15.25 12.5C15.25 12.91 14.91 13.25 14.5 13.25Z" fill="white"/>
                    </svg>
                    Hapus Permanen
                </button>

                <button id="batalBtn" class="px-4 py-2 bg-gray-600 text-white rounded-lg flex gap-2 items-center hover:bg-gray-700">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.00098 5L19 18.9991" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.99996 18.9991L18.999 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Batal
                </button>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- INFO MESSAGE -->
@if(isset($error))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
    {{ $error }}
</div>
@endif