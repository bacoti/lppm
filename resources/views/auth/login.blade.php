<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LPPM IDE LPKIA</title>
    
    {{-- Meta Tags for SEO --}}
    <meta name="description" content="Login Portal LPPM IDE LPKIA - Lembaga Penelitian dan Pengabdian Kepada Masyarakat">
    <meta name="keywords" content="Login, LPPM, IDE LPKIA, Bandung">
    <meta name="author" content="LPPM IDE LPKIA">
    
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/logo_lpkia.png') }}" type="image/png">
    
    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .bg-animation::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(-5px, -10px) rotate(1deg); }
            50% { transform: translate(10px, -5px) rotate(-1deg); }
            75% { transform: translate(-10px, 5px) rotate(1deg); }
        }

        /* Main Container */
        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header Section */
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-container {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .welcome-text {
            margin-bottom: 0.5rem;
        }

        .welcome-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }

        .welcome-subtitle {
            color: #64748b;
            font-size: 0.95rem;
            font-weight: 400;
            line-height: 1.5;
        }

        /* Form Styling */
        .login-form {
            space-y: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .input-group {
            position: relative;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 0.75rem 1rem 0.75rem 3rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
            height: 52px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: #fff;
            outline: none;
        }

        .form-control::placeholder {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            z-index: 3;
            transition: color 0.3s ease;
        }

        .form-control:focus + .input-icon {
            color: #667eea;
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            z-index: 3;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        /* Login Button */
        .btn-login {
            width: 100%;
            height: 52px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 1rem;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Remember Me & Forgot Password */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.5rem 0;
            font-size: 0.9rem;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 2px solid #d1d5db;
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #4f46e5;
            text-decoration: underline;
        }

        /* Error Messages */
        .alert {
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border: none;
            padding: 1rem;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* Footer Links */
        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        .footer-text {
            color: #6b7280;
            font-size: 0.85rem;
        }

        .footer-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        /* Loading State */
        .btn-loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                padding: 15px;
            }
            
            .login-card {
                padding: 2rem 1.5rem;
                border-radius: 16px;
            }
            
            .welcome-title {
                font-size: 1.5rem;
            }
            
            .form-options {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 1.5rem 1rem;
            }
            
            .logo {
                width: 60px;
                height: 60px;
            }
        }

        /* Accessibility */
        .form-control:focus {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }

        .btn-login:focus {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }

        /* Smooth transitions */
        * {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    {{-- Background Animation --}}
    <div class="bg-animation"></div>

    {{-- Main Login Container --}}
    <div class="login-container">
        <div class="login-card">
            
            {{-- Header Section --}}
            <div class="login-header">
                <div class="logo-container">
                    <img src="{{ asset('images/logo_lpkia.png') }}" alt="Logo LPPM IDE LPKIA" class="logo">
                </div>
                <div class="welcome-text">
                    <h1 class="welcome-title">Selamat Datang</h1>
                    <p class="welcome-subtitle">
                        Masuk ke portal LPPM IDE LPKIA untuk mengakses sistem manajemen penelitian dan pengabdian masyarakat
                    </p>
                </div>
            </div>

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terjadi Kesalahan!</strong>
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login.submit') }}" class="login-form" id="loginForm">
                @csrf
                
                {{-- Email Field --}}
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope text-primary"></i>
                        Alamat Email
                    </label>
                    <div class="input-group">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            placeholder="Masukkan alamat email Anda"
                            value="{{ old('email') }}"
                            required 
                            autocomplete="email"
                            autofocus
                        >
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock text-primary"></i>
                        Kata Sandi
                    </label>
                    <div class="input-group">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Masukkan kata sandi Anda"
                            required 
                            autocomplete="current-password"
                        >
                        <i class="fas fa-lock input-icon"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="far fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="form-options">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>
                    <a href="#" class="forgot-password">Lupa kata sandi?</a>
                </div>

                {{-- Login Button --}}
                <button type="submit" class="btn btn-login" id="loginBtn">
                    <span class="btn-text">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Masuk ke Dashboard
                    </span>
                    <div class="spinner d-none"></div>
                </button>
            </form>

            {{-- Footer --}}
            <div class="login-footer">
                <p class="footer-text">
                    Belum memiliki akun? 
                    <a href="#" class="footer-link">Hubungi Administrator</a>
                </p>
                <p class="footer-text mt-2">
                    <small>&copy; {{ date('Y') }} LPPM IDE LPKIA. All rights reserved.</small>
                </p>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Password Toggle Function
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Form Submit with Loading State
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            const btnText = btn.querySelector('.btn-text');
            const spinner = btn.querySelector('.spinner');
            
            btn.classList.add('btn-loading');
            btnText.classList.add('d-none');
            spinner.classList.remove('d-none');
        });

        // Enhanced Form Validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const inputs = form.querySelectorAll('input[required]');
            
            inputs.forEach(input => {
                input.addEventListener('blur', validateField);
                input.addEventListener('input', clearErrors);
            });

            function validateField(e) {
                const field = e.target;
                const value = field.value.trim();
                
                // Remove existing error classes
                field.classList.remove('is-invalid');
                
                // Email validation
                if (field.type === 'email' && value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(value)) {
                        field.classList.add('is-invalid');
                        showFieldError(field, 'Format email tidak valid');
                    }
                }
                
                // Password validation
                if (field.type === 'password' && value) {
                    if (value.length < 6) {
                        field.classList.add('is-invalid');
                        showFieldError(field, 'Kata sandi minimal 6 karakter');
                    }
                }
            }

            function clearErrors(e) {
                const field = e.target;
                field.classList.remove('is-invalid');
                const errorDiv = field.parentNode.nextElementSibling;
                if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                    errorDiv.remove();
                }
            }

            function showFieldError(field, message) {
                let errorDiv = field.parentNode.nextElementSibling;
                if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                    errorDiv = document.createElement('div');
                    errorDiv.classList.add('invalid-feedback', 'd-block');
                    field.parentNode.insertAdjacentElement('afterend', errorDiv);
                }
                errorDiv.textContent = message;
            }
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });
        });

        // Keyboard navigation enhancement
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const focusedElement = document.activeElement;
                if (focusedElement.tagName === 'INPUT') {
                    const form = focusedElement.closest('form');
                    const inputs = Array.from(form.querySelectorAll('input'));
                    const currentIndex = inputs.indexOf(focusedElement);
                    
                    if (currentIndex < inputs.length - 1) {
                        e.preventDefault();
                        inputs[currentIndex + 1].focus();
                    }
                }
            }
        });
    </script>
</body>
</html>