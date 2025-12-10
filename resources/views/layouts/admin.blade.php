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
        class="fixed top-0 left-0 h-screen bg-[#002C5F] text-white p-4 flex flex-col transition-all duration-300 w-64">
        
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
            @php $active  = request()->routeIs('admin.dashboard'); @endphp
            <a href="{{ route('admin.dashboard') }}" 
               class="sidebar-item flex items-center gap-3 p-3 rounded-lg transition-all
               {{ $active ? 'bg-white text-[#002C5F]' : 'text-white hover:bg-white/20' }}">
                    <!-- Icon -->
                    <svg class="sidebar-icon h-6 w-6 
                        {{ $active ? 'stroke-[#002C5F]' : 'stroke-white' }}" 
                        fill="none" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M12 18V15" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.0698 2.82L3.13978 8.37C2.35978 8.99 1.85978 10.3 2.02978 11.28L3.35978 19.24C3.59978 20.66 4.95978 21.81 6.39978 21.81H17.5998C19.0298 21.81 20.3998 20.65 20.6398 19.24L21.9698 11.28C22.1298 10.3 21.6298 8.99 20.8598 8.37L13.9298 2.83C12.8598 1.97 11.1298 1.97 10.0698 2.82Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                <span class="sidebar-text">Dashboard</span>
            </a>

            <!-- Laporan -->
            @php $active  = request()->routeIs('admin.laporan'); @endphp
            <a href="{{ route('admin.laporan') }}" 
               class="sidebar-item flex items-center gap-3 p-3 rounded-lg transition-all
               {{ $active ? 'bg-white text-[#002C5F]' : 'text-white hover:bg-white/20' }}">
                    <!-- Icon -->
                    <svg class="sidebar-icon h-6 w-6
                        {{ $active ? 'stroke-[#002C5F]' : 'stroke-white' }}" 
                        fill="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.77 11.25H15.73C13.72 11.25 12.75 10.36 12.75 8.52V3.98C12.75 2.14 13.73 1.25 15.73 1.25H19.77C21.78 1.25 22.75 2.14 22.75 3.98V8.51C22.75 10.36 21.77 11.25 19.77 11.25ZM15.73 2.75C14.39 2.75 14.25 3.13 14.25 3.98V8.51C14.25 9.37 14.39 9.74 15.73 9.74H19.77C21.11 9.74 21.25 9.36 21.25 8.51V3.98C21.25 3.12 21.11 2.75 19.77 2.75H15.73Z" 
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M19.77 22.75H15.73C13.72 22.75 12.75 21.77 12.75 19.77V15.73C12.75 13.72 13.73 12.75 15.73 12.75H19.77C21.78 12.75 22.75 13.73 22.75 15.73V19.77C22.75 21.77 21.77 22.75 19.77 22.75ZM15.73 14.25C14.55 14.25 14.25 14.55 14.25 15.73V19.77C14.25 20.95 14.55 21.25 15.73 21.25H19.77C20.95 21.25 21.25 20.95 21.25 19.77V15.73C21.25 14.55 20.95 14.25 19.77 14.25H15.73Z" 
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.27 11.25H4.23C2.22 11.25 1.25 10.36 1.25 8.52V3.98C1.25 2.14 2.23 1.25 4.23 1.25H8.27C10.28 1.25 11.25 2.14 11.25 3.98V8.51C11.25 10.36 10.27 11.25 8.27 11.25ZM4.23 2.75C2.89 2.75 2.75 3.13 2.75 3.98V8.51C2.75 9.37 2.89 9.74 4.23 9.74H8.27C9.61 9.74 9.75 9.36 9.75 8.51V3.98C9.75 3.12 9.61 2.75 8.27 2.75H4.23Z"
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.27 22.75H4.23C2.22 22.75 1.25 21.77 1.25 19.77V15.73C1.25 13.72 2.23 12.75 4.23 12.75H8.27C10.28 12.75 11.25 13.73 11.25 15.73V19.77C11.25 21.77 10.27 22.75 8.27 22.75ZM4.23 14.25C3.05 14.25 2.75 14.55 2.75 15.73V19.77C2.75 20.95 3.05 21.25 4.23 21.25H8.27C9.45 21.25 9.75 20.95 9.75 19.77V15.73C9.75 14.55 9.45 14.25 8.27 14.25H4.23Z"
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                <span class="sidebar-text">Laporan</span>
            </a>

            <!-- Kontrol Admin -->
            @php $active  = request()->routeIs('admin.kontrol-admin'); @endphp
            <a href="{{ route('admin.kontrol-admin') }}" 
                class="sidebar-item flex items-center gap-3 p-3 rounded-lg transition-all
                {{ $active ? 'bg-white text-[#002C5F]' : 'text-white hover:bg-white/20' }}">

                <svg class="sidebar-icon h-6 w-6
                    {{ $active ? 'stroke-[#002C5F]' : 'stroke-white' }}" 
                    fill="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.9998 7.91002C17.9698 7.91002 17.9498 7.91002 17.9198 7.91002H17.8698C15.9798 7.85002 14.5698 6.39001 14.5698 4.59001C14.5698 2.75001 16.0698 1.26001 17.8998 1.26001C19.7298 1.26001 21.2298 2.76001 21.2298 4.59001C21.2198 6.40001 19.8098 7.86001 18.0098 7.92001C18.0098 7.91001 18.0098 7.91002 17.9998 7.91002ZM17.8998 2.75002C16.8898 2.75002 16.0698 3.57002 16.0698 4.58002C16.0698 5.57002 16.8398 6.37002 17.8298 6.41002C17.8398 6.40002 17.9198 6.40002 18.0098 6.41002C18.9798 6.36002 19.7298 5.56002 19.7398 4.58002C19.7398 3.57002 18.9198 2.75002 17.8998 2.75002Z" 
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.01 15.28C17.62 15.28 17.23 15.25 16.84 15.18C16.43 15.11 16.16 14.72 16.23 14.31C16.3 13.9 16.69 13.63 17.1 13.7C18.33 13.91 19.63 13.68 20.5 13.1C20.97 12.79 21.22 12.4 21.22 12.01C21.22 11.62 20.96 11.24 20.5 10.93C19.63 10.35 18.31 10.12 17.07 10.34C16.66 10.42 16.27 10.14 16.2 9.73002C16.13 9.32002 16.4 8.93003 16.81 8.86003C18.44 8.57003 20.13 8.88002 21.33 9.68002C22.21 10.27 22.72 11.11 22.72 12.01C22.72 12.9 22.22 13.75 21.33 14.35C20.42 14.95 19.24 15.28 18.01 15.28Z"
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5.96998 7.91C5.95998 7.91 5.94998 7.91 5.94998 7.91C4.14998 7.85 2.73998 6.39 2.72998 4.59C2.72998 2.75 4.22998 1.25 6.05998 1.25C7.88998 1.25 9.38998 2.75 9.38998 4.58C9.38998 6.39 7.97998 7.85 6.17998 7.91L5.96998 7.16L6.03998 7.91C6.01998 7.91 5.98998 7.91 5.96998 7.91ZM6.06998 6.41C6.12998 6.41 6.17998 6.41 6.23998 6.42C7.12998 6.38 7.90998 5.58 7.90998 4.59C7.90998 3.58 7.08998 2.75999 6.07998 2.75999C5.06998 2.75999 4.24998 3.58 4.24998 4.59C4.24998 5.57 5.00998 6.36 5.97998 6.42C5.98998 6.41 6.02998 6.41 6.06998 6.41Z"
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5.96 15.28C4.73 15.28 3.55 14.95 2.64 14.35C1.76 13.76 1.25 12.91 1.25 12.01C1.25 11.12 1.76 10.27 2.64 9.68002C3.84 8.88002 5.53 8.57003 7.16 8.86003C7.57 8.93003 7.84 9.32002 7.77 9.73002C7.7 10.14 7.31 10.42 6.9 10.34C5.66 10.12 4.35 10.35 3.47 10.93C3 11.24 2.75 11.62 2.75 12.01C2.75 12.4 3.01 12.79 3.47 13.1C4.34 13.68 5.64 13.91 6.87 13.7C7.28 13.63 7.67 13.91 7.74 14.31C7.81 14.72 7.54 15.11 7.13 15.18C6.74 15.25 6.35 15.28 5.96 15.28Z"
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.9998 15.38C11.9698 15.38 11.9498 15.38 11.9198 15.38H11.8698C9.97982 15.32 8.56982 13.86 8.56982 12.06C8.56982 10.22 10.0698 8.72998 11.8998 8.72998C13.7298 8.72998 15.2298 10.23 15.2298 12.06C15.2198 13.87 13.8098 15.33 12.0098 15.39C12.0098 15.38 12.0098 15.38 11.9998 15.38ZM11.8998 10.22C10.8898 10.22 10.0698 11.04 10.0698 12.05C10.0698 13.04 10.8398 13.84 11.8298 13.88C11.8398 13.87 11.9198 13.87 12.0098 13.88C12.9798 13.83 13.7298 13.03 13.7398 12.05C13.7398 11.05 12.9198 10.22 11.8998 10.22Z"
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.9998 22.76C10.7998 22.76 9.59978 22.45 8.66978 21.82C7.78978 21.23 7.27979 20.39 7.27979 19.49C7.27979 18.6 7.77978 17.74 8.66978 17.15C10.5398 15.91 13.4698 15.91 15.3298 17.15C16.2098 17.74 16.7198 18.58 16.7198 19.48C16.7198 20.37 16.2198 21.23 15.3298 21.82C14.3998 22.44 13.1998 22.76 11.9998 22.76ZM9.49979 18.41C9.02979 18.72 8.77979 19.11 8.77979 19.5C8.77979 19.89 9.03979 20.27 9.49979 20.58C10.8498 21.49 13.1398 21.49 14.4898 20.58C14.9598 20.27 15.2098 19.88 15.2098 19.49C15.2098 19.1 14.9498 18.72 14.4898 18.41C13.1498 17.5 10.8598 17.51 9.49979 18.41Z"
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <span class="sidebar-text">Kontrol Admin</span>
            </a>

            <!-- Arsip -->
            @php $active  = request()->routeIs('admin.arsip'); @endphp
            <a href="{{ route('admin.arsip') }}" 
               class="sidebar-item flex items-center gap-3 p-3 rounded-lg transition-all
                {{ $active ? 'bg-white text-[#002C5F]' : 'text-white hover:bg-white/20' }}">

                <svg class="sidebar-icon h-6 w-6
                    {{ $active ? 'stroke-[#002C5F]' : 'stroke-white' }}" 
                    fill="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 22.75H8C4.35 22.75 2.25 20.65 2.25 17V7C2.25 3.35 4.35 1.25 8 1.25H16C19.65 1.25 21.75 3.35 21.75 7V17C21.75 20.65 19.65 22.75 16 22.75ZM8 2.75C5.14 2.75 3.75 4.14 3.75 7V17C3.75 19.86 5.14 21.25 8 21.25H16C18.86 21.25 20.25 19.86 20.25 17V7C20.25 4.14 18.86 2.75 16 2.75H8Z"
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 11.11C8.83 11.11 8.66 11.08 8.5 11.01C8.04 10.81 7.75 10.36 7.75 9.87V2C7.75 1.59 8.09 1.25 8.5 1.25H15.5C15.91 1.25 16.25 1.59 16.25 2V9.85999C16.25 10.36 15.96 10.81 15.5 11C15.05 11.2 14.52 11.11 14.15 10.77L12 8.79999L9.84998 10.78C9.60998 11 9.31 11.11 9 11.11ZM12 7.21002C12.3 7.21002 12.61 7.31998 12.85 7.53998L14.75 9.28998V2.75H9.25V9.28998L11.15 7.53998C11.39 7.31998 11.7 7.21002 12 7.21002Z"
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17.5 14.75H13.25C12.84 14.75 12.5 14.41 12.5 14C12.5 13.59 12.84 13.25 13.25 13.25H17.5C17.91 13.25 18.25 13.59 18.25 14C18.25 14.41 17.91 14.75 17.5 14.75Z"
                            stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17.5 18.75H9C8.59 18.75 8.25 18.41 8.25 18C8.25 17.59 8.59 17.25 9 17.25H17.5C17.91 17.25 18.25 17.59 18.25 18C18.25 18.41 17.91 18.75 17.5 18.75Z"
                        stroke="none" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <span class="sidebar-text">Arsip</span>
            </a>
        </nav>

        <!-- LOGOUT -->
        <div class="mt-auto px-2 py-4">
            <a href="#" 
               class="sidebar-item flex items-center gap-3 p-3 rounded-lg text-white hover:bg-white/20">
                <img src="{{ asset('icon/logout-icon.svg') }}" 
                     class="sidebar-icon h-6 w-6" 
                     alt="Logout">
                <span class="sidebar-text">Logout</span>
            </a>
        </div>

    </aside>

    <!-- CONTENT -->
    <main id="main-content" class="flex-1 ml-64 p-6 bg-white overflow-auto">
        @include('admin.components.topbar')
        @yield('content')
    </main>
    
