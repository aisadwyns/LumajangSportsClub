@extends('layouts.mantis')

@section('content')
    <main class="main">
        <div class="page-title" style="background-color: #004AAC; padding: 40px 0;">
            <div class="container text-center text-white">
                <img src="{{ $komunitas->logo ? asset('storage/logo_komunitas/' . $komunitas->logo) : asset('assets/img/health/staff-1.webp') }}"
                    class="rounded-circle mb-3"
                    style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #fff;">
                <h1>{{ $komunitas->nama_komunitas }}</h1>
                <p>{{ $komunitas->lokasi }} | Rp{{ number_format($komunitas->harga_per_sesi, 0, ',', '.') }}/sesi</p>
            </div>
        </div>

        <section class="section mt-4">
            <div class="container">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Peserta Komunitas</h5>
                        <span class="badge bg-primary">Total: {{ $komunitas->users->count() }} Peserta</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peserta</th>
                                        <th>Metode Bayar</th>
                                        <th>Status Pembayaran</th>
                                        <th>Tanggal Join</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($komunitas->users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><strong>{{ $user->name }}</strong></td>
                                            <td>
                                                @if ($user->pivot->metode_pembayaran == 'cod')
                                                    <span>Bayar di Tempat (COD)</span>
                                                @elseif($user->pivot->metode_pembayaran == 'midtrans')
                                                    <span>Transfer (Midtrans)</span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->pivot->status_pembayaran == 'paid')
                                                    <span class="badge bg-success">Lunas</span>
                                                @elseif($user->pivot->status_pembayaran == 'cod')
                                                    <span class="badge bg-info text-dark">COD</span>
                                                @elseif($user->pivot->status_pembayaran == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary">{{ $user->pivot->status_pembayaran }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->pivot->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Belum ada peserta yang
                                                bergabung.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
