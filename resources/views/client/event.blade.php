@extends('layouts.client')

@section('content')
    <section id="events" class="services section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            @php
                // Memisahkan event menjadi 2 kumpulan: $eventAktif dan $riwayatEvent
                [$eventAktif, $riwayatEvent] = $events->partition(function ($event) {
                    return !\Carbon\Carbon::parse($event->event_date)->isPast();
                });
            @endphp

            {{-- SECTION 1: EVENT AKTIF --}}
            <div class="mb-4">
                <h4 class="fw-bold mb-1">Event Tersedia</h4>
                <p class="text-muted small">Jangan lewatkan kesempatan untuk bergabung dalam event olahraga terbaru!</p>
            </div>

            <div class="row gy-4 mb-5">
                @forelse ($eventAktif as $event)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item h-100 d-flex flex-column justify-content-between">
                            <div>
                                {{-- Thumbnail --}}
                                <div class="service-image">
                                    <img src="{{ asset('storage/thumbnail_event/' . $event->thumbnail) }}"
                                        alt="{{ $event->title }}" class="img-fluid">
                                    <div class="service-overlay">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="service-content">


                                    <h3>{{ $event->title }}</h3>
                                    <p>{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>

                                    {{-- Event Info --}}
                                    <div class="service-features">
                                        <span class="feature-item">
                                            <i class="bi bi-calendar"></i>
                                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                        </span>

                                        @if ($event->location)
                                            <span class="feature-item">
                                                <i class="bi bi-geo-alt"></i>
                                                {{ $event->location }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="service-content pt-0">
                                <a href="{{ $event->registration_link }}" target="_blank"
                                    class="service-btn w-100 text-center justify-content-center">
                                    <span>Daftar Sekarang</span>
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted">Tidak ada event aktif yang tersedia saat ini.</p>
                    </div>
                @endforelse

            </div>


            {{-- PEMISAH RIWAYAT EVENT --}}
            @if ($riwayatEvent->isNotEmpty())
                <hr class="my-5" style="opacity: 0.15;">

                <div class="mb-4">
                    <h4 class="fw-bold mb-1 text-secondary">Riwayat Event</h4>
                    <p class="text-muted small">Daftar kompetisi dan event yang telah selesai dilaksanakan.</p>
                </div>

                <div class="row gy-4">
                    @foreach ($riwayatEvent as $event)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            {{-- Kartu tetap berwarna asli, tidak abu-abu --}}
                            <div class="service-item h-100 d-flex flex-column justify-content-between">
                                <div>
                                    {{-- Thumbnail berwarna asli --}}
                                    <div class="service-image">
                                        <img src="{{ asset('storage/thumbnail_event/' . $event->thumbnail) }}"
                                            alt="{{ $event->title }}" class="img-fluid">
                                    </div>

                                    {{-- Content berwarna asli --}}
                                    <div class="service-content">
                                        <h3>{{ $event->title }}</h3>
                                        <p>{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>

                                        {{-- Event Info berwarna asli --}}
                                        <div class="service-features">
                                            <span class="feature-item">
                                                <i class="bi bi-calendar"></i>
                                                {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                            </span>
                                            @if ($event->location)
                                                <span class="feature-item">
                                                    <i class="bi bi-geo-alt"></i>
                                                    {{ $event->location }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- HANYA Tombol yang disable dan berwarna abu-abu --}}
                                <div class="service-content pt-0">
                                    {{-- Menggunakan class btn-secondary dan atribut disabled --}}
                                    <button class="btn btn-secondary btn-sm w-100 py-2 fw-semibold disabled-expired-btn"
                                        disabled>
                                        <i class="bi bi-x-circle me-2"></i> Sudah Berakhir
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif


            {{-- Pagination --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $events->links() }}
            </div>

        </div>

    </section>
@endsection

{{-- Tambahan Style Khusus merapikan tombol disabled --}}
@section('styles')
    <style>
        .disabled-expired-btn:disabled {
            background-color: #6c757d !important;
            /* Warna abu-abu tombol secondary */
            border-color: #6c757d !important;
            opacity: 0.65;
            /* Sedikit redup khas tombol disabled */
            cursor: not-allowed;
            /* Kursor silang saat diarahkan */
            border-radius: 50px;
            /* Menjaga bentuk kapsul service-btn asli */
        }
    </style>
@endsection
