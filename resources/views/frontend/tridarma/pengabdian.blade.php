@extends('frontend.layouts.app')

@section('title', 'Pengabdian Masyarakat')

@section('content')
<!-- Hero Section -->
<div class="service-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-icon mb-3">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h1 class="hero-title mb-3">Pengabdian Kepada Masyarakat</h1>
                <p class="hero-subtitle">Wujud nyata kontribusi LPPM LPKIA untuk kemajuan dan kesejahteraan masyarakat</p>
                <div class="hero-stats mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Service::count() }}</div>
                                <div class="stat-label">Total Pengabdian</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Service::whereIn('status', ['ongoing', 'completed'])->count() }}</div>
                                <div class="stat-label">Aktif & Selesai</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Service::where('hibah_kompetitif', true)->count() }}</div>
                                <div class="stat-label">Hibah Kompetitif</div>
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
                    <i class="fas fa-filter text-success me-2"></i>
                    <h5 class="mb-0 fw-bold">Filter & Pencarian</h5>
                </div>
                <form action="{{ route('tridarma.pengabdian') }}" method="GET" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="search" class="form-label small text-muted">
                                <i class="fas fa-search me-1"></i>Kata Kunci
                            </label>
                            <input type="text" name="q" id="search" value="{{ request('q') }}"
                                   class="form-control form-control-lg" 
                                   placeholder="Cari judul atau lokasi pengabdian...">
                        </div>
                        <div class="col-md-3">
                            <label for="jenis" class="form-label small text-muted">
                                <i class="fas fa-tag me-1"></i>Jenis Pengabdian
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
                            <label for="tahun" class="form-label small text-muted">
                                <i class="fas fa-calendar me-1"></i>Tahun
                            </label>
                            <select name="tahun" id="tahun" class="form-select form-select-lg">
                                <option value="">Semua Tahun</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label small text-muted d-block">&nbsp;</label>
                            <button type="submit" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small text-muted d-block">&nbsp;</label>
                            <a href="{{ route('tridarma.pengabdian') }}" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="fas fa-redo me-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Results Info -->
    @if(request()->has('q') || request()->has('jenis') || request()->has('tahun'))
    <div class="alert alert-info border-0 shadow-sm mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-info-circle me-2"></i>
            <div>
                <strong>Hasil Pencarian:</strong> 
                Ditemukan <strong>{{ $services->total() }}</strong> pengabdian
                @if(request('q'))
                    dengan kata kunci "<strong>{{ request('q') }}</strong>"
                @endif
                @if(request('jenis'))
                    jenis <strong>{{ $jenisOptions[request('jenis')] }}</strong>
                @endif
                @if(request('tahun'))
                    pada tahun <strong>{{ request('tahun') }}</strong>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Service Cards Grid -->
    <div class="row g-5 mb-5">
        @forelse($services as $service)
            <div class="col-lg-6 col-md-6">
                <div class="service-card h-100">
                    <!-- Card Header with Year -->
                    <div class="service-card-header">
                        @if($service->tanggal_mulai)
                            <span class="year-badge">
                                <i class="far fa-calendar-alt me-2"></i>{{ $service->tanggal_mulai->format('Y') }}
                            </span>
                        @endif
                        @if($service->hibah_kompetitif)
                            <span class="hibah-badge">
                                <i class="fas fa-award me-2"></i>Hibah
                            </span>
                        @endif
                    </div>
                    
                    <div class="service-card-body">
                        <!-- Category Badge -->
                        @if($service->jenis_pengabdian)
                        <div class="category-badge mb-3">
                            {{ $jenisOptions[$service->jenis_pengabdian] ?? 'Pengabdian' }}
                        </div>
                        @endif

                        <!-- Title -->
                        <h5 class="service-title">{{ Str::limit($service->judul, 100) }}</h5>
                        
                        <!-- Location -->
                        @if($service->lokasi)
                        <div class="location-info mb-3">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ Str::limit($service->lokasi, 60) }}</span>
                        </div>
                        @endif

                        <!-- Coordinator -->
                        <div class="coordinator-section mb-3">
                            <div class="coordinator-label">Penanggung Jawab</div>
                            <div class="coordinator-name">{{ $service->dosen?->nama_lengkap ?? 'N/A' }}</div>
                        </div>

                        <!-- Timeline -->
                        @if($service->tanggal_mulai && $service->tanggal_selesai)
                        <div class="timeline-info">
                            <div class="timeline-item">
                                <span class="timeline-label">Mulai:</span>
                                <span class="timeline-date">{{ $service->tanggal_mulai->format('d M Y') }}</span>
                            </div>
                            <div class="timeline-item">
                                <span class="timeline-label">Selesai:</span>
                                <span class="timeline-date">{{ $service->tanggal_selesai->format('d M Y') }}</span>
                            </div>
                        </div>
                        @endif

                        <!-- Status & Progress -->
                        <div class="status-section mt-3">
                            @if($service->status)
                            <span class="status-badge status-{{ $service->status }}">
                                {{ \App\Models\Service::getStatusOptions()[$service->status] ?? ucfirst($service->status) }}
                            </span>
                            @endif
                            @if($service->progress_percentage !== null)
                            <span class="progress-badge">
                                {{ $service->progress_percentage }}%
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="service-card-footer">
                        <a href="{{ route('frontend.services.show', $service->id) }}" class="btn-detail">
                            Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h4 class="empty-title">Tidak Ada Pengabdian Ditemukan</h4>
                    <p class="empty-text">
                        @if(request()->has('q') || request()->has('jenis') || request()->has('tahun'))
                            Coba ubah kata kunci atau filter pencarian Anda
                        @else
                            Belum ada data pengabdian yang tersedia
                        @endif
                    </p>
                    @if(request()->has('q') || request()->has('jenis') || request()->has('tahun'))
                        <a href="{{ route('tridarma.pengabdian') }}" class="btn btn-success">
                            <i class="fas fa-redo me-2"></i>Reset Pencarian
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($services->hasPages())
    <div class="d-flex justify-content-center">
        <nav aria-label="Service pagination">
            {{ $services->withQueryString()->links('pagination::bootstrap-5') }}
        </nav>
    </div>
    @endif
