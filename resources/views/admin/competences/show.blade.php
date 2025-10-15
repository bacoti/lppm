@extends('admin.layouts.admin')

@section('title', 'Detail Kompetensi Dosen')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-eye me-2"></i>
                                Detail Kompetensi Dosen
                            </h4>
                            <div class="btn-group">
                                <a href="{{ route('admin.competences.edit', $competence) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-2"></i>Edit
                                </a>
                                <a href="{{ route('admin.competences.index') }}" class="btn btn-light btn-sm">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Dosen -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-secondary">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-user me-2"></i>
                                    Informasi Dosen
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>Nama Lengkap:</strong>
                                        <p class="text-muted mb-0">{{ $competence->dosen->nama_lengkap ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>NIDN/NIP:</strong>
                                        <p class="text-muted mb-0">{{ $competence->dosen->nidn_nip ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Status Sertifikasi:</strong>
                                        @if($competence->status_sertifikasi)
                                            @php
                                                $statusClass = match($competence->status_sertifikasi) {
                                                    'aktif' => 'bg-success',
                                                    'tidak_aktif' => 'bg-danger',
                                                    'proses_perpanjangan' => 'bg-warning text-dark',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <p class="mb-0">
                                                <span class="badge {{ $statusClass }}">
                                                    {{ \App\Models\Competence::getStatusSertifikasiOptions()[$competence->status_sertifikasi] ?? $competence->status_sertifikasi }}
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-muted mb-0">-</p>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Gelar Akademik:</strong>
                                        <p class="text-muted mb-0">{{ $competence->dosen->gelar_akademik ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kompetensi Pedagogik -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-info">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>
                                    Kompetensi Pedagogik
                                </h6>
                                <small class="text-light">Kemampuan mengelola pembelajaran peserta didik</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Metodologi Pengajaran:</strong>
                                        <p class="text-muted mt-1">{{ $competence->metodologi_pengajaran ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Teknik Evaluasi:</strong>
                                        <p class="text-muted mt-1">{{ $competence->teknik_evaluasi ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Manajemen Kelas:</strong>
                                        <p class="text-muted mt-1">{{ $competence->manajemen_kelas ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Teknologi Pembelajaran:</strong>
                                        <p class="text-muted mt-1">{{ $competence->teknologi_pembelajaran ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <strong>Pengembangan Kurikulum:</strong>
                                        <p class="text-muted mt-1">{{ $competence->pengembangan_kurikulum ?: 'Belum diisi' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kompetensi Profesional -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-success">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-briefcase me-2"></i>
                                    Kompetensi Profesional
                                </h6>
                                <small class="text-light">Kemampuan penguasaan materi pembelajaran secara luas dan mendalam</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Keahlian Bidang:</strong>
                                        <p class="text-muted mt-1">{{ $competence->keahlian_bidang ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Penelitian Terapan:</strong>
                                        <p class="text-muted mt-1">{{ $competence->penelitian_terapan ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Publikasi Ilmiah:</strong>
                                        <p class="text-muted mt-1">{{ $competence->publikasi_ilmiah ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Kolaborasi Industri:</strong>
                                        <p class="text-muted mt-1">{{ $competence->kolaborasi_industri ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <strong>Update Pengetahuan:</strong>
                                        <p class="text-muted mt-1">{{ $competence->update_pengetahuan ?: 'Belum diisi' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kompetensi Sosial -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-warning">
                            <div class="card-header bg-warning text-dark">
                                <h6 class="mb-0">
                                    <i class="fas fa-users me-2"></i>
                                    Kompetensi Sosial
                                </h6>
                                <small>Kemampuan berkomunikasi dan bergaul secara efektif</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Komunikasi Efektif:</strong>
                                        <p class="text-muted mt-1">{{ $competence->komunikasi_efektif ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Kerjasama Tim:</strong>
                                        <p class="text-muted mt-1">{{ $competence->kerjasama_tim ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Kepemimpinan:</strong>
                                        <p class="text-muted mt-1">{{ $competence->kepemimpinan ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Adaptasi Budaya:</strong>
                                        <p class="text-muted mt-1">{{ $competence->adaptasi_budaya ?: 'Belum diisi' }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <strong>Etika Profesi:</strong>
                                        <p class="text-muted mt-1">{{ $competence->etika_profesi ?: 'Belum diisi' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sertifikasi dan Kompetensi Formal -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-certificate me-2"></i>
                                    Sertifikasi dan Kompetensi Formal
                                </h6>
                                <small class="text-light">Sertifikasi dan pelatihan formal yang dimiliki</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Sertifikat Pendidik:</strong>
                                        <p class="text-muted mt-1">{{ $competence->sertifikat_pendidik ?: 'Belum ada sertifikat' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Tanggal Sertifikat:</strong>
                                        <p class="text-muted mt-1">
                                            {{ $competence->tanggal_sertifikat ? $competence->tanggal_sertifikat->format('d F Y') : 'Belum diisi' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Sertifikasi Lain:</strong>
                                        <p class="text-muted mt-1">{{ $competence->sertifikasi_lain ?: 'Belum ada sertifikasi lain' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Pelatihan Kompetensi:</strong>
                                        <p class="text-muted mt-1">{{ $competence->pelatihan_kompetensi ?: 'Belum mengikuti pelatihan' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Card -->
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h6 class="text-muted mb-3">Ringkasan Kompetensi</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="fw-bold text-info">Pedagogik</div>
                                        <small>{{ collect(['metodologi_pengajaran', 'teknik_evaluasi', 'manajemen_kelas', 'teknologi_pembelajaran', 'pengembangan_kurikulum'])->filter(fn($field) => !empty($competence->$field))->count() }}/5 Diisi</small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="fw-bold text-success">Profesional</div>
                                        <small>{{ collect(['keahlian_bidang', 'penelitian_terapan', 'publikasi_ilmiah', 'kolaborasi_industri', 'update_pengetahuan'])->filter(fn($field) => !empty($competence->$field))->count() }}/5 Diisi</small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="fw-bold text-warning">Sosial</div>
                                        <small>{{ collect(['komunikasi_efektif', 'kerjasama_tim', 'kepemimpinan', 'adaptasi_budaya', 'etika_profesi'])->filter(fn($field) => !empty($competence->$field))->count() }}/5 Diisi</small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="fw-bold text-danger">Sertifikasi</div>
                                        <small>{{ collect(['sertifikat_pendidik', 'tanggal_sertifikat', 'sertifikasi_lain', 'pelatihan_kompetensi'])->filter(fn($field) => !empty($competence->$field))->count() }}/4 Diisi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .card {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .card-header h6 {
        font-weight: 600;
    }
    
    .card-header small {
        font-style: italic;
    }
    
    .text-muted {
        line-height: 1.5;
        word-wrap: break-word;
    }
    
    .badge {
        font-size: 0.8em;
        padding: 0.375rem 0.75rem;
    }
    
    strong {
        color: #495057;
        font-weight: 600;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add print functionality
        const printBtn = document.createElement('button');
        printBtn.className = 'btn btn-outline-secondary btn-sm ms-2';
        printBtn.innerHTML = '<i class="fas fa-print me-2"></i>Print';
        printBtn.onclick = function() {
            window.print();
        };
        
        const headerBtnGroup = document.querySelector('.btn-group');
        if (headerBtnGroup) {
            headerBtnGroup.appendChild(printBtn);
        }
        
        // Smooth scroll to sections
        const cards = document.querySelectorAll('.card');
        cards.forEach(function(card, index) {
            card.addEventListener('click', function(e) {
                if (e.target.closest('.btn')) return; // Don't trigger on button clicks
                
                // Add subtle highlight effect
                card.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    card.style.transform = 'translateY(-2px)';
                }, 200);
            });
        });
    });
</script>
@endpush
