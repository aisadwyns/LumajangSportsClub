@extends('layouts.client')

@section('content')
    <main class="main">
        <div class="container my-5">

            <section class="area-galeri-lapangan">
                <div class="bingkai-galeri">

                    <div class="wadah-foto-utama">
                        @if ($court->images->count() > 0)
                            <img src="{{ asset('storage/courts/' . $court->images[0]->image) }}" class="foto-kotak"
                                alt="Foto Utama">
                        @else
                            <div class="kotak-kosong"><i class="fas fa-image fa-2x text-muted"></i></div>
                        @endif
                    </div>

                    <div class="grup-foto-samping">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="wadah-foto-kecil">
                                @if (isset($court->images[$i]))
                                    <img src="{{ asset('storage/courts/' . $court->images[$i]->image) }}" class="foto-kotak"
                                        alt="Foto {{ $i }}">
                                @else
                                    <div class="kotak-kosong"><i class="fas fa-image text-muted"></i></div>
                                @endif
                            </div>
                        @endfor
                    </div>

                </div>
            </section>

            {{-- ✅ FIX: Status buka/tutup tidak lagi hardcoded --}}
            @php
                $jamSekarang = \Carbon\Carbon::now()->format('H:i');
                $jamBuka = substr($court->open_time, 0, 5);
                $jamTutup = substr($court->close_time, 0, 5);
                $isOpen = $jamSekarang >= $jamBuka && $jamSekarang < $jamTutup;
            @endphp

            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h1 class="fw-bold text-dark">{{ $court->name }}</h1>
                    <p class="text-muted small mb-0">
                        <span class="text-warning"><i class="fas fa-star"></i> 5.0</span>
                        (196 Reviews) •
                        {{-- ✅ FIX: Status dinamis berdasarkan jam operasional --}}
                        <span class="{{ $isOpen ? 'text-success' : 'text-danger' }}">
                            {{ $isOpen ? 'Open Now' : 'Closed' }}
                        </span> •
                        {{ ucfirst($court->sport_type) }}, {{ $court->venueAdmin->city ?? 'Lumajang' }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    {{-- <button class="btn btn-outline-primary me-2 px-4">Enquire</button> --}}
                    <button class="btn btn-primary px-4" style="background-color: #004AAC;" onclick="tampilkanJadwal()">Cek
                        Ketersediaan
                    </button>
                </div>
            </div>

            <hr>

            <div class="row mt-4">
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="text-primary me-3"><i class="fas fa-map-marker-alt fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Alamat</h6>
                            <p class="text-muted small mb-1">
                                {{ $court->venueAdmin?->address ?? 'Alamat tidak tersedia' }}
                            </p>

                            {{-- Sembunyikan tombol jika alamat benar-benar kosong --}}
                            @if ($court->venueAdmin?->address)
                                <a href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($court->venueAdmin->address . ', ' . ($court->venueAdmin->city ?? 'Lumajang')) }}"
                                    target="_blank" rel="noopener noreferrer" class="small text-decoration-none fw-bold">
                                    <i class="bi bi-geo-alt-fill me-1"></i> Get directions
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start border-start-md">
                        <div class="text-primary me-3 ms-md-3"><i class="fas fa-clock fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Jam Operasional</h6>
                            @php
                                // 1. Definisikan semua hari dalam seminggu
                                $semuaHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

                                // 2. Ambil data hari operasional (yang dicentang) dari database
                                $hariBuka = is_array($court->operational_days) ? $court->operational_days : [];

                                // 3. Cari selisihnya: Hari apa saja yang tidak dicentang (berarti Tutup/Libur)
                                $hariLibur = array_diff($semuaHari, $hariBuka);

                                // 4. Format jam agar rapi
                                $jamBukaFormat = $court->open_time
                                    ? \Carbon\Carbon::parse($court->open_time)->format('H:i')
                                    : '-';
                                $jamTutupFormat = $court->close_time
                                    ? \Carbon\Carbon::parse($court->close_time)->format('H:i')
                                    : '-';
                            @endphp

                            @if (count($hariLibur) > 0)
                                {{-- Jika terdapat hari libur, gabungkan dengan koma --}}
                                <p class="text-muted small mb-0">Tutup: <span
                                        class="text-danger fw-bold">{{ implode(', ', $hariLibur) }}</span></p>
                                <p class="text-muted small mb-0">Hari Lainnya Buka: {{ $jamBukaFormat }} -
                                    {{ $jamTutupFormat }}</p>
                            @else
                                {{-- Jika buka 7 hari full (array_diff kosong) --}}
                                <p class="text-muted small mb-0">Buka Setiap Hari: {{ $jamBukaFormat }} -
                                    {{ $jamTutupFormat }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start border-start-md">
                        <div class="text-primary me-3 ms-md-3"><i class="fas fa-wallet fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Metode Pembayaran</h6>
                            <p class="text-muted small mb-0">Cash, E-Wallet, Debit Card, Credit Card</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


    <div id="area-booking-jadwal" class="container" style="display:none; margin-bottom: 100px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold"><i class="fas fa-calendar-alt text-primary me-2"></i> Pilih Jadwal Tersedia</h4>
        </div>

        {{-- PILIH TANGGAL --}}
        <div class="mb-4">
            <label class="fw-bold">Pilih Tanggal</label>
            <input type="date" id="tanggalBooking" class="form-control mt-2" value="{{ $tanggal }}">
        </div>

        {{-- SLOT --}}
        <div class="grid-slot-waktu"
            style="display:grid; grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:15px;">

            @php
                $startHour = (int) substr($court->open_time, 0, 2);
                $endHour = (int) substr($court->close_time, 0, 2);
            @endphp

            @for ($i = $startHour; $i < $endHour; $i++)
                @php
                    $jam = sprintf('%02d:00', $i);
                    // ✅ FIX: bookedSlots sekarang sudah mencakup schedules DAN bookings
                    $isBooked = in_array($jam, $bookedSlots);
                @endphp

                <div class="slot-item {{ $isBooked ? 'booked' : '' }}"
                    onclick="pilihJam(this, '{{ $jam }}', {{ $court->price_per_hour }})">

                    @if ($isBooked)
                        <span class="badge-sold">Full</span>
                    @endif

                    <p class="small">60 Menit</p>

                    <strong>{{ $jam }} - {{ sprintf('%02d:00', $i + 1) }}</strong>

                    @if (!$isBooked)
                        <span class="text-primary fw-bold">
                            Rp{{ number_format($court->price_per_hour, 0, ',', '.') }}
                        </span>
                    @else
                        <span class="text-muted small">Tidak tersedia</span>
                    @endif

                </div>
            @endfor

        </div>
    </div>

    {{-- ✅ FIX: Hapus </div> ekstra yang tidak punya pasangan --}}

    <div id="checkout-bar" class="d-none animate__animated animate__slideInUp">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <span class="text-muted small">Total Pembayaran</span>
                <h4 class="fw-bold text-primary mb-0" id="display-total">Rp0</h4>
            </div>

            @auth
                {{-- Tombol jika user sudah login --}}
                <button class="btn btn-primary px-5 fw-bold" style="background-color: #004AAC;" data-bs-toggle="modal"
                    data-bs-target="#modalBookingCourt">
                    Lanjut ke Checkout
                </button>
            @else
                {{-- Tombol jika user belum login --}}
                <a href="{{ route('login') }}" class="btn btn-primary px-5 fw-bold" style="background-color: #004AAC;">
                    Login untuk lanjut ke checkout
                </a>
            @endauth

        </div>
    </div>

    {{-- MODAL BOOKING COURT --}}
    <div class="modal fade" id="modalBookingCourt" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">

                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Konfirmasi Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">

                    <p class="text-muted mb-3">
                        Booking <strong>{{ $court->name }}</strong>
                    </p>

                    <h5 id="infoBooking"></h5>

                    <p class="mt-3">
                        Total:
                        <strong class="text-primary">
                            Rp{{ number_format($court->price_per_hour, 0, ',', '.') }}
                        </strong>
                    </p>

                    <div class="alert alert-info small">
                        Pembayaran menggunakan Midtrans (Gopay, VA, Transfer Bank)
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <!-- Ubah ID dan tambahkan event onclick -->
                    <button type="button" class="btn btn-primary" id="btnProsesBooking"
                        onclick="bayarCourt()">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMidtrans" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-info mb-2">
                        Klik <b>Lanjutkan Pembayaran</b>
                    </div>
                    <div id="midtransStatus" class="small text-muted"></div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="btnPayMidtrans">Lanjutkan Pembayaran</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    <script>
        let jamTerpilih = null;
        let hargaTerpilih = 0;


        function tampilkanJadwal() {
            let area = document.getElementById('area-booking-jadwal');
            area.style.display = 'block';
            area.scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Ganti tanggal → reload dengan query param
        document.getElementById('tanggalBooking').addEventListener('change', function() {
            let tanggal = this.value;
            let url = new URL(window.location.href);
            url.searchParams.set('tanggal', tanggal);
            window.location.href = url;
        });

        function pilihJam(el, jam, harga) {

            if (el.classList.contains('booked')) return;

            // highlight
            document.querySelectorAll('.slot-item').forEach(e => e.classList.remove('terpilih'));
            el.classList.add('terpilih');

            let tanggal = document.getElementById('tanggalBooking').value;

            // simpan data
            selectedDate = tanggal;
            selectedTime = jam;

            // tampilkan info
            document.getElementById('infoBooking').innerText =
                tanggal + ' | ' + jam;

            // update total
            document.getElementById('display-total').innerText =
                'Rp ' + harga.toLocaleString('id-ID');

            // tampilkan checkout bar (INI YANG HILANG TADI)
            document.getElementById('checkout-bar').classList.remove('d-none');
        }

        let snapToken = null;
        let selectedDate = document.getElementById('tanggalBooking') ? document.getElementById('tanggalBooking').value : '';
        let selectedTime = ''; // Pastikan variabel ini terisi saat user milih jam

        function bayarCourt() {
            // Nutup modal pertama biar gak numpuk
            const modalBookingEl = document.getElementById('modalBookingCourt');
            const modalBooking = bootstrap.Modal.getInstance(modalBookingEl);
            if (modalBooking) modalBooking.hide();

            // Buka modal Midtrans
            const modalMidtransEl = document.getElementById('modalMidtrans');
            const modalMidtrans = new bootstrap.Modal(modalMidtransEl);

            document.getElementById('midtransStatus').innerText = 'Menyiapkan pembayaran...';
            document.getElementById('btnPayMidtrans').disabled = true;
            modalMidtrans.show();

            fetch("{{ route('booking.pay') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        court_id: "{{ $court->id ?? '' }}",
                        booking_date: selectedDate,
                        start_time: selectedTime
                    })
                })
                .then(r => r.json())
                .then(res => {
                    if (!res.success) throw new Error(res.error || 'Gagal membuat transaksi.');

                    snapToken = res.snap_token;
                    document.getElementById('midtransStatus').innerText = 'Siap. Klik "Lanjutkan Pembayaran".';
                    document.getElementById('btnPayMidtrans').disabled = false;
                })
                .catch(err => {
                    document.getElementById('midtransStatus').innerText = err.message;
                    document.getElementById('btnPayMidtrans').disabled = true;
                });
        }

        // Eksekusi Snap Midtrans
        document.getElementById('btnPayMidtrans')?.addEventListener('click', function() {
            if (!snapToken) return;

            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    location.reload();
                },
                onPending: function(result) {
                    location.reload();
                },
                onError: function(result) {
                    alert('Pembayaran gagal. Coba lagi.');
                },
                onClose: function() {
                    // Biarin kosong kalau user cuma nutup popup
                }
            });
        });
    </script>
@endsection
