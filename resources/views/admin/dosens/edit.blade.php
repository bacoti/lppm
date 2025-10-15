@extends('layouts.admin')

@section('title', 'Edit Data Dosen')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Edit Data Dosen</h3>
        <a href="{{ route('admin.dosens.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h6>Terjadi kesalahan:</h6>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.dosens.update', $dosen) }}" method="POST" enctype="multipart/form-data" id="dosenEditForm">
                @csrf
                @method('PATCH')
                
                {{-- Section 1: Identitas Dasar --}}
                <div class="mb-4">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-user"></i> Identitas Dasar
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nidn_nip" class="form-label">NIDN / NIP</label>
                            <input type="text" name="nidn_nip" id="nidn_nip" 
                                   class="form-control @error('nidn_nip') is-invalid @enderror" 
                                   value="{{ old('nidn_nip', $dosen->nidn_nip) }}" readonly
                                   placeholder="NIDN/NIP tidak dapat diubah">
                            <small class="form-text text-muted">NIDN/NIP tidak dapat diubah setelah data dibuat.</small>
                            @error('nidn_nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" 
                                   class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                   value="{{ old('nama_lengkap', $dosen->nama_lengkap) }}" required
                                   placeholder="Nama lengkap dosen">
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="gelar_akademik" class="form-label">Gelar Akademik</label>
                            <input type="text" name="gelar_akademik" id="gelar_akademik" 
                                   class="form-control @error('gelar_akademik') is-invalid @enderror" 
                                   value="{{ old('gelar_akademik', $dosen->gelar_akademik) }}"
                                   placeholder="Contoh: S.Kom., M.T., Dr.">
                            @error('gelar_akademik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="photo" class="form-label">Foto Profil</label>
                            
                            @if($dosen->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $dosen->photo) }}"
                                         alt="Foto {{ $dosen->nama_lengkap }}"
                                         class="img-thumbnail"
                                         style="max-width: 150px;">
                                    <div class="mt-1">
                                        <small class="text-muted">Foto saat ini</small>
                                    </div>
                                </div>
                            @endif
                            
                            <input type="file" name="photo" id="photo" 
                                   class="form-control @error('photo') is-invalid @enderror" 
                                   accept="image/jpeg,image/png,image/jpg">
                            <small class="form-text text-muted">
                                {{ $dosen->photo ? 'Upload foto baru untuk mengganti.' : 'Upload foto profil.' }} 
                                Format: JPG, PNG. Maksimal 2MB.
                            </small>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Section 2: Data Pribadi --}}
                <div class="mb-4">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-id-card"></i> Data Pribadi
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" 
                                   class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                   value="{{ old('tempat_lahir', $dosen->tempat_lahir) }}"
                                   placeholder="Kota tempat lahir">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" 
                                   class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                   value="{{ old('tanggal_lahir', $dosen->tanggal_lahir) }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" 
                                    class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin', $dosen->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $dosen->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" 
                                      class="form-control @error('alamat') is-invalid @enderror" 
                                      rows="3" placeholder="Alamat lengkap">{{ old('alamat', $dosen->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save"></i> Update Data Dosen
                    </button>
                    <a href="{{ route('admin.dosens.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('dosenEditForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                // Disable submit button to prevent double submission
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                
                // Basic validation
                const namaLengkap = document.getElementById('nama_lengkap').value.trim();
                
                if (!namaLengkap) {
                    e.preventDefault();
                    alert('Nama Lengkap wajib diisi!');
                    
                    // Re-enable submit button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save"></i> Update Data Dosen';
                    return false;
                }
            });
        }
    });
</script>
@endsection
