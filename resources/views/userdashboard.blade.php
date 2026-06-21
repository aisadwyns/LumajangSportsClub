<!-- ====== BARIS BAWAH: LEADERBOARD & ACTIVE CHALLENGES ====== -->
<div class="row">
    <!-- TOP PLAYERS LEADERBOARD -->
    <div class="col-md-12 col-xl-8 mb-4 mb-xl-0">
        <h5 class="mb-3">Top Players Leaderboard</h5>
        <div class="card tbl-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless mb-0">
                        <thead>
                            <tr>
                                <th>RANK</th>
                                <th>MEMBER</th>
                                <th>ACTIVITY</th>
                                <th>POINTS</th>
                                <th class="text-end">LEVEL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topPlayers as $index => $player)
                                <tr>
                                    <td>
                                        <!-- Logika Pewarnaan Badge Rank -->
                                        @if ($index == 0)
                                            <span
                                                class="badge bg-light-warning text-warning rounded-circle p-2">#1</span>
                                        @elseif($index == 1)
                                            <span
                                                class="badge bg-light-secondary text-secondary rounded-circle p-2">#2</span>
                                        @elseif($index == 2)
                                            <span class="badge bg-light-danger text-danger rounded-circle p-2">#3</span>
                                        @else
                                            <span
                                                class="badge bg-light-primary text-primary rounded-circle p-2">#{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $player->profile?->avatar ? asset('storage/avatar_user/' . $player->profile->avatar) : asset('client/dist/assets/img/customavatar-' . (($player->id % 5) + 1) . '.png') }}"
                                                    alt="user" class="rounded-circle"
                                                    style="width: 35px; height: 35px; object-fit: cover;">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0">{{ $player->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $player->bookings_count }} Bookings</div>
                                        <small class="text-muted">{{ $player->communities_count ?? 0 }}
                                            Komunitas</small>
                                    </td>
                                    <td><span class="text-primary fw-bold">{{ number_format($player->points) }}
                                            pts</span></td>
                                    <td class="text-end">
                                        <!-- Logika Penentuan Level Berdasarkan Poin -->
                                        @if ($player->points >= 2000)
                                            <span class="badge bg-primary">MVP</span>
                                        @elseif($player->points >= 1000)
                                            <span class="badge bg-info">Pro</span>
                                        @else
                                            <span class="badge bg-success">Starter</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ACTIVE CHALLENGES -->
    <div class="col-md-12 col-xl-4">
        <h5 class="mb-3" style="font-weight: 600; color: #2D3748;">Active Challenges</h5>
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                @forelse($activeChallenges as $challenge)
                    @php
                        // 🌟 REVISI: Ambil langsung dari data pivot yang dikirim oleh relasi user
                        $currentProgress = $challenge->pivot->progress ?? 0;
                        $target = $challenge->target_amount;

                        // Hitung persentase progress bar (maksimal 100%)
                        $percentage = $target > 0 ? ($currentProgress / $target) * 100 : 0;
                        $percentage = $percentage > 100 ? 100 : $percentage;

                        // Tentukan style warna dan ikon berdasarkan tipe challenge (challenge_type_id)
                        // 1: Akumulasi Booking Lapangan (Warning/Kuning)
                        // 2: Akumulasi Gabung Komunitas (Primary/Biru)
                        $isBooking = $challenge->challenge_type_id == 1;
                        $avatarClass = $isBooking ? 'bg-light-warning text-warning' : 'bg-light-primary text-primary';
                        $iconClass = $isBooking ? 'ti ti-calendar-event' : 'ti ti-users';
                    @endphp

                    <div class="d-flex align-items-start {{ !$loop->last ? 'mb-4' : '' }}">
                        <div class="avtar avtar-s rounded-circle {{ $avatarClass }} flex-shrink-0">
                            <i class="{{ $iconClass }} f-20"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <h6 class="mb-0" style="font-weight: 600; color: #1A202C;">{{ $challenge->title }}
                                </h6>

                                {{-- 🌟 Kondisi dinamis membaca status dari data pivot --}}
                                @if ($currentProgress >= $target)
                                    <span class="text-success small fw-bold"><i class="ti ti-check"></i> Done</span>
                                @else
                                    <span class="text-muted small">{{ $currentProgress }}/{{ $target }}</span>
                                @endif
                            </div>

                            <div class="progress" style="height: 6px; background-color: #EDF2F7;">
                                <div class="progress-bar {{ $isBooking ? 'bg-warning' : 'bg-primary' }}"
                                    role="progressbar" style="width: {{ $percentage }}%"
                                    aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <p
                                class="text-muted small mt-2 mb-0 {{ $currentProgress >= $target ? 'text-decoration-line-through' : '' }}">
                                Reward: <span class="fw-semibold text-dark">{{ $challenge->reward_coin }} Coins</span>
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-3">
                        <i class="ti ti-trophy f-28 d-block mb-2 text-secondary"></i>
                        Tidak ada tantangan aktif saat ini.
                    </div>
                @endforelse
            </div>
            <div class="card-footer bg-transparent border-0 text-center pb-4">
                <a href="{{ route('challenges.index') }}" class="btn btn-link-primary p-0 fw-semibold">Lihat Semua
                    Challenges</a>
            </div>
        </div>
    </div>
