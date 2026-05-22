<!-- Baris 1: Kartu Metrik (4 Kartu) -->
<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Total Lapangan</h6>
            <h4 class="mb-3">{{ $totalLapangan }} <span class="badge bg-light-primary border border-primary"><i
                        class="ti ti-layout-grid"></i> Aktif</span></h4>
            <p class="mb-0 text-muted text-sm">Jumlah lapangan yang tersedia</p>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Total Member</h6>
            <h4 class="mb-3">120 <span class="badge bg-light-success border border-success"><i class="ti ti-user"></i>
                    Aktif</span></h4>
            <p class="mb-0 text-muted text-sm">Member terdaftar di venue</p>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Jadwal Hari Ini</h6>
            <h4 class="mb-3">{{ $bookingHariIni }} <span class="badge bg-light-warning border border-warning"><i
                        class="ti ti-calendar"></i> Slot</span></h4>
            <p class="mb-0 text-muted text-sm">Booking masuk hari ini</p>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-2 f-w-400 text-muted">Total Pemasukan</h6>
            <h4 class="mb-3">Rp{{ number_format($pemasukanHariIni, 0, ',', '.') }} <span
                    class="badge bg-light-danger border border-danger"><i class="ti ti-wallet"></i> Hari ini</span></h4>
            <p class="mb-0 text-muted text-sm">Pendapatan dari booking</p>
        </div>
    </div>
</div>

<!-- Baris 2: Tabel Booking & Statistik -->
<div class="col-md-12 col-xl-8">
    <h5 class="mb-3">Booking Terbaru</h5>
    <div class="card tbl-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-borderless mb-0">
                    <thead>
                        <tr>
                            <th>ID BOOKING</th>
                            <th>LAPANGAN</th>
                            <th>DURASI</th>
                            <th>STATUS</th>
                            <th class="text-end">TOTAL BAYAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookingTerbaru as $booking)
                            <tr>
                                <td><a href="#"
                                        class="text-muted">{{ $booking->order_id ?? $booking->kode_booking }}</a></td>
                                <td>{{ $booking->court->name ?? 'Lapangan Dihapus' }}</td>
                                <td>
                                    <!-- Menghitung selisih jam otomatis dengan Carbon -->
                                    {{ \Carbon\Carbon::parse($booking->start_time)->diffInHours($booking->end_time) }}
                                    Jam
                                </td>
                                <td>
                                    @if ($booking->status == 'success' || $booking->status == 'confirmed')
                                        <span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-success"></i>Approved</span>
                                    @elseif($booking->status == 'pending')
                                        <span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-warning"></i>Pending</span>
                                    @else
                                        <span class="d-flex align-items-center gap-2"><i
                                                class="fas fa-circle text-danger"></i>Rejected</span>
                                    @endif
                                </td>
                                <td class="text-end">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada transaksi terbaru</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-xl-4">
    <h5 class="mb-3">Statistik Venue</h5>
    <div class="card">
        <div class="list-group list-group-flush">
            <a href="#"
                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                Booking Hari Ini
                <span class="h5 mb-0">{{ $bookingHariIni }}</span>
            </a>

            <a href="#"
                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                Slot Terisi
                <span class="h5 mb-0">{{ $slotTerisi }}%</span>
            </a>

            <a href="#"
                class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                Kepuasan Member
                <span class="h5 mb-0 text-success">Tinggi</span>
            </a>
        </div>
        <div class="card-body px-2">
            <div id="analytics-report-chart"></div>
        </div>
    </div>
</div>
