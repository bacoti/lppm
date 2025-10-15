@extends('admin.layouts.admin')

@section('title', 'Detail Pengabdian Masyarakat')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-eye me-2"></i>Detail Pengabdian Masyarakat</h4>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Status Badge -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="text-primary mb-0">{{ $service->judul }}</h3>
                                <span class="badge fs-6 bg-{{ $service->getStatusBadgeClass() }} px-3 py-2">
                                    {{ $service->getStatusOptions()[$service->status] ?? $service->status }}
                                </span>
                            </div>
                            @if($service->progress_percentage !== null)
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small class="text-muted">Progress</small>
                                        <small class="text-muted">{{ $service->progress_percentage }}%</small>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" role="progressbar"
                                             style="width: {{ $service->progress_percentage }}%"
                                             aria-valuenow="{{ $service->progress_percentage }}"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Dasar -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary border-bottom pb-2">
                                <i class="fas fa-info-circle me-2"></i>Informasi Dasar
                            </h5>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Dosen Penanggung Jawab</h6>
                                    <p class="card-text mb-0">
                                        @if($service->dosen)
                                            <strong>{{ $service->dosen->nama_lengkap }}</strong>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Bidang Pengabdian</h6>
                                    <p class="card-text mb-0">
                                        <strong>{{ $service->bidang ?? '-' }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Jenis Pengabdian</h6>
                                    <p class="card-text mb-0">
                                        <strong>{{ $service->getJenisPengabdianOptions()[$service->jenis_pengabdian] ?? '-' }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">ID Pengabdian</h6>
                                    <p class="card-text mb-0">
                                        <code>#{{ $service->id }}</code>
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($service->deskripsi)
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted mb-2">Deskripsi Pengabdian</h6>
                                        <p class="card-text">{{ $service->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Tim Pelaksana -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary border-bottom pb-2">
                                <i class="fas fa-users me-2"></i>Tim Pelaksana
                            </h5>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        @if($service->ketua_pengabdian)
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted mb-2">Ketua Pengabdian</h6>
                                        <p class="card-text mb-0">
                                            <strong>{{ $service->ketua_pengabdian }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($service->tim_pelaksana && count($timPelaksanaNames) > 0)
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted mb-2">Tim Pelaksana</h6>
                                        <div class="mb-0">
                                            @foreach($timPelaksanaNames as $name)
                                                <span class="badge bg-primary me-1 mb-1">{{ $name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($service->anggota_eksternal)
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted mb-2">Anggota Eksternal</h6>
                                        <p class="card-text mb-0">{{ $service->anggota_eksternal }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($service->mitra_kerjasama)
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted mb-2">Mitra Kerjasama</h6>
                                        <p class="card-text mb-0">{{ $service->mitra_kerjasama }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Waktu Pelaksanaan -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary border-bottom pb-2">
                                <i class="fas fa-calendar-alt me-2"></i>Waktu Pelaksanaan
                            </h5>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Tanggal Mulai</h6>
                                    <p class="card-text mb-0 h5 text-primary">
                                        @if($service->tanggal_mulai)
                                            {{ $service->tanggal_mulai->format('d/m/Y') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Tanggal Selesai</h6>
                                    <p class="card-text mb-0 h5 text-success">
                                        @if($service->tanggal_selesai)
                                            {{ $service->tanggal_selesai->format('d/m/Y') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Target Selesai</h6>
                                    <p class="card-text mb-0 h5 text-warning">
                                        @if($service->tanggal_target_selesai)
                                            {{ $service->tanggal_target_selesai->format('d/m/Y') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Durasi</h6>
                                    <p class="card-text mb-0 h5 text-info">
                                        @if($service->durasi_hari)
                                            {{ $service->durasi_hari }} hari
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lokasi dan Sasaran -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary border-bottom pb-2">
                                <i class="fas fa-map-marker-alt me-2"></i>Lokasi dan Sasaran
                            </h5>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Lokasi</h6>
                                    <p class="card-text mb-0">
                                        <strong>{{ $service->lokasi ?? '-' }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Jumlah Peserta</h6>
                                    <p class="card-text mb-0">
                                        <strong>{{ $service->jumlah_peserta ?? '-' }} orang</strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($service->alamat_lengkap)
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted mb-2">Alamat Lengkap</h6>
                                        <p class="card-text">{{ $service->alamat_lengkap }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Kelompok Sasaran</h6>
                                    <p class="card-text mb-0">{{ $service->kelompok_sasaran ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Kriteria Peserta</h6>
                                    <p class="card-text mb-0">{{ $service->kriteria_peserta ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pendanaan -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary border-bottom pb-2">
                                <i class="fas fa-money-bill-wave me-2"></i>Pendanaan
                            </h5>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Sumber Dana</h6>
                                    <p class="card-text mb-0">
                                        <strong>{{ $service->sumber_dana ?? '-' }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Jumlah Dana</h6>
                                    <p class="card-text mb-0 h5 text-success">
                                        <strong>{{ $service->getFormattedJumlahDana() }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-muted mb-2">Hibah Kompetitif</h6>
                                    <p class="card-text mb-0">
                                        @if($service->hibah_kompetitif)
                                            <span class="badge bg-success">Ya</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Output dan Dampak -->
                    @if($service->tujuan || $service->luaran || $service->dampak_manfaat || $service->indikator_keberhasilan || $service->kendala_hambatan)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-chart-line me-2"></i>Output dan Dampak
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            @if($service->tujuan)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">Tujuan Pengabdian</h6>
                                            <p class="card-text">{{ $service->tujuan }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service->luaran)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">Luaran yang Diharapkan</h6>
                                            <p class="card-text">{{ $service->luaran }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service->dampak_manfaat)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">Dampak dan Manfaat</h6>
                                            <p class="card-text">{{ $service->dampak_manfaat }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service->indikator_keberhasilan)
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">Indikator Keberhasilan</h6>
                                            <p class="card-text">{{ $service->indikator_keberhasilan }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service->kendala_hambatan)
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">Kendala dan Hambatan</h6>
                                            <p class="card-text">{{ $service->kendala_hambatan }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Dokumentasi -->
                    @if($service->file_proposal || $service->file_laporan || $service->file_dokumentasi || $service->file_sertifikat || $service->link_dokumentasi)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-file-alt me-2"></i>Dokumentasi
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            @if($service->file_proposal)
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">File Proposal</h6>
                                            <a href="{{ Storage::url($service->file_proposal) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-external-link-alt me-1"></i>Lihat File
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service->file_laporan)
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">File Laporan</h6>
                                            <a href="{{ Storage::url($service->file_laporan) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-external-link-alt me-1"></i>Lihat File
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service->file_dokumentasi)
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">File Dokumentasi</h6>
                                            <a href="{{ Storage::url($service->file_dokumentasi) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-external-link-alt me-1"></i>Lihat File
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service->file_sertifikat)
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">File Sertifikat</h6>
                                            <a href="{{ Storage::url($service->file_sertifikat) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-external-link-alt me-1"></i>Lihat File
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service->link_dokumentasi)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">Link Dokumentasi</h6>
                                            <a href="{{ $service->link_dokumentasi }}" target="_blank" class="btn btn-outline-info btn-sm">
                                                <i class="fas fa-external-link-alt me-1"></i>Buka Link
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- SK dan Administrasi -->
                    @if($service->nomor_sk || $service->tanggal_sk || $service->file_sk)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-file-signature me-2"></i>SK dan Administrasi
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            @if($service->nomor_sk)
                                <div class="col-md-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">Nomor SK</h6>
                                            <p class="card-text mb-0">
                                                <code>{{ $service->nomor_sk }}</code>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service->tanggal_sk)
                                <div class="col-md-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">Tanggal SK</h6>
                                            <p class="card-text mb-0">
                                                <strong>{{ $service->tanggal_sk->format('d/m/Y') }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service->file_sk)
                                <div class="col-md-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">File SK</h6>
                                            <a href="{{ Storage::url($service->file_sk) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-external-link-alt me-1"></i>Lihat File
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Evaluasi -->
                    @if($service->tingkat_kepuasan || $service->evaluasi_kegiatan || $service->rekomendasi)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-star me-2"></i>Evaluasi
                                </h5>
                            </div>
                        </div>

                        <div class="row g-3">
                            @if($service->tingkat_kepuasan)
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">Tingkat Kepuasan</h6>
                                            <p class="card-text mb-0">
                                                <span class="badge bg-info fs-6">{{ $service->getTingkatKepuasanOptions()[$service->tingkat_kepuasan] ?? $service->tingkat_kepuasan }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <!-- Spacer -->
                            </div>

                            @if($service->evaluasi_kegiatan)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">Evaluasi Kegiatan</h6>
                                            <p class="card-text">{{ $service->evaluasi_kegiatan }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service->rekomendasi)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-2">Rekomendasi</h6>
                                            <p class="card-text">{{ $service->rekomendasi }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col-12">
                            <small class="text-muted">
                                Dibuat: {{ $service->created_at->format('d/m/Y H:i') }} |
                                Diupdate: {{ $service->updated_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.card {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
}

.card-header {
    border-bottom: none;
    padding: 1.5rem;
}

.card-body {
    padding: 1.5rem;
}

.card-footer {
    border-top: 1px solid #dee2e6;
    padding: 1.5rem;
}

h5 {
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.border-bottom {
    border-bottom: 2px solid #e9ecef !important;
}

.text-primary {
    color: #0d6efd !important;
}

.badge {
    font-size: 0.75rem;
}

.btn-group .btn {
    margin-right: 2px;
}

.progress {
    border-radius: 4px;
}
</style>
@endpush
@endsection