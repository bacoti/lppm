@extends('frontend.layouts.app')

@section('title', 'Kualifikasi Dosen')

@section('content')
<!-- Hero Section -->
<div class="qualification-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-icon mb-3">
                    <i class="fas fa-university"></i>
                </div>
                <h1 class="hero-title mb-3">Kualifikasi Dosen LPKIA</h1>
                <p class="hero-subtitle">Jelajahi kualifikasi pendidikan dan keahlian akademik dosen-dosen berkualitas di LPKIA</p>
                <div class="hero-stats mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Qualification::count() }}</div>
                                <div class="stat-label">Total Kualifikasi</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Qualification::where('jenjang_pendidikan', 'LIKE', '%S3%')->count() }}</div>
                                <div class="stat-label">Doktor</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Qualification::where('jenjang_pendidikan', 'LIKE', '%S2%')->count() }}</div>
                                <div class="stat-label">Magister</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Search & Filter Section -->
    <div class="search-filter-section mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-search text-primary me-2"></i>
                    <h5 class="mb-0 fw-bold">Cari Kualifikasi Dosen</h5>
                </div>
                <form action="{{ route('pangkalan.kualifikasi') }}" method="GET" id="searchForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="search" class="form-label small text-muted">
                                <i class="fas fa-user-search me-1"></i>Kata Kunci
                            </label>
                            <input type="text" name="q" id="search" value="{{ $query ?? '' }}"
                                   class="form-control form-control-lg" 
                                   placeholder="Cari nama dosen, NIDN, atau bidang keilmuan...">
                        </div>
                        <div class="col-md-3">
                            <label for="jenjang" class="form-label small text-muted">
                                <i class="fas fa-graduation-cap me-1"></i>Jenjang Pendidikan
                            </label>
                            <select name="jenjang" id="jenjang" class="form-select form-select-lg">
                                <option value="">Semua Jenjang</option>
                                <option value="S1" {{ request('jenjang') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ request('jenjang') == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ request('jenjang') == 'S3' ? 'selected' : '' }}>S3</option>
                                <option value="Profesi" {{ request('jenjang') == 'Profesi' ? 'selected' : '' }}>Profesi</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label small text-muted d-block">&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small text-muted d-block">&nbsp;</label>
                            <a href="{{ route('pangkalan.kualifikasi') }}" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="fas fa-redo me-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Results Info -->
    @if(request()->has('q') || request()->has('jenjang'))
    <div class="alert alert-info border-0 shadow-sm mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-info-circle me-2"></i>
            <div>
                <strong>Hasil Pencarian:</strong> 
                Ditemukan <strong>{{ $qualifications->total() }}</strong> kualifikasi
                @if($query)
                    dengan kata kunci "<strong>{{ $query }}</strong>"
                @endif
                @if(request('jenjang'))
                    dengan jenjang <strong>{{ request('jenjang') }}</strong>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Qualification Table Section -->
    <div class="qualification-table-section">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="mb-0"><i class="fas fa-graduation-cap mr-2"></i>Daftar Kualifikasi Dosen</h4>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge badge-light">{{ $qualifications->total() }} kualifikasi tersedia</span>
                        @if($qualifications->hasPages())
                        <span class="badge badge-light">Halaman {{ $qualifications->currentPage() }} dari {{ $qualifications->lastPage() }}</span>
                        @endif
                        @if(request('jenjang'))
                        <span class="badge badge-info">{{ request('jenjang') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                @if($qualifications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%" class="text-center">#</th>
                                <th width="20%">Nama Dosen</th>
                                <th width="15%">NIDN</th>
                                <th width="15%">Jenjang</th>
                                <th width="20%">Bidang Keilmuan</th>
                                <th width="15%">Perguruan Tinggi</th>
                                <th width="10%">Tahun Lulus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($qualifications as $index => $qualification)
                            <tr>
                                <td class="text-center">{{ $qualifications->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dosen-avatar-table me-3">
                                            {{ strtoupper(substr($qualification->dosen?->nama_lengkap ?? 'N', 0, 2)) }}
                                        </div>
                                        <div>
                                            <strong>{{ $qualification->dosen?->nama_lengkap ?? 'N/A' }}</strong>
                                            @if($qualification->gelar_akademik)
                                            <br>
                                            <small class="text-muted">{{ $qualification->gelar_akademik }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($qualification->dosen?->nidn_nip)
                                        <span class="badge bg-light text-dark">{{ $qualification->dosen->nidn_nip }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($qualification->jenjang_pendidikan)
                                        <span class="badge
                                            @if(str_contains(strtolower($qualification->jenjang_pendidikan), 's1')) badge-warning
                                            @elseif(str_contains(strtolower($qualification->jenjang_pendidikan), 's2')) badge-info
                                            @elseif(str_contains(strtolower($qualification->jenjang_pendidikan), 's3')) badge-success
                                            @else badge-secondary @endif">
                                            <i class="fas fa-graduation-cap mr-1"></i>{{ $qualification->jenjang_pendidikan }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($qualification->bidang_keilmuan)
                                        {{ Str::limit($qualification->bidang_keilmuan, 40) }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($qualification->nama_perguruan_tinggi)
                                        {{ Str::limit($qualification->nama_perguruan_tinggi, 35) }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($qualification->tahun_lulus)
                                        <span class="badge badge-outline-secondary">{{ $qualification->tahun_lulus }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-graduation-cap fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Tidak ada data kualifikasi ditemukan</h4>
                    <p class="text-muted mb-4">
                        @if(request()->hasAny(['q', 'jenjang']))
                            Coba ubah kriteria pencarian atau filter Anda untuk menemukan data kualifikasi yang diinginkan.
                        @else
                            Belum ada data kualifikasi yang dipublikasikan saat ini.
                        @endif
                    </p>
                    @if(request()->hasAny(['q', 'jenjang']))
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('pangkalan.kualifikasi') }}" class="btn btn-primary">
                            <i class="fas fa-refresh mr-1"></i>Reset Filter
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i class="fas fa-home mr-1"></i>Kembali ke Beranda
                        </a>
                    </div>
                    @else
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home mr-1"></i>Kembali ke Beranda
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <!-- Pagination -->
        @if($qualifications->hasPages())
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Kualifikasi pagination">
                {{ $qualifications->withQueryString()->links('pagination::bootstrap-5') }}
            </nav>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
/* Hero Section */
.qualification-hero-section {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    padding: 80px 0 60px;
    color: white;
    position: relative;
    overflow: hidden;
}

.qualification-hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
    opacity: 0.3;
}

.hero-icon i {
    font-size: 4rem;
    opacity: 0.9;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: 1.25rem;
    opacity: 0.95;
    max-width: 600px;
    margin: 0 auto;
}

.hero-stats {
    position: relative;
    z-index: 1;
}

.stat-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 20px;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
    margin-top: 5px;
}

/* Search & Filter Section */
.search-filter-section .card {
    border-radius: 15px;
    transition: box-shadow 0.3s ease;
}

.search-filter-section .card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.form-control:focus, .form-select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
}

/* Qualification Table */
.qualification-table-section .table th {
    vertical-align: middle;
    font-weight: 600;
    background: #343a40;
    color: white;
    border: none;
}

.qualification-table-section .table td {
    vertical-align: middle;
    border: none;
}

.qualification-table-section .table tbody tr:hover {
    background-color: #f8f9fa;
}

.dosen-avatar-table {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    font-weight: 700;
    flex-shrink: 0;
}

.badge-outline-secondary {
    color: #6c757d;
    border: 1px solid #6c757d;
    background: transparent;
}

/* Responsive Table */
@media (max-width: 768px) {
    .qualification-table-section .table-responsive {
        font-size: 0.875rem;
    }

    .qualification-table-section .table th,
    .qualification-table-section .table td {
        padding: 0.5rem;
    }

    .dosen-avatar-table {
        width: 35px;
        height: 35px;
        font-size: 0.9rem;
    }
}

/* Pagination */
.pagination {
    gap: 5px;
}

.page-link {
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    color: #2563eb;
    font-weight: 600;
    transition: all 0.3s ease;
}

.page-link:hover {
    background: #2563eb;
    border-color: #2563eb;
    color: white;
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: #2563eb;
    border-color: #2563eb;
}
</style>
@endpush
@endsection
