<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPPM LPKIA</title>

    <link rel="icon" href="{{ asset('images/logo_lppm.png') }}" type="image/png">

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])
</head>

<body>
    {{-- Topbar --}}
    <nav class="navbar navbar-dark bg-dark px-3">
        <span class="navbar-text text-white">Web LPKIA</span>
        <span class="ms-auto text-white">PENAMAS</span>
    </nav>

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center px-4 py-2 custom-gradient-header">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/logo_lpkia.png') }}" alt="Logo" class="me-3 logo-lppm">
            <div class="text-white">
                <h5 class="mb-0 fw-bold">LPPM IDE LPKIA</h5>
                <small>Lembaga Penelitian dan Pengabdian Kepada Masyarakat</small>
            </div>
        </div>
        {{-- Login button removed per user request --}}
        {{--
        @auth
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-light">Login</a>
        @endauth
        --}}
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark navbar-sticky custom-gradient-navbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbarContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tentang') }}">Tentang Kami</a></li>

                    <li class="nav-item dropdown navbar-hover-dropdown">
                        <a class="nav-link" href="#" id="navbarDropdownJurnal">
                            Jurnal
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="http://jurnal.lpkia.ac.id/index.php/jti" target="_blank">Teknologi Informasi</a></li>
                            <li><a class="dropdown-item" href="http://jurnal.lpkia.ac.id/index.php/jdab" target="_blank">Administrasi Bisnis</a></li>
                            <li><a class="dropdown-item" href="http://jurnal.lpkia.ac.id/index.php/jda" target="_blank">Akuntansi</a></li>
                            <li><a class="dropdown-item" href="http://jurnal.lpkia.ac.id/index.php/jkb" target="_blank">Komputer Bisnis</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('tridarma.penelitian') }}">Penelitian</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tridarma.pengabdian') }}">Pengabdian</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('frontend.haki') }}">HAKI</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('dokumen.index') }}">Dokumen</a></li>

                    <li class="nav-item dropdown navbar-hover-dropdown">
                        <a class="nav-link" href="#">Pangkalan Dosen</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('pangkalan.profil') }}">Profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('pangkalan.kualifikasi') }}">Kualifikasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('pangkalan.kompetensi') }}">Kompetensi</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Carousel (optional) --}}
    @hasSection('carousel')
        @yield('carousel')
    @endif

    {{-- Content --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="footer-section bg-dark text-white mt-5">
        {{-- Main Footer Content --}}
        <div class="footer-main py-5">
            <div class="container">
                <div class="row g-4">
                    {{-- Logo & Description Column --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-brand mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('images/logo_lpkia.png') }}" alt="Logo LPPM" class="footer-logo me-3">
                                <div>
                                    <h5 class="mb-1 fw-bold text-primary">LPPM IDE LPKIA</h5>
                                    <small class="text-light">Bandung</small>
                                </div>
                            </div>
                            <p class="text-light mb-3 footer-description">
                                Lembaga Penelitian dan Pengabdian Kepada Masyarakat Institut Digtal Ekonomi (LPKIA) Bandung.
                            </p>
                            {{-- <div class="footer-stats d-flex gap-3">
                                <div class="stat-item text-center">
                                    <div class="h6 text-primary mb-0">15+</div>
                                    <small class="text-muted">Tahun Pengalaman</small>
                                </div>
                                <div class="stat-item text-center">
                                    <div class="h6 text-primary mb-0">50+</div>
                                    <small class="text-muted">Penelitian</small>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    {{-- Quick Links Column --}}
                    <div class="col-lg-2 col-md-6">
                        <h6 class="footer-title mb-3">
                            <i class="fas fa-link me-2 text-primary"></i>
                            Menu Utama
                        </h6>
                        <ul class="footer-links list-unstyled">
                            <li><a href="{{ route('home') }}" class="footer-link">Beranda</a></li>
                            <li><a href="{{ route('tentang') }}" class="footer-link">Tentang Kami</a></li>
                            <li><a href="{{ route('tridarma.penelitian') }}" class="footer-link">Penelitian</a></li>
                            <li><a href="{{ route('tridarma.pengabdian') }}" class="footer-link">Pengabdian</a></li>
                            <li><a href="{{ route('dokumen.index') }}" class="footer-link">Dokumen</a></li>
                            <li><a href="{{ route('faq') }}" class="footer-link">FAQ</a></li>
                        </ul>
                    </div>

                    {{-- Services Column --}}
                    <div class="col-lg-3 col-md-6">
                        <h6 class="footer-title mb-3">
                            <i class="fas fa-graduation-cap me-2 text-primary"></i>
                            Layanan
                        </h6>
                        <ul class="footer-links list-unstyled">
                            <li><a href="{{ route('pangkalan.profil') }}" class="footer-link">Profil Dosen</a></li>
                            <li><a href="{{ route('pangkalan.kualifikasi') }}" class="footer-link">Kualifikasi</a></li>
                            <li><a href="{{ route('pangkalan.kompetensi') }}" class="footer-link">Kompetensi</a></li>
                            <li><a href="http://jurnal.lpkia.ac.id" target="_blank" class="footer-link">Jurnal Online</a></li>
                        </ul>
                    </div>

                    {{-- Contact Column --}}
                    <div class="col-lg-3 col-md-6">
                        <h6 class="footer-title mb-3">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            Hubungi Kami
                        </h6>

                        {{-- Contact Info --}}
                        <div class="contact-info mb-4">
                            <div class="contact-item d-flex align-items-start mb-2">
                                <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                                <div>
                                    <small class="text-muted d-block">Alamat:</small>
                                    <span class="text-light">Jl. Soekarno-Hatta No.754<br>Bandung 40292</span>
                                </div>
                            </div>
                            <div class="contact-item d-flex align-items-center mb-2">
                                <i class="fas fa-phone text-primary me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Telepon:</small>
                                    <a href="tel:(022)7214840" class="text-light text-decoration-none">(022) 7214840</a>
                                </div>
                            </div>
                            <div class="contact-item d-flex align-items-center mb-3">
                                <i class="fas fa-envelope text-primary me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Email:</small>
                                    <a href="mailto:lppm@lpkia.ac.id" class="text-light text-decoration-none">lppm@lpkia.ac.id</a>
                                </div>
                            </div>
                        </div>

                        {{-- Social Media --}}
                        <div class="social-media">
                            <h6 class="mb-3">
                                <i class="fas fa-share-alt me-2 text-primary"></i>
                                Ikuti Kami
                            </h6>
                            <div class="social-links d-flex gap-2">
                                <a href="https://instagram.com/lppm_lpkia"
                                   class="social-link instagram"
                                   target="_blank"
                                   data-bs-toggle="tooltip"
                                   title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="https://twitter.com/lppm_lpkia"
                                   class="social-link twitter"
                                   target="_blank"
                                   data-bs-toggle="tooltip"
                                   title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="mailto:lppm@lpkia.ac.id"
                                   class="social-link email"
                                   data-bs-toggle="tooltip"
                                   title="Email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="https://linkedin.com/company/lppm-lpkia"
                                   class="social-link linkedin"
                                   target="_blank"
                                   data-bs-toggle="tooltip"
                                   title="LinkedIn">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div class="footer-bottom bg-black py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">
                            &copy; {{ date('Y') }} <strong class="text-primary">LPPM IDE LPKIA</strong>.
                            All rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="footer-bottom-links">
                            <a href="#" class="text-muted text-decoration-none me-3 small">Privacy Policy</a>
                            <a href="#" class="text-muted text-decoration-none me-3 small">Terms of Service</a>
                            <a href="#" class="text-muted text-decoration-none small">Sitemap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Custom CSS for Navbar Hover Dropdown --}}
    <style>
        /* Hover dropdown functionality */
        .navbar-hover-dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        /* Remove dropdown arrow and make it look like regular nav link */
        .navbar-hover-dropdown .nav-link::after {
            display: none !important;
        }

        /* Smooth transition for dropdown */
        .dropdown-menu {
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
        }

        .navbar-hover-dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Additional styling for better UX */
        .navbar-hover-dropdown {
            position: relative;
        }

        .navbar-hover-dropdown .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Mobile responsiveness - keep click behavior on mobile */
        @media (max-width: 991px) {
            .navbar-hover-dropdown:hover .dropdown-menu {
                display: none;
            }

            .navbar-hover-dropdown .dropdown-menu.show {
                display: block;
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
        }

        /* Footer Styles */
        .footer-section {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        }

        .footer-logo {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .footer-title {
            color: #f8f9fa;
            font-weight: 600;
            border-bottom: 2px solid #007bff;
            padding-bottom: 8px;
            display: inline-block;
        }

        .footer-description {
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-link {
            color: #adb5bd;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            position: relative;
            padding-left: 15px;
        }

        .footer-link::before {
            content: "→";
            position: absolute;
            left: 0;
            color: #007bff;
            transition: transform 0.3s ease;
        }

        .footer-link:hover {
            color: #007bff;
            transform: translateX(5px);
        }

        .footer-link:hover::before {
            transform: translateX(5px);
        }

        .contact-item {
            margin-bottom: 15px;
        }

        .contact-item i {
            width: 20px;
            text-align: center;
        }

        .social-links {
            gap: 10px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .social-link.instagram {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        }

        .social-link.twitter {
            background: #1da1f2;
        }

        .social-link.email {
            background: #ea4335;
        }

        .social-link.linkedin {
            background: #0077b5;
        }

        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #495057;
        }

        .footer-bottom-links a:hover {
            color: #007bff !important;
        }

        .footer-stats .stat-item {
            min-width: 80px;
        }

        /* Responsive Footer */
        @media (max-width: 768px) {
            .footer-main {
                padding: 3rem 0;
            }

            .footer-brand {
                text-align: center;
                margin-bottom: 2rem;
            }

            .footer-stats {
                justify-content: center;
            }

            .social-links {
                justify-content: center;
            }

            .footer-bottom-links {
                text-align: center;
                margin-top: 10px;
            }
        }
    </style>

    {{-- Custom JavaScript for Mobile Dropdown --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle mobile dropdown toggle
            if (window.innerWidth <= 991) {
                const dropdownLinks = document.querySelectorAll('.navbar-hover-dropdown .nav-link');

                dropdownLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const dropdown = this.parentElement;
                        const menu = dropdown.querySelector('.dropdown-menu');

                        // Toggle show class
                        menu.classList.toggle('show');

                        // Close other dropdowns
                        document.querySelectorAll('.navbar-hover-dropdown .dropdown-menu').forEach(otherMenu => {
                            if (otherMenu !== menu) {
                                otherMenu.classList.remove('show');
                            }
                        });
                    });
                });
            }

            // Initialize tooltips for social media links
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Smooth scroll for footer links
            document.querySelectorAll('.footer-link[href^="#"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Add animation on scroll for footer elements
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe footer elements
            document.querySelectorAll('.footer-section .col-lg-4, .footer-section .col-lg-2, .footer-section .col-lg-3').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s ease';
                observer.observe(el);
            });
        });
    </script>
</body>
</html>
