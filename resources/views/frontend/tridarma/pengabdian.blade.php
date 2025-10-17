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

    <!-- Service Table -->
    <div class="service-table-section">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-success text-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="mb-0"><i class="fas fa-hands-helping mr-2"></i>Daftar Pengabdian Masyarakat</h4>
                    <div class="d-flex gap-2">
                        <span class="badge badge-light">{{ $services->total() }} pengabdian ditemukan</span>
                        @if($services->hasPages())
                        <span class="badge badge-light">Halaman {{ $services->currentPage() }} dari {{ $services->lastPage() }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%" class="text-center">#</th>
                                <th width="25%">Judul Pengabdian</th>
                                <th width="15%">Penanggung Jawab</th>
                                <th width="12%">Jenis</th>
                                <th width="15%">Lokasi</th>
                                <th width="8%" class="text-center">Tahun</th>
                                <th width="10%">Status</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $index => $service)
                            <tr>
                                <td class="text-center">{{ $services->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <strong class="text-dark">{{ Str::limit($service->judul, 50) }}</strong>
                                            @if($service->tanggal_mulai && $service->tanggal_selesai)
                                            <br>
                                            <small class="text-muted">
                                                {{ $service->tanggal_mulai->format('d/m/Y') }} - {{ $service->tanggal_selesai->format('d/m/Y') }}
                                            </small>
                                            @endif
                                            @if($service->hibah_kompetitif)
                                            <br>
                                            <span class="badge badge-warning badge-sm">
                                                <i class="fas fa-award mr-1"></i>Hibah Kompetitif
                                            </span>
                                            @endif
                                            @if($service->progress_percentage !== null)
                                            <br>
                                            <span class="badge badge-info badge-sm">
                                                Progress: {{ $service->progress_percentage }}%
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="coordinator-avatar-sm me-2">
                                            {{ strtoupper(substr($service->dosen?->nama_lengkap ?? 'N', 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $service->dosen?->nama_lengkap ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($service->jenis_pengabdian)
                                        <span class="badge bg-success">{{ $jenisOptions[$service->jenis_pengabdian] ?? 'Pengabdian' }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($service->lokasi)
                                        <small>{{ Str::limit($service->lokasi, 30) }}</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary">{{ $service->tanggal_mulai?->format('Y') ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    @if($service->status)
                                        <span class="badge status-{{ $service->status }}">
                                            {{ \App\Models\Service::getStatusOptions()[$service->status] ?? ucfirst($service->status) }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('frontend.services.show', $service->id) }}"
                                       class="btn btn-success btn-sm"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-hands-helping"></i>
                                        </div>
                                        <h5 class="empty-title">Tidak Ada Pengabdian Ditemukan</h5>
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
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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

/* Service Table */
.service-table-section .card {
    border-radius: 15px;
    overflow: hidden;
}

.service-table-section .card-header {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
    border: none;
    padding: 20px 25px;
}

.service-table-section .table {
    margin-bottom: 0;
}

.service-table-section .table thead th {
    border: none;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    vertical-align: middle;
}

.service-table-section .table tbody td {
    vertical-align: middle;
    border-color: #f0f0f0;
    padding: 15px;
}

.service-table-section .table tbody tr:hover {
    background-color: #f8f9fa;
}

.coordinator-avatar-sm {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.75rem;
    flex-shrink: 0;
}

.badge-sm {
    font-size: 0.7rem;
    padding: 3px 6px;
}

.btn-sm {
    padding: 5px 10px;
    font-size: 0.8rem;
}

/* Status badges for table */
.status-draft {
    background: #f3f4f6;
    color: #6b7280;
}

.status-proposal {
    background: #dbeafe;
    color: #1e40af;
}

.status-approved {
    background: #e0e7ff;
    color: #4338ca;
}

.status-ongoing {
    background: #fef3c7;
    color: #92400e;
}

.status-completed {
    background: #d1fae5;
    color: #065f46;
}

.status-reported {
    background: #cffafe;
    color: #155e75;
}

/* Responsive Table */
@media (max-width: 768px) {
    .service-table-section .table-responsive {
        font-size: 0.85rem;
    }

    .service-table-section .table thead th {
        font-size: 0.8rem;
        padding: 8px;
    }

    .service-table-section .table tbody td {
        padding: 10px 8px;
    }

    .coordinator-avatar-sm {
        width: 30px;
        height: 30px;
        font-size: 0.7rem;
    }
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

.service-table-section .table {
    animation: fadeInUp 0.6s ease-out;
}

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
});
</script>
@endpush
@endsection