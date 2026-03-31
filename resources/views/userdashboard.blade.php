<div class="row mt-4">
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
                            <tr>
                                <td><span class="badge bg-light-warning text-warning rounded-circle p-2">#1</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/img/default-avatar.png') }}" alt="user"
                                                class="rounded-circle"
                                                style="width: 35px; height: 35px; object-fit: cover;">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Andika Wijaya</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>15 Bookings</td>
                                <td><span class="text-primary fw-bold">2,450 pts</span></td>
                                <td class="text-end"><span class="badge bg-primary">MVP</span></td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-light-secondary text-secondary rounded-circle p-2">#2</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/img/default-avatar.png') }}" alt="user"
                                                class="rounded-circle"
                                                style="width: 35px; height: 35px; object-fit: cover;">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Siti Aminah</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>12 Bookings</td>
                                <td><span class="text-primary fw-bold">2,100 pts</span></td>
                                <td class="text-end"><span class="badge bg-info">Pro</span></td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-light-danger text-danger rounded-circle p-2">#3</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/img/default-avatar.png') }}" alt="user"
                                                class="rounded-circle"
                                                style="width: 35px; height: 35px; object-fit: cover;">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Budi Santoso</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>10 Bookings</td>
                                <td><span class="text-primary fw-bold">1,850 pts</span></td>
                                <td class="text-end"><span class="badge bg-success">Starter</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <h5 class="mb-3">Active Challenges</h5>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start mb-4">
                    <div class="avtar avtar-s rounded-circle bg-light-primary text-primary flex-shrink-0">
                        <i class="ti ti-users f-20"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h6 class="mb-0">Join 3 Communities</h6>
                            <span class="text-muted small">2/3</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 66%"
                                aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted small mt-2 mb-0">Reward: 100 XP & Badge Newbie</p>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-4">
                    <div class="avtar avtar-s rounded-circle bg-light-warning text-warning flex-shrink-0">
                        <i class="ti ti-calendar-event f-20"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h6 class="mb-0">Weekly Booking</h6>
                            <span class="text-muted small">1/5</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"
                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted small mt-2 mb-0">Reward: Voucher Sewa 10%</p>
                    </div>
                </div>

                <div class="d-flex align-items-start">
                    <div class="avtar avtar-s rounded-circle bg-light-success text-success flex-shrink-0">
                        <i class="ti ti-trophy f-20"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h6 class="mb-0">First Win in Event</h6>
                            <span class="text-muted small text-success"><i class="ti ti-check"></i> Done</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-muted small mt-2 mb-0 text-decoration-line-through">Reward: Gold Medal Icon
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="#!" class="btn btn-link-primary">View All Challenges</a>
            </div>
        </div>
    </div>
</div>
