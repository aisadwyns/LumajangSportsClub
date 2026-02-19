@extends('layouts.client')

@section('content')
    <main class="main">

        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Komunitas</h1>
                            <p class="mb-0">Pilih komunitas berdasarkan jenis, waktu, lokasi, dan harga per sesi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('client') }}">Home</a></li>
                        <li class="current">Komunitas</li>
                    </ol>
                </div>
            </nav>
        </div>

        <section id="doctors" class="doctors section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">

                    @foreach ($komunitas as $i => $data)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 + ($i % 4) * 100 }}">
                            <div class="doctor-card text-center">

                                <div class="doctor-image d-flex justify-content-center">
                                    <img src="{{ $data->logo ? asset('storage/logo_komunitas/' . $data->logo) : asset('assets/img/health/staff-1.webp') }}"
                                        alt="{{ $data->nama_komunitas }}" class="img-fluid rounded-circle"
                                        style="width: 140px; height: 140px; object-fit: cover;">
                                </div>

                                <div class="doctor-content">
                                    <h4 class="mt-3">{{ $data->nama_komunitas }}</h4>
                                    <span class="specialty d-block mb-3">
                                        {{ $data->jenis?->nama ?? ($data->jenis?->nama_jenis ?? '-') }}
                                    </span>

                                    <div class="doctor-meta d-flex flex-column gap-2 align-items-center">
                                        <div class="experience d-flex align-items-center gap-2">
                                            <i class="bi bi-clock"></i>
                                            <span>{{ $data->waktu ? substr($data->waktu, 0, 5) : '-' }}</span>
                                        </div>

                                        <div class="department d-flex align-items-center gap-2">
                                            <i class="bi bi-geo-alt"></i>
                                            <span>{{ $data->lokasi ?? '-' }}</span>
                                        </div>

                                        <div class="department d-flex align-items-center gap-2">
                                            <i class="bi bi-cash-coin"></i>
                                            <span>Rp{{ number_format($data->harga_per_sesi ?? 0, 0, ',', '.') }}/sesi</span>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 justify-content-center mt-4">
                                        <a href="{{ route('komunitas.show', $data->id) }}" class="btn-appointment">
                                            Lihat Detail
                                        </a>

                                        @auth
                                            @if (auth()->user()->komunitas->contains($data->id))
                                                <form action="{{ route('komunitas.leave', $data->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-appointment"
                                                        style="background-color: #dc3545;">
                                                        Keluar
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('komunitas.join', $data->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-appointment">
                                                        Join
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="btn-appointment">Join</a>
                                        @endauth
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

    </main>
@endsection
