@extends('layouts.app')

@section('title', 'Tambah Program Studi')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('study-programs.index') }}">Prodi</a></li>
                    <li class="breadcrumb-item active">Tambah Baru</li>
                </ol>
            </nav>
            <h1 class="fw-800">Tambah Program Studi</h1>
            <p class="text-muted">Daftarkan kurikulum program studi baru ke dalam sistem.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('study-programs.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-4">
                            <div class="col-md-5">
                                <label for="code" class="form-label fw-bold small text-uppercase tracking-wider text-muted">Kode Prodi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-3"><i class="bi bi-hash text-primary"></i></span>
                                    <input type="text" 
                                           class="form-control bg-light border-0 py-3 rounded-end-3 @error('code') is-invalid @enderror" 
                                           id="code" name="code" value="{{ old('code') }}" 
                                           placeholder="TI / SI / IF" required>
                                </div>
                                @error('code')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-7">
                                <label for="name" class="form-label fw-bold small text-uppercase tracking-wider text-muted">Nama Program Studi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-3"><i class="bi bi-book text-primary"></i></span>
                                    <input type="text" 
                                           class="form-control bg-light border-0 py-3 rounded-end-3 @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" 
                                           placeholder="Teknik Informatika" required>
                                </div>
                                @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12 mt-5">
                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 shadow-sm fw-bold">
                                        <i class="bi bi-save me-2"></i>Simpan Prodi
                                    </button>
                                    <a href="{{ route('study-programs.index') }}" class="btn btn-light rounded-pill px-4 py-3 fw-bold">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-4 bg-info bg-opacity-10 text-info h-100">
                <div class="card-body p-4">
                    <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center p-3 mb-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-info-circle fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Informasi Kode</h5>
                    <p class="small mb-0">
                        Kode Program Studi digunakan sebagai identifier unik di seluruh sistem. 
                        Pastikan menggunakan kode yang konsisten dengan standar akademik (Contoh: <strong>TI</strong> untuk Teknik Informatika).
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .fw-800 { font-weight: 800; }
    .tracking-wider { letter-spacing: 0.05em; }
    .form-control:focus {
        background-color: var(--bg-body) !important;
        box-shadow: none;
        border: 1px solid var(--brand-navy) !important;
    }
    [data-bs-theme="dark"] .form-control:focus {
        border-color: var(--brand-yellow) !important;
    }
    .input-group-text { min-width: 45px; justify-content: center; }
</style>
@endsection
