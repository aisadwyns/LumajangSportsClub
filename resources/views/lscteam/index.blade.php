@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar LSC Team</h4>
                </div>
                <div>
                    <a href="{{ route('lscteam.create') }}" class="btn btn-primary">
                        Tambah LSC Team
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
                            <th>NIK</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Jobdesk</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teams as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->nama_lengkap }}</td>
                                <td>{{ $data->nik }}</td>
                                <td>{{ $data->user->email }}</td>
                                <td>{{ $data->nomor_hp }}</td>
                                <td>{{ $data->jobdesk }}</td>
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalFoto{{ $data->id }}"> Lihat Foto</button></td>
                                <td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('lscteam.edit', $data->id) }}">
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirmdelete{{ $data->id }}">
                                                    Hapus data
                                                </button>
                                            </li>
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

    {{-- Modal Delete --}}
    @foreach ($teams as $data)
        <div class="modal fade" id="confirmdelete{{ $data->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Lanjutkan penghapusan data?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Data LSC Team akan dihapus permanen.
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('lscteam.destroy', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-danger">
                                Lanjutkan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @foreach ($teams as $data)
        <div class="modal fade" id="modalFoto{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Foto Lapangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/foto_lscteam/' . $data->foto) }}" alt="{{ $data->foto }}"
                            class="img-fluid">
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
