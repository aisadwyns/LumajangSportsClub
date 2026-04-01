<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Data Pengunjung</h6>
            <h4 class="mb-3">12,540 <span class="badge bg-light-primary border border-primary"><i
                        class="ti ti-trending-up"></i> 15%</span></h4>
            <p class="mb-0 text-muted text-sm">Total views bulan ini <span class="text-primary">+1,200</span></p>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Data Pengguna</h6>
            <h4 class="mb-3">1,250 <span class="badge bg-light-success border border-success"><i
                        class="ti ti-user"></i> 5%</span></h4>
            <p class="mb-0 text-muted text-sm">User aktif terdaftar</p>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Data Komunitas</h6>
            <h4 class="mb-3">48 <span class="badge bg-light-warning border border-warning"><i
                        class="ti ti-layout-grid"></i> Aktif</span></h4>
            <p class="mb-0 text-muted text-sm">Komunitas olahraga terdaftar</p>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Total Pemasukan</h6>
            <h4 class="mb-3">Rp2.500.000 <span class="badge bg-light-danger border border-danger"><i
                        class="ti ti-wallet"></i> Gross</span></h4>
            <p class="mb-0 text-muted text-sm">Pendapatan lunas (Paid)</p>
        </div>
    </div>
</div>

<div class="col-md-12 col-xl-8">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="mb-0">Unique Visitor (LSC Web)</h5>
        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill" data-bs-target="#chart-tab-home"
                    type="button" role="tab" aria-controls="chart-tab-home" aria-selected="true">Month</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#chart-tab-profile" type="button" role="tab" aria-controls="chart-tab-profile"
                    aria-selected="false">Week</button>
            </li>
        </ul>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="tab-content" id="chart-tab-tabContent">
                <div class="tab-pane" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab"
                    tabindex="0">
                    <div id="visitor-chart-1"></div>
                </div>
                <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel"
                    aria-labelledby="chart-tab-profile-tab" tabindex="0">
                    <div id="visitor-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 col-xl-4">
    <h5 class="mb-3">Ikhtisar Pendapatan</h5>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Statistik Minggu Ini</h6>
            <h3 class="mb-3">Rp4.200.000</h3>
            <div id="income-overview-chart"></div>
        </div>
    </div>
</div>

<div class="col-md-12 col-xl-8">
    <h5 class="mb-3">Pemesanan Terbaru</h5>
    <div class="card tbl-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-borderless mb-0">
                    <thead>
                        <tr>
                            <th>ID BOOKING</th>
                            <th>LAYANAN / PRODUK</th>
                            <th>KUOTA/QTY</th>
                            <th>STATUS</th>
                            <th class="text-end">TOTAL BAYAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#" class="text-muted">LSC-2024001</a></td>
                            <td>Sewa Lapangan Futsal (GOR)</td>
                            <td>2 Jam</td>
                            <td><span class="d-flex align-items-center gap-2"><i
                                        class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span></td>
                            <td class="text-end">Rp300.000</td>
                        </tr>
                        <tr>
                            <td><a href="#" class="text-muted">LSC-2024002</a></td>
                            <td>Membership Bulanan (Gym)</td>
                            <td>1 User</td>
                            <td><span class="d-flex align-items-center gap-2"><i
                                        class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                            </td>
                            <td class="text-end">Rp150.000</td>
                        </tr>
                        <tr>
                            <td><a href="#" class="text-muted">LSC-2024003</a></td>
                            <td>Pendaftaran Turnamen Voli</td>
                            <td>1 Tim</td>
                            <td><span class="d-flex align-items-center gap-2"><i
                                        class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span></td>
                            <td class="text-end">Rp500.000</td>
                        </tr>
                        <tr>
                            <td><a href="#" class="text-muted">LSC-2024004</a></td>
                            <td>Sewa Lapangan Badminton</td>
                            <td>3 Jam</td>
                            <td><span class="d-flex align-items-center gap-2"><i
                                        class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                            </td>
                            <td class="text-end">Rp120.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 col-xl-4">
    <h5 class="mb-3">Laporan Analitik</h5>
    <div class="card">
        <div class="list-group list-group-flush">
            <a href="#"
                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Pertumbuhan
                Finansial Klub<span class="h5 mb-0">+28.5%</span></a>
            <a href="#"
                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Rasio
                Biaya Operasional<span class="h5 mb-0">12.4%</span></a>
            <a href="#"
                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Tingkat
                Kepuasan Member<span class="h5 mb-0">Tinggi</span></a>
        </div>
        <div class="card-body px-2">
            <div id="analytics-report-chart"></div>
        </div>
    </div>
</div>

<div class="col-md-12 col-xl-8">
    <h5 class="mb-3">Laporan Aktivitas</h5>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Statistik Minggu Ini</h6>
            <h3 class="mb-0">856 Aktivitas</h3>
            <div id="sales-report-chart"></div>
        </div>
    </div>
</div>
<div class="col-md-12 col-xl-4">
    <h5 class="mb-3">Riwayat Transaksi</h5>
    <div class="card">
        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s rounded-circle text-success bg-light-success">
                            <i class="ti ti-gift f-18"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Booking #LSC-0921</h6>
                        <p class="mb-0 text-muted">Hari ini, 08:00 AM</p>
                    </div>
                    <div class="flex-shrink-0 text-end">
                        <h6 class="mb-1">+ Rp250.000</h6>
                        <p class="mb-0 text-muted">Lunas</p>
                    </div>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s rounded-circle text-primary bg-light-primary">
                            <i class="ti ti-message-circle f-18"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Iuran Anggota #M-882</h6>
                        <p class="mb-0 text-muted">Kemarin, 04:30 PM</p>
                    </div>
                    <div class="flex-shrink-0 text-end">
                        <h6 class="mb-1">+ Rp100.000</h6>
                        <p class="mb-0 text-muted">Lunas</p>
                    </div>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s rounded-circle text-danger bg-light-danger">
                            <i class="ti ti-settings f-18"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Refund Sewa Lapangan</h6>
                        <p class="mb-0 text-muted">2 jam yang lalu</p>
                    </div>
                    <div class="flex-shrink-0 text-end">
                        <h6 class="mb-1">- Rp50.000</h6>
                        <p class="mb-0 text-muted">Proses</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
