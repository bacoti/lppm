@extends('admin.layouts.admin')

@section('title', 'Tambah Jurnal')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark font-weight-bold">
                    <i class="fas fa-plus-circle mr-2 text-success"></i>Tambah Jurnal
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jurnal.index') }}">Jurnal</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container-fluid">
    <form action="{{ route('admin.jurnal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Basic Information Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>Informasi Dasar
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="judul" class="required">Judul Artikel</label>
                            <textarea name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" 
                                      rows="3" placeholder="Masukkan judul artikel jurnal">{{ old('judul') }}</textarea>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_jurnal" class="required">Nama Jurnal</label>
                            <input type="text" name="nama_jurnal" id="nama_jurnal" 
                                   class="form-control @error('nama_jurnal') is-invalid @enderror"
                                   placeholder="Nama jurnal/publikasi" value="{{ old('nama_jurnal') }}">
                            @error('nama_jurnal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" 
                                   class="form-control @error('penerbit') is-invalid @enderror"
                                   placeholder="Nama penerbit jurnal" value="{{ old('penerbit') }}">
                            @error('penerbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jenis_jurnal" class="required">Jenis Jurnal</label>
                            <select name="jenis_jurnal" id="jenis_jurnal" class="form-control @error('jenis_jurnal') is-invalid @enderror">
                                <option value="">Pilih Jenis</option>
                                @foreach(\App\Models\Jurnal::getJenisJurnalOptions() as $key => $label)
                                    <option value="{{ $key }}" {{ old('jenis_jurnal') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_jurnal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status" class="required">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="">Pilih Status</option>
                                @foreach(\App\Models\Jurnal::getStatusOptions() as $key => $label)
                                    <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="akreditasi">Akreditasi</label>
                            <select name="akreditasi" id="akreditasi" class="form-control @error('akreditasi') is-invalid @enderror">
                                <option value="">Pilih Akreditasi</option>
                                @foreach(\App\Models\Jurnal::getAkreditasiOptions() as $key => $label)
                                    <option value="{{ $key }}" {{ old('akreditasi') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('akreditasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tahun" class="required">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror">
                                <option value="">Pilih Tahun</option>
                                @for($year = date('Y'); $year >= 2000; $year--)
                                    <option value="{{ $year }}" {{ old('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            @error('tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Authors and Publication Details Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>Penulis & Detail Publikasi
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <div id="penulis-container">
                                <div class="input-group mb-2 penulis-item">
                                    <input type="text" name="penulis[]" class="form-control" placeholder="Nama penulis">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger remove-penulis" type="button">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-success" id="add-penulis">
                                <i class="fas fa-plus mr-1"></i>Tambah Penulis
                            </button>
                            @error('penulis')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="volume">Volume</label>
                            <input type="text" name="volume" id="volume" 
                                   class="form-control @error('volume') is-invalid @enderror"
                                   placeholder="Volume jurnal" value="{{ old('volume') }}">
                            @error('volume')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nomor">Nomor</label>
                            <input type="text" name="nomor" id="nomor" 
                                   class="form-control @error('nomor') is-invalid @enderror"
                                   placeholder="Nomor jurnal" value="{{ old('nomor') }}">
                            @error('nomor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="halaman">Halaman</label>
                        <input type="text" name="halaman" id="halaman" 
                               class="form-control @error('halaman') is-invalid @enderror"
                               placeholder="mis: 1-10" value="{{ old('halaman') }}">
                        @error('halaman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="issn">ISSN</label>
                            <input type="text" name="issn" id="issn" 
                                   class="form-control @error('issn') is-invalid @enderror"
                                   placeholder="mis: 1234-5678" value="{{ old('issn') }}">
                            @error('issn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Additional Information Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-link mr-2"></i>Informasi Tambahan
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="doi">DOI</label>
                            <input type="text" name="doi" id="doi" 
                                   class="form-control @error('doi') is-invalid @enderror"
                                   placeholder="Digital Object Identifier" value="{{ old('doi') }}">
                            @error('doi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="url" name="url" id="url" 
                                   class="form-control @error('url') is-invalid @enderror"
                                   placeholder="Link ke artikel jurnal" value="{{ old('url') }}">
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="abstrak">Abstrak</label>
                            <textarea name="abstrak" id="abstrak" class="form-control @error('abstrak') is-invalid @enderror" 
                                      rows="5" placeholder="Abstrak artikel jurnal">{{ old('abstrak') }}</textarea>
                            @error('abstrak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kata_kunci">Kata Kunci</label>
                            <input type="text" name="kata_kunci" id="kata_kunci" 
                                   class="form-control @error('kata_kunci') is-invalid @enderror"
                                   placeholder="Pisahkan dengan koma (,)" value="{{ old('kata_kunci') }}">
                            <small class="form-text text-muted">Pisahkan setiap kata kunci dengan koma (,)</small>
                            @error('kata_kunci')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Files and Settings Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file mr-2"></i>File & Pengaturan
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file_pdf">File Jurnal (PDF)</label>
                            <div class="custom-file">
                                <input type="file" name="file_pdf" id="file_pdf" 
                                       class="custom-file-input @error('file_pdf') is-invalid @enderror"
                                       accept=".pdf">
                                <label class="custom-file-label" for="file_pdf">Pilih file PDF...</label>
                            </div>
                            <small class="form-text text-muted">Format: PDF, Maksimal: 10MB</small>
                            @error('file_pdf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cover_image">Gambar Cover</label>
                            <div class="custom-file">
                                <input type="file" name="cover_image" id="cover_image" 
                                       class="custom-file-input @error('cover_image') is-invalid @enderror"
                                       accept="image/*">
                                <label class="custom-file-label" for="cover_image">Pilih gambar...</label>
                            </div>
                            <small class="form-text text-muted">Format: JPG, PNG, maksimal 2MB</small>
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="is_featured" 
                                       name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label for="is_featured" class="custom-control-label">
                                    <strong>Tandai sebagai Featured</strong>
                                    <small class="text-muted d-block">Jurnal akan ditampilkan di halaman utama</small>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="card">
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('admin.jurnal.index') }}" class="btn btn-secondary mr-2">
                            <i class="fas fa-arrow-left mr-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save mr-1"></i>Simpan Jurnal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Custom file input labels
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
    });
    
    // Add penulis functionality
    $('#add-penulis').click(function() {
        let newPenulis = `
            <div class="input-group mb-2 penulis-item">
                <input type="text" name="penulis[]" class="form-control" placeholder="Nama penulis">
                <div class="input-group-append">
                    <button class="btn btn-outline-danger remove-penulis" type="button">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        $('#penulis-container').append(newPenulis);
    });
    
    // Remove penulis functionality
    $(document).on('click', '.remove-penulis', function() {
        if ($('.penulis-item').length > 1) {
            $(this).closest('.penulis-item').remove();
        }
    });
    
    // Add required indicator styles
    $('.required').addClass('font-weight-bold').append(' <span class="text-danger">*</span>');
});
</script>
@endpush

@push('styles')
<style>
.required {
    position: relative;
}
</style>
@endpush