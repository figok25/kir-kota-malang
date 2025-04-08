@extends('home.layouts.master')

@section("title", "Cek Data Kendaraan | BALAI UJI KIR MALANG KOTA")

@section("css")
<link href="assets/css/inovasi/style.css" rel="stylesheet">
@endsection

@section("content")
<div class="inov-bg">
    {{-- Background jika ada --}}
</div>

<div class="container mt-4" style="margin-top: 80px">
    <h1 class="text-center mb-4">Cek Data Kendaraan</h1>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('home.inovasi.index') }}" class="d-flex gap-2 justify-content-center mb-4">
        <input type="text" name="search" class="form-control w-50 search-input" placeholder="Masukkan No. Uji..." value="{{ request('search') }}">
        <button class="btn btn-primary fw-bold" type="submit">CARI</button>
    </form>

    {{-- Flash error jika data tidak ditemukan --}}
    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection
