@extends('admin.layouts.admin')

@section('title', 'Tambah Kompetensi Dosen')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-user-graduate me-2"></i>
                            Tambah Kompetensi Dosen
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.competences.store') }}" method="POST" id="competenceForm">
                            @csrf

                            <!-- Pilih Dosen -->
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
                                                <div class="col-md-6">
                                                    <label for="dosen_id" class="form-label">Pilih Dosen <span class="text-danger">*</span></label>
                                                    <select name="dosen_id" id="dosen_id" class="form-select @error('dosen_id') is-invalid @enderror" required>
                                                        <option value="">-- Pilih Dosen --</option>
                                                        @foreach($dosens as $dosen)
                                                            <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                                                {{ $dosen->nama_lengkap }} ({{ $dosen->nidn_nip }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('dosen_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="status_sertifikasi" class="form-label">Status Sertifikasi <span class="text-danger">*</span></label>
                                                    <select name="status_sertifikasi" id="status_sertifikasi" class="form-select @error('status_sertifikasi') is-invalid @enderror" required>
                                                        <option value="">-- Pilih Status --</option>
                                                        @foreach(\App\Models\Competence::getStatusSertifikasiOptions() as $value => $label)
                                                            <option value="{{ $value }}" {{ old('status_sertifikasi') == $value ? 'selected' : '' }}>
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
                                                    <label for="metodologi_pengajaran" class="form-label">Metodologi Pengajaran</label>
                                                    <textarea name="metodologi_pengajaran" id="metodologi_pengajaran" 
                                                              class="form-control @error('metodologi_pengajaran') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan metodologi dan strategi pengajaran yang dikuasai...">{{ old('metodologi_pengajaran') }}</textarea>
                                                    @error('metodologi_pengajaran')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="teknik_evaluasi" class="form-label">Teknik Evaluasi</label>
                                                    <textarea name="teknik_evaluasi" id="teknik_evaluasi" 
                                                              class="form-control @error('teknik_evaluasi') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan teknik evaluasi dan penilaian pembelajaran...">{{ old('teknik_evaluasi') }}</textarea>
                                                    @error('teknik_evaluasi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="manajemen_kelas" class="form-label">Manajemen Kelas</label>
                                                    <textarea name="manajemen_kelas" id="manajemen_kelas" 
                                                              class="form-control @error('manajemen_kelas') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan kemampuan manajemen dan pengelolaan kelas...">{{ old('manajemen_kelas') }}</textarea>
                                                    @error('manajemen_kelas')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="teknologi_pembelajaran" class="form-label">Teknologi Pembelajaran</label>
                                                    <textarea name="teknologi_pembelajaran" id="teknologi_pembelajaran" 
                                                              class="form-control @error('teknologi_pembelajaran') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan penggunaan teknologi dalam pembelajaran...">{{ old('teknologi_pembelajaran') }}</textarea>
                                                    @error('teknologi_pembelajaran')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="pengembangan_kurikulum" class="form-label">Pengembangan Kurikulum</label>
                                                    <textarea name="pengembangan_kurikulum" id="pengembangan_kurikulum" 
                                                              class="form-control @error('pengembangan_kurikulum') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan kemampuan pengembangan dan adaptasi kurikulum...">{{ old('pengembangan_kurikulum') }}</textarea>
                                                    @error('pengembangan_kurikulum')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
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
                                                    <label for="keahlian_bidang" class="form-label">Keahlian Bidang</label>
                                                    <textarea name="keahlian_bidang" id="keahlian_bidang" 
                                                              class="form-control @error('keahlian_bidang') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan keahlian khusus dalam bidang ilmu...">{{ old('keahlian_bidang') }}</textarea>
                                                    @error('keahlian_bidang')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="penelitian_terapan" class="form-label">Penelitian Terapan</label>
                                                    <textarea name="penelitian_terapan" id="penelitian_terapan" 
                                                              class="form-control @error('penelitian_terapan') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan kemampuan penelitian terapan di bidangnya...">{{ old('penelitian_terapan') }}</textarea>
                                                    @error('penelitian_terapan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="publikasi_ilmiah" class="form-label">Publikasi Ilmiah</label>
                                                    <textarea name="publikasi_ilmiah" id="publikasi_ilmiah" 
                                                              class="form-control @error('publikasi_ilmiah') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan publikasi dan karya ilmiah yang dihasilkan...">{{ old('publikasi_ilmiah') }}</textarea>
                                                    @error('publikasi_ilmiah')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="kolaborasi_industri" class="form-label">Kolaborasi Industri</label>
                                                    <textarea name="kolaborasi_industri" id="kolaborasi_industri" 
                                                              class="form-control @error('kolaborasi_industri') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan kolaborasi dengan industri dan praktisi...">{{ old('kolaborasi_industri') }}</textarea>
                                                    @error('kolaborasi_industri')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="update_pengetahuan" class="form-label">Update Pengetahuan</label>
                                                    <textarea name="update_pengetahuan" id="update_pengetahuan" 
                                                              class="form-control @error('update_pengetahuan') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan upaya pembaruan pengetahuan dan kompetensi...">{{ old('update_pengetahuan') }}</textarea>
                                                    @error('update_pengetahuan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
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
                                                    <label for="komunikasi_efektif" class="form-label">Komunikasi Efektif</label>
                                                    <textarea name="komunikasi_efektif" id="komunikasi_efektif" 
                                                              class="form-control @error('komunikasi_efektif') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan kemampuan komunikasi dengan mahasiswa dan kolega...">{{ old('komunikasi_efektif') }}</textarea>
                                                    @error('komunikasi_efektif')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="kerjasama_tim" class="form-label">Kerjasama Tim</label>
                                                    <textarea name="kerjasama_tim" id="kerjasama_tim" 
                                                              class="form-control @error('kerjasama_tim') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan kemampuan bekerja dalam tim dan kolaborasi...">{{ old('kerjasama_tim') }}</textarea>
                                                    @error('kerjasama_tim')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="kepemimpinan" class="form-label">Kepemimpinan</label>
                                                    <textarea name="kepemimpinan" id="kepemimpinan" 
                                                              class="form-control @error('kepemimpinan') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan kemampuan kepemimpinan dan pengembangan orang lain...">{{ old('kepemimpinan') }}</textarea>
                                                    @error('kepemimpinan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="adaptasi_budaya" class="form-label">Adaptasi Budaya</label>
                                                    <textarea name="adaptasi_budaya" id="adaptasi_budaya" 
                                                              class="form-control @error('adaptasi_budaya') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan kemampuan adaptasi dengan beragam budaya...">{{ old('adaptasi_budaya') }}</textarea>
                                                    @error('adaptasi_budaya')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="etika_profesi" class="form-label">Etika Profesi</label>
                                                    <textarea name="etika_profesi" id="etika_profesi" 
                                                              class="form-control @error('etika_profesi') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan pemahaman dan penerapan etika profesi...">{{ old('etika_profesi') }}</textarea>
                                                    @error('etika_profesi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
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
                                                    <label for="sertifikat_pendidik" class="form-label">Sertifikat Pendidik</label>
                                                    <input type="text" name="sertifikat_pendidik" id="sertifikat_pendidik" 
                                                           class="form-control @error('sertifikat_pendidik') is-invalid @enderror" 
                                                           placeholder="Nomor/Nama sertifikat pendidik..." value="{{ old('sertifikat_pendidik') }}">
                                                    @error('sertifikat_pendidik')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="tanggal_sertifikat" class="form-label">Tanggal Sertifikat</label>
                                                    <input type="date" name="tanggal_sertifikat" id="tanggal_sertifikat" 
                                                           class="form-control @error('tanggal_sertifikat') is-invalid @enderror" 
                                                           value="{{ old('tanggal_sertifikat') }}">
                                                    @error('tanggal_sertifikat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="sertifikasi_lain" class="form-label">Sertifikasi Lain</label>
                                                    <textarea name="sertifikasi_lain" id="sertifikasi_lain" 
                                                              class="form-control @error('sertifikasi_lain') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan sertifikasi profesional lainnya...">{{ old('sertifikasi_lain') }}</textarea>
                                                    @error('sertifikasi_lain')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="pelatihan_kompetensi" class="form-label">Pelatihan Kompetensi</label>
                                                    <textarea name="pelatihan_kompetensi" id="pelatihan_kompetensi" 
                                                              class="form-control @error('pelatihan_kompetensi') is-invalid @enderror" 
                                                              rows="3" placeholder="Deskripsikan pelatihan kompetensi yang pernah diikuti...">{{ old('pelatihan_kompetensi') }}</textarea>
                                                    @error('pelatihan_kompetensi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Simpan Kompetensi
                                        </button>
                                        <a href="{{ route('admin.competences.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times me-2"></i>Batal
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </form>
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
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    
    .text-danger {
        font-weight: 700;
    }
    
    .card-header h6 {
        font-weight: 600;
    }
    
    .card-header small {
        font-style: italic;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation enhancement
        const form = document.getElementById('competenceForm');
        
        form.addEventListener('submit', function(e) {
            const dosenSelect = document.getElementById('dosen_id');
            const statusSelect = document.getElementById('status_sertifikasi');
            
            if (!dosenSelect.value) {
                e.preventDefault();
                dosenSelect.focus();
                alert('Silakan pilih dosen terlebih dahulu.');
                return false;
            }
            
            if (!statusSelect.value) {
                e.preventDefault();
                statusSelect.focus();
                alert('Silakan pilih status sertifikasi.');
                return false;
            }
        });
        
        // Auto-resize textareas
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(function(textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    });
</script>
@endpush
