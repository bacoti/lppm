@extends('frontend.layouts.app')

@section('title', $service->judul)

@section('content')
<!-- Hero Section -->
<div class="service-detail-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tridarma.pengabdian') }}">Pengabdian</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </nav>

                <!-- Title Section -->
                <div class="detail-title-section">
                    <h1 class="detail-title">{{ $service->judul }}</h1>
                    <div class="detail-badges mt-3">
                        @if($service->tanggal_mulai)
                        <span class="badge badge-year">
                            <i class="far fa-calendar-alt me-2"></i>{{ $service->tanggal_mulai->format('Y') }}
                        </span>
                        @endif
                        @if($service->jenis_pengabdian)
                        <span class="badge badge-category">
                            <i class="fas fa-tag me-2"></i>{{ \App\Models\Service::getJenisPengabdianOptions()[$service->jenis_pengabdian] ?? $service->jenis_pengabdian }}
                        </span>
                        @endif
                        @if($service->status)
                        <span class="badge badge-status">
                            <i class="fas fa-circle me-2"></i>{{ ucfirst($service->status) }}
                        </span>
                        @endif
                        @if($service->hibah_kompetitif)
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
            <!-- Coordinator Info Card -->
            <div class="info-card coordinator-card mb-4">
                <div class="card-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Penanggung Jawab</h5>
                    <div class="coordinator-profile">
                        <div class="coordinator-avatar-large">
                            {{ strtoupper(substr($service->dosen?->nama_lengkap ?? 'N', 0, 2)) }}
                        </div>
                        <div class="coordinator-info-detail">
                            <h6 class="coordinator-name-large">{{ $service->dosen?->nama_lengkap ?? 'N/A' }}</h6>
                            @if($service->dosen?->nidn_nip)
                                <p class="coordinator-id">NIDN/NIP: {{ $service->dosen->nidn_nip }}</p>
                            @endif
                            @if($service->ketua_pengabdian && $service->ketua_pengabdian !== $service->dosen?->nama_lengkap)
                                <p class="coordinator-role-info">
                                    <i class="fas fa-crown me-1"></i>Ketua Pengabdian: <strong>{{ $service->ketua_pengabdian }}</strong>
                                </p>
                            @endif
                            @if($service->nidn_leader)
                                <p class="coordinator-role-info">
                                    <i class="fas fa-id-card me-1"></i>NIDN Ketua: <strong>{{ $service->nidn_leader }}</strong>
                                </p>
                            @endif
                            @if($service->leader_name && $service->leader_name !== $service->ketua_pengabdian)
                                <p class="coordinator-role-info">
                                    <i class="fas fa-user-tie me-1"></i>Nama Ketua: <strong>{{ $service->leader_name }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            @if($service->deskripsi)
            <div class="info-card mb-4">
                <div class="card-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Deskripsi Pengabdian</h5>
                    <p class="description-text">{{ $service->deskripsi }}</p>
                </div>
            </div>
            @endif

            <!-- Location & Target -->
            <div class="info-card mb-4">
                <div class="card-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Lokasi & Target</h5>
                    <div class="row">
                        @if($service->lokasi)
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                <div>
                                    <div class="info-label">Lokasi</div>
                                    <div class="info-value">{{ $service->lokasi }}</div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($service->mitra)
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="fas fa-handshake text-primary me-2"></i>
                                <div>
                                    <div class="info-label">Mitra</div>
                                    <div class="info-value">{{ $service->mitra }}</div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Team Members -->
            @if($service->tim_pelaksana && count($service->tim_pelaksana) > 0)
            <div class="info-card mb-4">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Tim Pelaksana</h5>
                    <div class="team-list">
                        @foreach($service->tim_pelaksana as $index => $member)
                            <div class="team-member">
                                <div class="member-number">{{ $index + 1 }}</div>
                                <div class="member-info">
                                    <div class="member-name">{{ $member }}</div>
                                    <div class="member-role">Anggota Tim</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Progress & Impact -->
            <div class="info-card mb-4">
                <div class="card-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Progress & Dampak</h5>

                    @if($service->progress_percentage !== null)
                    <div class="progress-section mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="progress-label">Progress Kegiatan</span>
                            <span class="progress-value">{{ $service->progress_percentage }}%</span>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                 style="width: {{ $service->progress_percentage }}%"
                                 aria-valuenow="{{ $service->progress_percentage }}"
                                 aria-valuemin="0" aria-valuemax="100">
                                {{ $service->progress_percentage }}%
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($service->dampak)
                    <div class="impact-section">
                        <h6 class="mb-3"><i class="fas fa-bullseye text-warning me-2"></i>Dampak Kegiatan</h6>
                        <p class="impact-text">{{ $service->dampak }}</p>
                    </div>
                    @endif

                    @if($service->jumlah_peserta)
                    <div class="participant-info mt-3">
                        <i class="fas fa-users text-info me-2"></i>
                        <strong>{{ $service->jumlah_peserta }}</strong> Peserta Terlibat
                    </div>
                    @endif
                </div>
            </div>

            <!-- Files Section -->
            <div class="info-card mb-4">
                <div class="card-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Dokumen Pengabdian</h5>
                    <div class="files-list">
                        @php
                            $files = [
                                'file_proposal' => ['label' => 'Proposal', 'icon' => 'file-alt', 'color' => 'info'],
                                'file_sk' => ['label' => 'SK Pengabdian', 'icon' => 'file-contract', 'color' => 'warning'],
                                'file_laporan' => ['label' => 'Laporan Kegiatan', 'icon' => 'file-pdf', 'color' => 'danger'],
                                'file_dokumentasi' => ['label' => 'Dokumentasi', 'icon' => 'images', 'color' => 'success'],
                                'file_evaluasi' => ['label' => 'Evaluasi', 'icon' => 'file-check', 'color' => 'primary']
                            ];
                            $hasFiles = false;
                        @endphp

                        @foreach($files as $field => $fileInfo)
                            @if($service->$field)
                                @php $hasFiles = true; @endphp
                                <a href="{{ asset('storage/' . $service->$field) }}" target="_blank" class="file-item">
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
                    @if($service->jenis_pengabdian)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-tag"></i>
                            <span>Jenis</span>
                        </div>
                        <div class="info-value">{{ \App\Models\Service::getJenisPengabdianOptions()[$service->jenis_pengabdian] ?? $service->jenis_pengabdian }}</div>
                    </div>
                    @endif

                    @if($service->skema_name)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-project-diagram"></i>
                            <span>Skema</span>
                        </div>
                        <div class="info-value">{{ $service->skema_name }}</div>
                    </div>
                    @endif

                    @if($service->pddikti_code_pt)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-university"></i>
                            <span>Kode PDDIKTI PT</span>
                        </div>
                        <div class="info-value">{{ $service->pddikti_code_pt }}</div>
                    </div>
                    @endif

                    @if($service->institution)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-building"></i>
                            <span>Institusi</span>
                        </div>
                        <div class="info-value">{{ $service->institution }}</div>
                    </div>
                    @endif

                    @if($service->proposal_status)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-file-contract"></i>
                            <span>Status Proposal</span>
                        </div>
                        <div class="info-value">
                            @php
                                $statusOptions = \App\Models\Service::getProposalStatusOptions();
                                $statusLabel = $statusOptions[$service->proposal_status] ?? $service->proposal_status;
                            @endphp
                            <span class="badge {{ match($service->proposal_status) {
                                'draft' => 'bg-secondary',
                                'submitted' => 'bg-info',
                                'review' => 'bg-warning',
                                'approved' => 'bg-primary',
                                'rejected' => 'bg-danger',
                                'funded' => 'bg-success',
                                default => 'bg-secondary'
                            } }}">{{ $statusLabel }}</span>
                        </div>
                    </div>
                    @endif

                    @if($service->sumber_dana)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Sumber Dana</span>
                        </div>
                        <div class="info-value">{{ $service->sumber_dana }}</div>
                    </div>
                    @endif

                    @if($service->fund_approved)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-coins"></i>
                            <span>Dana Disetujui</span>
                        </div>
                        <div class="info-value">Rp {{ number_format($service->fund_approved, 0, ',', '.') }}</div>
                    </div>
                    @elseif($service->jumlah_dana)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-coins"></i>
                            <span>Jumlah Dana</span>
                        </div>
                        <div class="info-value">Rp {{ number_format($service->jumlah_dana, 0, ',', '.') }}</div>
                    </div>
                    @endif

                    @if($service->tanggal_mulai)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="far fa-calendar-check"></i>
                            <span>Tanggal Mulai</span>
                        </div>
                        <div class="info-value">{{ $service->tanggal_mulai->format('d M Y') }}</div>
                    </div>
                    @endif

                    @if($service->tanggal_selesai)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="far fa-calendar-times"></i>
                            <span>Tanggal Selesai</span>
                        </div>
                        <div class="info-value">{{ $service->tanggal_selesai->format('d M Y') }}</div>
                    </div>
                    @endif

                    @if($service->durasi_hari)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-hourglass-half"></i>
                            <span>Durasi</span>
                        </div>
                        <div class="info-value">{{ $service->durasi_hari }} hari</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="sidebar-card">
                <div class="action-buttons">
                    <a href="{{ route('tridarma.pengabdian') }}" class="btn btn-outline-success w-100 mb-2">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                    @if($service->file_laporan)
                    <a href="{{ asset('storage/' . $service->file_laporan) }}" target="_blank" class="btn btn-success w-100">
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
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($service->judul) }}"
                       target="_blank" class="share-btn twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($service->judul . ' ' . request()->url()) }}"
                       target="_blank" class="share-btn whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="mailto:?subject={{ urlencode($service->judul) }}&body={{ urlencode(request()->url()) }}"
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
.service-detail-hero {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    padding: 60px 0 80px;
    color: white;
    position: relative;
}