</div>

@push('styles')
<style>
/* Hero Section */
.service-hero-section {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    padding: 80px 0 60px;
    color: white;
    position: relative;
    overflow: hidden;
}

.service-hero-section::before {
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
    max-width: 650px;
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
    border-color: #11998e;
    box-shadow: 0 0 0 0.2rem rgba(17, 153, 142, 0.25);
}

/* Service Cards - Enhanced Clear Separation */
.service-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    border: 3px solid #e8f5e9;
    display: flex;
    flex-direction: column;
    margin-bottom: 2rem;
    position: relative;
}

.service-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #11998e 0%, #38ef7d 100%);
    z-index: 1;
}

.service-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(17, 153, 142, 0.25);
    border-color: #11998e;
}

.service-card-header {
    padding: 15px 20px;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    display: flex;
    justify-content: space-between;
    align-items: center;
    min-height: 60px;
    border-bottom: 3px solid rgba(255,255,255,0.3);
}

.year-badge {
    background: rgba(255, 255, 255, 0.95);
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 700;
    color: #11998e;
    display: flex;
    align-items: center;
    gap: 5px;
}

.hibah-badge {
    background: #ff6b6b;
    color: white;
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 5px;
}

.service-card-body {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
    background: #fafafa;
    border-left: 4px solid #11998e;
    margin: 3px;
    border-radius: 12px;
}

/* Category Badge */
.category-badge {
    display: inline-block;
    background: #e8f5e9;
    color: #2e7d32;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    width: fit-content;
}

/* Title */
.service-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 15px;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 66px;
}

