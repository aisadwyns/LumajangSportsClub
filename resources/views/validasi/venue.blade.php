@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Pengajuan Venue</h4>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama Pemilik</th>
                            <th>Nama Venue</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($venues as $index => $venue)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $venue->id }}</td>
                                <td>{{ $venue->user?->name }}</td>
                                <td>{{ $venue->business_name }}</td>
                                <td>{{ $venue->address }}</td>
                                <td>{{ $venue->phone_number }}</td>

                                <td>
                                    <span
                                        class="badge
                                        @if ($venue->status == 'pending') bg-warning
                                        @elseif($venue->status == 'approved') bg-success
                                        @elseif($venue->status == 'rejected') bg-danger @endif">
                                        {{ $venue->status }}
                                    </span>
                                </td>

                                <td>
                                    @if ($venue->status == 'pending')
                                        <!-- APPROVE -->
                                        <form action="{{ route('admin.venues.approve', $venue->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button class="btn btn-success btn-sm">Approve</button>
                                        </form>

                                        <!-- REJECT -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#rejectModal{{ $venue->id }}">
                                            Reject
                                        </button>
                                    @else
                                        <span class="text-muted">Sudah diproses</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL REJECT --}}
    @foreach ($venues as $venue)
        <div class="modal fade" id="rejectModal{{ $venue->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.venues.reject', $venue->id) }}" method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">Tolak Venue</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <label>Alasan Penolakan</label>
                            <textarea name="reason" class="form-control" required></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Tolak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
