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

    <!-- HAKI Table -->
    <div class="haki-table-section">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-info text-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="mb-0"><i class="fas fa-copyright mr-2"></i>Daftar Hak Kekayaan Intelektual</h4>
                    <div class="d-flex gap-2">
                        <span class="badge badge-light">{{ $hakis->total() }} HAKI ditemukan</span>
                        @if($hakis->hasPages())
                        <span class="badge badge-light">Halaman {{ $hakis->currentPage() }} dari {{ $hakis->lastPage() }}</span>
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
                                <th width="25%">Judul HAKI</th>
                                <th width="15%">Jenis HAKI</th>
                                <th width="20%">Inventor</th>
                                <th width="10%">Status</th>
                                <th width="10%">Tanggal</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hakis as $index => $haki)
                            <tr>
                                <td class="text-center">{{ $hakis->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <strong class="text-dark">{{ Str::limit($haki->judul, 50) }}</strong>
                                            @if($haki->deskripsi)
                                            <br>
                                            <small class="text-muted">{{ Str::limit($haki->deskripsi, 60) }}</small>
                                            @endif
                                            @if($haki->nomor_pendaftaran)
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-hashtag mr-1"></i>{{ $haki->nomor_pendaftaran }}
                                            </small>
                                            @endif
                                            @if($haki->bidang_teknologi)
                                            <br>
                                            <small class="text-info">
                                                <i class="fas fa-cog mr-1"></i>{{ $haki->bidang_teknologi }}
                                            </small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        @switch($haki->jenis_haki)
                                            @case('paten')
                                                <i class="fas fa-lightbulb mr-1"></i>
                                                @break
                                            @case('hak_cipta')
                                                <i class="fas fa-copyright mr-1"></i>
                                                @break
                                            @case('merek')
                                                <i class="fas fa-trademark mr-1"></i>
                                                @break
                                            @case('desain_industri')
                                                <i class="fas fa-drafting-compass mr-1"></i>
                                                @break
                                            @default
                                                <i class="fas fa-file mr-1"></i>
                                        @endswitch
                                        {{ $jenisOptions[$haki->jenis_haki] ?? 'HAKI' }}
                                    </span>
                                </td>
                                <td>
                                    @if(is_array($haki->inventor) && count($haki->inventor) > 0)
                                        @foreach(array_slice($haki->inventor, 0, 2) as $inventor)
                                            <span class="badge badge-outline-secondary mr-1 mb-1">{{ $inventor }}</span>
                                        @endforeach
                                        @if(count($haki->inventor) > 2)
                                            <br><small class="text-muted">+{{ count($haki->inventor) - 2 }} lainnya</small>
                                        @endif
                                    @elseif($haki->inventor)
                                        <span class="badge badge-outline-secondary">{{ $haki->inventor }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $haki->getStatusBadgeClass() }}">
                                        {{ $statusOptions[$haki->status] ?? ucfirst($haki->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($haki->tanggal_daftar)
                                        {{ $haki->tanggal_daftar->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('frontend.haki.show', $haki) }}"
                                       class="btn btn-info btn-sm"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-copyright"></i>
                                        </div>
                                        <h5 class="empty-title">Tidak Ada HAKI Ditemukan</h5>
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

/* HAKI Table */
.haki-table-section .card {
    border-radius: 15px;
    overflow: hidden;
}

.haki-table-section .card-header {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%) !important;
    border: none;
    padding: 20px 25px;
}

.haki-table-section .table {
    margin-bottom: 0;
}

.haki-table-section .table thead th {
    border: none;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    vertical-align: middle;
}

.haki-table-section .table tbody td {
    vertical-align: middle;
    border-color: #f0f0f0;
    padding: 15px;
}

.haki-table-section .table tbody tr:hover {
    background-color: #f8f9fa;
}

.badge-outline-secondary {
    color: #6c757d;
    border: 1px solid #6c757d;
    background: transparent;
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
.status-granted { background: #dcfce7; color: #166534; }
.status-dalam_proses { background: #fef3c7; color: #92400e; }
.status-dipublikasi { background: #dbeafe; color: #1e40af; }
.status-diajukan { background: #e0e7ff; color: #3730a3; }

/* Responsive Table */
@media (max-width: 768px) {
    .haki-table-section .table-responsive {
        font-size: 0.85rem;
    }

    .haki-table-section .table thead th {
        font-size: 0.8rem;
        padding: 8px;
    }

    .haki-table-section .table tbody td {
        padding: 10px 8px;
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

.haki-table-section .table {
    animation: fadeInUp 0.6s ease-out;
}

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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit on filter change
    const jenisSelect = document.getElementById('jenis');
    const statusSelect = document.getElementById('status');

    if (jenisSelect) {
        jenisSelect.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    }
});
</script>
@endpush
@endsection