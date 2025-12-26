@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Member</h4>
                </div>
                <div>
                    <a href="{{ route('member.create') }}" class="btn btn-primary">
                        Tambah Member
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Nama Club</th>
                            <th>Nomor Telpon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datamember as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->nama_lengkap }}</td>
                                <td>{{ $data->nama_club }}</td>
                                <td>{{ $data->no_telpon }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
