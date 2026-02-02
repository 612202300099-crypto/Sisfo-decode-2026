@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="page-header">
        <h1>
            <i class="bi bi-person-plus-fill me-2"></i>
            Tambah Mahasiswa
        </h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-pencil-square me-2"></i>Form Tambah Mahasiswa
                </div>
                <div class="card-body">
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nim" class="form-label">
                                NIM <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nim') is-invalid @enderror" 
                                   id="nim" 
                                   name="nim" 
                                   value="{{ old('nim') }}"
                                   placeholder="Contoh: 20260001"
                                   required>
                            @error('nim')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Nama Mahasiswa <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   placeholder="Contoh: John Doe"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="study_program_id" class="form-label">
                                Program Studi <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('study_program_id') is-invalid @enderror" 
                                    id="study_program_id" 
                                    name="study_program_id" 
                                    required>
                                <option value="">-- Pilih Program Studi --</option>
                                @foreach($studyPrograms as $program)
                                    <option value="{{ $program->id }}" {{ old('study_program_id') == $program->id ? 'selected' : '' }}>
                                        {{ $program->name }} ({{ $program->code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('study_program_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i>Simpan
                            </button>
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="bi bi-info-circle me-1"></i>Petunjuk
                    </h6>
                    <ul class="small mb-0">
                        <li>Field bertanda <span class="text-danger">*</span> wajib diisi</li>
                        <li>NIM harus unik dan belum terdaftar</li>
                        <li>Pastikan memilih program studi yang benar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
