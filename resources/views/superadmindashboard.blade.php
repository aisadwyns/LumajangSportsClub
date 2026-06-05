<!-- Baris 1: 4 Kartu Metrik Utama -->
<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Data Pengunjung Hari ini</h6>
            <h4 class="mb-3">15 <span class="badge bg-light-primary border border-primary"><i
                        class="ti ti-trending-up"></i> kali dikunjungi</span></h4>
            <p class="mb-0 text-muted text-sm">Total views bulan ini <span class="text-primary">115</span></p>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Data Pengguna</h6>
            <h4 class="mb-3">{{ number_format($totalPengguna, 0, ',', '.') }} <span
                    class="badge bg-light-success border border-success"><i class="ti ti-user"></i> Aktif</span></h4>
            <p class="mb-0 text-muted text-sm">User aktif terdaftar</p>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Komunitas Saat Ini</h6>
            <h4 class="mb-3">{{ $totalKomunitas }} <span class="badge bg-light-warning border border-warning"><i
                        class="ti ti-layout-grid"></i> Terdaftar</span></h4>
            <p class="mb-0 text-muted text-sm">Komunitas olahraga terdaftar</p>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Total Pemasukan</h6>
            <h4 class="mb-3">Rp{{ number_format($totalPemasukan, 0, ',', '.') }} <span
                    class="badge bg-light-danger border border-danger"><i class="ti ti-wallet"></i> Bulan Ini</span>
            </h4>
            <p class="mb-0 text-muted text-sm">Pendapatan lunas (Paid)</p>
        </div>
    </div>
</div>

<!-- Baris 2: Chart Pengunjung & Ikhtisar Pendapatan -->
<div class="col-md-12 col-xl-8">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="mb-0">Visitor (LSC Web)</h5>
        <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill" data-bs-target="#chart-tab-home"
                    type="button" role="tab" aria-controls="chart-tab-home" aria-selected="true">Month</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#chart-tab-profile" type="button" role="tab" aria-controls="chart-tab-profile"
                    aria-selected="false">Month</button>
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
            <h3 class="mb-3">Rp{{ number_format($pendapatanMingguIni, 0, ',', '.') }}</h3>
            <div id="income-overview-chart"></div>
        </div>
    </div>
</div>



<!-- Baris 4: Laporan Aktivitas & Riwayat Transaksi -->
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
            @forelse($riwayatTransaksi as $trx)
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <!-- Ganti ikon dan warna berdasarkan status -->
                            @if (in_array($trx->status, ['success', 'confirmed']))
                                <div class="avtar avtar-s rounded-circle text-success bg-light-success">
                                    <i class="ti ti-gift f-18"></i>
                                </div>
                            @elseif($trx->status == 'pending')
                                <div class="avtar avtar-s rounded-circle text-warning bg-light-warning">
                                    <i class="ti ti-clock f-18"></i>
                                </div>
                            @else
                                <div class="avtar avtar-s rounded-circle text-danger bg-light-danger">
                                    <i class="ti ti-settings f-18"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Booking #{{ explode('-', $trx->order_id)[1] ?? $trx->kode_booking }}
                            </h6>
                            <!-- Menampilkan waktu dalam format "2 jam yang lalu" / "Hari ini, 08:00 AM" -->
                            <p class="mb-0 text-muted">{{ $trx->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1">+ Rp{{ number_format($trx->total_price, 0, ',', '.') }}</h6>
                            <p class="mb-0 text-muted">{{ ucfirst($trx->status) }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-3 text-center text-muted">Belum ada transaksi.</div>
            @endforelse
        </div>
    </div>
</div>
