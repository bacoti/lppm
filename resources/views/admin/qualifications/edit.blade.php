@extends('layouts.admin')

@section('title', 'Edit Kualifikasi Dosen')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Edit Kualifikasi Dosen</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.qualifications.index') }}">Kualifikasi Dosen</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Main Form Card --}}
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Kualifikasi: {{ $qualification->dosen->nama_lengkap }}
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.qualifications.update', $qualification) }}" method="POST" id="qualificationEditForm">
                @csrf
                @method('PUT')

                {{-- Section 1: Identitas Dosen --}}
                <div class="mb-4">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-person-circle text-primary me-2"></i>
                        Identitas Dosen
                    </h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="dosen_display" class="form-label">Dosen</label>
                            <input type="text" id="dosen_display" class="form-control" 
                                   value="{{ $qualification->dosen->nama_lengkap }} ({{ $qualification->dosen->nidn_nip }})" 
                                   readonly>
                            <input type="hidden" name="dosen_id" value="{{ $qualification->dosen_id }}">
                            <small class="form-text text-muted">Data dosen tidak dapat diubah</small>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Pendidikan --}}
                <div class="mb-4">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-mortarboard text-success me-2"></i>
                        Data Pendidikan
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="jenjang_pendidikan" class="form-label">Jenjang Pendidikan <span class="text-danger">*</span></label>
                            <select name="jenjang_pendidikan" id="jenjang_pendidikan" 
                                    class="form-select @error('jenjang_pendidikan') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenjang --</option>
                                @foreach(\App\Models\Qualification::getJenjangPendidikanOptions() as $value => $label)
                                    <option value="{{ $value }}" {{ old('jenjang_pendidikan', $qualification->jenjang_pendidikan) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenjang_pendidikan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="gelar_diperoleh" class="form-label">Gelar yang Diperoleh</label>
                            <input type="text" name="gelar_diperoleh" id="gelar_diperoleh" 
                                   class="form-control @error('gelar_diperoleh') is-invalid @enderror" 
                                   value="{{ old('gelar_diperoleh', $qualification->gelar_diperoleh) }}"
                                   placeholder="Contoh: S.Kom., M.T., Dr.">
                            @error('gelar_diperoleh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nama_perguruan_tinggi" class="form-label">Nama Perguruan Tinggi <span class="text-danger">*</span></label>
                            <input type="text" name="nama_perguruan_tinggi" id="nama_perguruan_tinggi" 
                                   class="form-control @error('nama_perguruan_tinggi') is-invalid @enderror" 
                                   value="{{ old('nama_perguruan_tinggi', $qualification->nama_perguruan_tinggi) }}" required
                                   placeholder="Nama lengkap perguruan tinggi">
                            @error('nama_perguruan_tinggi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="bidang_keilmuan" class="form-label">Bidang Keilmuan/Program Studi <span class="text-danger">*</span></label>
                            <input type="text" name="bidang_keilmuan" id="bidang_keilmuan" 
                                   class="form-control @error('bidang_keilmuan') is-invalid @enderror" 
                                   value="{{ old('bidang_keilmuan', $qualification->bidang_keilmuan) }}" required
                                   placeholder="Contoh: Teknik Informatika, Manajemen">
                            @error('bidang_keilmuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="status_pt" class="form-label">Status Perguruan Tinggi</label>
                            <select name="status_pt" id="status_pt" 
                                    class="form-select @error('status_pt') is-invalid @enderror">
                                <option value="">-- Pilih Status PT --</option>
                                @foreach(\App\Models\Qualification::getStatusPTOptions() as $value => $label)
                                    <option value="{{ $value }}" {{ old('status_pt', $qualification->status_pt) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_pt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="akreditasi_pt" class="form-label">Akreditasi Perguruan Tinggi</label>
                            <select name="akreditasi_pt" id="akreditasi_pt" 
                                    class="form-select @error('akreditasi_pt') is-invalid @enderror">
                                <option value="">-- Pilih Akreditasi --</option>
                                @foreach(\App\Models\Qualification::getAkreditasiPTOptions() as $value => $label)
                                    <option value="{{ $value }}" {{ old('akreditasi_pt', $qualification->akreditasi_pt) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('akreditasi_pt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="ipk" class="form-label">IPK/GPA</label>
                            <input type="number" name="ipk" id="ipk" 
                                   class="form-control @error('ipk') is-invalid @enderror" 
                                   value="{{ old('ipk', $qualification->ipk) }}" step="0.01" min="0" max="4"
                                   placeholder="Contoh: 3.75">
                            @error('ipk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                            <input type="number" name="tahun_lulus" id="tahun_lulus" 
                                   class="form-control @error('tahun_lulus') is-invalid @enderror" 
                                   value="{{ old('tahun_lulus', $qualification->tahun_lulus) }}" min="1950" max="{{ date('Y') + 5 }}"
                                   placeholder="Contoh: {{ date('Y') }}">
                            @error('tahun_lulus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status_kelulusan" class="form-label">Status Kelulusan</label>
                            <select name="status_kelulusan" id="status_kelulusan" 
                                    class="form-select @error('status_kelulusan') is-invalid @enderror">
                                @foreach(\App\Models\Qualification::getStatusKelulusanOptions() as $value => $label)
                                    <option value="{{ $value }}" {{ old('status_kelulusan', $qualification->status_kelulusan ?? 'Lulus') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_kelulusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="riwayat_pendidikan" class="form-label">Riwayat Pendidikan (Opsional)</label>
                            <textarea name="riwayat_pendidikan" id="riwayat_pendidikan" 
                                      class="form-control @error('riwayat_pendidikan') is-invalid @enderror" 
                                      rows="3" placeholder="Deskripsi tambahan mengenai riwayat pendidikan">{{ old('riwayat_pendidikan', $qualification->riwayat_pendidikan) }}</textarea>
                            @error('riwayat_pendidikan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Section 3: Jabatan & Karir --}}
                <div class="mb-4">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-briefcase text-warning me-2"></i>
                        Jabatan & Karir
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan/Status</label>
                            <input type="text" name="jabatan" id="jabatan" 
                                   class="form-control @error('jabatan') is-invalid @enderror" 
                                   value="{{ old('jabatan', $qualification->jabatan) }}"
                                   placeholder="Contoh: Dosen Tetap, Dosen LB">
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="jabatan_fungsional" class="form-label">Jabatan Fungsional</label>
                            <select name="jabatan_fungsional" id="jabatan_fungsional" 
                                    class="form-select @error('jabatan_fungsional') is-invalid @enderror">
                                <option value="">-- Pilih Jabatan Fungsional --</option>
                                @foreach(\App\Models\Qualification::getJabatanFungsionalOptions() as $value => $label)
                                    <option value="{{ $value }}" {{ old('jabatan_fungsional', $qualification->jabatan_fungsional) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jabatan_fungsional')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Section 4: Sertifikasi (Optional) --}}
                <div class="mb-4">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-award text-info me-2"></i>
                        Sertifikasi Pendidik <small class="text-muted">(Opsional)</small>
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="nomor_sertifikat_pendidik" class="form-label">Nomor Sertifikat Pendidik</label>
                            <input type="text" name="nomor_sertifikat_pendidik" id="nomor_sertifikat_pendidik" 
                                   class="form-control @error('nomor_sertifikat_pendidik') is-invalid @enderror" 
                                   value="{{ old('nomor_sertifikat_pendidik', $qualification->nomor_sertifikat_pendidik) }}"
                                   placeholder="Nomor sertifikat pendidik">
                            @error('nomor_sertifikat_pendidik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="tahun_sertifikasi" class="form-label">Tahun Sertifikasi</label>
                            <input type="number" name="tahun_sertifikasi" id="tahun_sertifikasi" 
                                   class="form-control @error('tahun_sertifikasi') is-invalid @enderror" 
                                   value="{{ old('tahun_sertifikasi', $qualification->tahun_sertifikasi) }}" min="2000" max="{{ date('Y') }}"
                                   placeholder="Tahun sertifikasi">
                            @error('tahun_sertifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="status_sertifikasi" class="form-label">Status Sertifikasi</label>
                            <select name="status_sertifikasi" id="status_sertifikasi" 
                                    class="form-select @error('status_sertifikasi') is-invalid @enderror">
                                <option value="">-- Pilih Status --</option>
                                @foreach(\App\Models\Qualification::getStatusSertifikasiOptions() as $value => $label)
                                    <option value="{{ $value }}" {{ old('status_sertifikasi', $qualification->status_sertifikasi) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_sertifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Section 5: Penelitian (Optional) --}}
                <div class="mb-4">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-search text-secondary me-2"></i>
                        Data Penelitian <small class="text-muted">(Opsional)</small>
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="bidang_penelitian_utama" class="form-label">Bidang Penelitian Utama</label>
                            <input type="text" name="bidang_penelitian_utama" id="bidang_penelitian_utama" 
                                   class="form-control @error('bidang_penelitian_utama') is-invalid @enderror" 
                                   value="{{ old('bidang_penelitian_utama', $qualification->bidang_penelitian_utama) }}"
                                   placeholder="Contoh: Artificial Intelligence, Data Science">
                            @error('bidang_penelitian_utama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="h_index" class="form-label">H-Index</label>
                            <input type="number" name="h_index" id="h_index" 
                                   class="form-control @error('h_index') is-invalid @enderror" 
                                   value="{{ old('h_index', $qualification->h_index) }}" min="0"
                                   placeholder="0">
                            @error('h_index')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="publikasi_scopus" class="form-label">Publikasi Scopus</label>
                            <input type="number" name="publikasi_scopus" id="publikasi_scopus" 
                                   class="form-control @error('publikasi_scopus') is-invalid @enderror" 
                                   value="{{ old('publikasi_scopus', $qualification->publikasi_scopus) }}" min="0"
                                   placeholder="0">
                            @error('publikasi_scopus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.qualifications.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>
                    <div>
                        <a href="{{ route('admin.qualifications.show', $qualification) }}" class="btn btn-outline-info me-2">
                            <i class="bi bi-eye me-1"></i>
                            Lihat Detail
                        </a>
                        <button type="submit" class="btn btn-warning" id="updateBtn">
                            <span class="spinner-border spinner-border-sm me-2 d-none" id="loading"></span>
                            <i class="bi bi-check-lg me-1"></i>
                            Update Kualifikasi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript for Enhanced UX --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('qualificationEditForm');
    const updateBtn = document.getElementById('updateBtn');
    const loading = document.getElementById('loading');

    // Form submission with loading state
    form.addEventListener('submit', function() {
        updateBtn.disabled = true;
        loading.classList.remove('d-none');
        updateBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memperbarui...';
    });

    // Auto-format IPK input
    const ipkInput = document.getElementById('ipk');
    ipkInput.addEventListener('input', function() {
        const value = parseFloat(this.value);
        if (value > 4) {
            this.value = 4;
        } else if (value < 0) {
            this.value = 0;
        }
    });

    // Show unsaved changes warning
    let formChanged = false;
    form.addEventListener('input', function() {
        formChanged = true;
    });

    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
});
</script>
@endsection
