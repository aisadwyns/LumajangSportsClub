@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Komunitas</h4>
                </div>
                <div><a href="{{ route('komunitas.create') }}" class="btn btn-primary">Tambah Komunitas</a></div>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Jenis</th>
                            <th>Nama Komunitas</th>
                            <th>Lokasi</th>
                            <th>Kontak</th>
                            <th>Harga/Sesi</th>
                            <th>Waktu</th>
                            <th>Link WA</th>
                            <th>Logo</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($komunitas as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->jenis?->nama ?? '-' }}</td>
                                <td>{{ $data->nama_komunitas }}</td>
                                <td>{{ $data->lokasi ?? '-' }}</td>
                                <td>{{ $data->kontak ?? '-' }}</td>
                                <td>{{ number_format($data->harga_per_sesi ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $data->waktu ?? '-' }}</td>
                                <td>
                                    @if ($data->link_wa)
                                        <a href="{{ $data->link_wa }}" target="_blank"
                                            class="btn btn-sm btn-success">Buka</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalLogo{{ $data->id }}">
                                        Lihat Logo
                                    </button>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">Aksi</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('komunitas.edit', $data->id) }}">Edit</a></li>
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
    @foreach ($komunitas as $data)
        <div class="modal fade" id="confirmdelete{{ $data->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Lanjutkan penghapusan data?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">Data komunitas akan dihapus permanen.</div>
                    <div class="modal-footer">
                        <form action="{{ route('komunitas.destroy', $data->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Lanjutkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Logo --}}
    @foreach ($komunitas as $data)
        <div class="modal fade" id="modalLogo{{ $data->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Logo Komunitas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($data->logo)
                            <img src="{{ asset('storage/logo_komunitas/' . $data->logo) }}" alt="{{ $data->logo }}"
                                class="img-fluid">
                        @else
                            <div class="text-center">Logo belum ada.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
