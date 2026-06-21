@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Komunitas & Pengajuan</h4>
                </div>
                <div><a href="{{ route('komunitas.create') }}" class="btn btn-primary">Tambah Komunitas</a></div>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jenis</th>
                            <th>Nama Komunitas</th>
                            <th>Lokasi</th>
                            <th>Kontak</th>
                            <th>Harga/Sesi</th>
                            <th>Waktu</th>
                            <th>Link WA</th>
                            <th>Logo</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($komunitas as $index => $data)
                            <tr class="{{ $data->status != 'publish' ? 'table-warning' : '' }}">
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->jenis?->nama_jenis ?? '-' }}</td>
                                <td>
                                    <strong>{{ $data->nama_komunitas }}</strong>
                                    @if ($data->status != 'publish')
                                        <br><small class="text-muted">Oleh: {{ $data->user?->name ?? 'User Umum' }}</small>
                                    @endif
                                </td>
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
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalLogo{{ $data->id }}">
                                        Lihat
                                    </button>
                                </td>
                                <td>
                                    @if ($data->status == 'publish')
                                        <span class="badge bg-success"> Aktif</span>
                                    @elseif($data->status == 'unpublish')
                                        <span class="badge bg-danger"> Off</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pengajuan</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">Aksi</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('komunitas.show', $data->id) }}">Detail</a></li>
                                            <li><a class="dropdown-item fw-bold text-primary"
                                                    href="{{ route('komunitas.edit', $data->id) }}">Edit / Atur Status</a>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger"
                                                    data-bs-toggle="modal"
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
                    <div class="modal-body">Data komunitas <strong>{{ $data->nama_komunitas }}</strong> akan dihapus
                        permanen.</div>
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
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Logo Komunitas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        @if ($data->logo)
                            <img src="{{ asset('storage/logo_komunitas/' . $data->logo) }}" alt="{{ $data->logo }}"
                                class="img-fluid rounded" style="max-height: 350px; object-fit: contain;">
                        @else
                            <div class="text-center text-muted p-4">Logo belum ada.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
