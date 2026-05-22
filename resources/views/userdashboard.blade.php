<div class="row mt-4">
    <!-- TOP PLAYERS LEADERBOARD -->
    <div class="col-md-12 col-xl-8">
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
                                                <!-- Anda bisa mengganti ini dengan avatar dari DB jika ada -->
                                                <img src="{{ asset('assets/img/default-avatar.png') }}" alt="user"
                                                    class="rounded-circle"
                                                    style="width: 35px; height: 35px; object-fit: cover;">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0">{{ $player->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $player->bookings_count }} Bookings</td>
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
        <h5 class="mb-3">Active Challenges</h5>
        <div class="card">
            <div class="card-body">

                <!-- Challenge 1: Join Komunitas -->
                <div class="d-flex align-items-start mb-4">
                    <div class="avtar avtar-s rounded-circle bg-light-primary text-primary flex-shrink-0">
                        <i class="ti ti-users f-20"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h6 class="mb-0">Join 3 Communities</h6>
                            <span class="text-muted small">{{ $joinedCommunitiesCount }}/3</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $progressKomunitas > 100 ? 100 : $progressKomunitas }}%"
                                aria-valuenow="{{ $progressKomunitas }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted small mt-2 mb-0">Reward: 100 XP & Badge Newbie</p>
                    </div>
                </div>

                <!-- Challenge 2: Weekly Booking -->
                <div class="d-flex align-items-start mb-4">
                    <div class="avtar avtar-s rounded-circle bg-light-warning text-warning flex-shrink-0">
                        <i class="ti ti-calendar-event f-20"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h6 class="mb-0">Weekly Booking</h6>
                            <span class="text-muted small">{{ $weeklyBookingCount }}/5</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $progressBooking > 100 ? 100 : $progressBooking }}%"
                                aria-valuenow="{{ $progressBooking }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted small mt-2 mb-0">Reward: Voucher Sewa 10%</p>
                    </div>
                </div>

                <!-- Challenge 3: First Win (Contoh Status Komplit) -->
                <div class="d-flex align-items-start">
                    <div class="avtar avtar-s rounded-circle bg-light-success text-success flex-shrink-0">
                        <i class="ti ti-trophy f-20"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h6 class="mb-0">First Booking Success</h6>
                            @if (auth()->user()->bookings()->where('status', 'success')->exists())
                                <span class="text-muted small text-success"><i class="ti ti-check"></i> Done</span>
                            @else
                                <span class="text-muted small">0/1</span>
                            @endif
                        </div>
                        <div class="progress" style="height: 6px;">
                            @if (auth()->user()->bookings()->where('status', 'success')->exists())
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                        </div>
                        <p
                            class="text-muted small mt-2 mb-0 {{ auth()->user()->bookings()->where('status', 'success')->exists() ? 'text-decoration-line-through' : '' }}">
                            Reward: First 50 Points</p>
                    </div>
                </div>

            </div>
            <div class="card-footer text-center">
                <a href="#!" class="btn btn-link-primary">View All Challenges</a>
            </div>
        </div>
    </div>
</div>
