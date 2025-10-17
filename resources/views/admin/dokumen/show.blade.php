@extends('admin.layouts.admin')

@section('title', 'Detail Dokumen')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Dokumen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.dokumen.index') }}">Dokumen</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                            <h3 class="card-title">{{ $dokumen->judul }}</h3>
                            <div class="card-tools">
                                <span class="badge {{ $dokumen->status == 'published' ? 'badge-success' : 'badge-secondary' }}">
                                    {{ ucfirst($dokumen->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
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
                                        @if($dokumen->user)
                                        <tr>
                                            <td><strong>Uploader:</strong></td>
                                            <td>{{ $dokumen->user->name }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ $dokumen->file_url }}" target="_blank" class="btn btn-primary">
                                <i class="fas fa-download mr-1"></i>Download File
                            </a>
                            <a href="{{ route('admin.dokumen.edit', $dokumen) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
