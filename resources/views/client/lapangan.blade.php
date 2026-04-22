@extends('layouts.client')

@section('content')
    <main class="main">

        <div class="page-title">
            <div class="heading text-white" style="background-color: #004AAC">
                <div class="container text-center">
                    <h1 class="heading-title text-white">Lapangan</h1>
                    <p class="mb-0">Pilih lapangan terbaik untuk bermain.</p>
                </div>
            </div>
        </div>

        <section id="courts" class="departments section">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">

                    @foreach ($courts as $i => $court)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i + 1) * 100 }}">
                            <div class="department-card">

                                {{-- ICON --}}
                                <div class="department-icon">
                                    <i class="fas fa-futbol"></i>
                                </div>

                                {{-- IMAGE --}}
                                <div class="department-image">
                                    <img src="{{ $court->image
                                        ? asset('storage/courts/' . $court->image)
                                        : asset('client/dist/assets/img/health/lapangan-1.jpg') }}"
                                        alt="{{ $court->name }}" class="img-fluid">
                                </div>

                                {{-- CONTENT --}}
                                <div class="department-content">
                                    <h3>{{ $court->name }}</h3>

                                    <p>{{ $court->description ?? 'Lapangan olahraga berkualitas' }}</p>

                                    <div class="court-info">

                                        <div class="info-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{ ucfirst($court->court_type ?? '-') }}</span>
                                        </div>

                                        <div class="info-item">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <span>
                                                Rp{{ number_format($court->price_per_hour ?? 0, 0, ',', '.') }}/jam
                                            </span>
                                        </div>

                                        <div class="info-item">
                                            <i class="fas fa-clock"></i>
                                            <span>
                                                {{ $court->open_time ? substr($court->open_time, 0, 5) : '-' }}
                                                -
                                                {{ $court->close_time ? substr($court->close_time, 0, 5) : '-' }}
                                            </span>
                                        </div>

                                    </div>

                                    <a href="{{ route('lapangan.show', $court->id) }}" class="learn-more mt-4">
                                        <span>Lihat Lapangan</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>

                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </section>

    </main>
@endsection
