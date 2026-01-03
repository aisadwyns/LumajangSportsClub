@extends('layouts.mantis')

@section('content')
    <div class="">
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
                            <th>Opsi</th>

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
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('member.edit', $data->id) }}">Edit</a></li>
                                            <li><button type="button" class="btn text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirmdelete{{ $data->id }}">
                                                    Hapus data
                                                </button></li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($datamember as $data)
        <!-- Modal -->
        <div class="modal fade" id="confirmdelete{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lanjutkan penghapusan data?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Data akan dihapus permanen, klik lanjutkan untuk menghapus data
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('member.destroy', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Lanjutkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
