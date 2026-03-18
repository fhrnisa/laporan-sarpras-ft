@extends('layouts.admin')

@section('title', 'Laporan')

@section('page-title', 'Laporan')
@section('showSearch', true)

@section('search-placeholder', 'Cari nama, email, atau lokasi laporan')
@section('search-mode', 'laporan')

@section('content')

@include('admin.laporan.partials.table')
@include('admin.laporan.partials.modal-detail')
@include('admin.laporan.partials.modal-reject')
@include('admin.laporan.partials.modal-process')
@include('admin.laporan.partials.modal-complete')
@include('admin.laporan.partials.confirm')

@include('admin.laporan.partials.toast')

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
</style>
@endpush


@vite('resources/js/admin/laporan/main.js')