</div>

<!-- SCRIPT COLLAPSE -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const sidebarTexts = document.querySelectorAll('.sidebar-text');
    const sidebarItems = document.querySelectorAll('.sidebar-item');

    const logoExpanded = document.getElementById('logo-expanded');
    const logoCollapsed = document.getElementById('logo-collapsed');

    const btnCollapse = document.getElementById('btn-collapse');
    const btnExpand = document.getElementById('btn-expand');

    // Ambil state dari localStorage
    let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

    function applyCollapsedUI() {
        // Set state collapse UI
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-20');

        const main = document.getElementById("main-content");
        main.classList.remove('ml-64');
        main.classList.add('ml-20');

        sidebarTexts.forEach(text => text.classList.add('hidden'));

        logoExpanded.classList.add('hidden');
        logoCollapsed.classList.remove('hidden');

        btnCollapse.classList.add('hidden');
        btnExpand.classList.remove('hidden');

        sidebarItems.forEach(item => {
            item.classList.add('justify-center', 'gap-0');
            item.classList.remove('gap-3');
        });
    }

    function applyExpandedUI() {
        // Set state expand UI
        sidebar.classList.remove('w-20');
        sidebar.classList.add('w-64');

        const main = document.getElementById("main-content");
        main.classList.remove('ml-20');
        main.classList.add('ml-64');

        sidebarTexts.forEach(text => text.classList.remove('hidden'));

        logoExpanded.classList.remove('hidden');
        logoCollapsed.classList.add('hidden');

        btnExpand.classList.add('hidden');
        btnCollapse.classList.remove('hidden');

        sidebarItems.forEach(item => {
            item.classList.remove('justify-center', 'gap-0');
            item.classList.add('gap-3');
        });
    }

    function collapseSidebar(save = true) {
        isCollapsed = true;
        applyCollapsedUI();
        
        // Simpan state jika collapse manual
        if (save) localStorage.setItem('sidebarCollapsed', 'true');
    }

    function expandSidebar(save = true) {
        isCollapsed = false;
        applyExpandedUI();

        // Simpan state jika expand manual
        if (save) localStorage.setItem('sidebarCollapsed', 'false');
    }

    // Event tombol
    btnCollapse.addEventListener('click', () => collapseSidebar(true));
    btnExpand.addEventListener('click', () => expandSidebar(true));

    // Responsif untuk mobile
    function handleResize() {
        if (window.innerWidth < 768) {
            // Mobile selalu collapse, tapi jangan simpan ke localStorage
            collapseSidebar(false);
        } else {
            // Desktop mengikuti localStorage
            isCollapsed ? collapseSidebar(false) : expandSidebar(false);
        }
    }

    // Jalankan saat load & saat resize
    handleResize();
    window.addEventListener('resize', handleResize);
});
</script>


</body>
</html>