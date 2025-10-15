@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Cari Profil Dosen</h3>

        <form action="{{ route('pangkalan.profil') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="q" class="form-control"
                       placeholder="Cari nama, NIDN, atau keahlian..."
                       value="{{ $query ?? '' }}">
                <button class="btn btn-success" type="submit">Cari</button>
            </div>
        </form>

        @if(isset($dosens) && $dosens->count())
            <div class="row">
                @foreach($dosens as $dosen)
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ $dosen->photo ? asset('storage/'.$dosen->photo) : asset('images/pp.png') }}"
                                 class="card-img-top" alt="Foto Dosen">
                            <div class="card-body">
                                <h5 class="card-title">{{ $dosen->nama_lengkap }}</h5>
                                <p class="card-text">NIDN: {{ $dosen->nidn_nip }}</p>
                                <p class="card-text">Keahlian: {{ $dosen->keahlian ?? 'Not input yet' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
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
    </div>
@endsection
