@extends('layouts.client')

@section('content')
    <main class="main">

        <div class="page-title">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="#">Home</a></li>
                        <li><a href="{{ route('komunitas.index') }}">Komunitas</a></li>
                        <li class="current">Detail {{ $komunitas->nama_komunitas }}</li>
                    </ol>
                </div>
            </nav>
        </div>

        <section class="bagian-detail-komunitas">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">

                    <div class="col-lg-8">
                        <div class="konten-detail-kiri">
                            <h2 class="judul-komunitas fw-bold mb-3">{{ $komunitas->nama_komunitas }}</h2>
                            <p class="sub-judul text-muted mb-4">
                                {{ $komunitas->deskripsi_singkat ?? 'Tingkatkan kemampuan Anda bersama para ahli di bidangnya.' }}
                            </p>

                            <div class="info-tambahan d-flex align-items-center gap-3 mb-4">
                                <span class="label-level">PEMULA</span>
                                <div class="rating-bintang text-warning">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-half"></i>
                                </div>
                                <span class="text-muted small">42 ulasan</span>
                                <span class="text-muted small">0 anggota</span>
                            </div>

                            <hr class="garis-pembatas my-5">

                            <div class="area-deskripsi">
                                <h4 class="fw-bold mb-3">Tentang Komunitas</h4>
                                <p class="tagline-komunitas fw-semibold">
                                    {{ $komunitas->tagline ?? 'Membangun Masa Depan Bersama' }}</p>
                                <div class="teks-isi-deskripsi">
                                    {!! $komunitas->deskripsi ?? 'Informasi lengkap komunitas belum tersedia.' !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="panel-samping-lengket">
                            <div class="kartu-aksi-join border-0 shadow-sm overflow-hidden">
                                <div class="wadah-gambar-sampul">
                                    <img src="{{ $komunitas->logo ? asset('storage/logo_komunitas/' . $komunitas->logo) : asset('assets/img/hero-bg.jpg') }}"
                                        class="gambar-sampul" alt="Cover">
                                </div>

                                <div class="isi-kartu p-4">
                                    <div class="harga-sesi mb-2">
                                        <h3 class="fw-bold">
                                            Rp{{ number_format($komunitas->harga_per_sesi ?? 0, 0, ',', '.') }}</h3>
                                    </div>
                                    <p class="label-akses text-muted small mb-4">Akses keanggotaan selamanya</p>

                                    @auth
                                        @if (auth()->user()->komunitas->contains($komunitas->id))
                                            <form action="{{ route('komunitas.leave', $komunitas->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="tombol-aksi tombol-keluar w-100 py-2 fw-bold mb-3">
                                                    Keluar Komunitas
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('komunitas.join', $komunitas->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="tombol-aksi tombol-gabung w-100 py-2 fw-bold mb-3">
                                                    Gabung Sekarang
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="tombol-aksi tombol-gabung w-100 py-2 fw-bold mb-3 text-center d-block text-decoration-none">
                                            Login untuk Gabung
                                        </a>
                                    @endauth

                                    <div class="manfaat-komunitas mt-4">
                                        <h6 class="fw-bold mb-3">Apa yang Anda dapatkan:</h6>
                                        <ul class="daftar-manfaat list-unstyled d-flex flex-column gap-2">
                                            <li><i class="bi bi-patch-check-fill text-success me-2"></i> Materi Eksklusif
                                            </li>
                                            <li><i class="bi bi-patch-check-fill text-success me-2"></i> Lokasi:
                                                {{ $komunitas->lokasi ?? '-' }}</li>
                                            <li><i class="bi bi-patch-check-fill text-success me-2"></i> Sesi Jam:
                                                {{ $komunitas->waktu ? substr($komunitas->waktu, 0, 5) : '-' }}</li>
                                            <li><i class="bi bi-patch-check-fill text-success me-2"></i> Konsultasi Langsung
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="aksi-bagikan text-center mt-3">
                                <button class="btn btn-link text-muted text-decoration-none small">
                                    <i class="bi bi-share-fill me-1"></i> Bagikan Komunitas
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
