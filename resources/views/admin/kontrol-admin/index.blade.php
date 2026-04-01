@extends('layouts.admin')

@section('title', 'Kontrol Admin')
@section('page-title', 'Kontrol Admin')
@section('showSearch', true)

@section('search-placeholder', 'Cari admin')
@section('search-mode', 'admin')

@section('body_class', 'admin-page') @section('content')
<div class="space-y-6">
    @include('admin.kontrol-admin.partials.filter')
    @include('admin.kontrol-admin.partials.table')
    @include('admin.kontrol-admin.partials.admin-modal')
    @include('admin.kontrol-admin.partials.toast')

</div>
@endsection