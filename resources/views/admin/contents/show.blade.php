@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Preview Konten: {{ $content->title }}</h3>
        <div class="btn-group">
            <a href="{{ route('admin.contents.edit', $content->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ $content->title }}</h5>
                    <small class="text-muted">Slug: {{ $content->slug }}</small>
                </div>
                <div class="card-body">
                    <div class="content-preview">
                        {!! $content->body !!}
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <small>
                        <i class="fas fa-calendar-alt"></i> Dibuat: {{ $content->created_at->format('d M Y H:i') }} |
                        <i class="fas fa-edit"></i> Diperbarui: {{ $content->updated_at->format('d M Y H:i') }}
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Gambar Terkait ({{ $content->imageContents->count() }})</h6>
                </div>
                <div class="card-body">
                    @if($content->imageContents->count() > 0)
                        <div class="row g-2">
                            @foreach($content->imageContents as $image)
                                <div class="col-6">
                                    <div class="position-relative">
                                        <img src="{{ $image->image_url }}" 
                                             class="img-thumbnail w-100" 
                                             alt="Content Image"
                                             style="height: 100px; object-fit: cover;">
                                        <small class="text-muted d-block mt-1">
                                            {{ basename($image->image_url) }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">
                            <i class="fas fa-image"></i> Tidak ada gambar
                        </p>
                    @endif
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Aksi</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.contents.edit', $content->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Konten
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash"></i> Hapus Konten
                        </button>
                        <a href="{{ route('home') }}" target="_blank" class="btn btn-info">
                            <i class="fas fa-external-link-alt"></i> Lihat di Website
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus konten "<strong>{{ $content->title }}</strong>"?</p>
                <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> Tindakan ini tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.contents.destroy', $content->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.content-preview {
    line-height: 1.8;
}
.content-preview img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 10px 0;
}
.content-preview h1, .content-preview h2, .content-preview h3 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}
.content-preview p {
    margin-bottom: 1rem;
}
</style>
@endsection