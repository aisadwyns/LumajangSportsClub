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
                    <button class="btn btn-primary px-4" style="background-color: #004AAC;">Book now</button>
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
@endsection
