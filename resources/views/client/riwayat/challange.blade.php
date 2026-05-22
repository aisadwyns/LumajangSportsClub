@extends('client.app') <!-- Sesuaikan dengan nama layout master Kakak -->

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold text-dark">🏆 Lumajang Sports Club Challenges</h2>
                <p class="text-muted">Selesaikan misi di bawah ini dan kumpulkan poin reward-mu!</p>
            </div>
        </div>

        <div class="row">
            @forelse($challenges as $challenge)
                @php
                    // Mengambil data pivot milik user login jika ada
                    $userProgress = $challenge->participants->first();
                    $currentProgress = $userProgress ? $userProgress->pivot->current_progress : 0;
                    $isCompleted = $userProgress && $userProgress->pivot->status === 'completed';

                    // Hitung persen progress bar (maksimal 100%)
                    $percentage = ($currentProgress / $challenge->target_amount) * 100;
                    $percentage = $percentage > 100 ? 100 : $percentage;
                @endphp

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 position-relative">

                        <!-- Badge Status Tergantung Penyelesaian Misi -->
                        <div class="position-absolute top-0 end-0 mt-3 me-3">
                            @if ($isCompleted)
                                <span class="badge bg-success px-3 py-2 rounded-pill">Selesai Clamed</span>
                            @else
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Berjalan</span>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column pt-4">
                            <span class="text-uppercase tracking-wider small fw-bold text-primary mb-1">
                                {{ str_replace('_', ' ', $challenge->tipe_misi) }}
                            </span>
                            <h5 class="card-title fw-bold text-dark mb-2">{{ $challenge->judul }}</h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ $challenge->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                            <!-- Progress Section -->
                            <div class="mt-4">
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>Progress Misi</span>
                                    <span class="fw-bold text-dark">{{ $currentProgress }} /
                                        {{ $challenge->target_amount }}</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 10px;">
                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                        role="progressbar" style="width: {{ $percentage }}%"
                                        aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>

                            <hr class="text-muted my-3">

                            <!-- Footer Info Card -->
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <div>
                                    <span class="d-block text-muted small">Hadiah:</span>
                                    <span class="fw-bold text-warning fs-5">🪙 +{{ $challenge->poin_reward }} Poin</span>
                                </div>
                                <div class="text-end">
                                    <span class="d-block text-muted small">Berakhir pada:</span>
                                    <span
                                        class="small fw-semibold text-danger">{{ $challenge->end_date->format('d M Y') }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted fs-4">Belum ada *challenge* aktif saat ini. Tetap pantau terus ya!</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
