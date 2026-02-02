@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
    <div class="page-header">
        <h1>
            <i class="bi bi-pencil-square me-2"></i>
            Edit Mahasiswa
        </h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-pencil-square me-2"></i>Form Edit Mahasiswa
                </div>
                <div class="card-body">
                    <form action="{{ route('students.update', $student) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nim" class="form-label">
                                NIM <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nim') is-invalid @enderror" 
                                   id="nim" 
                                   name="nim" 
                                   value="{{ old('nim', $student->nim) }}"
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
                                   value="{{ old('name', $student->name) }}"
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
                                    <option value="{{ $program->id }}" {{ old('study_program_id', $student->study_program_id) == $program->id ? 'selected' : '' }}>
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
                                <i class="bi bi-save me-1"></i>Update
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
                        <i class="bi bi-info-circle me-1"></i>Informasi
                    </h6>
                    <ul class="small mb-0">
                        <li>Field bertanda <span class="text-danger">*</span> wajib diisi</li>
                        <li>NIM harus unik</li>
                    </ul>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="bi bi-clock-history me-1"></i>Info Waktu
                    </h6>
                    <small class="text-muted d-block">
                        <strong>Dibuat:</strong><br>
                        {{ $student->created_at->format('d M Y, H:i') }}
                    </small>
                    @if($student->updated_at != $student->created_at)
                        <small class="text-muted d-block mt-2">
                            <strong>Terakhir diupdate:</strong><br>
                            {{ $student->updated_at->format('d M Y, H:i') }}
                        </small>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
