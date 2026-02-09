@extends('layouts.app')

@section('title', 'Manajemen Program Studi')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h1 class="fw-800 mb-0">Program Studi</h1>
            <p class="text-muted mb-0">Kelola kurikulum dan data program studi kampus.</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <div class="dropdown d-inline-block me-2">
                <button class="btn btn-outline-dark rounded-pill px-4" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-file-earmark-arrow-down me-2"></i>Ekspor/Impor
                </button>
                <ul class="dropdown-menu shadow-lg border-0 rounded-4">
                    <li><a class="dropdown-item py-2" href="{{ route('import-export.template', 'study-programs') }}"><i class="bi bi-file-earmark-spreadsheet me-2 text-success"></i>Unduh Template</a></li>
                    <li><a class="dropdown-item py-2" href="{{ route('import-export.export', 'study-programs') }}"><i class="bi bi-download me-2 text-primary"></i>Ekspor CSV</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#importModal"><i class="bi bi-upload me-2 text-warning"></i>Impor Data</a></li>
                </ul>
            </div>
            <a href="{{ route('study-programs.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-lg me-2"></i>Tambah Prodi
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="ps-4 py-3" style="width: 80px">No</th>
                            <th class="py-3">Kode Prodi</th>
                            <th class="py-3">Nama Program Studi</th>
                            <th class="py-3 text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($studyPrograms as $index => $program)
                            <tr>
                                <td class="ps-4">
                                    <span class="text-muted fw-medium small">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-soft-brand text-brand border border-primary border-opacity-10 rounded-pill px-3">{{ $program->code }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $program->name }}</div>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('study-programs.edit', $program) }}" 
                                           class="btn btn-sm btn-light rounded-pill px-3" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        
                                        <form id="delete-form-{{ $program->id }}" 
                                              action="{{ route('study-programs.destroy', $program) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    onclick="confirmDelete('delete-form-{{ $program->id }}')" 
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-5 text-center text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                    Belum ada data program studi tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <form action="{{ route('import-export.import', 'study-programs') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold">Impor Program Studi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body py-4">
                        <div class="bg-info bg-opacity-10 text-info p-3 rounded-4 mb-4 small d-flex">
                            <i class="bi bi-info-circle-fill me-3 fs-4"></i>
                            <div>Gunakan template CSV resmi. Pastikan kode prodi belum pernah digunakan sebelumnya.</div>
                        </div>
                        <div class="mb-0">
                            <label for="file" class="form-label fw-bold small">Pilih File CSV</label>
                            <input type="file" name="file" class="form-control rounded-3" accept=".csv" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Mulai Impor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .fw-800 { font-weight: 800; }
    .bg-soft-brand { background-color: rgba(41, 22, 111, 0.05); }
    .text-brand { color: var(--brand-navy); }
    
    [data-bs-theme="dark"] .bg-soft-brand { background-color: rgba(255, 245, 0, 0.05); }
    [data-bs-theme="dark"] .text-brand { color: var(--brand-yellow); }
    [data-bs-theme="dark"] .table tbody td { border-bottom: 1px solid rgba(255,255,255,0.05); }

    .table thead th { border-bottom: none; }
    .table tbody td { border-bottom: 1px solid rgba(0,0,0,0.03); }
    .table tbody tr:last-child td { border-bottom: none; }
</style>
@endsection
