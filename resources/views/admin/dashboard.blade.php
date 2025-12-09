@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <!-- Top Search -->
    <div class="flex justify-between items-center mb-6 gap-5">

        <h1 class="text-3xl font-semibold text-[#002C55]">Dashboard</h1>

        <!-- Search Bar -->
        <div class="relative w-full">
            <input 
                type="text"
                placeholder="Cari Laporan" 
                class="w-full pl-4 pr-12 py-2 rounded-lg border border-[#DDDDDD] 
                    focus:ring-1 focus:ring-[#002C55]"
            >

            <button class="absolute right-3 top-1/2 -translate-y-1/2">
                <img src="{{ asset('icon/search-icon.svg') }}" class="h-5 w-5">
            </button>
        </div>

        <!-- Notification Button -->
        <button class="p-2 border border-[#DDDDDD] rounded-lg hover:bg-gray-100">
            <img src="{{ asset('icon/notif-icon.svg') }}" class="h-6 w-6" alt="">
        </button>

    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-10">

        <div class="bg-[#C5CAFF] p-4 rounded-lg">
            <img src="{{ asset('icon/receive-icon.svg') }}" alt="" class="h-10">
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Masuk</h2>
            <div class="flex items-center gap-2 mt-2">
                <p class="text-5xl font-bold text-[#002C55]">32</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>

        <div class="bg-[#E1E7E9] p-4 rounded-lg">
            <img src="{{ asset('icon/clock-icon.svg') }}" alt="" class="h-10">
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Menunggu</h2>
            <div class="flex items-center gap-2 mt-2">
                <p class="text-5xl font-bold text-[#002C55]">12</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>

        <div class="bg-[#FEEF94] p-4 rounded-lg">
            <img src="{{ asset('icon/process-icon.svg') }}" alt="" class="h-10">
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Diproses</h2>
            <div class="flex items-center gap-2 mt-2">
                <p class="text-5xl font-bold text-[#002C55]">9</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>

        <div class="bg-[#A0F1B5] p-4 rounded-lg">
            <img src="{{ asset('icon/check-icon.svg') }}" alt="" class="h-10">
            <h2 class="font-semibold text-lg text-[#002C55] mt-3">Laporan Terselesaikan</h2>
            <div class="flex items-center gap-2 mt-2">
                <p class="text-5xl font-bold text-[#002C55]">32</p>
                <span class="text-lg text-[#002C55] mt-1">Laporan</span>
            </div>
        </div>

    </div>
@endsection
