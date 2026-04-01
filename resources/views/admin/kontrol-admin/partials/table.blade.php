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
                                    'super_admin' => 'bg-purple-100 text-purple-800',
                                    'viewer' => 'bg-[#DDDDDD] text-[#022C55]',
                                    'admin' => 'bg-blue-100 text-[#022C55]'
                                ];
                            @endphp
                            <span class="px-4 py-2 text-sm font-medium rounded-sm {{ $roleColors[$admin->role] ?? 'bg-gray-200' }}">
                                {{ ucfirst(str_replace('_', ' ', $admin->role)) }}
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#002C55]">
                            @if($admin->last_active_at)
                                {{-- Gunakan Carbon untuk format yang lebih cantik --}}
                                {{ \Carbon\Carbon::parse($admin->last_active_at)->translatedFormat('d M Y, H:i') }}
                                <span class="text-xs text-gray-400 block">
                                    ({{ \Carbon\Carbon::parse($admin->last_active_at)->diffForHumans() }})
                                </span>
                            @else
                                <span class="text-gray-400 italic">Belum pernah aktif</span>
                            @endif
                        </td>

                        <!-- ACTION CELL -->
                        <td class="text-center action-cell px-6 py-4">
                            @if(Session::get('user.role') === 'super_admin')
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
                            @else
                                <span class="text-gray-400 italic text-sm">Tidak ada aksi</span>
                            @endif
                        </td>

                        <!-- Checkbox muncul saat mode kelola -->
                        <td class="checkbox-cell hidden px-6 py-4">
                            @if(Session::get('user.role') === 'super_admin')
                            <input type="checkbox" class="admin-checkbox" value="{{ $admin->id }}">
                            @endif
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
        <div class="flex items-center justify-between px-6 py-4 border-t">
            <div class="text-sm text-gray-700">
                Menampilkan {{ ($currentPage - 1) * 10 + 1 }} sampai 
                {{ min($currentPage * 10, $total) }} dari {{ $total }} data
            </div>

            <div class="flex gap-2">
                {{-- Tombol Previous --}}
                @if($currentPage > 1)
                    <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}" 
                    class="px-3 py-1 border rounded hover:bg-gray-100">Previous</a>
                @endif

                {{-- Nomor Halaman --}}
                @for($i = 1; $i <= $lastPage; $i++)
                    <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" 
                    class="px-3 py-1 border rounded {{ $currentPage == $i ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }}">
                    {{ $i }}
                    </a>
                @endfor

                {{-- Tombol Next --}}
                @if($currentPage < $lastPage)
                    <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}" 
                    class="px-3 py-1 border rounded hover:bg-gray-100">Next</a>
                @endif
            </div>
        </div>
    </div>
</div>

