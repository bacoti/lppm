@extends('frontend.layouts.app')

@section('title', 'Kompetensi Dosen')

@section('content')
<!-- Hero Section -->
<div class="competence-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-icon mb-3">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1 class="hero-title mb-3">Kompetensi Dosen LPKIA</h1>
                <p class="hero-subtitle">Jelajahi keahlian dan kompetensi dosen-dosen berkualitas di LPKIA</p>
                <div class="hero-stats mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Competence::count() }}</div>
                                <div class="stat-label">Total Kompetensi</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Competence::where('status_sertifikasi', 'aktif')->count() }}</div>
                                <div class="stat-label">Tersertifikasi</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Dosen::count() }}</div>
                                <div class="stat-label">Dosen Aktif</div>
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
                    <h5 class="mb-0 fw-bold">Cari Kompetensi Dosen</h5>
                </div>
                <form action="{{ route('pangkalan.kompetensi') }}" method="GET" id="searchForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="search" class="form-label small text-muted">
                                <i class="fas fa-user-search me-1"></i>Kata Kunci
                            </label>
                            <input type="text" name="q" id="search" value="{{ $query ?? '' }}"
                                   class="form-control form-control-lg" 
                                   placeholder="Cari nama dosen, NIDN, atau bidang keahlian...">
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="form-label small text-muted">
                                <i class="fas fa-certificate me-1"></i>Status Sertifikasi
                            </label>
                            <select name="status" id="status" class="form-select form-select-lg">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ ($status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ ($status ?? '') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="proses_perpanjangan" {{ ($status ?? '') == 'proses_perpanjangan' ? 'selected' : '' }}>Proses Perpanjangan</option>
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
                            <a href="{{ route('pangkalan.kompetensi') }}" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="fas fa-redo me-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Results Info -->
    @if(request()->has('q') || request()->has('status'))
    <div class="alert alert-info border-0 shadow-sm mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-info-circle me-2"></i>
            <div>
                <strong>Hasil Pencarian:</strong> 
                Ditemukan <strong>{{ $competences->total() }}</strong> kompetensi
                @if($query)
                    dengan kata kunci "<strong>{{ $query }}</strong>"
                @endif
                @if($status ?? '')
                    dengan status <strong>{{ ucfirst(str_replace('_', ' ', $status)) }}</strong>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Competence Table Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="mb-0"><i class="fas fa-graduation-cap mr-2"></i>Daftar Kompetensi Dosen</h4>
                <div class="d-flex gap-2 flex-wrap">
                    <span class="badge badge-light">{{ $competences->total() }} kompetensi tersedia</span>
                    @if($competences->hasPages())
                    <span class="badge badge-light">Halaman {{ $competences->currentPage() }} dari {{ $competences->lastPage() }}</span>
                    @endif
                    @if($query)
                    <span class="badge badge-info">{{ $query }}</span>
                    @endif
                    @if($status ?? '')
                    <span class="badge badge-warning">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($competences->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="20%">Nama Dosen</th>
                            <th width="15%">NIDN</th>
                            <th width="15%">Jenjang Pendidikan</th>
                            <th width="20%">Bidang Keilmuan</th>
                            <th width="10%">Status Sertifikasi</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($competences as $index => $competence)
                        <tr>
                            <td class="text-center">{{ $competences->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="dosen-avatar-table me-3">
                                        {{ strtoupper(substr($competence->dosen?->nama_lengkap ?? 'N', 0, 2)) }}
                                    </div>
                                    <div>
                                        <strong>{{ $competence->dosen?->nama_lengkap ?? 'N/A' }}</strong>
                                        @if($competence->tahun_lulus)
                                        <br>
                                        <small class="text-muted">Lulus {{ $competence->tahun_lulus }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($competence->dosen?->nidn_nip)
                                    <span class="badge bg-light text-dark">{{ $competence->dosen->nidn_nip }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($competence->jenjang_pendidikan)
                                    <span class="badge badge-primary">{{ $competence->jenjang_pendidikan }}</span>
                                    @if($competence->nama_perguruan_tinggi)
                                    <br>
                                    <small class="text-muted">{{ Str::limit($competence->nama_perguruan_tinggi, 25) }}</small>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($competence->bidang_keilmuan)
                                    <span class="badge badge-outline-secondary">{{ Str::limit($competence->bidang_keilmuan, 30) }}</span>
                                    @if($competence->metodologi_pengajaran)
                                    <br>
                                    <small class="text-muted">{{ Str::limit($competence->metodologi_pengajaran, 35) }}</small>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($competence->status_sertifikasi)
                                    <span class="badge {{ $competence->status_sertifikasi == 'aktif' ? 'bg-success' : ($competence->status_sertifikasi == 'tidak_aktif' ? 'bg-danger' : 'bg-warning') }}">
                                        @if($competence->status_sertifikasi == 'aktif')
                                            <i class="fas fa-check-circle me-1"></i>Aktif
                                        @elseif($competence->status_sertifikasi == 'tidak_aktif')
                                            <i class="fas fa-times-circle me-1"></i>Tidak Aktif
                                        @else
                                            <i class="fas fa-clock me-1"></i>Proses
                                        @endif
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($competence->sertifikat_pendidik)
                                    <button class="btn btn-info btn-sm" title="Sertifikat: {{ $competence->sertifikat_pendidik }}">
                                        <i class="fas fa-award"></i> Sertifikat
                                    </button>
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
                <h4 class="text-muted mb-3">Tidak ada kompetensi ditemukan</h4>
                <p class="text-muted mb-4">
                    @if(request()->has('q') || request()->has('status'))
                        Coba ubah kriteria pencarian atau filter Anda untuk menemukan kompetensi yang diinginkan.
                    @else
                        Belum ada data kompetensi yang dipublikasikan saat ini.
                    @endif
                </p>
                @if(request()->has('q') || request()->has('status'))
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('pangkalan.kompetensi') }}" class="btn btn-primary">
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
    @if($competences->hasPages())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Kompetensi pagination">
            {{ $competences->withQueryString()->links('pagination::bootstrap-5') }}
        </nav>
    </div>
    @endif
</div>

@push('styles')
<style>
/* Hero Section */
.competence-hero-section {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    padding: 80px 0 60px;
    color: white;
    position: relative;
    overflow: hidden;
}

.competence-hero-section::before {
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
    border-color: #6366f1;
    box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
}

/* Table Styles */
.dosen-avatar-table {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    font-weight: 700;
    flex-shrink: 0;
}

.badge-outline-secondary {
    color: #6c757d;
    border: 1px solid #6c757d;
    background: transparent;
}

.table th {
    vertical-align: middle;
    font-weight: 600;
}

.table td {
    vertical-align: middle;
}

.table-responsive {
    border-radius: 0;
}

/* Competence Cards - Keep for potential future use */
.competence-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    border: 2px solid #e5e7eb;
    display: flex;
    flex-direction: column;
}

.competence-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(99, 102, 241, 0.15);
    border-color: #6366f1;
}

.competence-card-header {
    padding: 20px;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.dosen-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    flex-shrink: 0;
}

.certification-badge {
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.certification-badge.status-aktif {
    background: #d1fae5;
    color: #065f46;
}

.certification-badge.status-tidak_aktif {
    background: #fee2e2;
    color: #991b1b;
}

.certification-badge.status-proses_perpanjangan {
    background: #fef3c7;
    color: #92400e;
}

.competence-card-body {
    padding: 25px;
    flex: 1;
}

.dosen-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 15px;
}

.nidn-info {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    font-size: 0.9rem;
    font-weight: 500;
}

.nidn-info i {
    color: #6366f1;
}

.education-section {
    background: #f9fafb;
    padding: 15px;
    border-radius: 10px;
    border-left: 4px solid #6366f1;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 10px;
}

.info-row:last-child {
    margin-bottom: 0;
}

.info-label {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    font-size: 0.85rem;
    font-weight: 500;
    min-width: 0;
    flex: 1;
}

.info-label i {
    color: #6366f1;
    width: 14px;
}

.info-value {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.85rem;
    text-align: right;
    flex: 1;
    min-width: 0;
}

.expertise-section {
    background: #ede9fe;
    padding: 12px;
    border-radius: 8px;
}

.expertise-label {
    font-size: 0.75rem;
    color: #6b46c1;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.expertise-tag {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #5b21b6;
    font-weight: 600;
    font-size: 0.9rem;
}

.methodology-section {
    padding-top: 12px;
    border-top: 1px solid #e5e7eb;
}

.methodology-label {
    font-size: 0.75rem;
    color: #6b7280;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.methodology-text {
    color: #4b5563;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

.competence-card-footer {
    padding: 15px 25px;
    background: #f9fafb;
    border-top: 1px solid #e5e7eb;
}

.certificate-info {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-icon {
    font-size: 5rem;
    color: #cbd5e0;
    margin-bottom: 20px;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 10px;
}

.empty-text {
    color: #718096;
    font-size: 1.1rem;
    margin-bottom: 25px;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .stat-number {
        font-size: 2rem;
    }

    .competence-hero-section {
        padding: 50px 0 40px;
    }

    .competence-card-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }

    .info-row {
        flex-direction: column;
        gap: 5px;
    }

    .info-value {
        text-align: left;
    }

    .table-responsive {
        font-size: 0.875rem;
    }

    .table th, .table td {
        padding: 0.5rem;
    }

    .dosen-avatar-table {
        width: 35px;
        height: 35px;
        font-size: 0.875rem;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.competence-card {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.competence-card:nth-child(1) { animation-delay: 0.1s; }
.competence-card:nth-child(2) { animation-delay: 0.2s; }
.competence-card:nth-child(3) { animation-delay: 0.3s; }
.competence-card:nth-child(4) { animation-delay: 0.4s; }
.competence-card:nth-child(5) { animation-delay: 0.5s; }
.competence-card:nth-child(6) { animation-delay: 0.6s; }

/* Pagination */
.pagination {
    gap: 5px;
}

.page-link {
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    color: #6366f1;
    font-weight: 600;
    padding: 10px 16px;
    transition: all 0.3s ease;
}

.page-link:hover {
    background-color: #6366f1;
    border-color: #6366f1;
    color: white;
}

.page-item.active .page-link {
    background: #6366f1;
    border-color: #6366f1;
    color: white;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit on status change
    const statusSelect = document.getElementById('status');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            document.getElementById('searchForm').submit();
        });
    }
});
</script>
@endpush
@endsection
