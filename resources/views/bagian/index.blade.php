@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Lapangan</h4>
                </div>
                <div>
                    <a href="{{ route('lapangan.create') }}" class="btn btn-primary">
                        Tambah Lapangan
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bagian</th>

                            <th>Opsi</th>

                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($bagian as $index => $data)
                            <tr>
                                @csrf
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->nama_bagian }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $data->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $data->id }}">
                                            <li><a class="dropdown-item text-primary"
                                                    href="{{ route('bagian.show', $data->id) }}">
                                                    Detail</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('lapangan.edit', $data->id) }}">Edit</a></li>
                                            <li> <button type="button"
                                                    class="dropdown-item text-danger"data-bs-toggle="modal"
                                                    data-bs-target="#confirmdelete{{ $data->id }}">Hapus data</button>
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

    @foreach ($bagian as $data)
        <!-- Modal -->
        <div class="modal fade" id="confirmdelete{{ $data->id }}" tabindex="-1"
            aria-labelledby="deleteLapanganLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteLapanganLabel{{ $data->id }}">
                            Lanjutkan penghapusan data lapangan?
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Data <strong>{{ $data->nama_lapangan }}</strong> akan dihapus permanen.
                            Klik <b>Lanjutkan</b> untuk menghapus data.</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('lapangan.destroy', $data->id) }}" method="POST">
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
    @foreach ($bagian as $data)
        <div class="modal fade" id="modalFoto{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Foto Lapangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/foto_lapangan/' . $data->foto) }}" alt="{{ $data->foto }}"
                            class="img-fluid">
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
