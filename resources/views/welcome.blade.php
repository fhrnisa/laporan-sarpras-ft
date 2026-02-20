@extends('layouts.app')

@section('title', 'Laporan Perbaikan Sarpras FT UNNES')

@php
$laporanSelesai = [
    [
        'id' => 1,
        'lokasi' => 'Ruang 207, Lantai 2 Gedung E11',
        'deskripsi' => 'Lampu yang mati dan tidak bisa menyala di ruang kelas 207 Lantai 2 Gedung E11. Dikarenakan konsleting listrik.',
        'foto_before' => 'https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b',
        'foto_after' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36',
        'tanggal' => '29 Desember 2025'
    ],
    [
        'id' => 2,
        'lokasi' => 'Toilet Mahasiswa Gedung C',
        'deskripsi' => 'Keran air rusak dan tidak mengalir dengan baik.',
        'foto_before' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a',
        'foto_after' => 'https://images.unsplash.com/photo-1584622781564-1d987f7333c1',
        'tanggal' => '27 Desember 2025'
    ],
    [
        'id' => 3,
        'lokasi' => 'Ruang Dosen Gedung D',
        'deskripsi' => 'AC tidak dingin dan mengeluarkan suara berisik.',
        'foto_before' => 'https://images.unsplash.com/photo-1598300053653-3c2c8d6d5c6c',
        'foto_after' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c',
        'tanggal' => '25 Desember 2025'
    ],
];
@endphp

