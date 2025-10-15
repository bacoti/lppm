@extends('admin.layouts.admin')

@section('title', 'Detail HAKI')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail HAKI</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.haki.index') }}">HAKI</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Header Actions -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge badge-lg {{ $haki->getStatusBadgeClass() }}">
                                <i class="fas fa-circle mr-1"></i>{{ $haki->getStatusLabel() }}
                            </span>
                        </div>
                        <div>
                            <a href="{{ route('admin.haki.edit', $haki) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <a href="{{ route('admin.haki.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Dasar -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2 text-primary"></i>Informasi Dasar
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="text-primary mb-3">{{ $haki->judul }}</h4>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Jenis HAKI:</strong><br>
                                    <span class="text-muted">{{ $haki->getJenisHakiLabel() }}</span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Bidang Teknologi:</strong><br>
                                    <span class="text-muted">{{ $haki->bidang_teknologi ?? '-' }}</span>
                                </div>
                            </div>

                            @if($haki->deskripsi)
                            <div class="mb-3">
                                <strong>Deskripsi:</strong><br>
                                <p class="text-muted">{{ $haki->deskripsi }}</p>
                            </div>
                            @endif

                            @if($haki->klasifikasi)
                            <div class="mb-3">
                                <strong>Klasifikasi (IPC):</strong><br>
                                <span class="badge badge-secondary">{{ $haki->klasifikasi }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            <div class="info-box bg-gradient-primary">
                                <span class="info-box-icon"><i class="fas fa-lightbulb"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Jenis HAKI</span>
                                    <span class="info-box-number">{{ $haki->getJenisHakiLabel() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventor/Pencipta -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users mr-2 text-success"></i>Inventor/Pencipta
                    </h3>
                </div>
                <div class="card-body">
                    @if($haki->inventor && count($haki->inventor) > 0)
                        <div class="row">
                            @foreach($haki->inventor as $index => $inventor)
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="rounded-circle bg-success d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <span class="text-white font-weight-bold">{{ $index + 1 }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>{{ $inventor }}</strong>
                                        @if($index == 0)
                                            <br><small class="text-muted">Inventor Utama</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Tidak ada data inventor.</p>
                    @endif
                </div>
            </div>

            <!-- Informasi Pendaftaran -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-alt mr-2 text-warning"></i>Informasi Pendaftaran
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-hashtag"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Nomor Pendaftaran</span>
                                    <span class="info-box-number">{{ $haki->nomor_pendaftaran ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-newspaper"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Nomor Publikasi</span>
                                    <span class="info-box-number">{{ $haki->nomor_publikasi ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-certificate"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Nomor Sertifikat</span>
                                    <span class="info-box-number">{{ $haki->nomor_sertifikat ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Tanggal Daftar:</strong></td>
                                    <td>{{ $haki->tanggal_daftar?->format('d/m/Y') ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Publikasi:</strong></td>
                                    <td>{{ $haki->tanggal_publikasi?->format('d/m/Y') ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Granted:</strong></td>
                                    <td>{{ $haki->tanggal_granted?->format('d/m/Y') ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Berlaku Mulai:</strong></td>
                                    <td>{{ $haki->tanggal_berlaku_mulai?->format('d/m/Y') ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Berlaku Selesai:</strong></td>
                                    <td>{{ $haki->tanggal_berlaku_selesai?->format('d/m/Y') ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Perpanjangan:</strong></td>
                                    <td>
                                        @if($haki->diperpanjang)
                                            <span class="badge badge-success">Diperpanjang</span>
                                        @else
                                            <span class="badge badge-secondary">Tidak</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($haki->kantor_kekayaan_intelektual)
                    <div class="mt-3">
                        <strong>Kantor Kekayaan Intelektual:</strong>
                        <span class="badge badge-info ml-2">{{ $haki->kantor_kekayaan_intelektual }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- File dan Dokumen -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-download mr-2 text-danger"></i>File dan Dokumen
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border rounded p-3 text-center">
                                <h5>File Dokumen</h5>
                                @if($haki->file_dokumen)
                                    <div class="mb-2">
                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                    </div>
                                    <a href="{{ Storage::url($haki->file_dokumen) }}" 
                                       class="btn btn-outline-primary btn-sm" target="_blank">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </a>
                                @else
                                    <div class="text-muted">
                                        <i class="fas fa-file-times fa-3x"></i>
                                        <p class="mt-2">Tidak ada file</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 text-center">
                                <h5>File Sertifikat</h5>
                                @if($haki->file_sertifikat)
                                    <div class="mb-2">
                                        <i class="fas fa-certificate fa-3x text-success"></i>
                                    </div>
                                    <a href="{{ Storage::url($haki->file_sertifikat) }}" 
                                       class="btn btn-outline-success btn-sm" target="_blank">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </a>
                                @else
                                    <div class="text-muted">
                                        <i class="fas fa-file-times fa-3x"></i>
                                        <p class="mt-2">Tidak ada file</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($haki->catatan)
                    <div class="mt-4">
                        <div class="alert alert-info">
                            <h5><i class="fas fa-sticky-note mr-2"></i>Catatan</h5>
                            <p class="mb-0">{{ $haki->catatan }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Informasi Sistem -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info mr-2 text-secondary"></i>Informasi Sistem
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Dibuat:</strong></td>
                                    <td>{{ $haki->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir diubah:</strong></td>
                                    <td>{{ $haki->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>ID HAKI:</strong></td>
                                    <td><code>#{{ $haki->id }}</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Slug:</strong></td>
                                    <td><code>{{ $haki->slug }}</code></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('admin.haki.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i>Kembali ke Daftar
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('admin.haki.edit', $haki) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-1"></i>Edit HAKI
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus HAKI ini?</p>
                <div class="alert alert-warning">
                    <strong>{{ $haki->judul }}</strong><br>
                    <small>Jenis: {{ $haki->getJenisHakiLabel() }}</small>
                </div>
                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('admin.haki.destroy', $haki) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash mr-1"></i>Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.badge-lg {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

.info-box {
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    border-radius: .25rem;
    background: #fff;
    display: flex;
    margin-bottom: 1rem;
    min-height: 80px;
    padding: .5rem;
    position: relative;
    width: 100%;
}

.info-box .info-box-icon {
    border-radius: .25rem;
    align-items: center;
    display: flex;
    font-size: 1.875rem;
    justify-content: center;
    text-align: center;
    width: 70px;
}

.info-box .info-box-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    line-height: 1.8;
    margin-left: .5rem;
    padding: 0 10px;
}
</style>
@endpush