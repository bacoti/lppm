@extends('frontend.layouts.app')

@section('title', 'Hak Kekayaan Intelektual (HAKI)')

@section('content')
<!-- Hero Section -->
<div class="haki-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-icon mb-3">
                    <i class="fas fa-copyright"></i>
                </div>
                <h1 class="hero-title mb-3">Hak Kekayaan Intelektual (HAKI)</h1>
                <p class="hero-subtitle">Inovasi dan kreativitas yang telah terlindungi hak kekayaan intelektualnya dari LPPM LPKIA</p>
                <div class="hero-stats mt-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Haki::count() }}</div>
                                <div class="stat-label">Total HAKI</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Haki::where('status', 'granted')->count() }}</div>
                                <div class="stat-label">Granted</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Haki::where('jenis_haki', 'paten')->count() }}</div>
                                <div class="stat-label">Paten</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Haki::where('jenis_haki', 'hak_cipta')->count() }}</div>
                                <div class="stat-label">Hak Cipta</div>
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
                    <i class="fas fa-filter text-info me-2"></i>
                    <h5 class="mb-0 fw-bold">Filter & Pencarian</h5>
                </div>
                <form action="{{ route('frontend.haki') }}" method="GET" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="search" class="form-label small text-muted">
                                <i class="fas fa-search me-1"></i>Kata Kunci
                            </label>
                            <input type="text" name="q" id="search" value="{{ request('q') }}"
                                   class="form-control form-control-lg" 
                                   placeholder="Cari judul, inventor, atau bidang teknologi...">
                        </div>
                        <div class="col-md-3">
                            <label for="jenis" class="form-label small text-muted">
                                <i class="fas fa-tag me-1"></i>Jenis HAKI
                            </label>
                            <select name="jenis" id="jenis" class="form-select form-select-lg">
                                <option value="">Semua Jenis</option>
                                @foreach($jenisOptions as $key => $label)
                                    <option value="{{ $key }}" {{ request('jenis') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="status" class="form-label small text-muted">
                                <i class="fas fa-check-circle me-1"></i>Status
                            </label>
                            <select name="status" id="status" class="form-select form-select-lg">
                                <option value="">Semua Status</option>
                                @foreach($statusOptions as $key => $label)
                                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label small text-muted d-block">&nbsp;</label>
                            <button type="submit" class="btn btn-info btn-lg w-100">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small text-muted d-block">&nbsp;</label>
                            <a href="{{ route('frontend.haki') }}" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="fas fa-redo me-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Results Info -->
    @if(request()->has('q') || request()->has('jenis') || request()->has('status'))
    <div class="alert alert-info border-0 shadow-sm mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-info-circle me-2"></i>
            <div>
                <strong>Hasil Pencarian:</strong> 
                Ditemukan <strong>{{ $hakis->total() }}</strong> HAKI
                @if(request('q'))
                    dengan kata kunci "<strong>{{ request('q') }}</strong>"
                @endif
                @if(request('jenis'))
                    jenis <strong>{{ $jenisOptions[request('jenis')] }}</strong>
                @endif
                @if(request('status'))
                    status <strong>{{ $statusOptions[request('status')] }}</strong>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- HAKI Cards Grid -->
    <div class="row g-4 mb-5">
        @forelse($hakis as $haki)
            <div class="col-lg-6 col-md-6">
                <div class="haki-card h-100">
                    <!-- Card Header -->
                    <div class="haki-card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="jenis-badge jenis-{{ $haki->jenis_haki }}">
                                <i class="fas fa-copyright me-1"></i>{{ $jenisOptions[$haki->jenis_haki] }}
                            </span>
                            <span class="status-badge status-{{ $haki->status }}">
                                @if($haki->status == 'granted')
                                    <i class="fas fa-check-circle me-1"></i>
                                @elseif($haki->status == 'dalam_proses')
                                    <i class="fas fa-clock me-1"></i>
                                @elseif($haki->status == 'dipublikasi')
                                    <i class="fas fa-file-alt me-1"></i>
                                @else
                                    <i class="fas fa-info-circle me-1"></i>
                                @endif
                                {{ $statusOptions[$haki->status] }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="haki-card-body">
                        <!-- Title -->
                        <h5 class="haki-title">{{ $haki->judul }}</h5>
                        
                        <!-- Description -->
                        @if($haki->deskripsi)
                        <p class="haki-description">{{ Str::limit($haki->deskripsi, 120) }}</p>
                        @endif

                        <!-- Inventor Section -->
                        <div class="inventor-section mb-3">
                            <div class="inventor-label">Inventor/Pencipta</div>
                            <div class="inventor-names">
                                @if(is_array($haki->inventor))
                                    {{ implode(', ', $haki->inventor) }}
                                @else
                                    {{ $haki->inventor }}
                                @endif
                            </div>
                        </div>

                        <!-- Details Grid -->
                        <div class="details-grid">
                            @if($haki->nomor_pendaftaran)
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-file-contract"></i>
                                    <span>No. Pendaftaran</span>
                                </div>
                                <div class="detail-value">{{ $haki->nomor_pendaftaran }}</div>
                            </div>
                            @endif

                            @if($haki->tanggal_daftar)
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-calendar"></i>
                                    <span>Tanggal Daftar</span>
                                </div>
                                <div class="detail-value">{{ $haki->tanggal_daftar->format('d M Y') }}</div>
                            </div>
                            @endif

                            @if($haki->bidang_teknologi)
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-cog"></i>
                                    <span>Bidang Teknologi</span>
                                </div>
                                <div class="detail-value">{{ $haki->bidang_teknologi }}</div>
                            </div>
                            @endif

                            @if($haki->kantor_kekayaan_intelektual)
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-building"></i>
                                    <span>Kantor KI</span>
                                </div>
                                <div class="detail-value">{{ $haki->kantor_kekayaan_intelektual }}</div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="haki-card-footer">
                        <a href="{{ route('frontend.haki.show', $haki) }}" class="btn-detail">
                            Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-copyright"></i>
                    </div>
                    <h4 class="empty-title">Tidak Ada HAKI Ditemukan</h4>
                    <p class="empty-text">
                        @if(request()->has('q') || request()->has('jenis') || request()->has('status'))
                            Coba ubah kata kunci atau filter pencarian Anda
                        @else
                            Belum ada data HAKI yang tersedia
                        @endif
                    </p>
                    @if(request()->has('q') || request()->has('jenis') || request()->has('status'))
                        <a href="{{ route('frontend.haki') }}" class="btn btn-info">
                            <i class="fas fa-redo me-2"></i>Reset Pencarian
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($hakis->hasPages())
    <div class="d-flex justify-content-center">
        <nav aria-label="HAKI pagination">
            {{ $hakis->withQueryString()->links('pagination::bootstrap-5') }}
        </nav>
    </div>
    @endif
</div>

@push('styles')
<style>
/* Hero Section */
.haki-hero-section {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
    padding: 80px 0 60px;
    color: white;
    position: relative;
    overflow: hidden;
}

.haki-hero-section::before {
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
    max-width: 700px;
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
    border-color: #17a2b8;
    box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
}

/* HAKI Cards - Enhanced Clear Separation */
.haki-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    border: 3px solid #e3f2fd;
    display: flex;
    flex-direction: column;
    margin-bottom: 2rem;
    position: relative;
}

.haki-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #17a2b8 0%, #6f42c1 100%);
    z-index: 1;
}

.haki-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(23, 162, 184, 0.25);
    border-color: #17a2b8;
}

