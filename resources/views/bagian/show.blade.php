@extends('layouts.mantis')
@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Bagian</h4>
                </div>

            </div>

            <div class="card-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bagian->teams as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->nama_lengkap }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endsection
