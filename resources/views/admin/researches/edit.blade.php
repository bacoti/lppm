@extends('admin.layouts.admin')

@section('title', 'Edit Data Penelitian')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Edit Data Penelitian</h1>

        <form action="{{ route('admin.researches.update', $research) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3 mb-3">
                {{-- Dosen (read-only) --}}
                <div class="col-12 col-md-4 col-lg-3">
                    <input type="text" class="form-control"
                           value="{{ $research->dosen->nama_lengkap }} ({{ $research->dosen->nidn_nip }})"
                           readonly>

                    {{-- Keep dosen_id in the payload so update() still receives it --}}
                    <input type="hidden" name="dosen_id" value="{{ $research->dosen_id }}">
                </div>

                {{-- Judul Penelitian --}}
                <div class="col-12 col-md-6 col-lg-8">
                    <input type="text" class="form-control"
                           name="judul"
                           placeholder="Judul Penelitian"
                           value="{{ old('judul', $research->judul) }}">
                </div>

                {{-- Bidang --}}
                <div class="col-12 col-md-4 col-lg-3">
                    <input type="text" class="form-control"
                           name="bidang"
                           placeholder="Bidang"
                           value="{{ old('bidang', $research->bidang) }}">
                </div>

                {{-- Tahun --}}
                <div class="col-12 col-md-4 col-lg-2">
                    <input type="number" class="form-control"
                           name="tahun"
                           placeholder="Tahun"
                           value="{{ old('tahun', $research->tahun) }}">
                </div>

                {{-- Sumber Dana --}}
                <div class="col-12 col-md-4 col-lg-3">
                    <input type="text" class="form-control"
                           name="sumber_dana"
                           placeholder="Sumber Dana"
                           value="{{ old('sumber_dana', $research->sumber_dana) }}">
                </div>

                {{-- Jumlah Dana --}}
                <div class="col-12 col-md-4 col-lg-4">
                    <input type="number" step="0.01" class="form-control"
                           name="jumlah_dana"
                           placeholder="Jumlah Dana"
                           value="{{ old('jumlah_dana', $research->jumlah_dana) }}">
                </div>

                {{-- Abstrak --}}
                <div class="col-12">
                    <textarea name="abstrak" rows="3" class="form-control"
                              placeholder="Abstrak">{{ old('abstrak', $research->abstrak) }}</textarea>
                </div>

                {{-- Luaran --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <input type="text" class="form-control"
                           name="luaran"
                           placeholder="Luaran"
                           value="{{ old('luaran', $research->luaran) }}">
                </div>

                {{-- File Laporan --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <input type="file" class="form-control" name="file_laporan">
                    @if($research->file_laporan)
                        <small class="text-muted">
                            File saat ini:
                            <a href="{{ asset('storage/' . $research->file_laporan) }}" target="_blank">
                                Lihat Laporan
                            </a>
                        </small>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.researches.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
