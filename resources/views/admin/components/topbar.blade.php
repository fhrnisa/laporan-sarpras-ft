<header>
    <!-- Top Search -->
    <div class="flex items-center justify-between mb-6 gap-5">
        <!-- Left Section: Title and Search Bar -->
        <div class="flex items-center gap-5 flex-1 min-w-0">
            <!-- Page Title -->
            <h1 class="text-3xl font-semibold text-[#002C55] whitespace-nowrap">
                @yield('page-title', 'Dashboard')
            </h1>

            @hasSection('showSearch')
                <!-- Search Bar -->
                <div class="relative flex-1 max-w-md min-w-[200px]">
                    <input
                        type="text"
                        id="topbarSearch"
                        placeholder="@yield('search-placeholder', 'Cari Laporan')"
                        data-search-mode="@yield('search-mode', 'default')"
                        value="{{ request('search', '') }}"
                        class="w-full pl-4 pr-12 py-2 rounded-lg border border-[#DDDDDD]
                            focus:ring-1 focus:ring-[#002C55] focus:outline-none">

                    <button id="searchButton" class="absolute right-3 top-1/2 -translate-y-1/2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3189 14.433C19.5659 12.8253 20.1536 10.803 19.9624 8.77745C19.7713 6.75187 18.8156 4.87521 17.2899 3.52924C15.7641 2.18327 13.783 1.4691 11.7494 1.53203C9.71575 1.59496 7.78251 2.43025 6.34292 3.86798C4.90207 5.30671 4.06405 7.2407 3.99962 9.27585C3.93518 11.311 4.6492 13.2941 5.99615 14.8211C7.3431 16.3481 9.22162 17.304 11.2489 17.4941C13.2762 17.6841 15.2996 17.094 16.9069 15.844L16.9499 15.889L21.1919 20.132C21.2848 20.2249 21.3951 20.2986 21.5165 20.3489C21.6379 20.3992 21.768 20.425 21.8994 20.425C22.0308 20.425 22.1609 20.3992 22.2823 20.3489C22.4037 20.2986 22.514 20.2249 22.6069 20.132C22.6998 20.0391 22.7735 19.9288 22.8238 19.8074C22.8741 19.686 22.9 19.5559 22.9 19.4245C22.9 19.2931 22.8741 19.163 22.8238 19.0416C22.7735 18.9202 22.6998 18.8099 22.6069 18.717L18.3639 14.475L18.3189 14.433ZM16.2429 5.28298C16.8075 5.83846 17.2566 6.50023 17.5641 7.23012C17.8717 7.96001 18.0317 8.74357 18.0349 9.5356C18.0381 10.3276 17.8845 11.1125 17.5829 11.8448C17.2813 12.5772 16.8377 13.2426 16.2776 13.8027C15.7176 14.3627 15.0521 14.8064 14.3198 15.108C13.5874 15.4096 12.8026 15.5632 12.0105 15.56C11.2185 15.5568 10.4349 15.3967 9.70505 15.0892C8.97517 14.7816 8.3134 14.3326 7.75792 13.768C6.64784 12.6397 6.02857 11.1184 6.03502 9.5356C6.04146 7.95278 6.67309 6.43663 7.79233 5.31739C8.91156 4.19816 10.4277 3.56653 12.0105 3.56008C13.5934 3.55364 15.1146 4.1729 16.2429 5.28298Z" fill="#959595"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <!-- Right Section: User and Notification -->
        <div class="flex items-center gap-4 shrink-0">
            <!-- User Info Section -->
            <div class="flex items-center gap-4 shrink-0 whitespace-nowrap">
                <!-- User Info -->
                @if(session('user'))
                    <div class="flex items-center gap-2 max-w-md">
                        <div class="flex flex-col items-end">
                            <span class="text-base w-full font-medium text-[#002C55] max-w-[180px] truncate">{{ session('user.name') }}</span>
                            <span class="text-xs px-2 py-0.5 rounded
                                {{ session('user.role') === 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ session('user.role') === 'admin' ? 'Administrator' : 'Viewer' }}
                            </span>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-user text-blue-600 text-sm"></i>
                        </div>
                    </div>
                @endif

                <!-- Notification Button -->
                <button id="openNotification" class="p-2 border border-[#DDDDDD] rounded-lg hover:bg-gray-100">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.0201 2.91C8.71009 2.91 6.02009 5.6 6.02009 8.91V11.8C6.02009 12.41 5.76009 13.34 5.45009 13.86L4.30009 15.77C3.59009 16.95 4.08009 18.26 5.38009 18.7C9.69009 20.14 14.3401 20.14 18.6501 18.7C19.8601 18.3 20.3901 16.87 19.7301 15.77L18.5801 13.86C18.2801 13.34 18.0201 12.41 18.0201 11.8V8.91C18.0201 5.61 15.3201 2.91 12.0201 2.91Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M13.8699 3.2C13.5599 3.11 13.2399 3.04 12.9099 3C11.9499 2.88 11.0299 2.95 10.1699 3.2C10.4599 2.46 11.1799 1.94 12.0199 1.94C12.8599 1.94 13.5799 2.46 13.8699 3.2Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15.02 19.06C15.02 20.71 13.67 22.06 12.02 22.06C11.2 22.06 10.44 21.72 9.90002 21.18C9.36002 20.64 9.02002 19.88 9.02002 19.06" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Notification Panel -->
        <div id="notificationPanel" class="hidden fixed inset-0 bg-black/40 z-50">
            <div class="absolute right-0 top-0 h-auto w-full max-w-md bg-white mt-6 mr-6 shadow-xl rounded-xl overflow-y-auto">

                <!-- Header -->
                <div class="flex justify-between items-start p-5 border-b border-gray-300">
                    <div>
                        <h2 id="detailTitle" class="text-3xl font-semibold text-[#002C55]">Notifikasi</h2>
                        <p id="detailDate" class="text-lg text-[#002C55]">3 Pesan Baru</p>
                    </div>
                    <button id="closeNotification" class="text-gray-500 hover:text-gray-700">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.00098 5L19 18.9991" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.99996 18.9991L18.999 5" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                <!-- Content -->
                <div class="p-5 space-y-5 text-sm text-[#002C55]">

                    <div class="grid grid-rows-2">
                        <div class="flex justify-between">
                            <p class="text-lg text-[#002C55] font-semibold">1 Laporan Baru Masuk</p>
                            <p class="text-lg text-[#ED3237]">*</p>
                        </div>
                        <div>
                            <p class="text-base text-[#002C55]">Nama Pengusul: Sang Bimo Raharjoning Leksono</p>
                        </div>
                    </div>

                    <div class="grid grid-rows-2">
                        <div class="flex justify-between">
                            <p class="text-lg text-[#002C55] font-semibold">1 Laporan Baru Masuk</p>
                            <p class="text-lg text-[#ED3237]">*</p>
                        </div>
                        <div>
                            <p class="text-base text-[#002C55]">Nama Pengusul: Fahrunnisa Kusumawardani</p>
                        </div>
                    </div>

                    <div class="grid grid-rows-2">
                        <div class="flex justify-between">
                            <p class="text-lg text-[#002C55] font-semibold">Admin 123 Mengubah Status Laporan</p>
                            <p class="text-lg text-[#ED3237]">*</p>
                        </div>
                        <div>
                            <p class="text-base text-[#002C55]">Laporan #2</p>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="p-5">
                    <button id="readBtn" class="w-full py-2 bg-[#002C5F] text-white rounded-md hover:bg-[#01408C]">
                        Tandai Dibaca
                    </button>
                </div>

            </div>
        </div>

    </div>
</header>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Notification Panel
    const openBtn = document.getElementById("openNotification");
    const closeBtn = document.getElementById("closeNotification");
    const panel = document.getElementById("notificationPanel");

    if (openBtn && closeBtn && panel) {
        // Buka panel
        openBtn.addEventListener("click", () => {
            panel.classList.remove("hidden");
        });

        // Tutup panel via tombol ×
        closeBtn.addEventListener("click", () => {
            panel.classList.add("hidden");
        });

        // Klik area hitam = tutup panel
        panel.addEventListener("click", (e) => {
            if (e.target === panel) {
                panel.classList.add("hidden");
            }
        });
    }

    // Search Functionality
    const searchInput = document.getElementById("topbarSearch");
    const searchButton = document.getElementById("searchButton");

    if (searchInput) {
        const searchMode = searchInput.dataset.searchMode;
        let searchTimeout;

        // Handle input with debounce
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                handleSearch(this.value.trim(), searchMode);
            }, 500);
        });

        // Handle enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                clearTimeout(searchTimeout);
                handleSearch(this.value.trim(), searchMode);
            }
        });

        // Handle search button click
        if (searchButton) {
            searchButton.addEventListener('click', function() {
                clearTimeout(searchTimeout);
                handleSearch(searchInput.value.trim(), searchMode);
            });
        }

        function handleSearch(query, mode) {
            const currentUrl = new URL(window.location.href);

            if (query) {
                currentUrl.searchParams.set('search', query);
            } else {
                currentUrl.searchParams.delete('search');
            }

            // Jika mode laporan, tambahkan filter lain
            if (mode === 'laporan') {
                // Preserve existing filters
                const filterStatus = document.getElementById('filterStatus');
                const filterTanggal = document.getElementById('filterTanggal');

                if (filterStatus && filterStatus.value !== 'all') {
                    currentUrl.searchParams.set('status', filterStatus.value);
                } else {
                    currentUrl.searchParams.delete('status');
                }

                if (filterTanggal && filterTanggal.value !== '7hari') {
                    currentUrl.searchParams.set('tanggal', filterTanggal.value);
                } else {
                    currentUrl.searchParams.delete('tanggal');
                }
            }

            window.location.href = currentUrl.toString();
        }
    }
});
</script>
