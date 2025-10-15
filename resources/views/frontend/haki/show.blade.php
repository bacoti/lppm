@extends('frontend.layouts.app')

@section('title', $haki->judul . ' - HAKI')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.haki') }}">HAKI</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="detail-card">
                <!-- Header Section -->
                <div class="detail-header">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="jenis-badge jenis-{{ $haki->jenis_haki }}">
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
                        <span class="status-badge status-{{ $haki->status }}">
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
                    <h1 class="detail-title">{{ $haki->judul }}</h1>
                </div>

                <!-- Content Section -->
                <div class="detail-content">
                    @if($haki->deskripsi)
                    <div class="content-section mb-4">
                        <h5 class="section-title">
                            <i class="fas fa-align-left me-2"></i>Deskripsi
                        </h5>
                        <div class="section-content">
                            {!! nl2br(e($haki->deskripsi)) !!}
                        </div>
                    </div>
                    @endif

                    @if($haki->abstrak)
                    <div class="content-section mb-4">
                        <h5 class="section-title">
                            <i class="fas fa-file-text me-2"></i>Abstrak
                        </h5>
                        <div class="section-content">
                            {!! nl2br(e($haki->abstrak)) !!}
                        </div>
                    </div>
                    @endif

                    @if($haki->klaim)
                    <div class="content-section mb-4">
                        <h5 class="section-title">
                            <i class="fas fa-list-alt me-2"></i>Klaim
                        </h5>
                        <div class="section-content">
                            {!! nl2br(e($haki->klaim)) !!}
                        </div>
                    </div>
                    @endif

                    <!-- Documents Section -->
                    @if($haki->dokumen_pendukung || $haki->sertifikat)
                    <div class="content-section mb-4">
                        <h5 class="section-title">
                            <i class="fas fa-file-download me-2"></i>Dokumen
                        </h5>
                        <div class="document-grid">
                            @if($haki->dokumen_pendukung)
                            <div class="document-item">
                                <div class="document-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="document-info">
                                    <div class="document-name">Dokumen Pendukung</div>
                                    <div class="document-size">PDF</div>
                                </div>
                                <a href="{{ Storage::url($haki->dokumen_pendukung) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-download me-1"></i>Download
                                </a>
                            </div>
                            @endif
                            
                            @if($haki->sertifikat)
                            <div class="document-item">
                                <div class="document-icon">
                                    <i class="fas fa-certificate"></i>
                                </div>
                                <div class="document-info">
                                    <div class="document-name">Sertifikat</div>
                                    <div class="document-size">PDF</div>
                                </div>
                                <a href="{{ Storage::url($haki->sertifikat) }}" target="_blank" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-download me-1"></i>Download
                                </a>
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
            <div class="info-card mb-4">
                <div class="info-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Detail
                    </h5>
                </div>
                <div class="info-content">
                    <!-- Inventor -->
                    @if($haki->inventor)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-user me-2"></i>Inventor/Pencipta
                        </div>
                        <div class="info-value">
                            @if(is_array($haki->inventor))
                                @foreach($haki->inventor as $inventor)
                                    <span class="inventor-tag">{{ $inventor }}</span>
                                @endforeach
                            @else
                                {{ $haki->inventor }}
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Registration Details -->
                    @if($haki->nomor_pendaftaran)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-file-contract me-2"></i>No. Pendaftaran
                        </div>
                        <div class="info-value">{{ $haki->nomor_pendaftaran }}</div>
                    </div>
                    @endif

                    @if($haki->nomor_publikasi)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-file-alt me-2"></i>No. Publikasi
                        </div>
                        <div class="info-value">{{ $haki->nomor_publikasi }}</div>
                    </div>
                    @endif

                    @if($haki->nomor_sertifikat)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-certificate me-2"></i>No. Sertifikat
                        </div>
                        <div class="info-value">{{ $haki->nomor_sertifikat }}</div>
                    </div>
                    @endif

                    <!-- Dates -->
                    @if($haki->tanggal_daftar)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar me-2"></i>Tanggal Daftar
                        </div>
                        <div class="info-value">{{ $haki->tanggal_daftar->format('d F Y') }}</div>
                    </div>
                    @endif

                    @if($haki->tanggal_publikasi)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar-check me-2"></i>Tanggal Publikasi
                        </div>
                        <div class="info-value">{{ $haki->tanggal_publikasi->format('d F Y') }}</div>
                    </div>
                    @endif

                    @if($haki->tanggal_granted)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar-check me-2"></i>Tanggal Granted
                        </div>
                        <div class="info-value">{{ $haki->tanggal_granted->format('d F Y') }}</div>
                    </div>
                    @endif

                    <!-- Additional Info -->
                    @if($haki->bidang_teknologi)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-cog me-2"></i>Bidang Teknologi
                        </div>
                        <div class="info-value">{{ $haki->bidang_teknologi }}</div>
                    </div>
                    @endif

                    @if($haki->kantor_kekayaan_intelektual)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-building me-2"></i>Kantor KI
                        </div>
                        <div class="info-value">{{ $haki->kantor_kekayaan_intelektual }}</div>
                    </div>
                    @endif

                    @if($haki->kelas_nice)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-tags me-2"></i>Kelas Nice
                        </div>
                        <div class="info-value">{{ $haki->kelas_nice }}</div>
                    </div>
                    @endif

                    @if($haki->masa_berlaku_start && $haki->masa_berlaku_end)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-hourglass-half me-2"></i>Masa Berlaku
                        </div>
                        <div class="info-value">
                            {{ $haki->masa_berlaku_start->format('d M Y') }} - 
                            {{ $haki->masa_berlaku_end->format('d M Y') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Related HAKI -->
            @if($relatedHakis->count() > 0)
            <div class="related-card">
                <div class="related-header">
                    <h5 class="mb-0">
                        <i class="fas fa-link me-2"></i>HAKI Terkait
                    </h5>
                </div>
                <div class="related-content">
                    @foreach($relatedHakis as $related)
                    <div class="related-item">
                        <div class="related-info">
                            <h6 class="related-title">{{ Str::limit($related->judul, 50) }}</h6>
                            <div class="related-meta">
                                <span class="related-type">{{ ucfirst(str_replace('_', ' ', $related->jenis_haki)) }}</span>
                                <span class="related-separator">•</span>
                                <span class="related-status">{{ ucfirst(str_replace('_', ' ', $related->status)) }}</span>
                            </div>
                        </div>
                        <a href="{{ route('frontend.haki.show', $related) }}" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Back Button -->
            <div class="back-button-container">
                <a href="{{ route('frontend.haki') }}" class="btn btn-info btn-lg w-100">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar HAKI
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Detail Card */
.detail-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.detail-header {
    padding: 30px;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-bottom: 1px solid #e5e7eb;
}

.detail-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a202c;
    line-height: 1.3;
    margin-bottom: 0;
}

.jenis-badge, .status-badge {
    padding: 8px 16px;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.jenis-badge.jenis-paten { background: #dbeafe; color: #1e40af; }
.jenis-badge.jenis-merek { background: #fef3c7; color: #92400e; }
.jenis-badge.jenis-hak_cipta { background: #dcfce7; color: #166534; }
.jenis-badge.jenis-desain_industri { background: #fde2e7; color: #9f1239; }
.jenis-badge.jenis-rahasia_dagang { background: #ede9fe; color: #6b46c1; }

.status-badge.status-granted { background: #dcfce7; color: #166534; }
.status-badge.status-dalam_proses { background: #fef3c7; color: #92400e; }
.status-badge.status-dipublikasi { background: #dbeafe; color: #1e40af; }
.status-badge.status-diajukan { background: #e0e7ff; color: #3730a3; }

.detail-content {
    padding: 30px;
}

.content-section {
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 25px;
}

.content-section:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #17a2b8;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.section-content {
    color: #4a5568;
    line-height: 1.7;
    font-size: 1rem;
}

/* Document Grid */
.document-grid {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.document-item {
    display: flex;
    align-items: center;
    padding: 20px;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.document-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.document-icon {
    width: 50px;
    height: 50px;
    background: #17a2b8;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin-right: 15px;
}

.document-info {
    flex: 1;
}

.document-name {
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 3px;
}

.document-size {
    color: #6b7280;
    font-size: 0.9rem;
}

/* Info Card */
.info-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.info-header {
    padding: 20px;
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
    color: white;
}

.info-content {
    padding: 0;
}

.info-item {
    padding: 15px 20px;
    border-bottom: 1px solid #f1f5f9;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-size: 0.85rem;
    color: #6b7280;
    font-weight: 600;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
}

.info-value {
    color: #1a202c;
    font-weight: 600;
}

.inventor-tag {
    display: inline-block;
    background: #e0f2fe;
    color: #0891b2;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.85rem;
    margin: 2px 5px 2px 0;
}

/* Related HAKI */
.related-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid #e5e7eb;
    margin-bottom: 25px;
}

.related-header {
    padding: 20px;
    background: linear-gradient(135deg, #6f42c1 0%, #8b5cf6 100%);
    color: white;
}

.related-content {
    padding: 0;
}

.related-item {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.3s ease;
}

.related-item:hover {
    background: #f8fafc;
}

.related-item:last-child {
    border-bottom: none;
}

.related-info {
    flex: 1;
}

.related-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 5px;
    line-height: 1.3;
}

.related-meta {
    font-size: 0.8rem;
    color: #6b7280;
}

.related-separator {
    margin: 0 8px;
}

/* Back Button */
.back-button-container {
    margin-top: 25px;
}

/* Breadcrumb */
.breadcrumb {
    background: #f8fafc;
    border-radius: 10px;
    padding: 12px 20px;
}

.breadcrumb-item a {
    color: #17a2b8;
    text-decoration: none;
    font-weight: 500;
}

.breadcrumb-item a:hover {
    color: #138496;
}

.breadcrumb-item.active {
    color: #6b7280;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
    .detail-title {
        font-size: 1.5rem;
    }
    
    .detail-header, .detail-content {
        padding: 20px;
    }
    
    .section-title {
        font-size: 1.1rem;
    }
    
    .document-item {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .document-icon {
        margin-right: 0;
    }
}

/* Animation */
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

.detail-card, .info-card, .related-card {
    animation: fadeIn 0.6s ease-out;
}
</style>
@endpush
@endsection