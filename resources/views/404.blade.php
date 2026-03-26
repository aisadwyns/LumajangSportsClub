@extends('layouts.client')
@section('content')
    <div class="container">
        <div class="class">
            <div>
                <section id="error-404" class="error-404 section">
                    <div class="container" data-aos="fade-up" data-aos-delay="100">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 text-center">
                                <div class="error-number" data-aos="zoom-in" data-aos-delay="200">
                                    404
                                </div>
                                <h1 class="error-title" data-aos="fade-up" data-aos-delay="300">
                                    Halaman Tidak Ditemukan
                                </h1>
                                <p class="error-description" data-aos="fade-up" data-aos-delay="400">
                                    Waduh, sepertinya kamu keluar dari area permainan! Halaman yang kamu cari mungkin telah
                                    dihapus, berganti nama, atau sedang tidak tersedia untuk sementara di platform Lumajang
                                    Sports Club.
                                </p>
                                <div class="error-actions" data-aos="fade-up" data-aos-delay="500">
                                    <a href="/" class="btn-primary">
                                        <i class="bi bi-house"></i>
                                        Kembali ke Beranda
                                    </a>
                                    <a href="#!" class="btn-secondary">
                                        <i class="bi bi-search"></i>
                                        Cari di Website
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-10">
                                <div class="helpful-links" data-aos="fade-up" data-aos-delay="600">
                                    <h3>Mungkin kamu mencari:</h3>
                                    <div class="links-grid">
                                        <a href="#!" class="link-item">
                                            <i class="bi bi-info-circle"></i>
                                            <span>Tentang LSC</span>
                                        </a>
                                        <a href="#!" class="link-item">
                                            <i class="bi bi-telephone"></i>
                                            <span>Kontak Kami</span>
                                        </a>
                                        <a href="#!" class="link-item">
                                            <i class="bi bi-grid-3x3-gap"></i>
                                            <span>Sewa Lapangan</span>
                                        </a>
                                        <a href="{{ route('blogs.public') }}" class="link-item">
                                            <i class="bi bi-journal-text"></i>
                                            <span>Blog & Berita</span>
                                        </a>
                                        <a href="#!" class="link-item">
                                            <i class="bi bi-question-circle"></i>
                                            <span>Pusat Bantuan</span>
                                        </a>
                                        <a href="#!" class="link-item">
                                            <i class="bi bi-shield-check"></i>
                                            <span>Kebijakan Privasi</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection()
