@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Cari Profil Dosen</h3>

        <form action="{{ route('pangkalan.profil') }}" method="GET" class="mb-4 row g-2 align-items-center">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" name="q" class="form-control"
                           placeholder="Cari nama, NIDN, email, atau keahlian..."
                           value="{{ $query ?? '' }}">
                </div>
            </div>
            <div class="col-md-4 d-grid">
                <button class="btn btn-success" type="submit">Cari</button>
            </div>
        </form>

        @if(isset($dosens) && $dosens->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>NIDN / NIP</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Departemen</th>
                            <th>Affiliasi</th>
                            <th>Scopus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dosens as $index => $dosen)
                        <tr>
                            <td>{{ $dosens->firstItem() + $index }}</td>
                            <td style="width:64px">
                                <img src="{{ $dosen->photo ? asset('storage/'.$dosen->photo) : asset('images/pp.png') }}"
                                     alt="Foto" style="width:56px; height:56px; object-fit:cover; border-radius:6px;">
                            </td>
                            <td>
                                <strong>{{ $dosen->nama_lengkap }}</strong>
                                <div><small class="text-muted">{{ $dosen->gelar_akademik }}</small></div>
                            </td>
                            <td>{{ $dosen->nidn_nip }}</td>
                            <td>{{ $dosen->email ?? '-' }}</td>
                            <td>{{ $dosen->getRoleLabel() }}</td>
                            <td>{{ $dosen->department ?? '-' }}</td>
                            <td>{{ Str::limit($dosen->affiliation ?? '-', 30) }}</td>
                            <td>{{ $dosen->scopus_id ? 'Yes' : 'No' }}</td>
                            <td>
                                          <a href="#" class="btn btn-sm btn-primary btn-view" data-bs-toggle="modal" data-bs-target="#dosenModal"
                                              data-dosen="{{ htmlspecialchars(json_encode($dosen->only(['nidn_nip','nama_lengkap','gelar_akademik','photo','tanggal_lahir','tempat_lahir','jenis_kelamin','alamat','email','scopus_id','google_id','wos_researcher_id','garuda_id','level_department','department','academic_grade','country','id_card','affiliation'])), ENT_QUOTES, 'UTF-8') }}">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination links --}}
            <div class="mt-3">
                {{ $dosens->appends(['q' => $query])->links('pagination::bootstrap-5') }}
            </div>
        @else
            @if($query)
                <p class="text-muted">Tidak ditemukan dosen dengan kata kunci <strong>{{ $query }}</strong>.</p>
            @endif
        @endif

        <!-- Detail Modal -->
        <div class="modal fade" id="dosenModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img id="modalPhoto" src="" alt="Foto" class="img-fluid rounded mb-3" style="max-height:220px;">
                                <h5 id="modalName"></h5>
                                <p id="modalGelar" class="text-muted small"></p>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-borderless table-sm mb-0">
                                    <tbody>
                                        <tr><th>NIDN / NIP</th><td id="modalNidn"></td></tr>
                                        <tr><th>Email</th><td id="modalEmail"></td></tr>
                                        <tr><th>Affiliasi</th><td id="modalAffiliation"></td></tr>
                                        <tr><th>Department</th><td id="modalDepartment"></td></tr>
                                        <tr><th>Role</th><td id="modalRole"></td></tr>
                                        <tr><th>Scopus ID</th><td id="modalScopus"></td></tr>
                                        <tr><th>Google Scholar</th><td id="modalGoogle"></td></tr>
                                        <tr><th>WOS ID</th><td id="modalWos"></td></tr>
                                        <tr><th>Garuda ID</th><td id="modalGaruda"></td></tr>
                                        <tr><th>Jenjang</th><td id="modalLevel"></td></tr>
                                        <tr><th>Jabatan Fungsional</th><td id="modalAcademicGrade"></td></tr>
                                        <tr><th>Negara</th><td id="modalCountry"></td></tr>
                                        <tr><th>ID Card</th><td id="modalIdCard"></td></tr>
                                        <tr><th>Alamat</th><td id="modalAddress"></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('dosenModal');
    if (!modal) return;

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const data = button ? JSON.parse(button.getAttribute('data-dosen')) : null;
        if (!data) return;

        document.getElementById('modalPhoto').src = data.photo ? ('/storage/' + data.photo) : '/images/pp.png';
        document.getElementById('modalName').textContent = data.nama_lengkap || '-';
        document.getElementById('modalGelar').textContent = data.gelar_akademik || '';
        document.getElementById('modalNidn').textContent = data.nidn_nip || '-';
        document.getElementById('modalEmail').textContent = data.email || '-';
        document.getElementById('modalAffiliation').textContent = data.affiliation || '-';
        document.getElementById('modalDepartment').textContent = data.department || '-';
        document.getElementById('modalRole').textContent = data.role ? (data.role === 'lecturer' ? 'Dosen' : 'Peneliti') : '-';
        document.getElementById('modalScopus').textContent = data.scopus_id || '-';
        document.getElementById('modalGoogle').textContent = data.google_id || '-';
        document.getElementById('modalWos').textContent = data.wos_researcher_id || '-';
        document.getElementById('modalGaruda').textContent = data.garuda_id || '-';
        document.getElementById('modalLevel').textContent = data.level_department || '-';
        document.getElementById('modalAcademicGrade').textContent = data.academic_grade || '-';
        document.getElementById('modalCountry').textContent = data.country || '-';
        document.getElementById('modalIdCard').textContent = data.id_card || '-';
        document.getElementById('modalAddress').textContent = data.alamat || '-';
    });
});
</script>
@endpush
@endsection
