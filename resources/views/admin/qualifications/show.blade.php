@extends('layouts.admin')

@section('title', 'Detail Kualifikasi Dosen')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Detail Kualifikasi Dosen</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.qualifications.index') }}">Kualifikasi Dosen</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.qualifications.edit', $qualification) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <a href="{{ route('admin.qualifications.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row">
        {{-- Main Info Card --}}
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-graduate me-2"></i>
                        {{ $qualification->dosen->nama_lengkap }}
                    </h5>
                </div>
                
                <div class="card-body">
                    {{-- Section 1: Identitas Dosen --}}
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-user-tie me-2"></i>Identitas Dosen
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">NIDN/NIP</small>
                                    <span class="fs-6">{{ $qualification->dosen->nidn_nip ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">Nama Lengkap</small>
                                    <span class="fs-6">{{ $qualification->dosen->nama_lengkap ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">Gelar Akademik</small>
                                    <span class="fs-6">{{ $qualification->dosen->gelar_akademik ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Section 2: Data Pendidikan --}}
                    <div class="mb-4">
                        <h6 class="text-success mb-3">
                            <i class="fas fa-graduation-cap me-2"></i>Data Pendidikan
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">Jenjang Pendidikan</small>
                                    @if($qualification->jenjang_pendidikan)
                                        <span class="badge bg-primary w-fit">{{ $qualification->jenjang_pendidikan }}</span>
                                    @else
                                        <span class="fs-6 text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">Gelar yang Diperoleh</small>
                                    <span class="fs-6">{{ $qualification->gelar_diperoleh ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">Nama Perguruan Tinggi</small>
                                    <span class="fs-6">{{ $qualification->nama_perguruan_tinggi ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">Status & Akreditasi PT</small>
                                    <div class="d-flex gap-2">
                                        @if($qualification->status_pt)
                                            <span class="badge bg-info">{{ $qualification->status_pt }}</span>
                                        @endif
                                        @if($qualification->akreditasi_pt)
                                            <span class="badge bg-secondary">{{ $qualification->akreditasi_pt }}</span>
                                        @endif
                                        @if(!$qualification->status_pt && !$qualification->akreditasi_pt)
                                            <span class="fs-6 text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">Bidang Keilmuan</small>
                                    <span class="fs-6">{{ $qualification->bidang_keilmuan ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">IPK/GPA</small>
                                    @if($qualification->ipk)
                                        <span class="badge bg-{{ $qualification->ipk >= 3.5 ? 'success' : ($qualification->ipk >= 3.0 ? 'warning' : 'danger') }} w-fit">
                                            {{ number_format($qualification->ipk, 2) }}
                                        </span>
                                    @else
                                        <span class="fs-6 text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">Tahun Lulus & Status</small>
                                    <div class="d-flex gap-2">
                                        @if($qualification->tahun_lulus)
                                            <span class="fs-6">{{ $qualification->tahun_lulus }}</span>
                                        @endif
                                        @if($qualification->status_kelulusan)
                                            <span class="badge bg-{{ $qualification->status_kelulusan == 'Lulus' ? 'success' : 'warning' }}">
                                                {{ $qualification->status_kelulusan }}
                                            </span>
                                        @endif
                                        @if(!$qualification->tahun_lulus && !$qualification->status_kelulusan)
                                            <span class="fs-6 text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($qualification->riwayat_pendidikan)
                                <div class="col-12">
                                    <div class="d-flex flex-column">
                                        <small class="fw-semibold text-secondary">Riwayat Pendidikan</small>
                                        <span class="fs-6">{{ $qualification->riwayat_pendidikan }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    {{-- Section 3: Jabatan & Karir --}}
                    <div class="mb-4">
                        <h6 class="text-warning mb-3">
                            <i class="fas fa-briefcase me-2"></i>Jabatan & Karir
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">Jabatan/Status</small>
                                    <span class="fs-6">{{ $qualification->jabatan ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column">
                                    <small class="fw-semibold text-secondary">Jabatan Fungsional</small>
                                    @if($qualification->jabatan_fungsional)
                                        <span class="badge bg-info w-fit">{{ $qualification->jabatan_fungsional }}</span>
                                    @else
                                        <span class="fs-6 text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section 4: Sertifikasi --}}
                    @if($qualification->nomor_sertifikat_pendidik || $qualification->tahun_sertifikasi || $qualification->status_sertifikasi)
                        <hr>
                        <div class="mb-4">
                            <h6 class="text-info mb-3">
                                <i class="fas fa-award me-2"></i>Sertifikasi Pendidik
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="d-flex flex-column">
                                        <small class="fw-semibold text-secondary">Nomor Sertifikat</small>
                                        <span class="fs-6">{{ $qualification->nomor_sertifikat_pendidik ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex flex-column">
                                        <small class="fw-semibold text-secondary">Tahun Sertifikasi</small>
                                        <span class="fs-6">{{ $qualification->tahun_sertifikasi ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex flex-column">
                                        <small class="fw-semibold text-secondary">Status Sertifikasi</small>
                                        @if($qualification->status_sertifikasi)
                                            <span class="badge bg-{{ $qualification->status_sertifikasi == 'Sudah' ? 'success' : ($qualification->status_sertifikasi == 'Dalam Proses' ? 'warning' : 'secondary') }} w-fit">
                                                {{ $qualification->status_sertifikasi }}
                                            </span>
                                        @else
                                            <span class="fs-6 text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Section 5: Penelitian --}}
                    @if($qualification->bidang_penelitian_utama || $qualification->h_index || $qualification->publikasi_scopus)
                        <hr>
                        <div class="mb-4">
                            <h6 class="text-secondary mb-3">
                                <i class="fas fa-microscope me-2"></i>Data Penelitian
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column">
                                        <small class="fw-semibold text-secondary">Bidang Penelitian Utama</small>
                                        <span class="fs-6">{{ $qualification->bidang_penelitian_utama ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column">
                                        <small class="fw-semibold text-secondary">H-Index</small>
                                        @if($qualification->h_index !== null)
                                            <span class="badge bg-dark w-fit">{{ $qualification->h_index }}</span>
                                        @else
                                            <span class="fs-6 text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column">
                                        <small class="fw-semibold text-secondary">Publikasi Scopus</small>
                                        @if($qualification->publikasi_scopus !== null)
                                            <span class="badge bg-dark w-fit">{{ $qualification->publikasi_scopus }}</span>
                                        @else
                                            <span class="fs-6 text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.w-fit {
    width: fit-content !important;
}

.badge {
    font-size: 0.75em;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.text-secondary {
    color: #6c757d !important;
}

hr {
    margin: 1.5rem 0;
    opacity: 0.3;
}
</style>
@endsection
