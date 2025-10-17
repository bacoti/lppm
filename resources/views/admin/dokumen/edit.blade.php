@extends('admin.layouts.admin')

@section('title', 'Edit Dokumen')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Dokumen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.dokumen.index') }}">Dokumen</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Dokumen</h3>
                        </div>
                        <form action="{{ route('admin.dokumen.update', $dokumen) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="judul">Judul Dokumen <span class="text-danger">*</span></label>
                                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror"
                                           value="{{ old('judul', $dokumen->judul) }}" placeholder="Masukkan judul dokumen" required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                              rows="3" placeholder="Masukkan deskripsi dokumen (opsional)">{{ old('deskripsi', $dokumen->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>File Saat Ini</label>
                                    <div class="mb-2">
                                        <i class="fas fa-file-{{ $dokumen->file_extension == 'pdf' ? 'pdf' : 'alt' }} mr-1"></i>
                                        {{ $dokumen->file_name }} ({{ $dokumen->file_size_formatted }})
                                        <a href="{{ $dokumen->file_url }}" target="_blank" class="btn btn-sm btn-info ml-2">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="file">Upload File Baru (Opsional)</label>
                                    <div class="custom-file">
                                        <input type="file" name="file" id="file" class="custom-file-input @error('file') is-invalid @enderror"
                                               accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar">
                                        <label class="custom-file-label" for="file">Pilih file baru...</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Biarkan kosong jika tidak ingin mengubah file. Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, ZIP, RAR. Maksimal 20MB.
                                    </small>
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="published" {{ old('status', $dokumen->status) == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="draft" {{ old('status', $dokumen->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i>Update
                                </button>
                                <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Update file label when file selected
    $('#file').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName || 'Pilih file baru...');
    });
});
</script>
@endpush
