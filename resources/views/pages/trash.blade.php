@extends('layouts.app')

@section('title', 'Tempat Sampah')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h1 class="fw-800 mb-0">Tempat Sampah</h1>
            <p class="text-muted mb-0">Pulihkan atau hapus data secara permanen.</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('home') }}" class="btn btn-outline-dark rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Nav tabs -->
    <ul class="nav nav-pills mb-4 p-2 rounded-pill shadow-sm d-inline-flex" id="trashTabs" role="tablist" style="background-color: var(--bg-card); border: 1px solid var(--border-color);">
        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-pill px-4" id="students-tab" data-bs-toggle="tab" data-bs-target="#students" type="button" role="tab">
                Mahasiswa ({{ $deletedStudents->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4" id="programs-tab" data-bs-toggle="tab" data-bs-target="#programs" type="button" role="tab">
                Prodi ({{ $deletedStudyPrograms->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4" id="subjects-tab" data-bs-toggle="tab" data-bs-target="#subjects" type="button" role="tab">
                Mata Kuliah ({{ $deletedSubjects->count() }})
            </button>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content border-0 shadow-sm rounded-4 overflow-hidden" style="background-color: var(--bg-card);">
        <!-- Students Tab -->
        <div class="tab-pane fade show active" id="students" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="ps-4 py-3">Mahasiswa</th>
                            <th class="py-3">Prodi</th>
                            <th class="py-3">Tgl Hapus</th>
                            <th class="py-3 text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deletedStudents as $student)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $student->name }}</div>
                                    <div class="text-muted small">{{ $student->nim }}</div>
                                </td>
                                <td>{{ $student->studyProgram->name }}</td>
                                <td>{{ $student->deleted_at->format('d/m/Y H:i') }}</td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <form action="{{ route('trash.restore', ['student', $student->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3 me-2">
                                                <i class="bi bi-arrow-counterclockwise"></i> Pulihkan
                                            </button>
                                        </form>
                                        <form action="{{ route('trash.force-delete', ['student', $student->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus permanen? Tindakan ini tidak dapat dibatalkan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-5 text-center text-muted">Tempat sampah kosong</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Programs Tab -->
        <div class="tab-pane fade" id="programs" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="ps-4 py-3">Nama Program Studi</th>
                            <th class="py-3">Tgl Hapus</th>
                            <th class="py-3 text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deletedStudyPrograms as $program)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $program->name }}</div>
                                    <div class="text-muted small">Code: {{ $program->code }}</div>
                                </td>
                                <td>{{ $program->deleted_at->format('d/m/Y H:i') }}</td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <form action="{{ route('trash.restore', ['study-program', $program->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3 me-2">
                                                <i class="bi bi-arrow-counterclockwise"></i> Pulihkan
                                            </button>
                                        </form>
                                        <form action="{{ route('trash.force-delete', ['study-program', $program->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus permanen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-5 text-center text-muted">Tempat sampah kosong</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Subjects Tab -->
        <div class="tab-pane fade" id="subjects" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="ps-4 py-3">Mata Kuliah</th>
                            <th class="py-3">Tgl Hapus</th>
                            <th class="py-3 text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deletedSubjects as $subject)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $subject->name }}</div>
                                    <div class="text-muted small">Code: {{ $subject->code }}</div>
                                </td>
                                <td>{{ $subject->deleted_at->format('d/m/Y H:i') }}</td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <form action="{{ route('trash.restore', ['subject', $subject->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3 me-2">
                                                <i class="bi bi-arrow-counterclockwise"></i> Pulihkan
                                            </button>
                                        </form>
                                        <form action="{{ route('trash.force-delete', ['subject', $subject->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus permanen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-5 text-center text-muted">Tempat sampah kosong</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .fw-800 { font-weight: 800; }
    #trashTabs.nav-pills .nav-link { 
        color: var(--text-main) !important; 
        background-color: var(--bg-body);
        font-weight: 700; 
        transition: all 0.3s ease;
        margin: 0 4px;
        border: 1px solid var(--border-color) !important;
        opacity: 0.7;
    }
    #trashTabs.nav-pills .nav-link:hover {
        background-color: #ffffff;
        opacity: 1;
        border-color: var(--brand-navy) !important;
        color: var(--brand-navy) !important;
    }
    [data-bs-theme="dark"] #trashTabs.nav-pills .nav-link:hover { 
        background-color: rgba(255,255,255,0.05);
        color: var(--brand-yellow) !important;
        border-color: var(--brand-yellow) !important;
    }
    
    #trashTabs.nav-pills .nav-link.active { 
        opacity: 1;
        background-color: var(--brand-navy) !important; 
        color: #ffffff !important; 
        border-color: var(--brand-navy) !important;
        box-shadow: 0 4px 12px rgba(41, 22, 111, 0.2);
    }
    [data-bs-theme="dark"] #trashTabs.nav-pills .nav-link.active {
        background-color: var(--brand-yellow) !important;
        color: var(--brand-navy) !important;
        border-color: var(--brand-yellow) !important;
        box-shadow: 0 4px 12px rgba(255, 245, 0, 0.2);
    }
    .table thead th { border-bottom: none; }
    .table tbody td { border-bottom: 1px solid var(--border-color); }
    .table tbody tr:last-child td { border-bottom: none; }
</style>
@endsection