.service-detail-hero::before {
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
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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

/* Coordinator Card */
.coordinator-profile {
    display: flex;
    align-items: center;
    gap: 20px;
}

.coordinator-avatar-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    font-weight: 700;
    flex-shrink: 0;
}

.coordinator-info-detail {
    flex: 1;
}

.coordinator-name-large {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 5px;
}

.coordinator-id {
    color: #718096;
    font-size: 0.9rem;
    margin-bottom: 8px;
}

.coordinator-role-info {
    color: #4a5568;
    font-size: 0.95rem;
    margin-top: 10px;
}

/* Description */
.description-text {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #4a5568;
    text-align: justify;
}

/* Info Items */
.info-item {
    display: flex;
    align-items: start;
    gap: 10px;
}

.info-label {
    font-size: 0.85rem;
    color: #718096;
    margin-bottom: 5px;
}

.info-value {
    font-weight: 600;
    color: #2d3748;
    font-size: 1rem;
}

/* Team List */
.team-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.team-member {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: background 0.3s ease;
}

.team-member:hover {
    background: #e9ecef;
}

.member-number {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
}

.member-info {
    flex: 1;
}

.member-name {
    font-weight: 600;
    color: #2d3748;
}

.member-role {
    font-size: 0.85rem;
    color: #718096;
}

/* Progress Section */
.progress-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.progress-label {
    font-weight: 600;
    color: #2d3748;
}

.progress-value {
    font-weight: 700;
    color: #11998e;
    font-size: 1.2rem;
}

.progress {
    border-radius: 15px;
    background: #e9ecef;
}

.progress-bar {
    border-radius: 15px;
    font-weight: 600;
}

/* Impact Section */
.impact-section {
    background: #fffbeb;
    padding: 20px;
    border-radius: 10px;
    border-left: 4px solid #f59e0b;
}

.impact-text {
    color: #78350f;
    line-height: 1.7;
    margin: 0;
}

.participant-info {
    display: flex;
    align-items: center;
    padding: 15px;
    background: #e6f3ff;
    border-radius: 10px;
    color: #0066cc;
    font-size: 1.05rem;
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
    border-color: #11998e;
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
    color: #11998e;
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

.info-row .info-label {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #718096;
    font-size: 0.9rem;
}

.info-row .info-label i {
    color: #11998e;
}

.info-row .info-value {
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

    .coordinator-profile {
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

    .info-row .info-value {
        text-align: left;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Smooth scroll to top
document.querySelector('.btn-outline-success')?.addEventListener('click', function(e) {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
@endpush
@endsection
