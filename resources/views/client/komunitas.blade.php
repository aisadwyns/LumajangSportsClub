@extends('layouts.client')

@section('content')
    <main class="main">

        <div class="page-title">
            <div class="heading text-white" style="background-color: #004AAC">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title text-white">Komunitas</h1>
                            <p class="mb-0">Pilih komunitas berdasarkan jenis, waktu, lokasi, dan harga per sesi.</p>


                            <div class="mt-4">
                                @auth
                                    <a href="{{ route('client.komunitas.create') }}" class="btn btn-light fw-bold px-4 py-2"
                                        style="color: #004AAC; border-radius: 30px;">
                                        <i class="bi bi-plus-circle-fill me-2"></i> Ingin Menambahkan Komunitas Anda? Buat di
                                        Sini!
                                    </a>
                                @else
                                    <a href="{{ route('login') }}?redirect_to={{ route('client.komunitas.create') }}"
                                        class="btn btn-light fw-bold px-4 py-2" style="color: #004AAC; border-radius: 30px;">
                                        <i class="bi bi-plus-circle-fill me-2"></i> Ingin Menambahkan Komunitas Anda? Buat di
                                        Sini!
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('client') }}">Home</a></li>
                        <li class="current">Komunitas</li>
                    </ol>
                </div>
            </nav> --}}
        </div>

        <section id="doctors" class="doctors section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">

                    @foreach ($komunitas as $i => $data)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 + ($i % 4) * 100 }}">
                            <a href="{{ route('client.komunitas.show', $data->id) }}"
                                class="text-decoration-none text-reset">
                                <div class="doctor-card text-center h-100">

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
                                    </div>

                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        @auth
            @if (isset($riwayat_komunitas) && $riwayat_komunitas->count() > 0)
                <section id="riwayat-pengajuan" class="riwayat section py-4" style="background-color: #f8f9fa;">
                    <div class="container" data-aos="fade-up">
                        <div class="mb-4">
                            <h3 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Riwayat Pengajuan Anda</h3>
                            <p class="text-muted small">Daftar komunitas olahraga yang pernah Anda daftarkan di platform
                                Lumajang Sports Club</p>
                        </div>

                        <div class="card shadow-sm p-3 mb-5" style="border-radius: 12px; border: none;">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 text-nowrap">
                                    <thead class="table-light" style="font-size: 13px;">
                                        <tr>
                                            <th scope="col" class="ps-3">Logo</th>
                                            <th scope="col">Nama Komunitas</th>
                                            <th scope="col">Cabang Olahraga</th>
                                            <th scope="col">Lokasi Basecamp</th>
                                            <th scope="col">Tanggal Pengajuan</th>
                                            <th scope="col" class="pe-3 text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 14px;">
                                        @foreach ($riwayat_komunitas as $riwayat)
                                            <tr>
                                                <td class="ps-3">
                                                    <img src="{{ $riwayat->logo ? asset('storage/logo_komunitas/' . $riwayat->logo) : asset('assets/img/health/staff-1.webp') }}"
                                                        alt="Logo" class="rounded-circle"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                </td>
                                                <td>
                                                    <span class="fw-bold text-dark">{{ $riwayat->nama_komunitas }}</span>
                                                </td>
                                                <td>{{ $riwayat->jenis?->nama ?? ($riwayat->jenis?->nama_jenis ?? '-') }}</td>
                                                <td><i
                                                        class="bi bi-geo-alt text-secondary me-1"></i>{{ $riwayat->lokasi ?? '-' }}
                                                </td>
                                                <td>{{ $riwayat->created_at ? $riwayat->created_at->translatedFormat('d F Y') : '-' }}
                                                </td>
                                                <td class="pe-3 text-center">
                                                    @if ($riwayat->status == 'publish')
                                                        <span class="badge bg-success-subtle text-success px-3 py-2"
                                                            style="border-radius: 20px; font-size: 12px;">
                                                            <i class="bi bi-check-circle-fill me-1"></i> Disetujui
                                                        </span>
                                                    @elseif($riwayat->status == 'unpublish')
                                                        <span class="badge bg-danger-subtle text-danger px-3 py-2"
                                                            style="border-radius: 20px; font-size: 12px;">
                                                            <i class="bi bi-x-circle-fill me-1"></i> Ditolak / Off
                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning-subtle text-warning px-3 py-2"
                                                            style="border-radius: 20px; font-size: 12px;">
                                                            <i class="bi bi-hourglass-split me-1"></i> Menunggu
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endauth

    </main>
@endsection
