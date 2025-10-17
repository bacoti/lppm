<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('images/logo_lpkia.png') }}" alt="Logo LPPM" class="brand-image img-circle elevation-3"
             style="opacity: .9; width:33px; height:33px;">
        <span class="brand-text font-weight-light">Admin LPPM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Update Content --}}
                <li class="nav-item">
                    <a href="{{ route('admin.contents.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Contents</p>
                    </a>
                </li>

                {{-- View Website --}}
                <li class="nav-item">
                    <a href="{{ route('home') }}" target="_blank" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>View Website</p>
                    </a>
                </li>

                {{-- Pangkalan Dosen --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Pangkalan Dosen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.dosens.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Dosen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.qualifications.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kualifikasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.competences.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kompetensi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Penelitian --}}
                <li class="nav-item">
                    <a href="{{ route('admin.researches.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-microscope"></i>
                        <p>Penelitian</p>
                    </a>
                </li>

                {{-- Pengabdian --}}
                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-hands-helping"></i>
                        <p>Pengabdian</p>
                    </a>
                </li>

                {{-- HAKI --}}
                <li class="nav-item">
                    <a href="{{ route('admin.haki.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-copyright"></i>
                        <p>HAKI</p>
                    </a>
                </li>

                {{-- Dokumen --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dokumen.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Dokumen</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
