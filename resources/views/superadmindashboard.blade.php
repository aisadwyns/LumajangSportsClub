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
<div class="row">
    <div class="col-md-12 col-xl-8 d-flex flex-column">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="mb-0" style="font-weight: 600; color: #2D3748;">Visitor (LSC Web)</h5>
            <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-1 px-3" id="chart-tab-home-tab" data-bs-toggle="pill"
                        data-bs-target="#chart-tab-home" type="button" role="tab" aria-controls="chart-tab-home"
                        aria-selected="false">Month</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active py-1 px-3" id="chart-tab-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#chart-tab-profile" type="button" role="tab"
                        aria-controls="chart-tab-profile" aria-selected="true">Week</button>
                </li>
            </ul>
        </div>
        <div class="card border-0 shadow-sm mb-4 flex-fill" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="tab-content" id="chart-tab-tabContent">
                    <div class="tab-pane fade" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab"
                        tabindex="0">
                        <div id="visitor-chart-month"></div>
                    </div>
                    <div class="tab-pane fade show active" id="chart-tab-profile" role="tabpanel"
                        aria-labelledby="chart-tab-profile-tab" tabindex="0">
                        <div id="visitor-chart-week"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-4 d-flex flex-column">
        <h5 class="mb-3" style="font-weight: 600; color: #2D3748;">Ikhtisar Pendapatan</h5>
        <div class="card border-0 shadow-sm mb-4 flex-fill d-flex flex-column" style="border-radius: 12px;">
            <div class="card-body p-4 d-flex flex-column justify-content-between flex-fill">
                <div>
                    <h6 class="mb-1 text-muted" style="font-weight: 400; font-size: 0.9rem;">Statistik Minggu Ini</h6>
                    <h3 class="mb-0" style="font-weight: 700; color: #1A202C;">
                        Rp{{ number_format($pendapatanMingguIni, 0, ',', '.') }}</h3>
                </div>

                <div id="grafik-pendapatan-baru" class="w-100 mt-auto"></div>
            </div>
        </div>
    </div>
</div>



<!-- Baris 4: Laporan Aktivitas & Riwayat Transaksi -->
<div class="col-md-12 col-xl-8 d-flex flex-column">
    <h5 class="mb-3" style="font-weight: 600; color: #2D3748;">Laporan Aktivitas</h5>
    <div class="card border-0 shadow-sm mb-4 flex-fill d-flex flex-column" style="border-radius: 12px;">
        <div class="card-body p-4 d-flex flex-column justify-content-between flex-fill">
            <div>
                <h6 class="mb-1 text-muted" style="font-weight: 400; font-size: 0.9rem;">Total Aktivitas (6 Bulan
                    Terakhir)</h6>
                <h3 class="mb-0" style="font-weight: 700; color: #1A202C;">
                    {{ number_format($totalAktivitas, 0, ',', '.') }} Aktivitas
                </h3>
            </div>

            <div id="grafik-aktivitas-baru" class="w-100 mt-4"></div>
        </div>
    </div>
</div>

