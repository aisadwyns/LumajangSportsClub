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
            <h4 class="mb-3">{{ $totalMember }} <span class="badge bg-light-success border border-success"><i
                        class="ti ti-user"></i>
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

{{-- <div class="col-md-12 col-xl-4">
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
</div> --}}
<div class="col-md-12 col-xl-4 d-flex flex-column">
    <h5 class="mb-3" style="font-weight: 600; color: #2D3748;">Statistik Venue</h5>
    <div class="card border-0 shadow-sm mb-4 flex-fill d-flex flex-column" style="border-radius: 12px;">
        <div class="list-group list-group-flush border-0"
            style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <div class="list-group-item d-flex align-items-center justify-content-between p-3 border-0 bg-transparent">
                <span style="font-weight: 500; color: #4A5568;">Booking Hari Ini</span>
                <span class="h5 mb-0" style="font-weight: 700; color: #1A202C;">{{ $bookingHariIni }}</span>
            </div>
        </div>
        <div class="card-body p-3 d-flex flex-column justify-content-between flex-fill mt-auto">
            <div id="grafik-booking-venue-baru" class="w-100"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Warna oranye/kuning hangat agar senada dengan nuansa visual di gambar contohmu
        const colorBookingVenue = '#F59E0B';

        const optionsVenue = {
            chart: {
                type: 'line', // Jenis grafik garis (line chart) sesuai mockup gambar ke-7 kamu
                height: 260,
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            colors: [colorBookingVenue],
            stroke: {
                curve: 'smooth', // Garis melengkung halus (smooth)
                width: 3
            },
            markers: {
                size: 4, // Memberikan titik bulatan kecil pada setiap koordinat minggu
                colors: [colorBookingVenue],
                strokeColors: '#fff',
                strokeWidth: 2,
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: 'Total Booking',
                data: @json($venueBookingData) // Data dinamis jumlah booking per minggu dari controller
            }],
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4, // Garis latar belakang putus-putus samar seperti gambar mockup
                padding: {
                    top: 10,
                    right: 15,
                    bottom: 0,
                    left: 10
                }
            },
            xaxis: {
                categories: @json($venueChartLabels), // Otomatis berisi 6 nama bulan terakhir
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                tickAmount: 5, // Mengatur kerapatan grid horizontal untuk 6 titik
                labels: {
                    style: {
                        colors: '#a0aec0',
                        fontSize: '11px',
                        fontWeight: 500
                    }
                }
            },
            yaxis: {
                tickAmount: 4,
                labels: {
                    style: {
                        colors: '#a0aec0'
                    },
                    formatter: function(val) {
                        return Math.round(
                            val
                        ); // Memastikan angka di sumbu Y selalu bulat (karena jumlah booking tidak mungkin desimal)
                    }
                }
            },
            tooltip: {
                theme: 'light',
                y: {
                    formatter: function(val) {
                        return val + " Kali Booking";
                    }
                }
            }
        };

        // Render grafik baru ke dalam container ID baru kita
        const chartVenue = new ApexCharts(document.querySelector("#grafik-booking-venue-baru"), optionsVenue);
        chartVenue.render();
    });
</script>
