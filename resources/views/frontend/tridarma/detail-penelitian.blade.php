@extends('frontend.layouts.app')

@section('title', $research->judul)

@section('content')
<!-- Hero Section -->
<div class="research-detail-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tridarma.penelitian') }}">Penelitian</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </nav>

                <!-- Title Section -->
                <div class="detail-title-section">
                    <h1 class="detail-title">{{ $research->judul }}</h1>
                    <div class="detail-badges mt-3">
                        <span class="badge badge-year">
                            <i class="far fa-calendar-alt me-2"></i>{{ $research->tahun ?? 'N/A' }}
                        </span>
                        @if($research->bidang)
                        <span class="badge badge-category">
                            <i class="fas fa-tag me-2"></i>{{ $research->bidang }}
                        </span>
                        @endif
                        @if($research->status)
                        <span class="badge badge-status">
                            <i class="fas fa-circle me-2"></i>{{ ucfirst($research->status) }}
                        </span>
                        @endif
                        @if($research->hibah_kompetitif)
                        <span class="badge badge-hibah">
                            <i class="fas fa-award me-2"></i>Hibah Kompetitif
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Researcher Info Card -->
            <div class="info-card researcher-card mb-4">
                <div class="card-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Peneliti</h5>
                    <div class="researcher-profile">
                        <div class="researcher-avatar-large">
                            {{ strtoupper(substr($research->dosen?->nama_lengkap ?? 'N', 0, 2)) }}
                        </div>
                        <div class="researcher-info-detail">
                            <h6 class="researcher-name-large">{{ $research->dosen?->nama_lengkap ?? 'N/A' }}</h6>
                            @if($research->dosen?->nidn_nip)
                                <p class="researcher-id">NIDN/NIP: {{ $research->dosen->nidn_nip }}</p>
                            @endif
                            @if($research->ketua_peneliti && $research->ketua_peneliti !== $research->dosen?->nama_lengkap)
                                <p class="researcher-role-info">
                                    <i class="fas fa-crown me-1"></i>Ketua Peneliti: <strong>{{ $research->ketua_peneliti }}</strong>
                                </p>
                            @endif
                            @if($research->nidn_leader)
                                <p class="researcher-role-info">
                                    <i class="fas fa-id-card me-1"></i>NIDN Ketua: <strong>{{ $research->nidn_leader }}</strong>
                                </p>
                            @endif
                            @if($research->leader_name && $research->leader_name !== $research->ketua_peneliti)
                                <p class="researcher-role-info">
                                    <i class="fas fa-user-tie me-1"></i>Nama Ketua: <strong>{{ $research->leader_name }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Abstract Section -->
            @if($research->abstrak)
            <div class="info-card mb-4">
                <div class="card-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Abstrak</h5>
                    <p class="abstract-text">{{ $research->abstrak }}</p>
                </div>
            </div>
            @endif

            <!-- Keywords -->
            @if($research->keywords)
            <div class="info-card mb-4">
                <div class="card-icon">
                    <i class="fas fa-key"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Kata Kunci</h5>
                    <div class="keywords-list">
                        @foreach(explode(',', $research->keywords) as $keyword)
                            <span class="keyword-tag">{{ trim($keyword) }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Research Output -->
            @if($research->luaran || $research->jurnal_conference)
            <div class="info-card mb-4">
                <div class="card-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Luaran Penelitian</h5>
                    @if($research->luaran)
                        <div class="output-item">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>{{ $research->luaran }}</span>
                        </div>
                    @endif
                    @if($research->jurnal_conference)
                        <div class="output-item mt-2">
                            <i class="fas fa-newspaper text-primary me-2"></i>
                            <span><strong>Publikasi:</strong> {{ $research->jurnal_conference }}</span>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Files Section -->
            <div class="info-card mb-4">
                <div class="card-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Dokumen Penelitian</h5>
                    <div class="files-list">
                        @php
                            $files = [
                                'file_laporan' => ['label' => 'Laporan Penelitian', 'icon' => 'file-pdf', 'color' => 'danger'],
                                'file_proposal' => ['label' => 'Proposal', 'icon' => 'file-alt', 'color' => 'info'],
                                'file_sk' => ['label' => 'SK Penelitian', 'icon' => 'file-contract', 'color' => 'warning'],
                                'file_progress_report' => ['label' => 'Laporan Progress', 'icon' => 'file-chart-line', 'color' => 'success'],
                                'file_final_report' => ['label' => 'Laporan Akhir', 'icon' => 'file-check', 'color' => 'primary']
                            ];
                            $hasFiles = false;
                        @endphp

                        @foreach($files as $field => $fileInfo)
                            @if($research->$field)
                                @php $hasFiles = true; @endphp
                                <a href="{{ asset('storage/' . $research->$field) }}" target="_blank" class="file-item">
                                    <div class="file-icon text-{{ $fileInfo['color'] }}">
                                        <i class="fas fa-{{ $fileInfo['icon'] }}"></i>
                                    </div>
                                    <div class="file-info">
                                        <div class="file-name">{{ $fileInfo['label'] }}</div>
                                        <div class="file-action">
                                            <i class="fas fa-download me-1"></i>Download
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach

                        @if(!$hasFiles)
                            <div class="text-muted text-center py-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Belum ada dokumen yang tersedia
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Info -->
            <div class="sidebar-card mb-4">
                <h5 class="sidebar-title">
                    <i class="fas fa-info-circle me-2"></i>Informasi Singkat
                </h5>
                <div class="sidebar-content">
                    @if($research->kategori)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-layer-group"></i>
                            <span>Kategori</span>
                        </div>
                        <div class="info-value">{{ ucfirst($research->kategori) }}</div>
                    </div>
                    @endif

                    @if($research->skema_name || $research->skema_abbreviation)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-project-diagram"></i>
                            <span>Skema</span>
                        </div>
                        <div class="info-value">
                            {{ $research->skema_name ?: $research->skema_abbreviation }}
                            @if($research->skema_name && $research->skema_abbreviation)
                                <br><small class="text-muted">({{ $research->skema_abbreviation }})</small>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if($research->pddikti_code_pt)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-university"></i>
                            <span>Kode PDDIKTI PT</span>
                        </div>
                        <div class="info-value">{{ $research->pddikti_code_pt }}</div>
                    </div>
                    @endif

                    @if($research->institution)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-building"></i>
                            <span>Institusi</span>
                        </div>
                        <div class="info-value">{{ $research->institution }}</div>
                    </div>
                    @endif

                    @if($research->tingkat)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-chart-line"></i>
                            <span>Tingkat</span>
                        </div>
                        <div class="info-value">{{ ucfirst($research->tingkat) }}</div>
                    </div>
                    @endif

                    @if($research->proposal_status)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-file-contract"></i>
                            <span>Status Proposal</span>
                        </div>
                        <div class="info-value">
                            @php
                                $statusOptions = \App\Models\Research::getProposalStatusOptions();
                                $statusLabel = $statusOptions[$research->proposal_status] ?? $research->proposal_status;
                            @endphp
                            <span class="badge {{ match($research->proposal_status) {
                                'draft' => 'bg-secondary',
                                'submitted' => 'bg-warning',
                                'review' => 'bg-info',
                                'approved' => 'bg-success',
                                'rejected' => 'bg-danger',
                                'funded' => 'bg-primary',
                                default => 'bg-secondary'
                            } }}">{{ $statusLabel }}</span>
                        </div>
                    </div>
                    @endif

                    @if($research->sumber_dana)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Sumber Dana</span>
                        </div>
                        <div class="info-value">{{ $research->sumber_dana }}</div>
                    </div>
                    @endif

                    @if($research->funds_approved)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-coins"></i>
                            <span>Dana Disetujui</span>
                        </div>
                        <div class="info-value">Rp {{ number_format($research->funds_approved, 0, ',', '.') }}</div>
                    </div>
                    @endif

                    @if($research->tanggal_mulai)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="far fa-calendar-check"></i>
                            <span>Tanggal Mulai</span>
                        </div>
                        <div class="info-value">{{ $research->tanggal_mulai->format('d M Y') }}</div>
                    </div>
                    @endif

                    @if($research->tanggal_selesai)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="far fa-calendar-times"></i>
                            <span>Tanggal Selesai</span>
                        </div>
                        <div class="info-value">{{ $research->tanggal_selesai->format('d M Y') }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="sidebar-card">
                <div class="action-buttons">
                    <a href="{{ route('tridarma.penelitian') }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                    @if($research->file_laporan)
                    <a href="{{ asset('storage/' . $research->file_laporan) }}" target="_blank" class="btn btn-primary w-100">
                        <i class="fas fa-download me-2"></i>Download Laporan
                    </a>
                    @endif
                </div>
            </div>

            <!-- Share Section -->
            <div class="sidebar-card mt-4">
                <h5 class="sidebar-title">
                    <i class="fas fa-share-alt me-2"></i>Bagikan
                </h5>
                <div class="share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                       target="_blank" class="share-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($research->judul) }}"
                       target="_blank" class="share-btn twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($research->judul . ' ' . request()->url()) }}"
                       target="_blank" class="share-btn whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="mailto:?subject={{ urlencode($research->judul) }}&body={{ urlencode(request()->url()) }}"
                       class="share-btn email">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Hero Section */
