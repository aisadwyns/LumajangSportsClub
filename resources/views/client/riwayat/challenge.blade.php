@extends('layouts.mantis')

@section('content')
    <div class="container-fluid">
        {{-- Header Sisi Client --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Tantangan & Kompetisi</h4>
                <p class="text-muted small mb-0">Selesaikan misi olahraga, kumpulkan poin reward, dan jadilah juara!</p>
            </div>
        </div>

        <div class="row">
            @forelse ($challenges as $challenge)
                @php
                    // Ambil relasi partisipasi user saat ini
                    $participation = $challenge->participants->first();
                    $isJoined = $participation ? true : false;

                    // Hitung persentase progres secara presisi untuk width style
                    $currentProgress = $participation ? $participation->progress : 0;
                    $percentage = min(($currentProgress / $challenge->target_amount) * 100, 100);
                @endphp

                <div class="col-md-6 col-lg-4 mb-4">
                    {{-- KONDISI 1: JIKA USER SUDAH JOIN (Tampilan Biru Gradient Khas LSC) --}}
                    @if ($isJoined)
                        <div class="card h-100 shadow border-0"
                            style="border-radius: 16px; background: linear-gradient(135deg, #004aac 0%, #002657 100%); color: white; min-height: 380px;">
                            <div class="card-body d-flex flex-column justify-content-between p-4">

                                {{-- Top Row Meta --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge text-white px-2 py-1"
                                        style="font-size: 11px; background: rgba(255,255,255,0.15); border-radius: 6px;">
                                        <i class="ti ti-coins"></i> +{{ number_format($challenge->reward_coin) }} Poin
                                    </span>
                                    <div class="text-white-50"><i class="ti ti-dots-vertical"></i></div>
                                </div>

                                {{-- Main Title Section --}}
                                <div>
                                    <h4 class="fw-bold text-white mb-1" style="letter-spacing: -0.5px;">
                                        {{ $challenge->title }}
                                    </h4>
                                    <small class="text-white-50 d-block mb-3">
                                        Batas Akhir: {{ \Carbon\Carbon::parse($challenge->end_date)->format('d/m/Y') }}
                                    </small>
                                </div>

                                {{-- Progress Bar Baris Tunggal (Angka Progres/Target) --}}
                                <div class="my-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small class="text-white-50" style="font-size: 12px;">Progres Kamu</small>
                                        <span class="fw-bold text-white" style="font-size: 13px;">
                                            {{ $currentProgress }} / {{ $challenge->target_amount }}
                                        </span>
                                    </div>
                                    <div class="progress"
                                        style="height: 6px; background-color: rgba(255, 255, 255, 0.2); border-radius: 10px;">
                                        <div class="progress-bar bg-white" role="progressbar"
                                            style="width: {{ $percentage }}%; border-radius: 10px;"></div>
                                    </div>
                                </div>

                                {{-- 3-Column Statistics Sederhana di Bagian Bawah Card --}}
                                <div class="row text-center my-3 p-2 rounded-3" style="background: rgba(0,0,0,0.15);">
                                    <div class="col-4 border-end border-white-10">
                                        <h4 class="fw-bold mb-0 text-white" style="font-size: 16px;">
                                            {{ $challenge->target_amount }}</h4>
                                        <small class="text-white-50 text-uppercase d-block"
                                            style="font-size: 9px; letter-spacing: 0.5px;">Target</small>
                                    </div>
                                    <div class="col-4 border-end border-white-10">
                                        <h4 class="fw-bold mb-0 text-warning" style="font-size: 16px;">
                                            {{ $currentProgress }}</h4>
                                        <small class="text-white-50 text-uppercase d-block"
                                            style="font-size: 9px; letter-spacing: 0.5px;">Selesai</small>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="fw-bold mb-0 text-white" style="font-size: 16px;">
                                            {{ $challenge->total_winner }}</h4>
                                        <small class="text-white-50 text-uppercase d-block"
                                            style="font-size: 9px; letter-spacing: 0.5px;">Kuota</small>
                                    </div>
                                </div>

                                {{-- Action Button & Status Badge Footer --}}
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    @if ($participation->status == 'completed')
                                        <span class="badge bg-success px-3 py-2" style="border-radius: 6px;">FINISHED</span>
                                        <button class="btn btn-light btn-sm disabled fw-bold" disabled>
                                            <i class="ti ti-check"></i> Selesai
                                        </button>
                                    @else
                                        <span class="badge px-3 py-2 text-dark fw-bold"
                                            style="background-color: #D1F4FF !important; border-radius: 6px;">DIIKUTI</span>
                                        <button class="btn btn-sm fw-bold shadow-sm"
                                            style="background: #fff; color: #004aac; border-radius: 8px;" disabled>
                                            Running...
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- KONDISI 2: JIKA USER BELUM JOIN (Tampilan Card Putih dengan Aksen Biru LSC) --}}
                    @else
                        <div class="card h-100 shadow-sm border border-light"
                            style="border-radius: 16px; min-height: 380px; background: #ffffff;">
                            <div class="card-body d-flex flex-column justify-content-between p-4">

                                {{-- Top Row Meta --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge px-2 py-1"
                                        style="font-size: 11px; border-radius: 6px; background-color: #e6f0ff; color: #004aac !important;">
                                        <i class="ti ti-coins"></i> +{{ number_format($challenge->reward_coin) }} Poin
                                    </span>
                                    <div class="text-muted"><i class="ti ti-dots-vertical"></i></div>
                                </div>

                                {{-- Main Title Section --}}
                                <div>
                                    <h4 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">
                                        {{ $challenge->title }}
                                    </h4>
                                    <small class="text-muted d-block mb-2">
                                        Batas Akhir: {{ \Carbon\Carbon::parse($challenge->end_date)->format('d/m/Y') }}
                                    </small>
                                    <p class="text-muted small text-truncate-2" style="font-size: 13px;">
                                        {{ $challenge->description ?? 'Mainkan tipe olahraga pilihanmu dan akumulasikan kemenangan kontes sekarang.' }}
                                    </p>
                                </div>

                                {{-- Progress Bar Baris Tunggal Status 0 --}}
                                <div class="my-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small class="text-muted" style="font-size: 12px;">Progres Capaian</small>
                                        <span class="fw-bold text-muted" style="font-size: 13px;">
                                            0 / {{ $challenge->target_amount }}
                                        </span>
                                    </div>
                                    <div class="progress"
                                        style="height: 6px; background-color: #EAECF0; border-radius: 10px;">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: 0%; border-radius: 10px; background-color: #004aac;"></div>
                                    </div>
                                </div>

                                {{-- 3-Column Statistics Sederhana di Bagian Bawah Card --}}
                                <div class="row text-center my-3 p-2 rounded-3"
                                    style="background-color: #F9FAFB !important;">
                                    <div class="col-4 border-end">
                                        <h4 class="fw-bold mb-0" style="color: #004aac; font-size: 16px;">
                                            {{ $challenge->target_amount }}</h4>
                                        <small class="text-muted text-uppercase d-block"
                                            style="font-size: 9px; letter-spacing: 0.5px;">Target</small>
                                    </div>
                                    <div class="col-4 border-end">
                                        <h4 class="fw-bold mb-0 text-muted" style="font-size: 16px;">0</h4>
                                        <small class="text-muted text-uppercase d-block"
                                            style="font-size: 9px; letter-spacing: 0.5px;">Selesai</small>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="fw-bold mb-0" style="color: #004aac; font-size: 16px;">
                                            {{ $challenge->total_winner }}</h4>
                                        <small class="text-muted text-uppercase d-block"
                                            style="font-size: 9px; letter-spacing: 0.5px;">Kuota</small>
                                    </div>
                                </div>

                                {{-- Action Button & Status Badge Footer --}}
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="badge text-muted px-3 py-2"
                                        style="background-color: #F2F4F7 !important; border-radius: 6px; color: #344054 !important;">AVAILABLE</span>

                                    <form action="{{ route('challenges.join', $challenge->id) }}" method="POST"
                                        class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-sm text-white fw-bold"
                                            style="border-radius: 8px; background-color: #004aac; border-color: #004aac;">
                                            Ikut Misi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                {{-- State Kosong --}}
                <div class="col-12 text-center py-5">
                    <div class="card p-5 border-0 shadow-sm" style="border-radius: 16px;">
                        <h5 class="text-muted mb-0">Belum ada tantangan aktif yang bisa diikuti saat ini.</h5>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Tambahan CSS khusus merapikan layout --}}
    <style>
        .border-white-10 {
            border-color: rgba(255, 255, 255, 0.15) !important;
        }

        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 38px;
        }
    </style>
@endsection
