@extends('layouts.admin')

@section('title', 'Arsip')

@section('page-title', 'Arsip')
@section('showSearch', true)

@section('search-placeholder', 'Cari data di arsip')
@section('search-mode', 'arsip')


@section('content')
<div class="space-y-6">

    @include('admin.arsip.partials.filter')

    @include('admin.arsip.partials.table')

</div>

@include('admin.arsip.partials.modal-detail')
@include('admin.arsip.partials.confirm')
@include('admin.arsip.partials.toast')

@endsection

@push('styles')
<style>
    .checkbox-cell { width: 60px; }
    .action-cell { width: 100px; }

    /* Status colors */
    .status-menunggu { background-color: #E1E7E9; color: #022C55; }
    .status-diproses { background-color: #FEEF94; color: #022C55; }
    .status-terselesaikan { background-color: #A0F1B5; color: #022C55; }
    .status-ditolak { background-color: #FF7A7E; color: #022C55; }
    
    /* Animation classes */
    .toast-enter {
        animation: toastEnter 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }
    
    .toast-exit {
        animation: toastExit 0.3s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards;
    }
    
    @keyframes toastEnter {
        0% {
            opacity: 0;
            transform: translateY(-50px) scale(0.9);
        }
        70% {
            transform: translateY(5px) scale(1.02);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    @keyframes toastExit {
        0% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        100% {
            opacity: 0;
            transform: translateY(-50px) scale(0.9);
        }
    }
    
    /* Toast styling */
    #toastInner {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 
                    0 10px 10px -5px rgba(0, 0, 0, 0.04);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>
@endpush

@vite('resources/js/admin/arsip/main.js')