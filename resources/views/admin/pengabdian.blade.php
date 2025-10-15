@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dosen</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Budi</td>
                <td>budi@example.com</td>
                <td><a href="#" class="btn btn-sm btn-primary">Tambah Pengabdian</a></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection