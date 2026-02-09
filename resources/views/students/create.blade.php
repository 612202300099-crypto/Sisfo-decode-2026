@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Mahasiswa</a></li>
                    <li class="breadcrumb-item active">Tambah Baru</li>
                </ol>
            </nav>
            <h1 class="fw-800">Tambah Mahasiswa</h1>
            <p class="text-muted">Masukkan profil mahasiswa baru ke dalam sistem.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="nim" class="form-label fw-bold small text-uppercase tracking-wider text-muted">NIM</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-3"><i class="bi bi-person-badge text-primary"></i></span>
                                    <input type="text" 
                                           class="form-control bg-light border-0 py-3 rounded-end-3 @error('nim') is-invalid @enderror" 
                                           id="nim" name="nim" value="{{ old('nim') }}" 
                                           placeholder="2026xxxx" required>
                                </div>
                                @error('nim')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold small text-uppercase tracking-wider text-muted">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-3"><i class="bi bi-person text-primary"></i></span>
                                    <input type="text" 
                                           class="form-control bg-light border-0 py-3 rounded-end-3 @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" 
                                           placeholder="John Doe" required>
                                </div>
                                @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label for="study_program_id" class="form-label fw-bold small text-uppercase tracking-wider text-muted">Program Studi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-3"><i class="bi bi-book text-primary"></i></span>
                                    <select class="form-select bg-light border-0 py-3 rounded-end-3 @error('study_program_id') is-invalid @enderror" 
                                            id="study_program_id" name="study_program_id" required>
                                        <option value="">-- Pilih Program Studi --</option>
                                        @foreach($studyPrograms as $program)
                                            <option value="{{ $program->id }}" {{ old('study_program_id') == $program->id ? 'selected' : '' }}>
                                                {{ $program->name }} ({{ $program->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('study_program_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12 mt-5">
                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 shadow-sm fw-bold">
                                        <i class="bi bi-save me-2"></i>Simpan Mahasiswa
                                    </button>
                                    <a href="{{ route('students.index') }}" class="btn btn-light rounded-pill px-4 py-3 fw-bold">
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
            <div class="card border-0 shadow-sm rounded-4 bg-primary bg-opacity-10 text-primary h-100">
                <div class="card-body p-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center p-3 mb-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-lightbulb fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Tips Penginputan</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex">
                            <i class="bi bi-check-circle-fill me-3 mt-1 opacity-75"></i>
                            <span>Gunakan <strong>NIM resmi</strong> kampus untuk validasi data yang akurat.</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="bi bi-check-circle-fill me-3 mt-1 opacity-75"></i>
                            <span>Nama mahasiswa sebaiknya ditulis menggunakan <strong>Title Case</strong> (Contoh: Budi Santoso).</span>
                        </li>
                        <li class="d-flex">
                            <i class="bi bi-check-circle-fill me-3 mt-1 opacity-75"></i>
                            <span>Pilih Program Studi yang sesuai dengan konsentrasi mahasiswa tersebut.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .fw-800 { font-weight: 800; }
    .tracking-wider { letter-spacing: 0.05em; }
    .form-control:focus, .form-select:focus {
        background-color: var(--bg-body) !important;
        box-shadow: none;
        border: 1px solid var(--brand-navy) !important;
    }
    [data-bs-theme="dark"] .form-control:focus, [data-bs-theme="dark"] .form-select:focus {
        border-color: var(--brand-yellow) !important;
    }
    .input-group-text { min-width: 45px; justify-content: center; }
</style>
@endsection
