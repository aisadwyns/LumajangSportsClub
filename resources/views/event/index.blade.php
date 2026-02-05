@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Event</h4>
                </div>
                <div>
                    <a href="{{ route('events.create') }}" class="btn btn-primary">
                        Tambah Event
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Jenis Komunitas</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Thumbnail</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->jenisKomunitas?->nama_jenis }}</td>
                                <td>{{ $data->event_date }}</td>
                                <td>{{ $data->location }}</td>
                                <td>
                                    <span class="badge bg-{{ $data->status == 'published' ? 'success' : 'secondary' }}">
                                        {{ $data->status }}
                                    </span>
                                </td>
                                <td>
                                    @if ($data->thumbnail)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalThumbnail{{ $data->id }}">
                                            Lihat
                                        </button>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('events.edit', $data->id) }}">
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
    @foreach ($events as $data)
        <div class="modal fade" id="confirmdelete{{ $data->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Lanjutkan penghapusan data?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Data event akan dihapus permanen.
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('events.destroy', $data->id) }}" method="POST">
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

    {{-- Modal Thumbnail --}}
    @foreach ($events as $data)
        @if ($data->thumbnail)
            <div class="modal fade" id="modalThumbnail{{ $data->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thumbnail Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset('storage/thumbnail_event/' . $data->thumbnail) }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