.research-detail-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 0 80px;
    color: white;
    position: relative;
}

.research-detail-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
    opacity: 0.3;
}

.breadcrumb {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 10px 20px;
    border-radius: 8px;
}

.breadcrumb-item a {
    color: white;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: rgba(255, 255, 255, 0.8);
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.6);
}

.detail-title-section {
    position: relative;
    z-index: 1;
}

.detail-title {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 20px;
}

.detail-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.detail-badges .badge {
    padding: 10px 18px;
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
}

.badge-year {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    color: white;
}

.badge-category {
    background: rgba(52, 211, 153, 0.2);
    backdrop-filter: blur(10px);
    color: #d1fae5;
}

.badge-status {
    background: rgba(96, 165, 250, 0.2);
    backdrop-filter: blur(10px);
    color: #dbeafe;
}

.badge-hibah {
    background: rgba(251, 191, 36, 0.2);
    backdrop-filter: blur(10px);
    color: #fef3c7;
}

/* Info Cards */
.info-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
    display: flex;
    gap: 20px;
    transition: box-shadow 0.3s ease;
}

.info-card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.card-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.card-content {
    flex: 1;
}

.card-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 15px;
}

/* Researcher Card */
.researcher-profile {
    display: flex;
    align-items: center;
    gap: 20px;
}

