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

            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <h1 class="fw-bold text-dark">{{ $court->name }}</h1>
                    <p class="text-muted small mb-0">
                        <span class="text-warning"><i class="fas fa-star"></i> 5.0</span>
                        (196 Reviews) •
                        <span class="text-success">Open Now</span> •
                        {{ ucfirst($court->sport_type) }}, {{ $court->venueAdmin->city ?? 'Lumajang' }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <button class="btn btn-outline-primary me-2 px-4">Enquire</button>
                    <button class="btn btn-primary px-4" style="background-color: #004AAC;" onclick="tampilkanJadwal()">Book
                        now</button>
                </div>
            </div>

            <hr>

            <div class="row mt-4">
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="text-primary me-3"><i class="fas fa-map-marker-alt fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Alamat</h6>
                            <p class="text-muted small mb-1">{{ $court->venueAdmin->address ?? 'Alamat tidak tersedia' }}
                            </p>
                            <a href="#" class="small text-decoration-none fw-bold">Get directions</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-start border-start-md">
                        <div class="text-primary me-3 ms-md-3"><i class="fas fa-clock fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Jam Operasional</h6>
                            <p class="text-muted small mb-0">Mon: <span class="text-danger">Closed</span></p>
                            <p class="text-muted small mb-0">Tue - Sun: {{ substr($court->open_time, 0, 5) }} -
                                {{ substr($court->close_time, 0, 5) }}</p>
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

        <div class="grid-slot-waktu"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 15px;">

            {{-- Logic PHP untuk generate jam berdasarkan open_time dan close_time --}}
            @php
                $startHour = (int) substr($court->open_time, 0, 2);
                $endHour = (int) substr($court->close_time, 0, 2);

                // Dummy data booked (Nanti ini harus dikirim dari Controller)
                // Misal jam 08:00 dan 10:00 sudah dipesan
                $jamSudahDipesan = ['08:00', '10:00', '19:00'];
            @endphp

            @for ($i = $startHour; $i < $endHour; $i++)
                @php
                    $formatJam = sprintf('%02d:00', $i);
                    $isBooked = in_array($formatJam, $jamSudahDipesan);
                @endphp

                <div class="slot-item {{ $isBooked ? 'booked' : '' }}"
                    onclick="pilihJam(this, '{{ $formatJam }}', {{ $court->price_per_hour }})">

                    @if ($isBooked)
                        <span class="badge-sold">Full</span>
                    @endif

                    <p class="text-muted small mb-1">60 Menit</p>
                    <strong class="d-block mb-1 text-dark">{{ $formatJam }} - {{ sprintf('%02d:00', $i + 1) }}</strong>

                    @if (!$isBooked)
                        <span
                            class="fw-bold text-primary">Rp{{ number_format($court->price_per_hour, 0, ',', '.') }}</span>
                    @else
                        <span class="small text-muted">Tidak Tersedia</span>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    <div id="checkout-bar" class="d-none animate__animated animate__slideInUp">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <span class="text-muted small">Total Pembayaran</span>
                <h4 class="fw-bold text-primary mb-0" id="display-total">Rp0</h4>
            </div>
            <button class="btn btn-primary px-5 fw-bold" style="background-color: #004AAC;" onclick="bukaModalCheckout()">
                Lanjut ke Checkout
            </button>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let jamTerpilih = null;
        let hargaTerpilih = 0;

        function tampilkanJadwal() {
            const area = document.getElementById('area-booking-jadwal');
            area.style.display = 'block';
            area.scrollIntoView({
                behavior: 'smooth'
            });
        }

        function pilihJam(elemen, jam, harga) {
            // Jika jadwal sudah dibooked (punya class booked), jangan lakukan apa-apa
            if (elemen.classList.contains('booked')) return;

            // Reset semua pilihan sebelumnya
            document.querySelectorAll('.slot-item').forEach(item => {
                item.classList.remove('terpilih');
            });

            // Tandai yang baru diklik
            elemen.classList.add('terpilih');

            jamTerpilih = jam;
            hargaTerpilih = harga;

            // Tampilkan checkout bar dan update harganya
            document.getElementById('display-total').innerText = "Rp " + harga.toLocaleString('id-ID');
            document.getElementById('checkout-bar').classList.remove('d-none');
        }

        function bukaModalCheckout() {
            if (!jamTerpilih) return alert('Silakan pilih jam main dulu!');

            document.getElementById('detail-pesanan-jam').innerText = "Jadwal: Jam " + jamTerpilih;
            document.getElementById('harga-final').innerText = "Rp" + hargaTerpilih.toLocaleString('id-ID');
            document.getElementById('total-final').innerText = "Rp" + hargaTerpilih.toLocaleString('id-ID');

            var myModal = new bootstrap.Modal(document.getElementById('modalCheckout'));
            myModal.show();
        }
    </script>
@endsection
