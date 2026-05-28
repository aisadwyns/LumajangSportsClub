@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Tantangan (Challenge)</h4>
                </div>
                <div>
                    <a href="{{ route('challenge.create') }}" class="btn btn-primary">
                        Tambah Tantangan
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Judul Tantangan</th>
                            <th>Tipe Kriteria</th>
                            <th>Target Akumulasi</th>
                            <th>Hadiah Koin</th>
                            <th>Kuota Pemenang</th>
                            <th>Periode Kontes</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($challenges as $index => $challenge)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $challenge->id }}</td>
                                <td><strong>{{ $challenge->title }}</strong></td>
                                <td>{{ $challenge->challengeType->name }}</td>
                                <td>{{ number_format($challenge->target_amount, 0, ',', '.') }}x Selesai</td>
                                <td>{{ number_format($challenge->reward_coin, 0, ',', '.') }} Koin</td>
                                <td>{{ $challenge->total_winner }} User</td>
                                <td>
                                    <small>
                                        {{ \Carbon\Carbon::parse($challenge->start_date)->format('d M Y H:i') }}
                                        <br> s/d <br>
                                        {{ \Carbon\Carbon::parse($challenge->end_date)->format('d M Y H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <span
                                        class="badge
                                        @if ($challenge->status == 'active') bg-success
                                        @elseif($challenge->status == 'draft') bg-warning
                                        @else bg-danger @endif">
                                        {{ strtoupper($challenge->status) }}
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
                                                    href="{{ route('challenge.edit', $challenge->id) }}">
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <button type="button" class="btn text-danger dropdown-item"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmdelete{{ $challenge->id }}">
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
    @foreach ($challenges as $challenge)
        <div class="modal fade" id="confirmdelete{{ $challenge->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Tantangan?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus tantangan <strong>{{ $challenge->title }}</strong>? Data
                        partisipan yang terhubung akan otomatis dihapus secara permanen.
                    </div>

                    <div class="modal-footer">
                        <form action="{{ route('challenge.destroy', $challenge->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
