@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Data Dosen</h1>
        <button class="btn btn-primary mb-3">Tambah Data Dosen</button>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">+ Tambah Dosen</a>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>NIDN</th>
                    <th>Gelar Akademik</th>
                    <th>Tempat </th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat & Kontak</th>
                    {{-- <th>Riwayat Pendidikan</th>
                    <th>Jenjang Pendidikan Terakhir</th>
                    <th>Nama Perguruan Tinggi</th>
                    <th>Bidang Keilmuan</th>
                    <th>Tahun Lulus</th>
                    <th>Jabatan & Status</th>
                    <th>Jabaran Fungsional</th> --}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Budi</td>
                    <td>budi@example.com</td>
                    <td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
