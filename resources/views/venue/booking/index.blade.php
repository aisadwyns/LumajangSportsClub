@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card shadow-sm border-0">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <div class="card-title mb-0">
                    <h4 class="fw-bold text-dark mb-0">Daftar Booking Lapangan</h4>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle" id="table">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>Booking ID</th>
                                <th>Nama Pemesan</th>
                                <th>Lapangan</th>
                                <th>Jadwal Main</th>
                                <th>Total Harga</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="10%">Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($books as $index => $book)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td><span class="text-muted fw-semibold">#BOOK-{{ $book->id }}</span></td>
                                    <td>
                                        <div class="fw-bold">{{ $book->user->name ?? 'User Tidak Ditemukan' }}</div>
                                    </td>
                                    <td>{{ $book->court?->name ?? 'Lapangan Tidak Ditemukan' }}</td>
                                    <td>
                                        <div class="fw-bold">
                                            {{ \Carbon\Carbon::parse($book->booking_date)->format('d M Y') }}</div>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($book->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($book->end_time)->format('H:i') }} WIB
                                        </small>
                                    </td>
                                    <td class="fw-bold text-primary">
                                        Rp {{ number_format($book->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $badgeClass = match ($book->status) {
                                                'pending' => 'bg-warning text-dark',
                                                'confirmed' => 'bg-primary',
                                                'completed' => 'bg-success',
                                                'cancelled' => 'bg-danger',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} px-3 py-2 rounded-pill text-uppercase"
                                            style="font-size: 0.75rem;">
                                            {{ $book->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                {{-- Opsi untuk update status booking --}}
                                                {{-- <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('venue.booking.edit', $book->id) }}">
                                                        <i class="fas fa-edit me-2 text-primary"></i> Detail & Update
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item text-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmdelete{{ $book->id }}">
                                                        <i class="fas fa-trash-alt me-2"></i> Hapus Data
                                                    </button>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">Belum ada data booking lapangan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL DELETE
    @foreach ($books as $book)
        <div class="modal fade" id="confirmdelete{{ $book->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold text-danger">Konfirmasi Pembatalan/Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body py-4">
                        <p class="mb-0">Apakah Anda yakin ingin menghapus data booking
                            <td><span class="text-muted fw-semibold">{{ $book->kode_booking }}</span></td> atas nama
                            <strong>{{ $book->user->name ?? 'User' }}</strong>?
                        </p>
                        <p class="text-muted small mt-2 mb-0">Tindakan ini tidak dapat dibatalkan dan akan menghapus data
                            dari *database* secara permanen.</p>
                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <form action="{{ route('venue.booking.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}
@endsection
