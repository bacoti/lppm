@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Tambah Konten Baru</h3>
        <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">
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

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <!-- Debug Info Panel -->
            <div class="alert alert-info" id="debugInfo" style="display: none;">
                <h6>🔍 Debug Information:</h6>
                <div id="debugContent"></div>
            </div>

            <form action="{{ route('admin.contents.store') }}" method="POST" enctype="multipart/form-data" id="contentForm">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title') }}" required 
                           placeholder="Masukkan judul konten">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                           value="{{ old('slug') }}" required 
                           placeholder="url-friendly-text">
                    <small class="form-text text-muted">URL friendly (contoh: tentang-kami, beranda)</small>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Gambar (Opsional)</label>
                    <div id="image-upload-wrapper">
                        <input type="file" name="images[]" class="form-control mb-2" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" id="add-image-button">
                        <i class="fas fa-plus"></i> Tambah Gambar
                    </button>
                    <small class="form-text text-muted">Format: JPG, PNG, GIF, WebP. Maksimal 2MB per file.</small>
                    @error('images.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label">Isi Konten <span class="text-danger">*</span></label>
                    <div id="editor-status" class="alert alert-warning" style="display: none;">
                        <i class="fas fa-spinner fa-spin"></i> Loading editor...
                    </div>
                    <textarea id="body" name="body" class="form-control @error('body') is-invalid @enderror" rows="10" required>{{ old('body') }}</textarea>
                    <small class="form-text text-muted">
                        <span id="editor-type">Editor: Basic Textarea</span>
                    </small>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save"></i> Simpan Konten
                    </button>
                    <button type="button" class="btn btn-info" id="debugBtn">
                        <i class="fas fa-bug"></i> Test Form
                    </button>
                    <button type="button" class="btn btn-warning" id="toggleDebugBtn">
                        <i class="fas fa-eye"></i> Show Debug
                    </button>
                    <a href="{{ route('admin.contents.index') }}" class="btn btn-secondary">
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
    let tinymceLoaded = false;
    let formReady = false;

    document.addEventListener('DOMContentLoaded', function() {
        console.log('🚀 Content creation form loaded');
        updateDebugInfo();
        
        // Setup all form functionality
        setupSlugGeneration();
        setupImageUpload();
        initializeEditor();
        setupFormHandlers();
        setupDebugTools();
        
        formReady = true;
        updateDebugInfo();
        console.log('✅ Form initialization complete');
    });

    function updateDebugInfo() {
        const debugContent = document.getElementById('debugContent');
        if (debugContent) {
            debugContent.innerHTML = `
                <div><strong>Form Ready:</strong> ${formReady ? '✅' : '❌'}</div>
                <div><strong>TinyMCE Loaded:</strong> ${tinymceLoaded ? '✅' : '❌'}</div>
                <div><strong>CSRF Token:</strong> ${!!document.querySelector('input[name="_token"]') ? '✅' : '❌'}</div>
                <div><strong>Current Time:</strong> ${new Date().toLocaleTimeString()}</div>
                <div><strong>Page URL:</strong> ${window.location.href}</div>
                <div><strong>User Agent:</strong> ${navigator.userAgent.split(' ')[0]}</div>
            `;
        }
    }

    function setupSlugGeneration() {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        
        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function() {
                const title = this.value;
                const slug = title.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                slugInput.value = slug;
            });
            console.log('✅ Slug generation setup complete');
        }
    }

    function setupImageUpload() {
        const addImageBtn = document.getElementById('add-image-button');
        const wrapper = document.getElementById('image-upload-wrapper');
        
        if (addImageBtn && wrapper) {
            addImageBtn.addEventListener('click', function () {
                const inputGroup = document.createElement('div');
                inputGroup.classList.add('d-flex', 'mb-2');
                
                const newInput = document.createElement('input');
                newInput.type = 'file';
                newInput.name = 'images[]';
                newInput.accept = 'image/jpeg,image/png,image/jpg,image/gif,image/webp';
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
            console.log('✅ Image upload setup complete');
        }
    }

    function initializeEditor() {
        const editorStatus = document.getElementById('editor-status');
        const editorType = document.getElementById('editor-type');
        
        if (editorStatus) editorStatus.style.display = 'block';
        
        // Set timeout untuk fallback jika TinyMCE gagal load
        const timeoutId = setTimeout(function() {
            console.log('⚠️ TinyMCE loading timeout, using basic textarea');
            if (editorStatus) editorStatus.style.display = 'none';
            if (editorType) editorType.textContent = 'Editor: Basic Textarea (TinyMCE timeout)';
            updateDebugInfo();
        }, 15000);

        // Coba load TinyMCE
        if (typeof tinymce === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://cdn.tiny.cloud/1/5ol1nixbiz4naji2ylsaf32fuq8hikrlrs3as07q7pr6bq1k/tinymce/6/tinymce.min.js';
            script.referrerPolicy = 'origin';
            
            script.onload = function() {
                clearTimeout(timeoutId);
                console.log('✅ TinyMCE script loaded');
                setupTinyMCE();
            };
            
            script.onerror = function() {
                console.error('❌ Failed to load TinyMCE script');
                clearTimeout(timeoutId);
                if (editorStatus) editorStatus.style.display = 'none';
                if (editorType) editorType.textContent = 'Editor: Basic Textarea (TinyMCE failed)';
                updateDebugInfo();
            };
            
            document.head.appendChild(script);
        } else {
            clearTimeout(timeoutId);
            setupTinyMCE();
        }
    }

    function setupTinyMCE() {
        try {
            tinymce.init({
                selector: '#body',
                height: 400,
                plugins: 'image link media table lists code',
                toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | link image | bullist numlist | table | code',
                menubar: false,
                branding: false,
                automatic_uploads: false, // Disable for debugging
                content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; }',
                setup: function (editor) {
                    editor.on('init', function () {
                        console.log('🎉 TinyMCE initialized successfully');
                        tinymceLoaded = true;
                        
                        const editorStatus = document.getElementById('editor-status');
                        const editorType = document.getElementById('editor-type');
                        
                        if (editorStatus) editorStatus.style.display = 'none';
                        if (editorType) editorType.textContent = 'Editor: TinyMCE Rich Text Editor ✅';
                        
                        updateDebugInfo();
                    });
                    
                    editor.on('change', function () {
                        editor.save(); // Sync content back to textarea
                    });
                }
            });
        } catch (error) {
            console.error('❌ TinyMCE setup error:', error);
            const editorStatus = document.getElementById('editor-status');
            const editorType = document.getElementById('editor-type');
            if (editorStatus) editorStatus.style.display = 'none';
            if (editorType) editorType.textContent = 'Editor: Basic Textarea (TinyMCE error)';
            updateDebugInfo();
        }
    }

    function setupFormHandlers() {
        const form = document.getElementById('contentForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                console.log('🚀 Form submission started...');
                
                // Sync TinyMCE content jika ada
                if (tinymceLoaded && tinymce.get('body')) {
                    tinymce.get('body').save();
                    console.log('✅ TinyMCE content synced');
                }
                
                // Disable submit button untuk prevent double submission
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                
                // Get dan validate form values
                const title = document.getElementById('title').value.trim();
                const slug = document.getElementById('slug').value.trim();
                const body = document.getElementById('body').value.trim();
                
                console.log('📝 Form validation data:', {
                    title: title || '(empty)',
                    slug: slug || '(empty)',
                    bodyLength: body.length,
                    tinymceActive: tinymceLoaded
                });
                
                // Basic validation
                let errors = [];
                if (!title) errors.push('Judul');
                if (!slug) errors.push('Slug');
                if (!body) errors.push('Isi Konten');
                
                if (errors.length > 0) {
                    e.preventDefault();
                    const errorMsg = '❌ Mohon lengkapi field berikut:\\n\\n' + errors.map(field => `• ${field}`).join('\\n');
                    alert(errorMsg);
                    
                    // Re-enable submit button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Konten';
                    
                    console.log('❌ Form validation failed:', errors);
                    return false;
                }
                
                console.log('✅ Form validation passed, proceeding with submission...');
                // Form akan submit secara normal
            });
            
            console.log('✅ Form handlers setup complete');
        }
    }

    function setupDebugTools() {
        // Debug button handler
        const debugBtn = document.getElementById('debugBtn');
        if (debugBtn) {
            debugBtn.addEventListener('click', function() {
                console.log('=== 🔍 COMPREHENSIVE FORM DEBUG ===');
                
                const form = document.getElementById('contentForm');
                const formData = new FormData(form);
                
                console.log('📋 Form Technical Details:');
                console.log('• Action URL:', form.action);
                console.log('• Method:', form.method);
                console.log('• TinyMCE Status:', tinymceLoaded ? '✅ Loaded' : '❌ Not Loaded');
                console.log('• Form Ready:', formReady ? '✅ Ready' : '❌ Not Ready');
                console.log('• CSRF Token:', document.querySelector('input[name="_token"]')?.value || 'Not Found');
                
                // Authentication check
                console.log('🔐 Checking Authentication...');
                fetch('{{ route("admin.dashboard") }}', {
                    method: 'GET',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => {
                    const authStatus = response.status === 200 ? '✅ Authenticated' : `❌ Not Authenticated (${response.status})`;
                    console.log('Auth Status:', authStatus);
                })
                .catch(error => {
                    console.log('❌ Auth Check Failed:', error.message);
                });
                
                // Form data inspection
                console.log('📨 Current Form Data:');
                let hasData = false;
                for (let [key, value] of formData.entries()) {
                    hasData = true;
                    if (key === 'body' && value.length > 200) {
                        console.log(`• ${key}: "${value.substring(0, 200)}..." (${value.length} chars)`);
                    } else if (value instanceof File) {
                        console.log(`• ${key}: File(${value.name}, ${value.size} bytes)`);
                    } else {
                        console.log(`• ${key}: "${value}"`);
                    }
                }
                
                if (!hasData) {
                    console.log('⚠️ No form data found!');
                }
                
                // Test API endpoint
                console.log('🧪 Testing API Endpoint...');
                fetch('{{ route("admin.contents.test-store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('✅ API Test Successful:', data);
                    alert('🎉 Test berhasil!\\n\\nForm data dapat dikirim dengan baik.\\nSilakan coba submit form asli.\\n\\nCek console untuk detail lengkap.');
                })
                .catch(error => {
                    console.error('❌ API Test Failed:', error);
                    alert(`💥 Test gagal!\\n\\nError: ${error.message}\\n\\nCek console untuk detail lengkap.`);
                });
            });
        }

        // Toggle debug panel
        const toggleDebugBtn = document.getElementById('toggleDebugBtn');
        const debugInfo = document.getElementById('debugInfo');
        if (toggleDebugBtn && debugInfo) {
            toggleDebugBtn.addEventListener('click', function() {
                if (debugInfo.style.display === 'none') {
                    debugInfo.style.display = 'block';
                    toggleDebugBtn.innerHTML = '<i class="fas fa-eye-slash"></i> Hide Debug';
                    updateDebugInfo();
                } else {
                    debugInfo.style.display = 'none';
                    toggleDebugBtn.innerHTML = '<i class="fas fa-eye"></i> Show Debug';
                }
            });
        }
        
        console.log('✅ Debug tools setup complete');
    }
</script>
@endsection