<div class="col-md-12 col-xl-4">
    <h5 class="mb-3">Riwayat Pendaftaran Komunitas</h5>
    <div class="card">
        <div class="list-group list-group-flush">
            @forelse($riwayatTransaksi as $trx)
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            @if ($trx->status_pembayaran == 'success')
                                <div class="avtar avtar-s rounded-circle text-success bg-light-success">
                                    <i class="ti ti-users f-18"></i>
                                </div>
                            @elseif($trx->status_pembayaran == 'pending')
                                <div class="avtar avtar-s rounded-circle text-warning bg-light-warning">
                                    <i class="ti ti-clock f-18"></i>
                                </div>
                            @else
                                <div class="avtar avtar-s rounded-circle text-danger bg-light-danger">
                                    <i class="ti ti-alert-circle f-18"></i>
                                </div>
                            @endif
                        </div>

                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">
                                {{ $trx->order_id ?? 'Pendaftaran COD (#' . $trx->id . ')' }}
                            </h6>
                            <p class="mb-0 text-muted small">
                                Komunitas: {{ $trx->komunitas?->nama_komunitas }} •
                                {{ $trx->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <div class="flex-shrink-0 text-end">
                            <h6 class="mb-1 text-uppercase small fw-bold text-secondary">
                                {{ $trx->metode_pembayaran }}
                            </h6>
                            <p class="mb-0 text-muted small">
                                @if ($trx->status_pembayaran == 'success')
                                    <span class="badge bg-light-success text-success">Sukses</span>
                                @elseif($trx->status_pembayaran == 'pending')
                                    <span class="badge bg-light-warning text-warning">Pending</span>
                                @else
                                    <span
                                        class="badge bg-light-danger text-danger">{{ $trx->status_pembayaran }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-4 text-center text-muted">Belum ada riwayat pendaftaran komunitas.</div>
            @endforelse
        </div>
    </div>
</div>
<a href="{{ route('dashboard.export-pdf') }}" class="btn btn-primary d-flex align-items-center gap-2"
    style="border-radius: 8px; font-weight: 500;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
        class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
        <path
            d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.33-.52.625-.718.822a3.44 3.44 0 0 1-.361-.33c.177-.247.536-.616.99-.948zM14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
    </svg>
    Cetak Ringkasan Eksekutif (PDF)
</a>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const colorPageViews = '#3B82F6'; // Biru murni
        const colorSessions = '#10B981'; // Hijau toska

        // 1. KONFIGURASI GRAFIK VISITOR MINGGUAN
        const optionsWeek = {
            chart: {
                type: 'area',
                height: 330,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            colors: [colorPageViews, colorSessions],
            stroke: {
                curve: 'smooth',
                width: 2.5
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                    name: 'Page Views',
                    data: @json($visitorWeekPageViews)
                },
                {
                    name: 'Sessions',
                    data: @json($visitorWeekSessions)
                }
            ],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.02,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: @json($chartWeekLabels),
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                tickAmount: 4,
                labels: {
                    style: {
                        colors: '#a0aec0'
                    }
                }
            },
            grid: {
                borderColor: '#f1f5f9'
            },
            legend: {
                position: 'bottom'
            }
        };
        const chartWeek = new ApexCharts(document.querySelector("#visitor-chart-week"), optionsWeek);
        chartWeek.render();

        // 2. KONFIGURASI GRAFIK VISITOR BULANAN (PER MINGGU)
        const optionsMonth = {
            chart: {
                type: 'area',
                height: 330,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            colors: [colorPageViews, colorSessions],
            stroke: {
                curve: 'smooth',
                width: 2.5
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                    name: 'Page Views',
                    data: @json($visitorMonthPageViews)
                },
                {
                    name: 'Sessions',
                    data: @json($visitorMonthSessions)
                }
            ],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.02,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: @json($chartMonthLabels),
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                tickAmount: 4,
                labels: {
                    style: {
                        colors: '#a0aec0'
                    }
                }
            },
            grid: {
                borderColor: '#f1f5f9'
            },
            legend: {
                position: 'bottom'
            }
        };
        const chartMonth = new ApexCharts(document.querySelector("#visitor-chart-month"), optionsMonth);
        chartMonth.render();


        // --- 4. GRAFIK IKHTISAR PENDAPATAN (BAR CHART BULAT) ---
        // --- GRAFIK IKHTISAR PENDAPATAN (BAR CHART) ---
        const optionsIncome = {
            chart: {
                type: 'bar',
                height: 310, // Mengunci tinggi chart agar sejajar dengan area chart visitor di sebelah kiri
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: false
                }
            },
            colors: ['#10B981'],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '40%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end'
                },
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: 'Pendapatan',
                data: @json($incomeWeekData) // Data dinamis dari query success midtrans
            }],
            grid: {
                show: false,
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            },
            xaxis: {
                categories: @json($chartWeekLabels), // Menggunakan data hari dinamis (Sen, Sel, Rab...)
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: true,
                    style: {
                        colors: '#a0aec0',
                        fontSize: '12px',
                        fontWeight: 500
                    }
                }
            },
            yaxis: {
                show: false
            },
            tooltip: {
                theme: 'light',
                y: {
                    formatter: function(val) {
                        return "Rp " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                }
            }
        };

        // Hapus atau timpa inisialisasi chart pendapatan lama milik template jika ada,
        // dan pastikan hanya baris di bawah ini yang merender ke elemen #income-overview-chart
        const chartIncome = new ApexCharts(document.querySelector("#grafik-pendapatan-baru"), optionsIncome);
        chartIncome.render();

        //chart aktivitas
        const optionsAktivitas = {
            chart: {
                type: 'bar',
                height: 310, // Menyamakan tinggi agar sejajar dengan card di sebelahnya
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                }
            },
            // Warna Biru untuk Booking, Kuning/Orange untuk Komunitas sesuai tema Mantis
            colors: ['#1890ff', '#faad14'],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%', // Memberi ruang proporsional untuk 2 bar berdampingan
                    borderRadius: 4,
                    borderRadiusApplication: 'end'
                },
            },
            stroke: {
                show: true,
                width: 3, // Jarak tipis antar bar agar tidak terlalu menempel kaku
                colors: ['transparent']
            },
            dataLabels: {
                enabled: false
            },
            // Input data dua series dari database Laravel
            series: [{
                    name: 'Booking Lapangan',
                    data: @json($dataBooking) // Array angka booking per bulan
                },
                {
                    name: 'Aktivitas Komunitas',
                    data: @json($dataKomunitas) // Array angka pendaftaran komunitas per bulan
                }
            ],
            grid: {
                strokeDashArray: 4,
                borderColor: '#f1f1f1',
                padding: {
                    top: 0,
                    right: 10,
                    bottom: 0,
                    left: 10
                }
            },
            xaxis: {
                categories: @json($chartAktivitasLabels), // Nama-nama bulan dinamis ['Jan', 'Feb', ...]
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: true,
                    style: {
                        colors: '#a0aec0',
                        fontSize: '12px',
                        fontWeight: 500
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#a0aec0',
                        fontSize: '12px'
                    }
                }
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right',
                fontFamily: 'Public Sans, sans-serif',
                markers: {
                    width: 10,
                    height: 10,
                    radius: '50%'
                }
            },
            tooltip: {
                theme: 'light',
                y: {
                    formatter: function(val) {
                        return val + " Aktivitas";
                    }
                }
            }
        };

        // Render ke elemen div #grafik-aktivitas-baru
        const chartAktivitas = new ApexCharts(document.querySelector("#grafik-aktivitas-baru"),
            optionsAktivitas);
        chartAktivitas.render();

        // --- 5. LOGIKA FIX AGAR CHART DALAM TAB TIDAK GEWENG/MENYUSUT ---
        // Kadang bootstrap tab menyembunyikan chart saat pertama load, script ini memicu re-render otomatis saat tab diklik
        const tabLinks = document.querySelectorAll('button[data-bs-toggle="pill"]');
        tabLinks.forEach(tab => {
            tab.addEventListener('shown.bs.tab', function() {
                chartWeek.windowResize();
                chartMonth.windowResize();
            });
        });
    });
</script>