.researcher-avatar-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    font-weight: 700;
    flex-shrink: 0;
}

.researcher-info-detail {
    flex: 1;
}

.researcher-name-large {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 5px;
}

.researcher-id {
    color: #718096;
    font-size: 0.9rem;
    margin-bottom: 8px;
}

.researcher-role-info {
    color: #4a5568;
    font-size: 0.95rem;
    margin-top: 10px;
}

/* Abstract */
.abstract-text {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #4a5568;
    text-align: justify;
}

/* Keywords */
.keywords-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.keyword-tag {
    background: #e6f3ff;
    color: #0066cc;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Output Items */
.output-item {
    font-size: 1.05rem;
    color: #4a5568;
    display: flex;
    align-items: start;
}

/* Files List */
.files-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.file-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.file-item:hover {
    background: #e6f3ff;
    border-color: #667eea;
    transform: translateX(5px);
}

.file-icon {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
}

.file-info {
    flex: 1;
}

.file-name {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 3px;
}

.file-action {
    font-size: 0.85rem;
    color: #667eea;
}

/* Sidebar */
.sidebar-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    border: 1px solid #f0f0f0;
}

.sidebar-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.sidebar-content {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: start;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.info-row:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.info-label {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #718096;
    font-size: 0.9rem;
}

.info-label i {
    color: #667eea;
}

.info-value {
    font-weight: 600;
    color: #2d3748;
    text-align: right;
    font-size: 0.9rem;
}

/* Action Buttons */
.action-buttons .btn {
    font-weight: 600;
}

/* Share Buttons */
.share-buttons {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.share-btn {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
}

.share-btn:hover {
    transform: translateY(-3px);
    color: white;
}

.share-btn.facebook {
    background: #3b5998;
}

.share-btn.twitter {
    background: #1da1f2;
}

.share-btn.whatsapp {
    background: #25d366;
}

.share-btn.email {
    background: #ea4335;
}

/* Responsive */
@media (max-width: 992px) {
    .detail-title {
        font-size: 1.8rem;
    }

    .researcher-profile {
        flex-direction: column;
        align-items: flex-start;
    }

    .info-card {
        flex-direction: column;
    }
}

@media (max-width: 768px) {
    .detail-title {
        font-size: 1.5rem;
    }

    .info-row {
        flex-direction: column;
        gap: 5px;
    }

    .info-value {
        text-align: left;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Smooth scroll to top
document.querySelector('.btn-outline-primary')?.addEventListener('click', function(e) {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Copy to clipboard functionality
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Link berhasil disalin!');
    });
}
</script>
@endpush
@endsection
