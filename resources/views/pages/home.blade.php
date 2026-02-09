@extends('layouts.app')

@section('title', 'Dashboard - Sisfo Decode')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <!-- Welcome Card with Brand Colors -->
            <div class="card overflow-hidden shadow-lg border-0 hero-card" style="background: linear-gradient(135deg, var(--brand-navy) 0%, #1e1150 100%);">
                <div class="card-body p-5 position-relative">
                    <!-- Glassmorphism decorative element -->
                    <div class="position-absolute translate-middle" style="top: 0; right: -50px; width: 200px; height: 200px; background: var(--brand-yellow); opacity: 0.1; filter: blur(50px); border-radius: 50%;"></div>
                    
                    <div class="row align-items-center position-relative">
                        <div class="col-md-8">
                            <h1 class="fw-bold mb-2 text-white">Selamat Datang di <span style="color: var(--brand-yellow)">Sisfo Decode</span></h1>
                            <p class="mb-0 text-white opacity-75 fs-5">Sistem Informasi Akademik yang powerful, aman, dan modern.</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-4 mt-md-0">
                            <div class="d-inline-flex align-items-center bg-white bg-opacity-10 text-white rounded-4 px-4 py-3 border border-white border-opacity-10 shadow-sm backdrop-blur">
                                <i class="bi bi-calendar3 me-3 fs-4 text-warning"></i>
                                <div class="text-start">
                                    <div class="small fw-medium opacity-50 text-uppercase tracking-wider">Hari Ini</div>
                                    <div class="fw-bold">{{ date('d M Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Stats Cards with Brand Left Border -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 stats-card" style="border-left: 5px solid var(--brand-navy) !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-4">
                            <i class="bi bi-mortarboard fs-3 text-primary"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted fw-bold small text-uppercase mb-1 tracking-wider">Program Studi</h6>
                            <h2 class="fw-800 mb-0">{{ $stats['studyProgramCount'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 stats-card" style="border-left: 5px solid var(--brand-yellow) !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-warning bg-opacity-10 p-3 rounded-4">
                            <i class="bi bi-people fs-3 text-warning"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted fw-bold small text-uppercase mb-1 tracking-wider">Total Mahasiswa</h6>
                            <h2 class="fw-800 mb-0">{{ $stats['studentCount'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 stats-card" style="border-left: 5px solid #3b82f6 !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-info bg-opacity-10 p-3 rounded-4">
                            <i class="bi bi-journal-check fs-3 text-info"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted fw-bold small text-uppercase mb-1 tracking-wider">Mata Kuliah</h6>
                            <h2 class="fw-800 mb-0">{{ $stats['subjectCount'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Chart Section -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Distribusi Akademik</h5>
                        <p class="text-muted small mb-0">Statistik mahasiswa per program studi</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm rounded-pill px-3" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots me-2"></i>Opsi
                        </button>
                        <ul class="dropdown-menu border-0 shadow-lg rounded-4">
                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-download me-2"></i>Unduh PNG</a></li>
                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-printer me-2"></i>Cetak Laporan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div id="studentChart" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>

        <!-- Latest Students Section -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-header bg-white border-0 py-4 px-4">
                    <h5 class="fw-bold mb-1">Update Terkini</h5>
                    <p class="text-muted small mb-0">Mahasiswa yang baru bergabung</p>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($stats['latestStudents'] as $student)
                            <div class="list-group-item border-0 py-3 px-4 d-flex align-items-center action-list-item">
                                <div class="flex-shrink-0">
                                    <div class="avatar bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-weight: 700;">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="ms-3 overflow-hidden">
                                    <h6 class="mb-0 fw-bold text-truncate text-dark">{{ $student->name }}</h6>
                                    <div class="d-flex align-items-center text-muted small mt-1">
                                        <i class="bi bi-person-badge-fill me-1"></i>
                                        <span>{{ $student->nim }}</span>
                                        <span class="mx-1">•</span>
                                        <span class="text-truncate">{{ $student->studyProgram->name }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-5 text-center text-muted">
                                <i class="bi bi-inbox fs-1 opacity-25 d-block mb-3"></i>
                                Belum ada data mahasiswa
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-4 text-center">
                    <a href="{{ url('/students') }}" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">
                        Lihat Data Lengkap <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const prodis = {!! json_encode(array_column($stats['studentsPerProgram'], 'name')) !!};
            const counts = {!! json_encode(array_column($stats['studentsPerProgram'], 'count')) !!};

            var options = {
                series: [{
                    name: 'Jumlah Mahasiswa',
                    data: counts
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: { show: false },
                    fontFamily: 'Inter, sans-serif'
                },
                plotOptions: {
                    bar: {
                        borderRadius: 12,
                        columnWidth: '40%',
                        distributed: true,
                    }
                },
                /* Colors based on brand palette */
                colors: ['#29166F', '#FFF500', '#3b82f6', '#10b981', '#f59e0b', '#ef4444'],
                dataLabels: { enabled: false },
                legend: { show: false },
                xaxis: {
                    categories: prodis,
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: { style: { colors: '#94a3b8', fontWeight: 500 } }
                },
                yaxis: {
                    labels: { style: { colors: '#94a3b8', fontWeight: 500 } }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                    xaxis: { lines: { show: false } }
                },
                tooltip: {
                    theme: document.documentElement.getAttribute('data-bs-theme') || 'light',
                    y: { formatter: (val) => val + " Mahasiswa" }
                }
            };

            var chart = new ApexCharts(document.querySelector("#studentChart"), options);
            chart.render();

            // Handle Theme Change
            window.addEventListener('themeChanged', function(e) {
                chart.updateOptions({
                    tooltip: {
                        theme: e.detail.theme
                    }
                });
            });
        });
    </script>
@endsection

@section('styles')
<style>
    .hero-card h1, .hero-card p, .hero-card .fw-bold { color: #ffffff !important; }
    .hero-card .text-warning { color: var(--brand-yellow) !important; }
    
    .stats-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 30px -10px rgba(0,0,0,0.1) !important;
    }
    .action-list-item {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .action-list-item:hover {
        background-color: var(--input-bg) !important;
    }
    [data-bs-theme="dark"] .card-header, [data-bs-theme="dark"] .card-footer {
        background-color: transparent !important;
    }
</style>
@endsection
