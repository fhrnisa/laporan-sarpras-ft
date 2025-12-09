<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Favicon (opsional) -->
    <link rel="icon" type="image/png" href="{{ asset('img/unnes-logo.png') }}">

    <!-- Font Fira Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <style>
        /* Tambahkan style untuk transisi yang smooth */
        .sidebar-item {
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        .sidebar-icon {
            min-width: 24px; /* Pastikan icon tetap konsisten */
        }
    </style>
</head>

<body class="bg-white">
    
<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="relative bg-[#002C5F] text-white p-4 flex flex-col transition-all duration-300 w-64">
        
        <!-- HEADER SIDEBAR -->
        <div class="relative mb-8 pt-4 px-2">

            <!-- Logo Expanded (visible saat sidebar expanded) -->
            <div id="logo-expanded" class="flex items-center justify-between transition-opacity duration-300">
                <img src="{{ asset('img/unnes-horizontal-white.webp') }}" 
                     class="h-10"
                     alt="Logo Unnes">
                
                <!-- Collapse Button -->
                <button id="btn-collapse" class="p-1 hover:bg-white/10 rounded-full">
                    <img src="{{ asset('icon/arrow-circle-left.svg') }}" 
                         class="h-8 w-8" 
                         alt="Collapse">
                </button>
            </div>

            <!-- Logo Collapsed (hidden saat expanded) -->
            <div id="logo-collapsed" class="hidden items-center justify-center">
                <img src="{{ asset('img/unnes-logo-white.webp') }}" 
                     class="h-10" 
                     alt="Logo Unnes">
                
                <!-- Expand Button -->
                <button id="btn-expand" class="absolute right-2 p-1 hover:bg-white/10 rounded-full hidden">
                    <img src="{{ asset('icon/arrow-circle-right.svg') }}" 
                         class="h-8 w-8" 
                         alt="Expand">
                </button>
            </div>
        </div>

        <!-- MENU NAVIGATION -->
        <nav class="flex-1 flex flex-col gap-2 px-2">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="sidebar-item flex items-center gap-3 p-3 rounded-lg text-white bg-white/20 hover:bg-white/30">
                <img src="{{ asset('icon/home-dark-icon.png') }}" 
                     class="sidebar-icon h-6 w-6" 
                     alt="Dashboard">
                <span class="sidebar-text font-medium">Dashboard</span>
            </a>

            <!-- Laporan -->
            <a href="{{ route('admin.laporan') }}" 
               class="sidebar-item flex items-center gap-3 p-3 rounded-lg text-white hover:bg-white/20">
                <img src="{{ asset('icon/report-white-icon.png') }}" 
                     class="sidebar-icon h-6 w-6" 
                     alt="Laporan">
                <span class="sidebar-text font-medium">Laporan</span>
            </a>

            <!-- Kontrol Admin -->
            <a href="{{ route('admin.kontrol-admin') }}" 
               class="sidebar-item flex items-center gap-3 p-3 rounded-lg text-white hover:bg-white/20">
                <img src="{{ asset('icon/admin-white-icon.png') }}" 
                     class="sidebar-icon h-6 w-6" 
                     alt="Kontrol Admin">
                <span class="sidebar-text font-medium">Kontrol Admin</span>
            </a>

            <!-- Arsip -->
            <a href="{{ route('admin.arsip') }}" 
               class="sidebar-item flex items-center gap-3 p-3 rounded-lg text-white hover:bg-white/20">
                <img src="{{ asset('icon/archieve-white-icon.png') }}" 
                     class="sidebar-icon h-6 w-6" 
                     alt="Arsip">
                <span class="sidebar-text font-medium">Arsip</span>
            </a>
        </nav>

        <!-- LOGOUT -->
        <div class="mt-auto px-2 py-4">
            <a href="#" 
               class="sidebar-item flex items-center gap-3 p-3 rounded-lg text-white hover:bg-white/20">
                <img src="{{ asset('icon/logout-icon.svg') }}" 
                     class="sidebar-icon h-6 w-6" 
                     alt="Logout">
                <span class="sidebar-text font-medium">Logout</span>
            </a>
        </div>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-6 bg-gray-50 overflow-auto">
        @yield('content')
    </main>
    
</div>

<!-- SCRIPT COLLAPSE -->
<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarTexts = document.querySelectorAll('.sidebar-text');
    const sidebarItems = document.querySelectorAll('.sidebar-item');

    const logoExpanded = document.getElementById('logo-expanded');
    const logoCollapsed = document.getElementById('logo-collapsed');

    const btnCollapse = document.getElementById('btn-collapse');
    const btnExpand = document.getElementById('btn-expand');

    let isCollapsed = false;

    // Function untuk collapse sidebar
    function collapseSidebar() {
        isCollapsed = true;
        
        // Ubah lebar sidebar
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-20'); // Lebar collapsed
        
        // Sembunyikan teks menu
        sidebarTexts.forEach(text => {
            text.classList.add('hidden');
        });
        
        // Switch logo
        logoExpanded.classList.add('hidden');
        logoCollapsed.classList.remove('hidden');
        
        // Switch tombol
        btnCollapse.classList.add('hidden');
        btnExpand.classList.remove('hidden');
        
        // Center items saat collapsed
        sidebarItems.forEach(item => {
            item.classList.add('justify-center');
            item.classList.remove('gap-3');
            item.classList.add('gap-0');
        });
    }

    // Function untuk expand sidebar
    function expandSidebar() {
        isCollapsed = false;
        
        // Ubah lebar sidebar
        sidebar.classList.remove('w-20');
        sidebar.classList.add('w-64'); // Lebar expanded
        
        // Tampilkan teks menu
        sidebarTexts.forEach(text => {
            text.classList.remove('hidden');
        });
        
        // Switch logo
        logoExpanded.classList.remove('hidden');
        logoCollapsed.classList.add('hidden');
        
        // Switch tombol
        btnExpand.classList.add('hidden');
        btnCollapse.classList.remove('hidden');
        
        // Reset alignment items
        sidebarItems.forEach(item => {
            item.classList.remove('justify-center', 'gap-0');
            item.classList.add('gap-3');
        });
    }

    // Event listeners
    btnCollapse.addEventListener('click', collapseSidebar);
    btnExpand.addEventListener('click', expandSidebar);

    // Optional: Auto-collapse untuk mobile
    function handleResize() {
        if (window.innerWidth < 768 && !isCollapsed) {
            collapseSidebar();
        } else if (window.innerWidth >= 768 && isCollapsed) {
            expandSidebar();
        }
    }

    // Listen untuk resize
    window.addEventListener('resize', handleResize);
    
    // Initialize berdasarkan ukuran layar
    handleResize();
</script>

</body>
</html>