@section('content')
<div class="p-6 min-h-screen">

    <!-- ===== HEADER ===== -->
    <header class="flex items-center justify-between">
    
            <img src="{{ asset('img/unnes-logo-horizontal.webp') }}"
                 alt="Logo Unnes Horizontal"
                 class="h-10 md:h-12 w-auto">
            <a href="{{ route('auth.login') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.1596 11.62C12.1296 11.62 12.1096 11.62 12.0796 11.62C12.0296 11.61 11.9596 11.61 11.8996 11.62C8.9996 11.53 6.8096 9.25 6.8096 6.44C6.8096 3.58 9.1396 1.25 11.9996 1.25C14.8596 1.25 17.1896 3.58 17.1896 6.44C17.1796 9.25 14.9796 11.53 12.1896 11.62C12.1796 11.62 12.1696 11.62 12.1596 11.62ZM11.9996 2.75C9.9696 2.75 8.3096 4.41 8.3096 6.44C8.3096 8.44 9.8696 10.05 11.8596 10.12C11.9096 10.11 12.0496 10.11 12.1796 10.12C14.1396 10.03 15.6796 8.42 15.6896 6.44C15.6896 4.41 14.0296 2.75 11.9996 2.75Z" fill="#002C55"/>
                    <path d="M12.1696 22.55C10.2096 22.55 8.23961 22.05 6.74961 21.05C5.35961 20.13 4.59961 18.87 4.59961 17.5C4.59961 16.13 5.35961 14.86 6.74961 13.93C9.74961 11.94 14.6096 11.94 17.5896 13.93C18.9696 14.85 19.7396 16.11 19.7396 17.48C19.7396 18.85 18.9796 20.12 17.5896 21.05C16.0896 22.05 14.1296 22.55 12.1696 22.55ZM7.57961 15.19C6.61961 15.83 6.09961 16.65 6.09961 17.51C6.09961 18.36 6.62961 19.18 7.57961 19.81C10.0696 21.48 14.2696 21.48 16.7596 19.81C17.7196 19.17 18.2396 18.35 18.2396 17.49C18.2396 16.64 17.7096 15.82 16.7596 15.19C14.2696 13.53 10.0696 13.53 7.57961 15.19Z" fill="#002C55"/>
                </svg>
            </a>
    </header>

    <!-- ===== HERO ===== -->
    <section class="px-6 pt-10 text-center space-y-4">
        <h1 class="text-[32px] md:text-6xl font-semibold text-[#002C55] leading-tight">
            Laporan Perbaikan Sarana Prasarana
            <span class="text-[#F36A00]">Fakultas Teknik </span>UNNES
        </h1>

        <p class="text-sm md:text-base text-[#002C55]">
            Sistem pelaporan kerusakan sarana dan prasarana Fakultas Teknik UNNES
            untuk mendukung kenyamanan, keamanan, dan kelancaran kegiatan akademik.
        </p>

        <!-- Mockup dummy -->
        <div class="flex justify-center pt-6">
            <img src="{{ asset('img/mockup-web.png') }}" alt="Mockup Website" class="w-full max-w-4xl">
        </div>
    </section>

    <!-- ===== LAPORAN SELESAI ===== -->
    <section class="mt-20 pb-16">
        <h2 class="text-xl font-semibold text-center text-[#002C55] leading-tight">
            Perbaikan yang<br>
            <span class="text-orange-500">Baru Terselesaikan</span>
        </h2>

        <div class="mt-6 space-y-6">
            @foreach ($laporanSelesai as $laporan)
                <article class="bg-white rounded-xl shadow overflow-hidden">

                    <!-- Before / After -->
                    <div class="grid grid-cols-2">
                        <div class="relative">
                            <img src="{{ $laporan['foto_before'] }}"
                                 class="h-40 w-full object-cover">
                            <span class="absolute bottom-2 left-2
                                         bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                Sebelum
                            </span>
                        </div>

                        <div class="relative">
                            <img src="{{ $laporan['foto_after'] }}"
                                 class="h-40 w-full object-cover">
                            <span class="absolute bottom-2 right-2
                                         bg-green-500 text-white text-xs px-2 py-1 rounded-full">
                                Setelah
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4 space-y-3">
                        <div class="flex items-center gap-2
                                    bg-green-100 text-green-700
                                    text-xs font-medium px-3 py-1 rounded-full w-fit">
                            <span>Selesai Diperbaiki</span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.55 15.15L18.025 6.675C18.225 6.475 18.4583 6.375 18.725 6.375C18.9917 6.375 19.225 6.475 19.425 6.675C19.625 6.875 19.725 7.11267 19.725 7.388C19.725 7.66333 19.625 7.90067 19.425 8.1L10.25 17.3C10.05 17.5 9.81666 17.6 9.55 17.6C9.28333 17.6 9.05 17.5 8.85 17.3L4.55 13C4.35 12.8 4.254 12.5627 4.262 12.288C4.27 12.0133 4.37433 11.7757 4.575 11.575C4.77566 11.3743 5.01333 11.2743 5.288 11.275C5.56266 11.2757 5.8 11.3757 6 11.575L9.55 15.15Z" fill="#00FF00"/>
                            </svg>
                        </div>

                        <div class="flex items-start gap-2 text-lg text-[#002C55]">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_472_2416)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 13.592C12.8484 13.592 13.6621 13.2551 14.2622 12.6553C14.8622 12.0555 15.1996 11.242 15.2 10.3936C15.2 9.54491 14.8628 8.73098 14.2627 8.13086C13.6626 7.53075 12.8487 7.1936 12 7.1936C11.1513 7.1936 10.3374 7.53075 9.73725 8.13086C9.13713 8.73098 8.79999 9.54491 8.79999 10.3936C8.80041 11.242 9.13774 12.0555 9.73781 12.6553C10.3379 13.2551 11.1516 13.592 12 13.592Z" stroke="#002C55" stroke-width="2" stroke-linecap="square"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M21.6 10.3936C21.6 18.3888 13.6 23.1856 12 23.1856C10.4 23.1856 2.39999 18.3888 2.39999 10.3936C2.40169 7.84868 3.41387 5.40853 5.21403 3.60956C7.0142 1.8106 9.45502 0.800048 12 0.800049C17.3008 0.800049 21.6 5.09605 21.6 10.3936Z" stroke="#002C55" stroke-width="2" stroke-linecap="square"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_472_2416">
                                <rect width="24" height="24" fill="white"/>
                                </clipPath>
                                </defs>
                                </svg>

                            <p class="font-medium">{{ $laporan['lokasi'] }}</p>
                        </div>

                        <p class="text-sm text-[#002C55] leading-tight">
                            {{ $laporan['deskripsi'] }}
                        </p>

                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.5" clip-path="url(#clip0_518_2342)">
                            <path d="M15 3.3335H5.00001C3.15906 3.3335 1.66667 4.82588 1.66667 6.66683V15.0002C1.66667 16.8411 3.15906 18.3335 5.00001 18.3335H15C16.841 18.3335 18.3333 16.8411 18.3333 15.0002V6.66683C18.3333 4.82588 16.841 3.3335 15 3.3335Z" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.66667 1.66675V5.00008M13.3333 1.66675V5.00008M1.66667 8.33341H18.3333" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_518_2342">
                            <rect width="20" height="20" fill="white"/>
                            </clipPath>
                            </defs>
                            </svg>

                            <span>Selesai: {{ $laporan['tanggal'] }}</span>
                        </div>

                        <span class="text-sm text-blue-600">
                            Lihat detail
                        </span>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

</div>
@endsection
