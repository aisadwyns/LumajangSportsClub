@extends('layouts.mantis')

@section('content')
    @foreach ($riwayat as $i => $data)
        <div class="col-lg-4 col-md-6">
            <a href="{{ route('komunitas.show', $data->id) }}" class="text-decoration-none text-reset">
                <div class="doctor-card h-100 p-4 border-0 shadow-sm" style="border-radius: 12px;">

                    <div class="text-end mb-2">
                        <span class="fw-bold text-uppercase" style="font-size: 0.65rem; color: #28a745;">
                            • Terdaftar
                        </span>
                    </div>

                    <div class="text-center">
                        <img src="{{ $data->logo ? asset('storage/logo_komunitas/' . $data->logo) : asset('assets/img/health/staff-1.webp') }}"
                            class="img-fluid rounded-circle mb-3"
                            style="width: 100px; height: 100px; object-fit: cover; background-color: #f8f9fa;">

                        <h5 class="fw-bold mb-1">{{ $data->nama_komunitas }}</h5>
                        <p class="text-muted small mb-3">{{ $data->jenis?->nama ?? '-' }}</p>
                    </div>

                    <hr class="my-3" style="opacity: 0.1;">

                    <div class="small text-secondary">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Lokasi</span>
                            <span class="text-dark fw-medium">{{ $data->lokasi ?? '-' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Jadwal</span>
                            <span class="text-dark fw-medium">{{ $data->waktu ? substr($data->waktu, 0, 5) : '-' }}
                                WIB</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Bergabung Pada</span>
                            {{-- <span class="text-dark fw-medium">{{ $data->pivot->created_at->format('d M Y') }}</span> --}}
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Metode Pembayaran</span>
                            <span class="text-primary fw-bold text-uppercase" style="font-size: 0.75rem;">
                                {{-- @if ($method == 'midtrans')
                                    <span class="text-primary fw-bold text-uppercase" style="font-size: 0.75rem;">
                                        <i class="bi bi-credit-card me-1"></i> ONLINE (MIDTRANS)
                                    </span>
                                @else
                                    <span class="text-primary fw-bold text-uppercase" style="font-size: 0.75rem;">
                                        <i class="bi bi-credit-card me-1"></i> Bayar DI Tempat
                                    </span>
                                @endif --}}
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
@endsection
