@extends('frontend.layouts.app')

@section('title', $dokumen->judul)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-file-alt mr-2"></i>{{ $dokumen->judul }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            @if($dokumen->deskripsi)
                            <div class="mb-4">
                                <h5>Deskripsi</h5>
                                <p class="text-muted">{{ $dokumen->deskripsi }}</p>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Informasi File</h5>
                                    <table class="table table-sm">
                                        <tr>
                                            <td><strong>Nama File:</strong></td>
                                            <td>{{ $dokumen->file_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ukuran:</strong></td>
                                            <td>{{ $dokumen->file_size_formatted }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tipe:</strong></td>
                                            <td>{{ $dokumen->mime_type }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Extension:</strong></td>
                                            <td>{{ strtoupper($dokumen->file_extension) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h5>Informasi Lain</h5>
                                    <table class="table table-sm">
                                        <tr>
                                            <td><strong>Dibuat:</strong></td>
                                            <td>{{ $dokumen->created_at->format('d F Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Diupdate:</strong></td>
                                            <td>{{ $dokumen->updated_at->format('d F Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-{{ $dokumen->file_extension == 'pdf' ? 'pdf' : 'alt' }} fa-4x text-primary mb-3"></i>
                                    <h6>{{ $dokumen->file_name }}</h6>
                                    <p class="text-muted small mb-3">{{ $dokumen->file_size_formatted }}</p>
                                    <a href="{{ route('dokumen.download', $dokumen->slug) }}"
                                       class="btn btn-primary btn-lg btn-block"
                                       target="_blank">
                                        <i class="fas fa-download mr-2"></i>Download Dokumen
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i>Kembali ke Daftar Dokumen
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
