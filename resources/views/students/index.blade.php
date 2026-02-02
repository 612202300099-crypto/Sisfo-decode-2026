@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
    <div class="page-header">
        <h1>
            <i class="bi bi-people-fill me-2"></i>
            Daftar Mahasiswa
        </h1>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-table me-2"></i>Data Mahasiswa</span>
            <div class="d-flex gap-2">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-file-earmark-arrow-down me-1"></i>Ekspor/Impor
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('import-export.template', 'students') }}"><i class="bi bi-file-earmark-excel me-2"></i>Unduh Template</a></li>
                        <li><a class="dropdown-item" href="{{ route('import-export.export', 'students') }}"><i class="bi bi-download me-2"></i>Ekspor Data (CSV)</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importModal"><i class="bi bi-upload me-2"></i>Impor Data</a></li>
                    </ul>
                </div>
                <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Mahasiswa
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 15%">NIM</th>
                                <th style="width: 30%">Nama Mahasiswa</th>
                                <th style="width: 25%">Program Studi</th>
                                <th style="width: 25%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $student->nim }}</span>
                                    </td>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $student->studyProgram->name }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('students.edit', $student) }}" 
                                           class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                        
                                        <form id="delete-form-{{ $student->id }}" 
                                              action="{{ route('students.destroy', $student) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    onclick="confirmDelete('delete-form-{{ $student->id }}')" 
                                                    class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Belum ada data mahasiswa. 
                    <a href="{{ route('students.create') }}" class="alert-link">Tambah data</a> sekarang.
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('import-export.import', 'students') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-upload me-2"></i>Impor Data Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info small">
                            <i class="bi bi-info-circle me-1"></i> Gunakan template CSV yang sudah disediakan untuk memastikan format data benar.
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih File CSV</label>
                            <input type="file" name="file" class="form-control" accept=".csv" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Mulai Impor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