/* Location */
.location-info {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #718096;
    font-size: 0.9rem;
    padding: 12px 0;
    border-bottom: 2px solid #e2e8f0;
    background: white;
    border-radius: 8px;
    margin-bottom: 8px;
    padding-left: 12px;
}

.location-info i {
    color: #11998e;
    font-size: 1rem;
}

/* Coordinator Section */
.coordinator-section {
    padding: 15px 12px;
    border-bottom: 2px solid #e2e8f0;
    background: white;
    border-radius: 8px;
    margin-bottom: 8px;
}

.coordinator-label {
    font-size: 0.75rem;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
    font-weight: 600;
}

.coordinator-name {
    font-size: 0.95rem;
    color: #1a202c;
    font-weight: 600;
}

/* Timeline Info */
.timeline-info {
    padding: 15px 12px;
    border-bottom: 2px solid #e2e8f0;
    background: white;
    border-radius: 8px;
    margin-bottom: 8px;
}

.timeline-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-label {
    font-size: 0.85rem;
    color: #718096;
    font-weight: 500;
}

.timeline-date {
    font-size: 0.85rem;
    color: #1a202c;
    font-weight: 600;
}

/* Status Section */
.status-section {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
    padding-top: 12px;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: capitalize;
}

.status-badge.status-draft {
    background: #f3f4f6;
    color: #6b7280;
}

.status-badge.status-proposal {
    background: #dbeafe;
    color: #1e40af;
}

.status-badge.status-approved {
    background: #e0e7ff;
    color: #4338ca;
}

.status-badge.status-ongoing {
    background: #fef3c7;
    color: #92400e;
}

.status-badge.status-completed {
    background: #d1fae5;
    color: #065f46;
}

.status-badge.status-reported {
    background: #cffafe;
    color: #155e75;
}

.progress-badge {
    background: #e0f2fe;
    color: #0369a1;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 700;
}

/* Card Footer */
.service-card-footer {
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-top: 3px solid #11998e;
    margin: 3px;
    border-radius: 12px;
}

.btn-detail {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 12px;
    background: #11998e;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.btn-detail:hover {
    background: #0d7a6f;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(17, 153, 142, 0.3);
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
        font-size: 1.8rem;
    }
    
    .hero-subtitle {
        font-size: 0.95rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .service-title {
        font-size: 1rem;
        min-height: auto;
    }
    
    .service-hero-section {
        padding: 40px 0 30px;
    }

    .service-card-header {
        flex-direction: column;
        gap: 8px;
        align-items: flex-start;
    }

    .year-badge, .hibah-badge {
        font-size: 0.75rem;
        padding: 4px 10px;
    }

    .service-card-body {
        padding: 15px;
    }

    .timeline-item {
        font-size: 0.8rem;
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

.service-card {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.service-card:nth-child(1) { animation-delay: 0.1s; }
.service-card:nth-child(2) { animation-delay: 0.2s; }
.service-card:nth-child(3) { animation-delay: 0.3s; }
.service-card:nth-child(4) { animation-delay: 0.4s; }
.service-card:nth-child(5) { animation-delay: 0.5s; }
.service-card:nth-child(6) { animation-delay: 0.6s; }

/* Pagination Styling */
.pagination {
    gap: 5px;
}

.page-link {
    border-radius: 8px;
    border: 2px solid #e2e8f0;
    color: #11998e;
    font-weight: 600;
    padding: 10px 16px;
    transition: all 0.3s ease;
}

.page-link:hover {
    background-color: #11998e;
    border-color: #11998e;
    color: white;
}

.page-item.active .page-link {
    background: #11998e;
    border-color: #11998e;
    color: white;
}

.page-item.disabled .page-link {
    opacity: 0.5;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit on filter change
    const jenisSelect = document.getElementById('jenis');
    const tahunSelect = document.getElementById('tahun');
    
    if (jenisSelect) {
        jenisSelect.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    }
    
    if (tahunSelect) {
        tahunSelect.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    }
    
    // Smooth scroll animation
    document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', function(e) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
});
</script>
@endpush
@endsection