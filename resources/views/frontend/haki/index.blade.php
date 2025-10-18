@extends('frontend.layouts.app')

@section('title', 'Hak Kekayaan Intelektual (HAKI)')

@section('content')
<!-- Modern Hero Section -->
<div class="haki-hero-section">
    <div class="container-fluid">
        <div class="container">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="hero-content">
                        <div class="hero-icon-wrapper mb-4">
                            <div class="hero-icon">
                                <i class="fas fa-copyright"></i>
                            </div>
                        </div>
                        <h1 class="hero-title mb-3">Hak Kekayaan Intelektual</h1>
                        <p class="hero-subtitle mb-4">Inovasi dan kreativitas yang telah terlindungi hak kekayaan intelektualnya dari LPPM LPKIA</p>

                        <!-- Enhanced Stats Cards -->
                        <div class="hero-stats">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fas fa-list-ul"></i>
                                        </div>
                                        <div class="stat-number">{{ \App\Models\Haki::count() }}</div>
                                        <div class="stat-label">Total HAKI</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="stat-number">{{ \App\Models\Haki::where('status', 'granted')->count() }}</div>
                                        <div class="stat-label">Granted</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fas fa-lightbulb"></i>
                                        </div>
                                        <div class="stat-number">{{ \App\Models\Haki::where('jenis_haki', 'paten')->count() }}</div>
                                        <div class="stat-label">Paten</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fas fa-copyright"></i>
                                        </div>
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
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="container">
        <!-- Enhanced Search & Filter Section -->
        <div class="search-filter-section mb-5">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header bg-gradient-primary text-white p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                            <i class="fas fa-filter fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold">Filter & Pencarian</h4>
                            <small>Temukan HAKI yang Anda cari dengan mudah</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('frontend.haki') }}" method="GET" id="filterForm">
                        <div class="row g-4">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="search" class="form-label fw-bold text-primary">
                                        <i class="fas fa-search me-2"></i>Kata Kunci
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                        <input type="text" name="q" id="search" value="{{ request('q') }}"
                                               class="form-control form-control-lg border-0 bg-light"
                                               placeholder="Cari judul, inventor, nomor permohonan...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="jenis" class="form-label fw-bold text-success">
                                        <i class="fas fa-tag me-2"></i>Jenis HAKI
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-tag text-muted"></i>
                                        </span>
                                        <select name="jenis" id="jenis" class="form-select form-select-lg border-0 bg-light">
                                            <option value="">Semua Jenis</option>
                                            @foreach($jenisOptions as $key => $label)
                                                <option value="{{ $key }}" {{ request('jenis') == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="status" class="form-label fw-bold text-info">
                                        <i class="fas fa-check-circle me-2"></i>Status
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-check-circle text-muted"></i>
                                        </span>
                                        <select name="status" id="status" class="form-select form-select-lg border-0 bg-light">
                                            <option value="">Semua Status</option>
                                            @foreach($statusOptions as $key => $label)
                                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label fw-bold text-muted d-block">&nbsp;</label>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg flex-fill">
                                            <i class="fas fa-search me-2"></i>Cari
                                        </button>
                                        <a href="{{ route('frontend.haki') }}" class="btn btn-outline-secondary btn-lg">
                                            <i class="fas fa-redo"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Results Info -->
        @if(request()->has('q') || request()->has('jenis') || request()->has('status'))
        <div class="alert alert-info border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <div class="d-flex align-items-start">
                <div class="bg-info bg-opacity-20 rounded-circle p-2 me-3 mt-1">
                    <i class="fas fa-info-circle text-info"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="alert-heading fw-bold mb-2">Hasil Pencarian</h6>
                    <p class="mb-0">
                        Ditemukan <strong class="text-primary">{{ $hakis->total() }}</strong> HAKI
                        @if(request('q'))
                            dengan kata kunci "<strong>{{ request('q') }}</strong>"
                        @endif
                        @if(request('jenis'))
                            jenis <strong>{{ $jenisOptions[request('jenis')] }}</strong>
                        @endif
                        @if(request('status'))
                            status <strong>{{ $statusOptions[request('status')] }}</strong>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- Enhanced HAKI Table -->
        <div class="haki-table-section">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header bg-gradient-info text-white p-4" style="background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%); border: none;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                                <i class="fas fa-copyright fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">Daftar Hak Kekayaan Intelektual</h4>
                                <small>Hasil pencarian dan filter</small>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge bg-white bg-opacity-20 text-white px-3 py-2">
                                <i class="fas fa-list me-1"></i>{{ $hakis->total() }} HAKI ditemukan
                            </span>
                            @if($hakis->hasPages())
                            <span class="badge bg-white bg-opacity-20 text-white px-3 py-2">
                                <i class="fas fa-file me-1"></i>Halaman {{ $hakis->currentPage() }} dari {{ $hakis->lastPage() }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%" class="text-center fw-bold text-muted">#</th>
                                    <th width="30%" class="fw-bold text-muted">Judul HAKI</th>
                                    <th width="15%" class="fw-bold text-muted">Jenis HAKI</th>
                                    <th width="20%" class="fw-bold text-muted">Inventor</th>
                                    <th width="10%" class="fw-bold text-muted text-center">Status</th>
                                    <th width="10%" class="fw-bold text-muted text-center">Tanggal</th>
                                    <th width="10%" class="fw-bold text-muted text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($hakis as $index => $haki)
                                <tr class="table-row">
                                    <td class="text-center fw-bold text-primary">{{ $hakis->firstItem() + $index }}</td>
                                    <td>
                                        <div class="haki-info">
                                            <h6 class="mb-2 fw-bold text-dark">{{ Str::limit($haki->judul, 50) }}</h6>
                                            @if($haki->deskripsi)
                                            <p class="text-muted small mb-2">{{ Str::limit($haki->deskripsi, 80) }}</p>
                                            @endif
                                            <div class="haki-details">
                                                @if($haki->nomor_pendaftaran)
                                                <span class="detail-item">
                                                    <i class="fas fa-hashtag text-muted me-1"></i>
                                                    <small class="text-muted">{{ $haki->nomor_pendaftaran }}</small>
                                                </span>
                                                @endif
                                                @if($haki->nomor_permohonan)
                                                <span class="detail-item">
                                                    <i class="fas fa-file-signature text-primary me-1"></i>
                                                    <small class="text-primary fw-bold">{{ $haki->nomor_permohonan }}</small>
                                                </span>
                                                @endif
                                                @if($haki->tahun_permohonan)
                                                <span class="detail-item">
                                                    <i class="fas fa-calendar-alt text-info me-1"></i>
                                                    <small class="text-info">{{ $haki->tahun_permohonan }}</small>
                                                </span>
                                                @endif
                                                @if($haki->pemegang_paten)
                                                <span class="detail-item">
                                                    <i class="fas fa-user-tie text-success me-1"></i>
                                                    <small class="text-success">{{ $haki->pemegang_paten }}</small>
                                                </span>
                                                @endif
                                                @if($haki->tanggal_penerimaan)
                                                <span class="detail-item">
                                                    <i class="fas fa-calendar-day text-warning me-1"></i>
                                                    <small class="text-warning">{{ $haki->tanggal_penerimaan->format('d/m/Y') }}</small>
                                                </span>
                                                @endif
                                                @if($haki->bidang_teknologi)
                                                <span class="detail-item">
                                                    <i class="fas fa-cog text-secondary me-1"></i>
                                                    <small class="text-secondary">{{ $haki->bidang_teknologi }}</small>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge fs-6 px-3 py-2
                                            @if($haki->jenis_haki == 'paten') bg-primary
                                            @elseif($haki->jenis_haki == 'hak_cipta') bg-info
                                            @elseif($haki->jenis_haki == 'merek') bg-warning text-dark
                                            @elseif($haki->jenis_haki == 'desain_industri') bg-danger
                                            @else bg-secondary @endif">
                                            @switch($haki->jenis_haki)
                                                @case('paten')
                                                    <i class="fas fa-lightbulb me-1"></i>
                                                    @break
                                                @case('hak_cipta')
                                                    <i class="fas fa-copyright me-1"></i>
                                                    @break
                                                @case('merek')
                                                    <i class="fas fa-trademark me-1"></i>
                                                    @break
                                                @case('desain_industri')
                                                    <i class="fas fa-drafting-compass me-1"></i>
                                                    @break
                                                @default
                                                    <i class="fas fa-file me-1"></i>
                                            @endswitch
                                            {{ $jenisOptions[$haki->jenis_haki] ?? 'HAKI' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(is_array($haki->inventor) && count($haki->inventor) > 0)
                                            <div class="inventor-tags">
                                                @foreach(array_slice($haki->inventor, 0, 2) as $inventor)
                                                    <span class="badge bg-light text-dark me-1 mb-1 px-2 py-1">{{ $inventor }}</span>
                                                @endforeach
                                                @if(count($haki->inventor) > 2)
                                                    <br><small class="text-muted">+{{ count($haki->inventor) - 2 }} lainnya</small>
                                                @endif
                                            </div>
                                        @elseif($haki->inventor)
                                            <span class="badge bg-light text-dark px-2 py-1">{{ $haki->inventor }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge fs-6 px-3 py-2 {{ $haki->getStatusBadgeClass() }}">
                                            {{ $statusOptions[$haki->status] ?? ucfirst($haki->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($haki->tanggal_daftar)
                                            <div class="date-info">
                                                <div class="fw-bold">{{ $haki->tanggal_daftar->format('d/m') }}</div>
                                                <small class="text-muted">{{ $haki->tanggal_daftar->format('Y') }}</small>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('frontend.haki.show', $haki) }}"
                                           class="btn btn-primary btn-sm px-3 py-2 fw-bold"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <div class="empty-icon-wrapper mb-4">
                                                <div class="empty-icon">
                                                    <i class="fas fa-copyright"></i>
                                                </div>
                                            </div>
                                            <h4 class="empty-title fw-bold text-muted mb-3">Tidak Ada HAKI Ditemukan</h4>
                                            <p class="empty-text text-muted mb-4">
                                                @if(request()->has('q') || request()->has('jenis') || request()->has('status'))
                                                    Coba ubah kata kunci atau filter pencarian Anda untuk menemukan hasil yang lebih sesuai.
                                                @else
                                                    Belum ada data HAKI yang tersedia di sistem saat ini.
                                                @endif
                                            </p>
                                            @if(request()->has('q') || request()->has('jenis') || request()->has('status'))
                                                <a href="{{ route('frontend.haki') }}" class="btn btn-primary btn-lg px-4">
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

        <!-- Enhanced Pagination -->
        @if($hakis->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="HAKI pagination">
                <div class="pagination-wrapper">
                    {{ $hakis->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </nav>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --info-gradient: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --light-bg: #f8fafc;
    --shadow: 0 10px 30px rgba(0,0,0,0.1);
    --border-radius: 20px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Modern Hero Section */
.haki-hero-section {
    background: var(--primary-gradient);
    position: relative;
    overflow: hidden;
    min-height: 75vh;
    display: flex;
    align-items: center;
}

.haki-hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="60" height="60" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="1.5" fill="white" opacity="0.1"/></svg>');
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.hero-content {
    position: relative;
    z-index: 2;
    animation: fadeInUp 1s ease-out;
}

.hero-icon-wrapper {
    display: inline-block;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border-radius: 50%;
    padding: 20px;
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.hero-icon i {
    font-size: 3rem;
    color: white;
    filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: white;
    text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    margin-bottom: 1rem;
    line-height: 1.1;
}

.hero-subtitle {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    max-width: 600px;
    margin: 0 auto 2rem;
    line-height: 1.6;
}

.hero-stats {
    position: relative;
    z-index: 1;
}

.stat-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    padding: 25px 20px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    transition: left 0.5s;
}

.stat-card:hover::before {
    left: 100%;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.stat-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    margin-bottom: 15px;
}

.stat-icon i {
    font-size: 1.5rem;
    color: white;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 5px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.stat-label {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Main Content */
.main-content {
    background: var(--light-bg);
    padding: 80px 0;
    margin-top: -50px;
    border-radius: 30px 30px 0 0;
    position: relative;
    z-index: 3;
}

/* Enhanced Search & Filter Section */
.search-filter-section .card {
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    border: none;
    overflow: hidden;
    transition: var(--transition);
}

.search-filter-section .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

.search-filter-section .card-header {
    border: none;
    padding: 25px 30px;
}

.search-filter-section .card-body {
    padding: 30px;
}

.form-group {
    margin-bottom: 0;
}

.form-label {
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.input-group-text {
    border: none;
    background: #f1f5f9;
    color: #64748b;
}

.form-control, .form-select {
    border: none;
    padding: 12px 16px;
    font-size: 0.95rem;
    transition: var(--transition);
}

.form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: white;
}

.btn-primary {
    background: var(--primary-gradient);
    border: none;
    padding: 12px 30px;
    border-radius: 12px;
    font-weight: 600;
    transition: var(--transition);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.btn-outline-secondary {
    border: 2px solid #e2e8f0;
    color: #64748b;
    border-radius: 12px;
    font-weight: 600;
    transition: var(--transition);
}

.btn-outline-secondary:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    transform: translateY(-2px);
}

/* Enhanced HAKI Table */
.haki-table-section .card {
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    border: none;
    overflow: hidden;
    transition: var(--transition);
}

.haki-table-section .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.15);
}

.haki-table-section .card-header {
    border: none;
    padding: 25px 30px;
}

.haki-table-section .table {
    margin-bottom: 0;
    font-size: 0.95rem;
}

.haki-table-section .table thead th {
    border: none;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 20px 15px;
    background: #f8fafc;
    color: #475569;
    border-bottom: 2px solid #e2e8f0;
}

.haki-table-section .table tbody td {
    vertical-align: middle;
    border-color: #f1f5f9;
    padding: 20px 15px;
    transition: var(--transition);
}

.table-row {
    transition: var(--transition);
}

.table-row:hover {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    transform: scale(1.01);
}

.haki-info h6 {
    color: #1e293b;
    font-size: 1rem;
    line-height: 1.4;
    margin-bottom: 8px;
}

.haki-details {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 8px;
}

.detail-item {
    display: inline-flex;
    align-items: center;
    font-size: 0.8rem;
    padding: 4px 8px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.badge {
    font-weight: 600;
    border-radius: 8px;
    padding: 6px 12px;
    font-size: 0.8rem;
}

.inventor-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
}

.date-info {
    line-height: 1.2;
}

.date-info .fw-bold {
    color: #1e293b;
    font-size: 1rem;
}

.date-info small {
    color: #64748b;
    font-size: 0.8rem;
}

/* Status badges */
.status-granted { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.status-dalam_proses { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.status-dipublikasi { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
.status-diajukan { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }

/* Enhanced Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-icon-wrapper {
    display: inline-block;
    background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
    border-radius: 50%;
    padding: 30px;
    margin-bottom: 20px;
}

.empty-icon {
    font-size: 4rem;
    color: #94a3b8;
}

.empty-title {
    font-size: 1.8rem;
    color: #475569;
    margin-bottom: 12px;
}

.empty-text {
    font-size: 1.1rem;
    color: #64748b;
    max-width: 500px;
    margin: 0 auto 25px;
}

/* Enhanced Pagination */
.pagination-wrapper {
    background: white;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.page-link {
    border-radius: 10px;
    border: 2px solid #e2e8f0;
    color: #17a2b8;
    font-weight: 600;
    padding: 10px 16px;
    margin: 0 2px;
    transition: var(--transition);
}

.page-link:hover {
    background: var(--info-gradient);
    border-color: transparent;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
}

.page-item.active .page-link {
    background: var(--info-gradient);
    border-color: transparent;
    box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
}

/* Animations */
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

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
    }

    .stat-number {
        font-size: 2rem;
    }

    .haki-hero-section {
        min-height: 60vh;
        padding: 40px 0;
    }

    .main-content {
        padding: 40px 0;
        margin-top: -30px;
        border-radius: 20px 20px 0 0;
    }

    .search-filter-section .card-body,
    .haki-table-section .card-header {
        padding: 20px;
    }

    .haki-table-section .table thead th,
    .haki-table-section .table tbody td {
        padding: 12px 8px;
        font-size: 0.85rem;
    }

    .haki-details {
        flex-direction: column;
        gap: 6px;
    }

    .detail-item {
        font-size: 0.75rem;
        padding: 3px 6px;
    }

    .btn {
        padding: 8px 16px;
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-stats .row {
        gap: 15px;
    }

    .stat-card {
        padding: 20px 15px;
    }

    .stat-number {
        font-size: 1.8rem;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
    }

    .stat-icon i {
        font-size: 1.2rem;
    }

    .search-filter-section .row {
        gap: 15px;
    }

    .form-control, .form-select {
        font-size: 0.9rem;
    }
}

/* Loading States */
.table-row {
    position: relative;
}

.table-row::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.5s;
}

.table-row:hover::after {
    left: 100%;
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Print Styles */
@media print {
    .haki-hero-section,
    .search-filter-section,
    .pagination-wrapper {
        display: none !important;
    }

    .main-content {
        background: white;
        margin-top: 0;
        border-radius: 0;
    }

    .table-row:hover {
        background: white !important;
        transform: none !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced form interactions
    const filterForm = document.getElementById('filterForm');
    const jenisSelect = document.getElementById('jenis');
    const statusSelect = document.getElementById('status');
    const searchInput = document.getElementById('search');

    // Auto-submit on filter change with loading state
    function submitWithLoading() {
        const submitBtn = filterForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;

        // Add loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mencari...';
        submitBtn.disabled = true;

        // Submit form
        filterForm.submit();
    }

    // Debounced search input
    let searchTimeout;
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(submitWithLoading, 800);
        });
    }

    // Instant filter changes
    if (jenisSelect) {
        jenisSelect.addEventListener('change', submitWithLoading);
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', submitWithLoading);
    }

    // Enhanced table interactions
    const tableRows = document.querySelectorAll('.table-row');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
        });

        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Smooth scroll for pagination
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Add loading overlay
            const tableSection = document.querySelector('.haki-table-section');
            const loadingOverlay = document.createElement('div');
            loadingOverlay.style.cssText = `
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(255, 255, 255, 0.9);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 1000;
                border-radius: 20px;
            `;
            loadingOverlay.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="mt-2 text-muted">Memuat data...</div>
                </div>
            `;

            tableSection.style.position = 'relative';
            tableSection.appendChild(loadingOverlay);
        });
    });

    // Animate stat cards on scroll
    const statCards = document.querySelectorAll('.stat-card');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.8s ease-out forwards';
            }
        });
    }, observerOptions);

    statCards.forEach(card => {
        statObserver.observe(card);
    });

    // Enhanced empty state animation
    const emptyState = document.querySelector('.empty-state');
    if (emptyState) {
        emptyState.style.animation = 'fadeInUp 1s ease-out';
    }

    // Add ripple effect to buttons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                transform: scale(0);
                animation: ripple 0.6s linear;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                pointer-events: none;
            `;

            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Keyboard navigation for table
    const table = document.querySelector('.table');
    if (table) {
        table.addEventListener('keydown', function(e) {
            const currentRow = e.target.closest('.table-row');
            if (!currentRow) return;

            let targetRow;
            switch(e.key) {
                case 'ArrowUp':
                    e.preventDefault();
                    targetRow = currentRow.previousElementSibling;
                    if (targetRow && targetRow.classList.contains('table-row')) {
                        targetRow.focus();
                        targetRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    break;
                case 'ArrowDown':
                    e.preventDefault();
                    targetRow = currentRow.nextElementSibling;
                    if (targetRow && targetRow.classList.contains('table-row')) {
                        targetRow.focus();
                        targetRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    break;
                case 'Enter':
                    e.preventDefault();
                    const link = currentRow.querySelector('a[href]');
                    if (link) link.click();
                    break;
            }
        });

        // Make table rows focusable
        tableRows.forEach(row => {
            row.setAttribute('tabindex', '0');
        });
    }

    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .table-row:focus {
            outline: 2px solid #667eea;
            outline-offset: -2px;
        }
    `;
    document.head.appendChild(style);

    // Performance optimization: Lazy load images if any
    const images = document.querySelectorAll('img[data-src]');
    if (images.length > 0) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }

    // Add smooth transitions for all interactive elements
    const interactiveElements = document.querySelectorAll('button, a, input, select');
    interactiveElements.forEach(element => {
        element.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
    });
});

// Add loading state management
function showLoadingState(element) {
    element.style.opacity = '0.6';
    element.style.pointerEvents = 'none';
}

function hideLoadingState(element) {
    element.style.opacity = '1';
    element.style.pointerEvents = 'auto';
}

// Error handling for failed requests
window.addEventListener('unhandledrejection', function(event) {
    console.error('Unhandled promise rejection:', event.reason);
    // Could show user-friendly error message here
});

// Service worker for caching (if needed in future)
if ('serviceWorker' in navigator) {
    // Register service worker for better performance
    // navigator.serviceWorker.register('/sw.js');
}
</script>
@endpush
@endsection
