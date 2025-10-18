@extends('frontend.layouts.app')

@section('title', $haki->judul . ' - HAKI')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); min-height: 100vh;">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white shadow-sm rounded-pill px-4 py-2">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('frontend.haki') }}" class="text-decoration-none">HAKI</a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    {{ Str::limit($haki->judul, 40) }}
                </li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Header Card -->
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header bg-gradient-primary text-white p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge fs-6 px-3 py-2" style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3);">
                                        <i class="fas fa-copyright me-1"></i>
                                        @switch($haki->jenis_haki)
                                            @case('paten') Paten @break
                                            @case('merek') Merek @break
                                            @case('hak_cipta') Hak Cipta @break
                                            @case('desain_industri') Desain Industri @break
                                            @case('rahasia_dagang') Rahasia Dagang @break
                                            @default {{ ucfirst(str_replace('_', ' ', $haki->jenis_haki)) }}
                                        @endswitch
                                    </span>
                                    <span class="badge fs-6 px-3 py-2
                                        @if($haki->status == 'granted') bg-success
                                        @elseif($haki->status == 'dalam_proses') bg-warning text-dark
                                        @elseif($haki->status == 'dipublikasi') bg-info
                                        @elseif($haki->status == 'diajukan') bg-primary
                                        @else bg-secondary @endif">
                                        @if($haki->status == 'granted')
                                            <i class="fas fa-check-circle me-1"></i>Granted
                                        @elseif($haki->status == 'dalam_proses')
                                            <i class="fas fa-clock me-1"></i>Dalam Proses
                                        @elseif($haki->status == 'dipublikasi')
                                            <i class="fas fa-file-alt me-1"></i>Dipublikasi
                                        @elseif($haki->status == 'diajukan')
                                            <i class="fas fa-paper-plane me-1"></i>Diajukan
                                        @else
                                            <i class="fas fa-info-circle me-1"></i>{{ ucfirst(str_replace('_', ' ', $haki->status)) }}
                                        @endif
                                    </span>
                                </div>
                                <h1 class="h2 fw-bold mb-0 text-white">{{ $haki->judul }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Quick Stats -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="text-center p-3 bg-light rounded-3">
                                    <i class="fas fa-calendar-alt fa-2x text-primary mb-2"></i>
                                    <div class="fw-bold text-primary">{{ $haki->tahun_permohonan ?? 'N/A' }}</div>
                                    <small class="text-muted">Tahun Permohonan</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 bg-light rounded-3">
                                    <i class="fas fa-user-tie fa-2x text-success mb-2"></i>
                                    <div class="fw-bold text-success">{{ $haki->pemegang_paten ?? 'N/A' }}</div>
                                    <small class="text-muted">Pemegang Paten</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 bg-light rounded-3">
                                    <i class="fas fa-file-signature fa-2x text-info mb-2"></i>
                                    <div class="fw-bold text-info">{{ $haki->nomor_permohonan ?? 'N/A' }}</div>
                                    <small class="text-muted">No. Permohonan</small>
                                </div>
                            </div>
                        </div>

                        <!-- Content Sections -->
                        @if($haki->deskripsi)
                        <div class="content-section mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary rounded-circle p-2 me-3">
                                    <i class="fas fa-align-left text-white"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-0 text-primary">Deskripsi</h4>
                            </div>
                            <div class="content-text p-3 bg-light rounded-3">
                                {!! nl2br(e($haki->deskripsi)) !!}
                            </div>
                        </div>
                        @endif

                        @if($haki->abstrak)
                        <div class="content-section mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success rounded-circle p-2 me-3">
                                    <i class="fas fa-file-text text-white"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-0 text-success">Abstrak</h4>
                            </div>
                            <div class="content-text p-3 bg-light rounded-3">
                                {!! nl2br(e($haki->abstrak)) !!}
                            </div>
                        </div>
                        @endif

                        @if($haki->klaim)
                        <div class="content-section mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-warning rounded-circle p-2 me-3">
                                    <i class="fas fa-list-alt text-white"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-0 text-warning">Klaim</h4>
                            </div>
                            <div class="content-text p-3 bg-light rounded-3">
                                {!! nl2br(e($haki->klaim)) !!}
                            </div>
                        </div>
                        @endif

                        <!-- Documents Section -->
                        @if($haki->dokumen_pendukung || $haki->sertifikat)
                        <div class="content-section">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-info rounded-circle p-2 me-3">
                                    <i class="fas fa-file-download text-white"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-0 text-info">Dokumen & Sertifikat</h4>
                            </div>
                            <div class="row g-3">
                                @if($haki->dokumen_pendukung)
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-danger rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                <i class="fas fa-file-pdf fa-lg text-white"></i>
                                            </div>
                                            <h6 class="card-title fw-bold">Dokumen Pendukung</h6>
                                            <p class="text-muted small mb-3">PDF Document</p>
                                            <a href="{{ Storage::url($haki->dokumen_pendukung) }}" target="_blank" class="btn btn-outline-danger btn-sm px-4">
                                                <i class="fas fa-download me-2"></i>Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if($haki->sertifikat)
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                                        <div class="card-body text-center p-4">
                                            <div class="bg-success rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                <i class="fas fa-certificate fa-lg text-white"></i>
                                            </div>
                                            <h6 class="card-title fw-bold">Sertifikat</h6>
                                            <p class="text-muted small mb-3">Official Certificate</p>
                                            <a href="{{ Storage::url($haki->sertifikat) }}" target="_blank" class="btn btn-outline-success btn-sm px-4">
                                                <i class="fas fa-download me-2"></i>Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Detail Information Card -->
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header bg-gradient-info text-white p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-info-circle me-2"></i>Informasi Lengkap
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <!-- Inventor -->
                        @if($haki->inventor)
                        <div class="info-group p-3 border-bottom">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-user text-primary me-2"></i>
                                <span class="fw-bold text-primary">Inventor/Pencipta</span>
                            </div>
                            <div class="info-value">
                                @if(is_array($haki->inventor))
                                    @foreach($haki->inventor as $inventor)
                                        <span class="badge bg-light text-dark me-1 mb-1 px-2 py-1">{{ $inventor }}</span>
                                    @endforeach
                                @else
                                    {{ $haki->inventor }}
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Registration Details -->
                        <div class="info-group p-3 border-bottom">
                            <h6 class="fw-bold text-muted mb-3">
                                <i class="fas fa-file-contract me-2"></i>Detail Pendaftaran
                            </h6>

                            @if($haki->nomor_pendaftaran)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">No. Pendaftaran</span>
                                <span class="fw-bold">{{ $haki->nomor_pendaftaran }}</span>
                            </div>
                            @endif

                            @if($haki->nomor_permohonan)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">No. Permohonan</span>
                                <span class="fw-bold">{{ $haki->nomor_permohonan }}</span>
                            </div>
                            @endif

                            @if($haki->nomor_publikasi)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">No. Publikasi</span>
                                <span class="fw-bold">{{ $haki->nomor_publikasi }}</span>
                            </div>
                            @endif

                            @if($haki->nomor_sertifikat)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">No. Sertifikat</span>
                                <span class="fw-bold">{{ $haki->nomor_sertifikat }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- Important Dates -->
                        <div class="info-group p-3 border-bottom">
                            <h6 class="fw-bold text-muted mb-3">
                                <i class="fas fa-calendar-alt me-2"></i>Tanggal Penting
                            </h6>

                            @if($haki->tanggal_daftar)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Tanggal Daftar</span>
                                <span class="fw-bold">{{ $haki->tanggal_daftar->format('d/m/Y') }}</span>
                            </div>
                            @endif

                            @if($haki->tanggal_penerimaan)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Tanggal Penerimaan</span>
                                <span class="fw-bold">{{ $haki->tanggal_penerimaan->format('d/m/Y') }}</span>
                            </div>
                            @endif

                            @if($haki->tanggal_publikasi)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Tanggal Publikasi</span>
                                <span class="fw-bold">{{ $haki->tanggal_publikasi->format('d/m/Y') }}</span>
                            </div>
                            @endif

                            @if($haki->tanggal_granted)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Tanggal Granted</span>
                                <span class="fw-bold">{{ $haki->tanggal_granted->format('d/m/Y') }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- Additional Info -->
                        <div class="info-group p-3">
                            <h6 class="fw-bold text-muted mb-3">
                                <i class="fas fa-cog me-2"></i>Informasi Tambahan
                            </h6>

                            @if($haki->tahun_permohonan)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Tahun Permohonan</span>
                                <span class="fw-bold">{{ $haki->tahun_permohonan }}</span>
                            </div>
                            @endif

                            @if($haki->pemegang_paten)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Pemegang Paten</span>
                                <span class="fw-bold">{{ $haki->pemegang_paten }}</span>
                            </div>
                            @endif

                            @if($haki->bidang_teknologi)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Bidang Teknologi</span>
                                <span class="fw-bold">{{ $haki->bidang_teknologi }}</span>
                            </div>
                            @endif

                            @if($haki->kantor_kekayaan_intelektual)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Kantor KI</span>
                                <span class="fw-bold">{{ $haki->kantor_kekayaan_intelektual }}</span>
                            </div>
                            @endif

                            @if($haki->kelas_nice)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Kelas Nice</span>
                                <span class="fw-bold">{{ $haki->kelas_nice }}</span>
                            </div>
                            @endif

                            @if($haki->masa_berlaku_start && $haki->masa_berlaku_end)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Masa Berlaku</span>
                                <span class="fw-bold">{{ $haki->masa_berlaku_start->format('d/m/Y') }} - {{ $haki->masa_berlaku_end->format('d/m/Y') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Related HAKI -->
                @if($relatedHakis->count() > 0)
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header bg-gradient-secondary text-white p-4" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border: none;">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-link me-2"></i>HAKI Terkait
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        @foreach($relatedHakis as $related)
                        <div class="related-item p-3 border-bottom">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold">{{ Str::limit($related->judul, 40) }}</h6>
                                    <div class="d-flex align-items-center gap-2">
                                        <small class="text-muted">
                                            <i class="fas fa-tag me-1"></i>{{ ucfirst(str_replace('_', ' ', $related->jenis_haki)) }}
                                        </small>
                                        <span class="badge
                                            @if($related->status == 'granted') bg-success
                                            @elseif($related->status == 'dalam_proses') bg-warning text-dark
                                            @elseif($related->status == 'dipublikasi') bg-info
                                            @else bg-secondary @endif" style="font-size: 0.7rem;">
                                            {{ ucfirst(str_replace('_', ' ', $related->status)) }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('frontend.haki.show', $related) }}" class="btn btn-outline-primary btn-sm ms-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Back Button -->
                <div class="text-center">
                    <a href="{{ route('frontend.haki') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold" style="border-radius: 50px; box-shadow: 0 4px 15px rgba(0,123,255,0.3);">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar HAKI
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Modern HAKI Detail Page Styles */
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --info-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    --card-shadow: 0 10px 30px rgba(0,0,0,0.1);
    --border-radius: 20px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Enhanced Breadcrumb */
.breadcrumb {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.breadcrumb-item a {
    color: #667eea !important;
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition);
}

.breadcrumb-item a:hover {
    color: #764ba2 !important;
    transform: translateY(-1px);
}

/* Main Content Card */
.card {
    border: none !important;
    transition: var(--transition);
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
}

.card-header {
    border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
}

/* Quick Stats */
.bg-light {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
    border: 1px solid rgba(0,0,0,0.05);
}

/* Content Sections */
.content-section {
    margin-bottom: 2rem;
}

.content-section .bg-primary,
.content-section .bg-success,
.content-section .bg-warning,
.content-section .bg-info {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.content-text {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%) !important;
    border: 1px solid rgba(0,0,0,0.05);
    line-height: 1.7;
    font-size: 0.95rem;
    color: #495057;
}

/* Document Cards */
.document-item .card {
    transition: var(--transition);
}

.document-item .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2) !important;
}

.document-item .card-body {
    padding: 2rem !important;
}

/* Info Groups */
.info-group {
    transition: var(--transition);
}

.info-group:hover {
    background: rgba(102, 126, 234, 0.02);
}

.info-group h6 {
    color: #667eea !important;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 1rem !important;
}

.info-group .d-flex {
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.info-group .d-flex:last-child {
    border-bottom: none;
}

/* Related Items */
.related-item {
    transition: var(--transition);
    border-radius: 10px;
    margin: 0.5rem 0;
}

.related-item:hover {
    background: linear-gradient(135deg, rgba(240, 147, 251, 0.05) 0%, rgba(245, 87, 108, 0.05) 100%) !important;
    transform: translateX(5px);
}

.related-item h6 {
    color: #2d3748;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

/* Enhanced Buttons */
.btn {
    border-radius: 25px !important;
    font-weight: 600 !important;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: var(--transition);
    border: none !important;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.btn-primary {
    background: var(--primary-gradient) !important;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-outline-primary:hover,
.btn-outline-success:hover,
.btn-outline-danger:hover {
    transform: translateY(-2px);
}

/* Badge Enhancements */
.badge {
    border-radius: 20px !important;
    font-weight: 600 !important;
    padding: 0.5rem 1rem !important;
    font-size: 0.75rem !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem !important;
    }

    .card-header h1,
    .card-header h5 {
        font-size: 1.25rem !important;
    }

    .btn-lg {
        padding: 0.75rem 2rem !important;
        font-size: 0.9rem !important;
    }

    .row.g-3 > .col-md-4 {
        margin-bottom: 1rem;
    }

    .info-group .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 0.25rem;
    }

    .info-group .d-flex span:last-child {
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .breadcrumb {
        font-size: 0.8rem;
    }

    .card-body {
        padding: 1rem !important;
    }

    .content-text {
        padding: 1rem !important;
        font-size: 0.9rem;
    }
}

/* Loading Animation */
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

.card {
    animation: fadeInUp 0.6s ease-out;
}

.card:nth-child(2) {
    animation-delay: 0.1s;
}

.card:nth-child(3) {
    animation-delay: 0.2s;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: var(--primary-gradient);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
}

/* Focus States */
.form-control:focus,
.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Print Styles */
@media print {
    .btn,
    .breadcrumb,
    .card-header {
        display: none !important;
    }

    .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }

    .content-text {
        background: white !important;
        border: 1px solid #ddd !important;
    }
}
</style>
@endpush
@endsection