.haki-card-header {
    padding: 15px 20px;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-bottom: 3px solid rgba(23, 162, 184, 0.3);
}

.jenjang-badge, .status-badge {
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.jenjang-badge.jenjang-paten { background: #dbeafe; color: #1e40af; }
.jenjang-badge.jenjang-merek { background: #fef3c7; color: #92400e; }
.jenjang-badge.jenjang-hak_cipta { background: #dcfce7; color: #166534; }
.jenjang-badge.jenjang-desain_industri { background: #fde2e7; color: #9f1239; }
.jenjang-badge.jenjang-rahasia_dagang { background: #ede9fe; color: #6b46c1; }

.status-badge.status-granted { background: #dcfce7; color: #166534; }
.status-badge.status-dalam_proses { background: #fef3c7; color: #92400e; }
.status-badge.status-dipublikasi { background: #dbeafe; color: #1e40af; }
.status-badge.status-diajukan { background: #e0e7ff; color: #3730a3; }

.haki-card-body {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
    background: #fafafa;
    border-left: 4px solid #17a2b8;
    margin: 3px;
    border-radius: 12px;
}

.haki-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 15px;
    line-height: 1.4;
}

.haki-description {
    color: #4a5568;
    margin-bottom: 20px;
    line-height: 1.6;
}

.inventor-section {
    padding: 15px 12px;
    border-bottom: 2px solid #e2e8f0;
    background: white;
    border-radius: 8px;
    margin-bottom: 15px;
}

.inventor-label {
    font-size: 0.75rem;
    color: #17a2b8;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.inventor-names {
    font-size: 0.95rem;
    color: #1a202c;
    font-weight: 600;
}

.details-grid {
    display: grid;
    gap: 12px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: start;
    padding: 12px;
    background: white;
    border-radius: 8px;
    border-left: 4px solid #17a2b8;
}

.detail-label {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    font-size: 0.85rem;
    font-weight: 500;
    flex: 1;
}

.detail-label i {
    color: #17a2b8;
    width: 14px;
}

.detail-value {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.85rem;
    text-align: right;
    flex: 1;
}

.haki-card-footer {
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-top: 3px solid #17a2b8;
    margin: 3px;
    border-radius: 12px;
}

.btn-detail {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 12px;
    background: #17a2b8;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.btn-detail:hover {
    background: #138496;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
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
    
    .haki-hero-section {
        padding: 50px 0 40px;
    }

    .haki-card-header {
        flex-direction: column;
        gap: 10px;
    }

    .detail-item {
        flex-direction: column;
        gap: 5px;
    }

    .detail-value {
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

.haki-card {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.haki-card:nth-child(1) { animation-delay: 0.1s; }
.haki-card:nth-child(2) { animation-delay: 0.2s; }
.haki-card:nth-child(3) { animation-delay: 0.3s; }
.haki-card:nth-child(4) { animation-delay: 0.4s; }
.haki-card:nth-child(5) { animation-delay: 0.5s; }
.haki-card:nth-child(6) { animation-delay: 0.6s; }

/* Pagination */
.pagination {
    gap: 5px;
}

.page-link {
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    color: #17a2b8;
    font-weight: 600;
    transition: all 0.3s ease;
}

.page-link:hover {
    background: #17a2b8;
    border-color: #17a2b8;
    color: white;
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: #17a2b8;
    border-color: #17a2b8;
}
</style>
@endpush
@endsection