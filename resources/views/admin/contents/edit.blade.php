@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Edit Konten: {{ $content->title }}</h3>
        <div class="btn-group">
            <a href="{{ route('admin.contents.show', $content->id) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> Preview
            </a>
            <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.contents.update', $content->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" 
                                   value="{{ old('title', $content->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" id="slug" class="form-control" 
                                   value="{{ old('slug', $content->slug) }}" required>
                            <small class="form-text text-muted">URL friendly (contoh: tentang-kami, beranda)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tambah Gambar Baru</label>
                            <div id="image-upload-wrapper">
                                <input type="file" name="images[]" class="form-control mb-2" accept="image/*">
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary" id="add-image-button">
                                <i class="fas fa-plus"></i> Tambah Gambar
                            </button>
                            <small class="form-text text-muted">Format: JPG, PNG, GIF, WebP. Maksimal 2MB per file.</small>
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Isi Konten <span class="text-danger">*</span></label>
                            <textarea id="body" name="body" class="form-control" rows="10" required>{{ old('body', $content->body) }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-images"></i> Gambar Saat Ini ({{ $content->imageContents->count() }})
                    </h6>
                </div>
                <div class="card-body">
                    @if($content->imageContents->count() > 0)
                        <div class="row g-2">
                            @foreach($content->imageContents as $image)
                                <div class="col-12" id="image-{{ $image->id }}">
                                    <div class="position-relative mb-3">
                                        <img src="{{ $image->image_url }}" 
                                             class="img-thumbnail w-100" 
                                             alt="Content Image"
                                             style="height: 120px; object-fit: cover;">
                                        
                                        <button type="button" 
                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                                                onclick="deleteImage({{ $image->id }})"
                                                title="Hapus gambar">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        
                                        <small class="text-muted d-block mt-1">
                                            {{ basename($image->image_url) }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">
                            <i class="fas fa-image"></i> Belum ada gambar
                        </p>
                    @endif
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-info-circle"></i> Informasi</h6>
                </div>
                <div class="card-body">
                    <small>
                        <strong>Dibuat:</strong> {{ $content->created_at->format('d M Y H:i') }}<br>
                        <strong>Diperbarui:</strong> {{ $content->updated_at->format('d M Y H:i') }}<br>
                        <strong>Slug:</strong> {{ $content->slug }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
        document.getElementById('slug').value = slug;
    });

    // Add more image upload fields
    document.getElementById('add-image-button').addEventListener('click', function () {
        const wrapper = document.getElementById('image-upload-wrapper');
        
        const inputGroup = document.createElement('div');
        inputGroup.classList.add('d-flex', 'mb-2');
        
        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.name = 'images[]';
        newInput.accept = 'image/*';
        newInput.classList.add('form-control', 'me-2');
        
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.classList.add('btn', 'btn-sm', 'btn-danger');
        removeBtn.innerHTML = '<i class="fas fa-minus"></i>';
        removeBtn.addEventListener('click', function() {
            inputGroup.remove();
        });
        
        inputGroup.appendChild(newInput);
        inputGroup.appendChild(removeBtn);
        wrapper.appendChild(inputGroup);
    });

    // Delete image function
    function deleteImage(imageId) {
        if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
            fetch(`/admin/contents/images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`image-${imageId}`).remove();
                    
                    // Show success message
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-success alert-dismissible fade show';
                    alert.innerHTML = `
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    document.querySelector('.container').insertBefore(alert, document.querySelector('.row'));
                    
                    // Auto hide alert
                    setTimeout(() => {
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 300);
                    }, 3000);
                } else {
                    alert('Gagal menghapus gambar');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus gambar');
            });
        }
    }
</script>

<script src="https://cdn.tiny.cloud/1/5ol1nixbiz4naji2ylsaf32fuq8hikrlrs3as07q7pr6bq1k/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#body',
        height: 500,
        plugins: 'image link media table lists code',
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | link image media | bullist numlist | table | code',
        automatic_uploads: true,
        images_upload_handler: function (blobInfo, success, failure) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route("admin.contents.upload") }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            xhr.onload = function () {
                if (xhr.status !== 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                let json;
                try {
                    json = JSON.parse(xhr.responseText);
                } catch (e) {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                if (!json || typeof json.location !== 'string') {
                    failure('Upload gagal: respons tidak sesuai.');
                    return;
                }

                success(json.location);
            };

            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }
    });
</script>
@endsection