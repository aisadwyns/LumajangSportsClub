@extends('layouts.client')
@section('content')
    <div class="container-fluid py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #004AAC;">CHAMPIONS</h2>
            <p class="text-muted">Peringkat Aktivitas Teratas di Lumajang Sports Club</p>
        </div>

        <div class="row g-4 justify-content-center align-items-end mb-5">
            <div class="col-md-4 col-xl-3">
                <div class="card champion-card rank-2 shadow-sm text-center p-4">
                    <div class="badge-rank text-secondary mb-2">2nd</div>
                    <div class="avatar-wrapper mb-3 mx-auto">
                        <img src="https://i.pravatar.cc/150?u=charlie" class="rounded-circle" width="80" height="80">
                    </div>
                    <h5 class="fw-bold mb-1">Charlie Herwitz <i class="bi bi-patch-check-fill text-lsc-blue"></i></h5>
                    <p class="small text-muted mb-3">Swing Trader / Tennis</p>
                    <div class="row border-top pt-3">
                        <div class="col-4 border-end"><strong>18</strong><br><small class="text-muted">Win</small></div>
                        <div class="col-4 border-end"><strong>359</strong><br><small class="text-muted">Pts</small></div>
                        <div class="col-4"><strong>85%</strong><br><small class="text-muted">Rate</small></div>
                    </div>
                    <button class="btn btn-outline-dark btn-sm mt-3 rounded-pill">Profile</button>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card champion-card rank-1 shadow text-center p-4"
                    style="transform: scale(1.08); z-index: 5; border-color: #ffc107;">
                    <div class="badge-rank text-warning mb-2"><i class="bi bi-trophy-fill"></i> 1st</div>
                    <div class="avatar-wrapper mb-3 mx-auto"
                        style="padding: 6px; background: linear-gradient(45deg, #FFD700, #FFA500);">
                        <img src="https://i.pravatar.cc/150?u=roger" class="rounded-circle" width="100" height="100">
                    </div>
                    <h4 class="fw-bold mb-1">Roger Korsgaard <i class="bi bi-patch-check-fill text-lsc-blue"></i></h4>
                    <p class="small text-muted mb-3">Professional Athlete</p>
                    <div class="row border-top pt-3">
                        <div class="col-4 border-end"><strong>20</strong><br><small class="text-muted">Win</small></div>
                        <div class="col-4 border-end"><strong>497</strong><br><small class="text-muted">Pts</small></div>
                        <div class="col-4"><strong>90%</strong><br><small class="text-muted">Rate</small></div>
                    </div>
                    <button class="btn btn-lsc btn-sm mt-3 w-100">View Champion</button>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card champion-card rank-3 shadow-sm text-center p-4">
                    <div class="badge-rank text-danger mb-2">3rd</div>
                    <div class="avatar-wrapper mb-3 mx-auto">
                        <img src="https://i.pravatar.cc/150?u=ahmad" class="rounded-circle" width="80" height="80">
                    </div>
                    <h5 class="fw-bold mb-1">Ahmad Mango <i class="bi bi-patch-check-fill text-lsc-blue"></i></h5>
                    <p class="small text-muted mb-3">Hard Hitter / Futsal</p>
                    <div class="row border-top pt-3">
                        <div class="col-4 border-end"><strong>15</strong><br><small class="text-muted">Win</small></div>
                        <div class="col-4 border-end"><strong>248</strong><br><small class="text-muted">Pts</small></div>
                        <div class="col-4"><strong>80%</strong><br><small class="text-muted">Rate</small></div>
                    </div>
                    <button class="btn btn-outline-dark btn-sm mt-3 rounded-pill">Profile</button>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-3 justify-content-center mb-5">
            <div class="achievement-chip shadow-sm">
                <img src="https://i.pravatar.cc/40?u=9" class="rounded-circle me-2">
                <div><small class="text-muted d-block" style="font-size: 10px;">Most Tips Given</small> <strong>Cristofer
                        G.</strong></div>
                <span class="badge rounded-pill bg-light text-dark ms-2 border">129</span>
            </div>
            <div class="achievement-chip shadow-sm">
                <img src="https://i.pravatar.cc/40?u=10" class="rounded-circle me-2">
                <div><small class="text-muted d-block" style="font-size: 10px;">Most Active</small> <strong>Roger
                        K.</strong></div>
                <span class="badge rounded-pill bg-light text-dark ms-2 border">37</span>
            </div>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr style="font-size: 12px; text-transform: uppercase; color: #666;">
                        <th class="ps-4">Rank</th>
                        <th>Name</th>
                        <th>Trophies</th>
                        <th>Streaks</th>
                        <th>Trades/Bookings</th>
                        <th>Avg. Win</th>
                        <th class="text-end pe-4">Xscore</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4 fw-bold text-muted">#4</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://i.pravatar.cc/50?u=11" class="rounded-circle me-3" width="35">
                                <div>
                                    <h6 class="mb-0">Cristofer George</h6><small class="text-muted">Badminton</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-warning"><i class="bi bi-star-fill"></i> Elite</span></td>
                        <td>14 <i class="bi bi-fire text-danger"></i></td>
                        <td>497</td>
                        <td>90%</td>
                        <td class="text-end pe-4"><span class="badge bg-lsc-blue px-3">X 83</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
