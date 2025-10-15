@extends('frontend.layouts.app')

@section('title', 'Penelitian')

@section('content')
<!-- Hero Section -->
<div class="research-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-icon mb-3">
                    <i class="fas fa-microscope"></i>
                </div>
                <h1 class="hero-title mb-3">Penelitian LPPM LPKIA</h1>
                <p class="hero-subtitle">Jelajahi berbagai penelitian inovatif dan berkualitas dari dosen-dosen kami</p>
                <div class="hero-stats mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Research::count() }}</div>
                                <div class="stat-label">Total Penelitian</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Research::distinct('tahun')->count('tahun') }}</div>
                                <div class="stat-label">Tahun Aktif</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">{{ \App\Models\Dosen::count() }}</div>
                                <div class="stat-label">Peneliti</div>
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
                    <i class="fas fa-filter text-primary me-2"></i>
                    <h5 class="mb-0 fw-bold">Filter & Pencarian</h5>
                </div>
                <form action="{{ route('tridarma.penelitian') }}" method="GET" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label for="search" class="form-label small text-muted">
                                <i class="fas fa-search me-1"></i>Kata Kunci
                            </label>
                            <input type="text" name="q" id="search" value="{{ request('q') }}"
                                   class="form-control form-control-lg" 
                                   placeholder="Cari judul penelitian atau nama peneliti...">
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-2">
                            <label class="form-label small text-muted d-block">&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small text-muted d-block">&nbsp;</label>
                            <a href="{{ route('tridarma.penelitian') }}" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="fas fa-redo me-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Results Info -->
    @if(request()->has('q') || request()->has('tahun'))
    <div class="alert alert-info border-0 shadow-sm mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-info-circle me-2"></i>
            <div>
                <strong>Hasil Pencarian:</strong> 
                Ditemukan <strong>{{ $researches->total() }}</strong> penelitian
                @if(request('q'))
                    dengan kata kunci "<strong>{{ request('q') }}</strong>"
                @endif
                @if(request('tahun'))
                    pada tahun <strong>{{ request('tahun') }}</strong>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Research Cards Grid -->
    <div class="row g-4 mb-5">
        @forelse($researches as $research)
            <div class="col-lg-4 col-md-6">
                <div class="research-card h-100">
                    <div class="research-card-header">
                        <span class="year-badge">
                            <i class="far fa-calendar-alt me-1"></i>{{ $research->tahun ?? 'N/A' }}
                        </span>
                        @if($research->hibah_kompetitif)
                            <span class="hibah-badge">
                                <i class="fas fa-award me-1"></i>Hibah
                            </span>
                        @endif
                    </div>
                    
                    <div class="research-card-body">
                        <h5 class="research-title">{{ Str::limit($research->judul, 80) }}</h5>
                        
                        @if($research->bidang)
                        <div class="research-category mb-3">
                            <i class="fas fa-tag me-1"></i>
                            <span>{{ $research->bidang }}</span>
                        </div>
                        @endif

                        <div class="researcher-info mb-3">
                            <div class="researcher-avatar">
                                {{ strtoupper(substr($research->dosen?->nama_lengkap ?? 'N', 0, 2)) }}
                            </div>
                            <div class="researcher-details">
                                <div class="researcher-name">{{ $research->dosen?->nama_lengkap ?? 'N/A' }}</div>
                                @if($research->ketua_peneliti && $research->ketua_peneliti !== $research->dosen?->nama_lengkap)
                                    <div class="researcher-role">Ketua: {{ $research->ketua_peneliti }}</div>
                                @endif
                            </div>
                        </div>

                        @if($research->abstrak)
                        <p class="research-abstract">{{ Str::limit($research->abstrak, 120) }}</p>
                        @endif

                        <div class="research-meta">
                            @if($research->sumber_dana)
                            <div class="meta-item">
                                <i class="fas fa-money-bill-wave text-success"></i>
                                <span>{{ Str::limit($research->sumber_dana, 20) }}</span>
                            </div>
                            @endif
                            @if($research->tingkat)
                            <div class="meta-item">
                                <i class="fas fa-layer-group text-info"></i>
                                <span>{{ ucfirst($research->tingkat) }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="research-card-footer">
                        <a href="{{ route('frontend.researches.show', $research->id) }}" 
                           class="btn-detail">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4 class="empty-title">Tidak Ada Penelitian Ditemukan</h4>
                    <p class="empty-text">
                        @if(request()->has('q') || request()->has('tahun'))
                            Coba ubah kata kunci atau filter pencarian Anda
                        @else
                            Belum ada data penelitian yang tersedia
                        @endif
                    </p>
                    @if(request()->has('q') || request()->has('tahun'))
                        <a href="{{ route('tridarma.penelitian') }}" class="btn btn-primary">
                            <i class="fas fa-redo me-2"></i>Reset Pencarian
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($researches->hasPages())
    <div class="d-flex justify-content-center">
        <nav aria-label="Research pagination">
            {{ $researches->withQueryString()->links('pagination::bootstrap-5') }}
        </nav>
    </div>
    @endif
</div>

@push('styles')
<style>
/* Hero Section */
.research-hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 0 60px;
    color: white;
    position: relative;
    overflow: hidden;
}

.research-hero-section::before {
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
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Research Cards */
.research-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.research-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

.research-card-header {
    padding: 15px 20px;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.year-badge {
    background: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #667eea;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.hibah-badge {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.research-card-body {
    padding: 25px;
}

.research-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 15px;
    line-height: 1.5;
    min-height: 60px;
}

.research-category {
    display: inline-flex;
    align-items: center;
    background: #e6f3ff;
    color: #0066cc;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
}

.researcher-info {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
}

.researcher-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.researcher-details {
    flex: 1;
    min-width: 0;
}

.researcher-name {
    font-weight: 600;
    color: #2d3748;
    font-size: 0.95rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.researcher-role {
    font-size: 0.8rem;
    color: #718096;
    margin-top: 2px;
}

.research-abstract {
    color: #4a5568;
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 15px;
}

.research-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    color: #718096;
}

.meta-item i {
    font-size: 1rem;
}

.research-card-footer {
    padding: 20px 25px;
    background: #fafbfc;
    border-top: 1px solid #e2e8f0;
}

.btn-detail {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-detail:hover {
    background: linear-gradient(135deg, #5568d3 0%, #653a8a 100%);
    color: white;
    transform: translateX(5px);
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
    
    .research-title {
        font-size: 1rem;
        min-height: auto;
    }
    
    .research-hero-section {
        padding: 50px 0 40px;
    }
}

/* Loading Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.research-card {
    animation: fadeIn 0.5s ease-out;
}

/* Pagination Styling */
.pagination {
    gap: 5px;
}

.page-link {
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    color: #667eea;
    font-weight: 500;
    padding: 10px 16px;
}

.page-link:hover {
    background-color: #667eea;
    border-color: #667eea;
    color: white;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit on filter change
    const tahunSelect = document.getElementById('tahun');
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
