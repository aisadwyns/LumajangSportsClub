<footer id="footer" class="footer-16 footer position-relative">

    <div class="container">

        <div class="footer-main" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-start">

                <!-- Brand -->
                <div class="col-lg-5">
                    <div class="brand-section">
                        <a href="{{ url('/') }}" class="logo d-flex align-items-center mb-4">
                            <span class="sitename">Lumajang Sports Club</span>
                        </a>

                        <p class="brand-description">
                            Platform olahraga terintegrasi untuk booking lapangan, komunitas olahraga,
                            dan informasi terkini seputar kegiatan Lumajang Sports Club.
                        </p>

                        <div class="contact-info mt-5">
                            <div class="contact-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>Lumajang, Jawa Timur, Indonesia</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-telephone"></i>
                                <span>+62 8xx-xxxx-xxxx</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-envelope"></i>
                                <span>info@lumajangsportsclub.id</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Navigation -->
                <div class="col-lg-7">
                    <div class="footer-nav-wrapper">
                        <div class="row">

                            <!-- Platform -->
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>Platform</h6>
                                    <nav class="footer-nav">
                                        <a href="{{ url('/') }}">Beranda</a>
                                        <a href="{{ route('blogs.public') }}">Blog</a>
                                        <a href="{{ url('/venues') }}">Booking Lapangan</a>
                                        <a href="{{ url('/komunitas') }}">Komunitas</a>
                                    </nav>
                                </div>
                            </div>

                            <!-- Layanan -->
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>Layanan</h6>
                                    <nav class="footer-nav">
                                        <a href="{{ url('/booking') }}">Pemesanan Lapangan</a>
                                        <a href="{{ url('/events') }}">Event Olahraga</a>
                                        <a href="{{ url('/membership') }}">Keanggotaan</a>
                                        <a href="{{ url('/mitra') }}">Mitra Venue</a>
                                    </nav>
                                </div>
                            </div>

                            <!-- Informasi -->
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>Informasi</h6>
                                    <nav class="footer-nav">
                                        <a href="{{ route('blogs.public') }}">Artikel & Berita</a>
                                        <a href="{{ url('/faq') }}">FAQ</a>
                                        <a href="{{ url('/tentang-kami') }}">Tentang Kami</a>
                                        <a href="{{ url('/kontak') }}">Kontak</a>
                                    </nav>
                                </div>
                            </div>

                            <!-- Akun -->
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>Akun</h6>
                                    <nav class="footer-nav">
                                        @auth
                                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                                            <a href="{{ url('/profile') }}">Profil</a>
                                        @else
                                            <a href="{{ route('login') }}">Masuk</a>
                                            <a href="{{ route('register') }}">Daftar</a>
                                        @endauth
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="bottom-content" data-aos="fade-up" data-aos-delay="300">
                <div class="row align-items-center">

                    <div class="col-lg-6">
                        <div class="copyright">
                            <p>
                                © {{ date('2026') }}
                                <span class="sitename">Lumajang Sports Club</span>.
                                All rights reserved.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="legal-links">
                            <a href="{{ url('/privacy-policy') }}">Kebijakan Privasi</a>
                            <a href="{{ url('/terms') }}">Syarat & Ketentuan</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</footer>
