@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('subjects.index') }}">Mata Kuliah</a></li>
                    <li class="breadcrumb-item active">Edit Mata Kuliah</li>
                </ol>
            </nav>
            <h1 class="fw-800">Edit Mata Kuliah</h1>
            <p class="text-muted">Perbarui informasi silabus <strong>{{ $subject->name }}</strong>.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('subjects.update', $subject) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4">
                            <div class="col-md-5">
                                <label for="code" class="form-label fw-bold small text-uppercase tracking-wider text-muted">Kode MK</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-3"><i class="bi bi-upc-scan text-primary"></i></span>
                                    <input type="text" 
                                           class="form-control bg-light border-0 py-3 rounded-end-3 @error('code') is-invalid @enderror" 
                                           id="code" name="code" value="{{ old('code', $subject->code) }}" 
                                           placeholder="MK001" required>
                                </div>
                                @error('code')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-7">
                                <label for="name" class="form-label fw-bold small text-uppercase tracking-wider text-muted">Nama Mata Kuliah</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-3"><i class="bi bi-journal-text text-primary"></i></span>
                                    <input type="text" 
                                           class="form-control bg-light border-0 py-3 rounded-end-3 @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $subject->name) }}" 
                                           placeholder="Pemrograman Web" required>
                                </div>
                                @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label for="study_program_id" class="form-label fw-bold small text-uppercase tracking-wider text-muted">Program Studi Pengampu</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-3"><i class="bi bi-book text-primary"></i></span>
                                    <select class="form-select bg-light border-0 py-3 rounded-end-3 @error('study_program_id') is-invalid @enderror" 
                                            id="study_program_id" name="study_program_id" required>
                                        @foreach($studyPrograms as $program)
                                            <option value="{{ $program->id }}" {{ old('study_program_id', $subject->study_program_id) == $program->id ? 'selected' : '' }}>
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
                                        <i class="bi bi-check-all me-2"></i>Simpan Perubahan
                                    </button>
                                    <a href="{{ route('subjects.index') }}" class="btn btn-light rounded-pill px-4 py-3 fw-bold">
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
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Metadata MK</h5>
                    
                    <div class="mb-4">
                        <label class="small text-muted text-uppercase fw-bold d-block mb-1">Dibuat Pada</label>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-event me-2 text-primary"></i>
                            <span class="fw-medium">{{ $subject->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="small text-muted text-uppercase fw-bold d-block mb-1">Terakhir Diupdate</label>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-history me-2 text-warning"></i>
                            <span class="fw-medium">{{ $subject->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="bg-light p-3 rounded-3 small">
                        <i class="bi bi-info-circle me-2 text-info"></i>
                        Perubahan pada mata kuliah ini akan segera tercermin pada data statistik dashboard utama.
                    </div>
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
