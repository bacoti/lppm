@extends('admin.layouts.admin')

@section('title', 'Edit HAKI')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit HAKI</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.haki.index') }}">HAKI</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.haki.update', $haki) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Informasi Dasar -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle mr-2"></i>Informasi Dasar
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul">Judul HAKI <span class="text-danger">*</span></label>
                                    <input type="text" name="judul" id="judul" 
                                           class="form-control @error('judul') is-invalid @enderror" 
                                           value="{{ old('judul', $haki->judul) }}" required>
                                    @error('judul')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jenis_haki">Jenis HAKI <span class="text-danger">*</span></label>
                                    <select name="jenis_haki" id="jenis_haki" 
                                            class="form-control @error('jenis_haki') is-invalid @enderror" required>
                                        <option value="">Pilih Jenis HAKI</option>
                                        @foreach($jenisHakiOptions as $key => $label)
                                            <option value="{{ $key }}" {{ old('jenis_haki', $haki->jenis_haki) == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_haki')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" 
                                            class="form-control @error('status') is-invalid @enderror" required>
                                        @foreach($statusOptions as $key => $label)
                                            <option value="{{ $key }}" {{ old('status', $haki->status) == $key ? 'selected' : '' }}>
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
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" 
                                      class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $haki->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pemegang_paten">Pemegang Paten</label>
                            <input type="text" name="pemegang_paten" id="pemegang_paten"
                                   class="form-control @error('pemegang_paten') is-invalid @enderror"
                                   value="{{ old('pemegang_paten', $haki->pemegang_paten) }}">
                            @error('pemegang_paten')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bidang_teknologi">Bidang Teknologi</label>
                                    <input type="text" name="bidang_teknologi" id="bidang_teknologi" 
                                           class="form-control @error('bidang_teknologi') is-invalid @enderror" 
                                           value="{{ old('bidang_teknologi', $haki->bidang_teknologi) }}">
                                    @error('bidang_teknologi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="klasifikasi">Klasifikasi (IPC untuk Paten)</label>
                                    <input type="text" name="klasifikasi" id="klasifikasi" 
                                           class="form-control @error('klasifikasi') is-invalid @enderror" 
                                           value="{{ old('klasifikasi', $haki->klasifikasi) }}">
                                    @error('klasifikasi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inventor/Pencipta -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-users mr-2"></i>Inventor/Pencipta
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="inventor-container">
                            @if(old('inventor', $haki->inventor))
                                @foreach(old('inventor', $haki->inventor) as $index => $inventor)
                                <div class="inventor-row mb-2">
                                    <div class="input-group">
                                        <input type="text" name="inventor[]" 
                                               class="form-control @error('inventor.'.$index) is-invalid @enderror" 
                                               placeholder="Nama inventor/pencipta" 
                                               value="{{ $inventor }}" required>
                                        <div class="input-group-append">
                                            @if($index == 0)
                                            <button type="button" class="btn btn-success add-inventor">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-danger remove-inventor">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                    @error('inventor.'.$index)
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @endforeach
                            @else
                                <div class="inventor-row mb-2">
                                    <div class="input-group">
                                        <input type="text" name="inventor[]" 
                                               class="form-control" 
                                               placeholder="Nama inventor/pencipta" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-success add-inventor">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @error('inventor')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Informasi Pendaftaran -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file-alt mr-2"></i>Informasi Pendaftaran
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nomor_permohonan">Nomor Permohonan</label>
                                    <input type="text" name="nomor_permohonan" id="nomor_permohonan"
                                           class="form-control @error('nomor_permohonan') is-invalid @enderror"
                                           value="{{ old('nomor_permohonan', $haki->nomor_permohonan) }}">
                                    @error('nomor_permohonan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tahun_permohonan">Tahun Permohonan</label>
                                    <input type="number" name="tahun_permohonan" id="tahun_permohonan"
                                           class="form-control @error('tahun_permohonan') is-invalid @enderror"
                                           value="{{ old('tahun_permohonan', $haki->tahun_permohonan) }}"
                                           min="2000" max="{{ date('Y') + 1 }}">
                                    @error('tahun_permohonan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nomor_pendaftaran">Nomor Pendaftaran</label>
                                    <input type="text" name="nomor_pendaftaran" id="nomor_pendaftaran"
                                           class="form-control @error('nomor_pendaftaran') is-invalid @enderror"
                                           value="{{ old('nomor_pendaftaran', $haki->nomor_pendaftaran) }}">
                                    @error('nomor_pendaftaran')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nomor_publikasi">Nomor Publikasi</label>
                                    <input type="text" name="nomor_publikasi" id="nomor_publikasi"
                                           class="form-control @error('nomor_publikasi') is-invalid @enderror"
                                           value="{{ old('nomor_publikasi', $haki->nomor_publikasi) }}">
                                    @error('nomor_publikasi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tanggal_daftar">Tanggal Daftar</label>
                                    <input type="date" name="tanggal_daftar" id="tanggal_daftar" 
                                           class="form-control @error('tanggal_daftar') is-invalid @enderror" 
                                           value="{{ old('tanggal_daftar', $haki->tanggal_daftar?->format('Y-m-d')) }}">
                                    @error('tanggal_daftar')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tanggal_publikasi">Tanggal Publikasi</label>
                                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi"
                                           class="form-control @error('tanggal_publikasi') is-invalid @enderror"
                                           value="{{ old('tanggal_publikasi', $haki->tanggal_publikasi?->format('Y-m-d')) }}">
                                    @error('tanggal_publikasi')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tanggal_penerimaan">Tanggal Penerimaan</label>
                                    <input type="date" name="tanggal_penerimaan" id="tanggal_penerimaan"
                                           class="form-control @error('tanggal_penerimaan') is-invalid @enderror"
                                           value="{{ old('tanggal_penerimaan', $haki->tanggal_penerimaan?->format('Y-m-d')) }}">
                                    @error('tanggal_penerimaan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kantor_kekayaan_intelektual">Kantor KI</label>
                                    <input type="text" name="kantor_kekayaan_intelektual" id="kantor_kekayaan_intelektual" 
                                           class="form-control @error('kantor_kekayaan_intelektual') is-invalid @enderror" 
                                           value="{{ old('kantor_kekayaan_intelektual', $haki->kantor_kekayaan_intelektual) }}">
                                    @error('kantor_kekayaan_intelektual')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal_berlaku_mulai">Tanggal Berlaku Mulai</label>
                                    <input type="date" name="tanggal_berlaku_mulai" id="tanggal_berlaku_mulai" 
                                           class="form-control @error('tanggal_berlaku_mulai') is-invalid @enderror" 
                                           value="{{ old('tanggal_berlaku_mulai', $haki->tanggal_berlaku_mulai?->format('Y-m-d')) }}">
                                    @error('tanggal_berlaku_mulai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal_berlaku_selesai">Tanggal Berlaku Selesai</label>
                                    <input type="date" name="tanggal_berlaku_selesai" id="tanggal_berlaku_selesai" 
                                           class="form-control @error('tanggal_berlaku_selesai') is-invalid @enderror" 
                                           value="{{ old('tanggal_berlaku_selesai', $haki->tanggal_berlaku_selesai?->format('Y-m-d')) }}">
                                    @error('tanggal_berlaku_selesai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check" style="margin-top: 32px;">
                                        <input type="checkbox" name="diperpanjang" id="diperpanjang" 
                                               class="form-check-input" value="1" 
                                               {{ old('diperpanjang', $haki->diperpanjang) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="diperpanjang">
                                            Diperpanjang
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- File Upload -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file-upload mr-2"></i>File Upload
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_dokumen">File Dokumen</label>
                                    @if($haki->file_dokumen)
                                        <div class="mb-2">
                                            <small class="text-success">
                                                <i class="fas fa-file mr-1"></i>
                                                File saat ini: <a href="{{ Storage::url($haki->file_dokumen) }}" target="_blank">Lihat file</a>
                                            </small>
                                        </div>
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" name="file_dokumen" id="file_dokumen" 
                                               class="custom-file-input @error('file_dokumen') is-invalid @enderror"
                                               accept=".pdf,.doc,.docx">
                                        <label class="custom-file-label" for="file_dokumen">Pilih file baru...</label>
                                    </div>
                                    <small class="text-muted">Format: PDF, DOC, DOCX (Max: 10MB)</small>
                                    @error('file_dokumen')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_sertifikat">File Sertifikat</label>
                                    @if($haki->file_sertifikat)
                                        <div class="mb-2">
                                            <small class="text-success">
                                                <i class="fas fa-file mr-1"></i>
                                                File saat ini: <a href="{{ Storage::url($haki->file_sertifikat) }}" target="_blank">Lihat file</a>
                                            </small>
                                        </div>
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" name="file_sertifikat" id="file_sertifikat" 
                                               class="custom-file-input @error('file_sertifikat') is-invalid @enderror"
                                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                        <label class="custom-file-label" for="file_sertifikat">Pilih file baru...</label>
                                    </div>
                                    <small class="text-muted">Format: PDF, DOC, DOCX, JPG, PNG (Max: 10MB)</small>
                                    @error('file_sertifikat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea name="catatan" id="catatan" rows="3" 
                                      class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan', $haki->catatan) }}</textarea>
                            @error('catatan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="card">
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.haki.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i>Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Handle inventor add/remove
    let inventorCount = {{ count(old('inventor', $haki->inventor)) }};
    
    $(document).on('click', '.add-inventor', function() {
        inventorCount++;
        const inventorRow = `
            <div class="inventor-row mb-2">
                <div class="input-group">
                    <input type="text" name="inventor[]" class="form-control" 
                           placeholder="Nama inventor/pencipta" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-inventor">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        $('#inventor-container').append(inventorRow);
    });
    
    $(document).on('click', '.remove-inventor', function() {
        $(this).closest('.inventor-row').remove();
        inventorCount--;
    });

    // Custom file input labels
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });
});
</script>
@endpush