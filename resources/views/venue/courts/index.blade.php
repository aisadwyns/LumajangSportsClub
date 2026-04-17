@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Court</h4>
                </div>
                <div>
                    <a href="{{ route('venue.court.create') }}" class="btn btn-primary">
                        Tambah Court
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama Court</th>
                            <th>Sport</th>
                            <th>Tipe</th>
                            <th>Harga/Jam</th>
                            <th>Jam Operasional</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($courts as $index => $court)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $court->id }}</td>
                                <td>{{ $court->name }}</td>
                                <td>{{ $court->sport_type }}</td>
                                <td>{{ $court->court_type ?? '-' }}</td>
                                <td>Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}</td>
                                <td>
                                    {{ $court->open_time ?? '-' }} - {{ $court->close_time ?? '-' }}
                                </td>
                                <td>
                                    <span
                                        class="badge
                                        @if ($court->status == 'active') bg-success
                                        @else bg-danger @endif">
                                        {{ $court->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Aksi
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('venue.court.edit', $court->id) }}">
                                                    Edit
                                                </a>
                                            </li>

                                            <li>
                                                <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirmdelete{{ $court->id }}">
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

    {{-- MODAL DELETE --}}
    @foreach ($courts as $court)
        <div class="modal fade" id="confirmdelete{{ $court->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Court?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        Data court akan dihapus permanen.
                    </div>

                    <div class="modal-footer">
                        <form action="{{ route('venue.court.destroy', $court->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit" class="btn btn-danger">
                                Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
