@extends('layouts.mantis')

@section('content')
    <style>
        .booking-history-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        .booking-card {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
            transition: box-shadow 0.2s ease;
            position: relative;
        }

        .booking-card:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .court-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 12px;
            padding-right: 40px;
            /* Space for the top-right icon */
        }

        .status-icon-bg {
            position: absolute;
            top: 24px;
            right: 24px;
            color: #b2dfdb;
            /* Light teal color matching the ribbon in image */
            font-size: 2rem;
            opacity: 0.8;
        }

        .booking-detail-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 8px;
        }

        .booking-detail-row i {
            width: 16px;
            text-align: center;
        }

        .kode-badge {
            background-color: #d8f5f2;
            /* Light cyan matching the image */
            color: #00bcd4;
            /* Cyan text */
            font-weight: 700;
            font-size: 0.8rem;
            padding: 6px 12px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn-outline-custom {
            border: 1px solid #94a3b8;
            color: #64748b;
            background-color: #fff;
            border-radius: 20px;
            padding: 8px 18px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-outline-custom:hover {
            background-color: #f8fafc;
            color: #334155;
        }

        .btn-solid-teal {
            background-color: #14b8a6;
            /* Teal color matching the image */
            color: #ffffff;
            border: none;
            border-radius: 20px;
            padding: 8px 24px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-solid-teal:hover {
            background-color: #0d9488;
            color: #ffffff;
        }
    </style>

    <div class="container py-5">
        <div class="booking-history-wrapper">
            @forelse ($books as $book)
                <div class="booking-card">
                    {{-- Ikon pita di pojok kanan atas --}}
                    <div class="status-icon-bg">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <div class="court-title">
                        {{ $book->court->name ?? 'Lapangan Tidak Ditemukan' }}
                    </div>
                    <div class="booking-detail-row">
                        <i class="bi bi-calendar3"></i>
                        <span>{{ \Carbon\Carbon::parse($book->booking_date)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="booking-detail-row">
                        <i class="bi bi-clock"></i>
                        <span>{{ \Carbon\Carbon::parse($book->start_time)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($book->end_time)->format('H:i') }} WIB</span>
                        <span class="mx-2">•</span>
                        <span class="fw-bold text-dark">Rp {{ number_format($book->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="kode-badge">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ $book->kode_booking }}
                    </div>
                    {{-- <div class="action-buttons">
                        <a href="#" class="btn-outline-custom">
                            <i class="bi bi-receipt"></i> Invoice
                        </a>
                        <a href="#" class="btn-solid-teal">
                            Lihat Tiket
                        </a>
                    </div> --}}
                </div>
            @empty
                <div class="text-center py-5">
                    <img src="{{ asset('assets/img/empty-state.png') }}" alt="Kosong" width="150"
                        class="mb-3 opacity-50">
                    <h5 class="text-muted">Belum ada riwayat booking</h5>
                    <p class="small text-muted">Ayo mulai aktivitas olahragamu sekarang!</p>
                    <a href="{{ route('lapangan.public') }}" class="btn btn-primary mt-2">Cari Lapangan</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
