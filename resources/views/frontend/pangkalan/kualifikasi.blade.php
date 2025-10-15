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

    <!-- Qualification Cards Grid -->
    <div class="row g-4 mb-5">
        @forelse($qualifications as $qualification)
            <div class="col-lg-4 col-md-6">
                <div class="qualification-card h-100">
                    <!-- Card Header -->
                    <div class="qualification-card-header">
                        <div class="dosen-avatar">
                            {{ strtoupper(substr($qualification->dosen?->nama_lengkap ?? 'N', 0, 2)) }}
                        </div>
                        @if($qualification->jenjang_pendidikan)
                            <span class="jenjang-badge 
                                @if(str_contains(strtolower($qualification->jenjang_pendidikan), 's1')) jenjang-s1
                                @elseif(str_contains(strtolower($qualification->jenjang_pendidikan), 's2')) jenjang-s2  
                                @elseif(str_contains(strtolower($qualification->jenjang_pendidikan), 's3')) jenjang-s3
                                @else jenjang-profesi @endif">
                                <i class="fas fa-graduation-cap me-1"></i>{{ $qualification->jenjang_pendidikan }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="qualification-card-body">
                        <!-- Dosen Name -->
                        <h5 class="dosen-name">{{ $qualification->dosen?->nama_lengkap ?? 'N/A' }}</h5>
                        
                        <!-- NIDN -->
                        @if($qualification->dosen?->nidn_nip)
                        <div class="nidn-info mb-3">
                            <i class="fas fa-id-card"></i>
                            <span>NIDN: {{ $qualification->dosen->nidn_nip }}</span>
                        </div>
                        @endif

                        <!-- Education Info -->
                        <div class="education-section mb-3">
                            @if($qualification->bidang_keilmuan)
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fas fa-brain"></i>
                                    <span>Bidang Keilmuan</span>
                                </div>
                                <div class="info-value">{{ Str::limit($qualification->bidang_keilmuan, 30) }}</div>
                            </div>
                            @endif
                            @if($qualification->nama_perguruan_tinggi)
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fas fa-university"></i>
                                    <span>Perguruan Tinggi</span>
                                </div>
                                <div class="info-value">{{ Str::limit($qualification->nama_perguruan_tinggi, 30) }}</div>
                            </div>
                            @endif
                            @if($qualification->tahun_lulus)
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fas fa-calendar"></i>
                                    <span>Tahun Lulus</span>
                                </div>
                                <div class="info-value">{{ $qualification->tahun_lulus }}</div>
                            </div>
                            @endif
                        </div>

                        <!-- Academic Degree -->
                        @if($qualification->gelar_akademik)
                        <div class="degree-section mb-3">
                            <div class="degree-label">Gelar Akademik</div>
                            <div class="degree-tag">
                                <i class="fas fa-award"></i>
                                {{ $qualification->gelar_akademik }}
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Card Footer -->
                    <div class="qualification-card-footer">
                        @if($qualification->nama_perguruan_tinggi)
                        <div class="university-info">
                            <i class="fas fa-school text-primary"></i>
                            <span>{{ Str::limit($qualification->nama_perguruan_tinggi, 40) }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    @if($query ?? request()->anyFilled(['q', 'jenjang']))
                        <h3 class="empty-title">Tidak Ada Hasil Ditemukan</h3>
                        <p class="empty-text">Tidak ditemukan kualifikasi yang sesuai dengan kriteria pencarian Anda.</p>
                        <a href="{{ route('pangkalan.kualifikasi') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-refresh me-2"></i>Reset Pencarian
                        </a>
                    @else
                        <h3 class="empty-title">Belum Ada Data Kualifikasi</h3>
                        <p class="empty-text">Data kualifikasi dosen belum tersedia saat ini.</p>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($qualifications->hasPages())
    <div class="d-flex justify-content-center">
        <nav aria-label="Qualification pagination">
            {{ $qualifications->appends(['q' => $query ?? '', 'jenjang' => request('jenjang')])->links('pagination::bootstrap-5') }}
        </nav>
    </div>
    @endif
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

/* Qualification Cards */
.qualification-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    border: 2px solid #e5e7eb;
    display: flex;
    flex-direction: column;
}

.qualification-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(37, 99, 235, 0.15);
    border-color: #2563eb;
}

.qualification-card-header {
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
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    flex-shrink: 0;
}

.jenjang-badge {
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.jenjang-badge.jenjang-s1 {
    background: #fef3c7;
    color: #92400e;
}

.jenjang-badge.jenjang-s2 {
    background: #dbeafe;
    color: #1e40af;
}

.jenjang-badge.jenjang-s3 {
    background: #dcfce7;
    color: #166534;
}

.jenjang-badge.jenjang-profesi {
    background: #fde2e7;
    color: #9f1239;
}

.qualification-card-body {
    padding: 25px;
    flex: 1;
}

.dosen-name {
    color: #1f2937;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.3;
}

.nidn-info {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    font-size: 0.95rem;
    font-weight: 500;
}

.nidn-info i {
    color: #2563eb;
}

.education-section {
    background: #f9fafb;
    padding: 15px;
    border-radius: 10px;
    border-left: 4px solid #2563eb;
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
    color: #2563eb;
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

.degree-section {
    background: #ede9fe;
    padding: 12px;
    border-radius: 8px;
}

.degree-label {
    font-size: 0.75rem;
    color: #6b46c1;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.degree-tag {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #5b21b6;
    font-weight: 600;
    font-size: 0.9rem;
}

.qualification-card-footer {
    padding: 15px 25px;
    background: #f9fafb;
    border-top: 1px solid #e5e7eb;
}

.university-info {
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
    
    .qualification-hero-section {
        padding: 50px 0 40px;
    }

    .qualification-card-header {
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

.qualification-card {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.qualification-card:nth-child(1) { animation-delay: 0.1s; }
.qualification-card:nth-child(2) { animation-delay: 0.2s; }
.qualification-card:nth-child(3) { animation-delay: 0.3s; }
.qualification-card:nth-child(4) { animation-delay: 0.4s; }
.qualification-card:nth-child(5) { animation-delay: 0.5s; }
.qualification-card:nth-child(6) { animation-delay: 0.6s; }

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