</div>
<!-- ====== BARIS ATAS: RIWAYAT BOOKING & KOMUNITAS ====== -->
<div class="row mb-4">
    <!-- RIWAYAT BOOKING TERBARU -->
    <div class="col-md-12 col-xl-7 mb-4 mb-xl-0">
        <h5 class="mb-3">Riwayat Booking Lapangan</h5>
        <div class="card">
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle mb-0">
                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="avtar avtar-s rounded-circle bg-light-info text-info flex-shrink-0">
                                                <i class="ti ti-calendar-stats f-20"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-1 text-truncate" style="max-width: 220px;">
                                                    {{ $book->court->name ?? 'Lapangan Tidak Ditemukan' }}
                                                </h6>
                                                <span class="text-muted small">
                                                    {{ \Carbon\Carbon::parse($book->booking_date)->translatedFormat('d F Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-muted small">
                                            <i class="ti ti-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($book->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($book->end_time)->format('H:i') }} WIB
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-light-cyan text-cyan border border-cyan-100 px-2 py-1 fw-bold">
                                            {{ $book->kode_booking }}
                                        </span>
                                    </td>
                                    <td class="text-end text-dark fw-semibold">
                                        Rp {{ number_format($book->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <p class="text-muted mb-2 small">Belum ada riwayat booking.</p>
                                        <a href="{{ route('lapangan.public') }}"
                                            class="btn btn-sm btn-light-primary">Cari Lapangan</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- KOMUNITAS YANG DIIKUTI -->
    <div class="col-md-12 col-xl-5">
        <h5 class="mb-3">Komunitas Saya</h5>
        <div class="card">
            <div class="card-body p-3" style="max-height: 295px; overflow-y: auto;">
                <div class="d-flex flex-column gap-3">
                    @forelse ($komunitas as $data)
                        <a href="{{ route('komunitas.show', $data->id) }}" class="text-decoration-none text-reset">
                            <div
                                class="d-flex align-items-center justify-content-between p-2 rounded bg-light-secondary-hover transition-all">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $data->komunitas?->logo ? asset('storage/logo_komunitas/' . $data->komunitas->logo) : asset('assets/img/health/staff-1.webp') }}"
                                        class="rounded-circle me-3 border"
                                        style="width: 45px; height: 45px; object-fit: cover; background-color: #f8f9fa;">
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $data->komunitas?->nama_komunitas }}</h6>
                                        <small class="text-muted">{{ $data->komunitas?->jenis?->nama_jenis ?? '-' }}
                                            • <i class="ti ti-map-pin small"></i>
                                            {{ $data->komunitas?->lokasi ?? '-' }}</small>
                                        <small class="text-muted">
                                            • <i class="ti ti-map-pin small"></i>
                                            {{ $data->komunitas?->waktu ?? '-' }}</small>
                                    </div>
                                </div>
                                <span class="badge bg-light-success text-success text-uppercase small"
                                    style="font-size: 0.65rem;">
                                    • Terdaftar
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-5">
                            <p class="text-muted small mb-0">Kamu belum bergabung dengan komunitas manapun.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Tambahan Style Kustom untuk Penyelarasan Tema -->
<style>
    .bg-light-cyan {
        background-color: rgba(0, 188, 212, 0.1);
    }

    .text-cyan {
        color: #00bcd4;
    }

    .border-cyan-100 {
        border-color: rgba(0, 188, 212, 0.2) !important;
    }

    .bg-light-secondary-hover:hover {
        background-color: var(--bs-gray-100);
        transition: background-color 0.2s ease-in-out;
    }

    .transition-all {
        transition: all 0.2s ease-in-out;
    }
</style>
