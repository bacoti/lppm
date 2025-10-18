@extends('admin.layouts.admin')

@section('title', 'Tambah HAKI')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark font-weight-bold">
                    <i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah HAKI
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.haki.index') }}">HAKI</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container-fluid">
    <form action="{{ route('admin.haki.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

                <!-- Informasi Dasar -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle mr-2 text-primary"></i>Informasi Dasar
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="judul" class="form-label fw-bold">
                                        Judul HAKI <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="judul" id="judul"
                                           class="form-control @error('judul') is-invalid @enderror"
                                           value="{{ old('judul') }}"
                                           placeholder="Masukkan judul HAKI" required>
                                    @error('judul')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="jenis_haki" class="form-label fw-bold">
                                        Jenis HAKI <span class="text-danger">*</span>
                                    </label>
                                    <select name="jenis_haki" id="jenis_haki"
                                            class="form-control select2 @error('jenis_haki') is-invalid @enderror" required>
                                        <option value="">Pilih Jenis HAKI</option>
                                        @foreach($jenisHakiOptions as $key => $label)
                                            <option value="{{ $key }}" {{ old('jenis_haki') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_haki')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label fw-bold">
                                        Status <span class="text-danger">*</span>
                                    </label>
                                    <select name="status" id="status"
                                            class="form-control select2 @error('status') is-invalid @enderror" required>
                                        @foreach($statusOptions as $key => $label)
                                            <option value="{{ $key }}" {{ old('status', 'draft') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Masukkan deskripsi HAKI">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pemegang_paten" class="form-label fw-bold">Pemegang Paten</label>
                            <input type="text" name="pemegang_paten" id="pemegang_paten"
                                   class="form-control @error('pemegang_paten') is-invalid @enderror"
                                   value="{{ old('pemegang_paten') }}"
                                   placeholder="Masukkan nama pemegang paten">
                            @error('pemegang_paten')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bidang_teknologi" class="form-label fw-bold">Bidang Teknologi</label>
                                    <input type="text" name="bidang_teknologi" id="bidang_teknologi"
                                           class="form-control @error('bidang_teknologi') is-invalid @enderror"
                                           value="{{ old('bidang_teknologi') }}"
                                           placeholder="Contoh: Teknologi Informasi, Teknik Sipil">
                                    @error('bidang_teknologi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="klasifikasi" class="form-label fw-bold">
                                        Klasifikasi (IPC untuk Paten)
                                    </label>
                                    <input type="text" name="klasifikasi" id="klasifikasi"
                                           class="form-control @error('klasifikasi') is-invalid @enderror"
                                           value="{{ old('klasifikasi') }}"
                                           placeholder="Contoh: G06F 17/30">
                                    @error('klasifikasi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inventor/Pencipta -->
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-users mr-2 text-success"></i>Inventor/Pencipta
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-info"></i> Informasi!</h5>
                            Tambahkan semua inventor/pencipta yang terlibat dalam karya ini. Minimal satu inventor diperlukan.
                        </div>
                        <div id="inventor-container">
                            <div class="inventor-row mb-3">
                                <label class="form-label fw-bold">Inventor/Pencipta 1 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="inventor[]"
                                           class="form-control @error('inventor.0') is-invalid @enderror"
                                           placeholder="Masukkan nama lengkap inventor/pencipta"
                                           value="{{ old('inventor.0') }}" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success add-inventor" title="Tambah Inventor">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('inventor.0')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        @error('inventor')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Informasi Pendaftaran -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file-alt mr-2 text-info"></i>Informasi Pendaftaran
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="nomor_permohonan" class="form-label fw-bold">Nomor Permohonan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" name="nomor_permohonan" id="nomor_permohonan"
                                               class="form-control @error('nomor_permohonan') is-invalid @enderror"
                                               value="{{ old('nomor_permohonan') }}"
                                               placeholder="Contoh: P00202100123">
                                    </div>
                                    @error('nomor_permohonan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="tahun_permohonan" class="form-label fw-bold">Tahun Permohonan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="number" name="tahun_permohonan" id="tahun_permohonan"
                                               class="form-control @error('tahun_permohonan') is-invalid @enderror"
                                               value="{{ old('tahun_permohonan') }}"
                                               placeholder="2024" min="2000" max="{{ date('Y') + 1 }}">
                                    </div>
                                    @error('tahun_permohonan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="nomor_pendaftaran" class="form-label fw-bold">Nomor Pendaftaran</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" name="nomor_pendaftaran" id="nomor_pendaftaran"
                                               class="form-control @error('nomor_pendaftaran') is-invalid @enderror"
                                               value="{{ old('nomor_pendaftaran') }}"
                                               placeholder="Contoh: P00202100123">
                                    </div>
                                    @error('nomor_pendaftaran')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="nomor_publikasi" class="form-label fw-bold">Nomor Publikasi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" name="nomor_publikasi" id="nomor_publikasi"
                                               class="form-control @error('nomor_publikasi') is-invalid @enderror"
                                               value="{{ old('nomor_publikasi') }}"
                                               placeholder="Contoh: ID0000012345">
                                    </div>
                                    @error('nomor_publikasi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_daftar" class="form-label fw-bold">Tanggal Daftar</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="tanggal_daftar" id="tanggal_daftar"
                                               class="form-control @error('tanggal_daftar') is-invalid @enderror"
                                               value="{{ old('tanggal_daftar') }}">
                                    </div>
                                    @error('tanggal_daftar')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_publikasi" class="form-label fw-bold">Tanggal Publikasi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="tanggal_publikasi" id="tanggal_publikasi"
                                               class="form-control @error('tanggal_publikasi') is-invalid @enderror"
                                               value="{{ old('tanggal_publikasi') }}">
                                    </div>
                                    @error('tanggal_publikasi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_penerimaan" class="form-label fw-bold">Tanggal Penerimaan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                        </div>
                                        <input type="date" name="tanggal_penerimaan" id="tanggal_penerimaan"
                                               class="form-control @error('tanggal_penerimaan') is-invalid @enderror"
                                               value="{{ old('tanggal_penerimaan') }}">
                                    </div>
                                    @error('tanggal_penerimaan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label for="kantor_kekayaan_intelektual" class="form-label fw-bold">Kantor KI</label>
                                    <input type="text" name="kantor_kekayaan_intelektual" id="kantor_kekayaan_intelektual"
                                           class="form-control @error('kantor_kekayaan_intelektual') is-invalid @enderror"
                                           value="{{ old('kantor_kekayaan_intelektual', 'DJKI Indonesia') }}"
                                           placeholder="DJKI Indonesia">
                                    @error('kantor_kekayaan_intelektual')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_berlaku_mulai" class="form-label fw-bold">Tanggal Berlaku Mulai</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                        </div>
                                        <input type="date" name="tanggal_berlaku_mulai" id="tanggal_berlaku_mulai"
                                               class="form-control @error('tanggal_berlaku_mulai') is-invalid @enderror"
                                               value="{{ old('tanggal_berlaku_mulai') }}">
                                    </div>
                                    @error('tanggal_berlaku_mulai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_berlaku_selesai" class="form-label fw-bold">Tanggal Berlaku Selesai</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                                        </div>
                                        <input type="date" name="tanggal_berlaku_selesai" id="tanggal_berlaku_selesai"
                                               class="form-control @error('tanggal_berlaku_selesai') is-invalid @enderror"
                                               value="{{ old('tanggal_berlaku_selesai') }}">
                                    </div>
                                    @error('tanggal_berlaku_selesai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">&nbsp;</label>
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="diperpanjang" id="diperpanjang"
                                               value="1" {{ old('diperpanjang') ? 'checked' : '' }}>
                                        <label for="diperpanjang" class="font-weight-normal">
                                            <i class="fas fa-redo mr-1"></i>Diperpanjang
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- File Upload -->
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file-upload mr-2 text-warning"></i>File Upload
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_dokumen" class="form-label fw-bold">File Dokumen</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file_dokumen" id="file_dokumen"
                                                   class="custom-file-input @error('file_dokumen') is-invalid @enderror"
                                                   accept=".pdf,.doc,.docx">
                                            <label class="custom-file-label" for="file_dokumen">Pilih file dokumen...</label>
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>Format: PDF, DOC, DOCX (Max: 10MB)
                                    </small>
                                    @error('file_dokumen')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_sertifikat" class="form-label fw-bold">File Sertifikat</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file_sertifikat" id="file_sertifikat"
                                                   class="custom-file-input @error('file_sertifikat') is-invalid @enderror"
                                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                            <label class="custom-file-label" for="file_sertifikat">Pilih file sertifikat...</label>
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>Format: PDF, DOC, DOCX, JPG, PNG (Max: 10MB)
                                    </small>
                                    @error('file_sertifikat')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="catatan" class="form-label fw-bold">Catatan</label>
                            <textarea name="catatan" id="catatan" rows="3"
                                      class="form-control @error('catatan') is-invalid @enderror"
                                      placeholder="Tambahkan catatan atau keterangan tambahan jika diperlukan">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="card">
                    <div class="card-footer bg-light">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('admin.haki.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-times mr-2"></i>Batal
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-save mr-2"></i>Simpan Data HAKI
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<style>
.card {
    margin-bottom: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border: none;
    border-radius: 8px;
}

.card-outline.card-primary {
    border-top: 3px solid #007bff;
}

.card-outline.card-success {
    border-top: 3px solid #28a745;
}

.card-outline.card-info {
    border-top: 3px solid #17a2b8;
}

.card-outline.card-warning {
    border-top: 3px solid #ffc107;
}

.card-header {
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    border-bottom: 1px solid #dee2e6;
    border-radius: 8px 8px 0 0 !important;
}

.card-title {
    font-weight: 600;
    font-size: 1.1rem;
}

.form-label.fw-bold {
    font-weight: 600 !important;
    color: #495057;
    margin-bottom: 8px;
}

.form-control {
    border-radius: 6px;
    border: 1px solid #ced4da;
    padding: 10px 12px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.input-group-text {
    background-color: #e9ecef;
    border-color: #ced4da;
    color: #6c757d;
}

.btn {
    border-radius: 6px;
    font-weight: 500;
    padding: 8px 16px;
    transition: all 0.3s ease;
}

.btn-lg {
    padding: 12px 24px;
    font-size: 1.1rem;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.custom-file-label {
    border-radius: 6px;
    border: 1px solid #ced4da;
    padding: 10px 12px;
}

.custom-file-label::after {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
    border-radius: 0 6px 6px 0;
}

.alert {
    border-radius: 6px;
    border: none;
}

.alert-info {
    background-color: #d1ecf1;
    color: #0c5460;
}

.inventor-row {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 6px;
    border: 1px solid #e9ecef;
    margin-bottom: 15px;
}

.card-footer.bg-light {
    background-color: #f8f9fa !important;
    border-top: 1px solid #dee2e6;
    border-radius: 0 0 8px 8px !important;
    padding: 20px;
}

.text-danger {
    color: #dc3545 !important;
    font-weight: 500;
}

.invalid-feedback {
    display: block;
    font-size: 0.875rem;
    color: #dc3545;
    margin-top: 5px;
}

.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 15px;
    }

    .btn-lg {
        width: 100%;
        margin-bottom: 10px;
    }

    .text-right {
        text-align: left !important;
    }

    .inventor-row {
        padding: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }
}

/* Animation for smooth interactions */
.card {
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

/* Custom scrollbar for better UX */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Handle inventor add/remove
    let inventorCount = 1;

    $(document).on('click', '.add-inventor', function() {
        inventorCount++;
        const inventorRow = `
            <div class="inventor-row mb-3">
                <label class="form-label fw-bold">Inventor/Pencipta ${inventorCount}</label>
                <div class="input-group">
                    <input type="text" name="inventor[]" class="form-control"
                           placeholder="Masukkan nama lengkap inventor/pencipta" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-inventor" title="Hapus Inventor">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        $('#inventor-container').append(inventorRow);

        // Update numbering
        updateInventorLabels();
    });

    $(document).on('click', '.remove-inventor', function() {
        $(this).closest('.inventor-row').remove();
        inventorCount--;
        updateInventorLabels();
    });

    // Update inventor labels numbering
    function updateInventorLabels() {
        $('#inventor-container .inventor-row').each(function(index) {
            $(this).find('label').text(`Inventor/Pencipta ${index + 1}${index === 0 ? ' *' : ''}`);
        });
    }

    // Custom file input labels
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        if (fileName.length > 30) {
            fileName = fileName.substring(0, 30) + '...';
        }
        $(this).next('.custom-file-label').html(fileName);
    });

    // Form validation enhancement
    $('form').on('submit', function(e) {
        let hasError = false;

        // Check required fields
        $(this).find('input[required], select[required], textarea[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                hasError = true;
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (hasError) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Form Tidak Lengkap',
                text: 'Harap lengkapi semua field yang wajib diisi.',
                showConfirmButton: true
            });

            // Scroll to first error
            $('html, body').animate({
                scrollTop: $('.is-invalid').first().offset().top - 100
            }, 500);
        }
    });

    // Remove validation error on input
    $('input, select, textarea').on('input change', function() {
        if ($(this).val()) {
            $(this).removeClass('is-invalid');
        }
    });

    // Auto-resize textarea
    $('textarea').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Show loading on form submit
    $('form').on('submit', function() {
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...');
    });
});
</script>
@endpush
