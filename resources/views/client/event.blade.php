@extends('layouts.client')

@section('content')
    <section id="events" class="services section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                @forelse ($events as $event)
                    @php
                        // Cek apakah tanggal event sudah lebih kecil dari hari ini
                        $sudahLewat = \Carbon\Carbon::parse($event->event_date)->isPast();
                    @endphp

                    <div class="col-lg-4 col-md-6 {{ $sudahLewat ? 'event-tutup' : '' }}" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="service-item">

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

                                <p>
                                    {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                                </p>

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

                                <a href="{{ $sudahLewat ? '#' : $event->registration_link }}"
                                    {{ $sudahLewat ? '' : 'target="_blank"' }} class="service-btn">
                                    <span>{{ $sudahLewat ? 'Sudah Berakhir' : 'Daftar Sekarang' }}</span>

                                    {{-- Tanda panah hanya muncul jika event BELUM lewat --}}
                                    @if (!$sudahLewat)
                                        <i class="fas fa-arrow-right"></i>
                                    @endif
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Tidak ada event tersedia.</p>
                    </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $events->links() }}
            </div>

        </div>

    </section>
@endsection
