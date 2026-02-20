<!DOCTYPE html>
<html lang="en">

<head>
    <x-client.head />
</head>

<body class="index-page">
    <header id="header" class="header fixed-top">
        <x-client.header />
        <x-client.navbar />
    </header>

    <main class="main">
        <!-- Hero Section -->
        <x-client.hero />
        <!-- /Hero Section -->


        <section id="about" class="about section">
            <div class="certifications-section aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h3>Accreditations &amp; Certifications</h3>
                        <p class="section-description">Recognized by leading healthcare organizations for our commitment
                            to
                            quality care</p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 aos-init aos-animate" data-aos="zoom-in"
                        data-aos-delay="100">
                        <div class="certification-item">
                            <img src="{{ asset('client/dist') }}/assets/img/clients/clients-1.webp" class="img-fluid"
                                alt="Healthcare certification">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 aos-init aos-animate" data-aos="zoom-in"
                        data-aos-delay="200">
                        <div class="certification-item">
                            <img src="{{ asset('client/dist') }}/assets/img/clients/clients-2.webp" class="img-fluid"
                                alt="Medical accreditation">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 aos-init aos-animate" data-aos="zoom-in"
                        data-aos-delay="300">
                        <div class="certification-item">
                            <img src="{{ asset('client/dist') }}/assets/img/clients/clients-3.webp" class="img-fluid"
                                alt="Healthcare certification">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 aos-init aos-animate" data-aos="zoom-in"
                        data-aos-delay="400">
                        <div class="certification-item">
                            <img src="{{ asset('client/dist') }}/assets/img/clients/clients-4.webp" class="img-fluid"
                                alt="Medical certification">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 aos-init aos-animate" data-aos="zoom-in"
                        data-aos-delay="500">
                        <div class="certification-item">
                            <img src="{{ asset('client/dist') }}/assets/img/clients/clients-5.webp" class="img-fluid"
                                alt="Healthcare accreditation">
                        </div>
                    </div>
                </div><!-- End Certifications Row -->
            </div>
        </section>

        <section id="home-about" class="home-about section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
                        <div class="about-content">
                            <h2 class="section-heading">Lumajang Sports Club — Temukan Partner &amp; Booking Lapangan
                            </h2>
                            <p class="lead-text">
                                Lumajang Sports Club (LSC) adalah platform buat kamu yang mau cari partner olahraga,
                                gabung komunitas, dan booking lapangan dalam satu tempat.
                            </p>

                            <p>
                                Di LSC, kamu bisa ketemu teman main yang selevel, ikut open match, dan atur jadwal main
                                lebih gampang. Mulai dari badminton, futsal, basket, voli, sampai lari bareng—semua jadi
                                lebih seru karena kamu nggak main sendirian. Aktivitas kamu juga tercatat untuk sistem
                                poin &amp; leaderboard.
                            </p>

                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="15000" data-purecounter-duration="1"></div>
                                    <div class="stat-label">Members Bergabung</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="25" data-purecounter-duration="1"></div>
                                    <div class="stat-label">Komunitas Aktif</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="50" data-purecounter-duration="1"></div>
                                    <div class="stat-label">Venue &amp; Lapangan Partner</div>
                                </div>
                            </div>

                            <div class="cta-section">
                                <a href="about-lsc.html" class="btn-primary">Kenal Lumajang Sports Club</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="about-visual">
                            <div class="main-image">
                                <img src="assets/img/health/facilities-9.webp" alt="Lumajang Sports Club"
                                    class="img-fluid">
                            </div>
                            <div class="floating-card">
                                <div class="card-content">
                                    <div class="icon">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="card-text">
                                        <h4>Cari Partner Cepat</h4>
                                        <p>Match sesuai jadwal &amp; level permainan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="experience-badge">
                                <div class="badge-content">
                                    <span class="years">25+</span>
                                    <span class="text">Komunitas &amp; Venue Terhubung</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Home About Section -->

        <!-- Featured Departments Section -->
        <section id="featured-departments" class="featured-departments section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Fitur Unggulan</h2>
                <p>Temukan partner, gabung komunitas, booking venue, dan raih peringkat di leaderboard.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-5">

                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="specialty-card">
                            <div class="specialty-content">
                                <div class="specialty-meta">
                                    <span class="specialty-label">Matchmaking</span>
                                </div>
                                <h3>Cari Partner Olahraga</h3>
                                <p>
                                    Temukan partner berdasarkan cabang olahraga, lokasi, jadwal kosong, dan level
                                    permainan.
                                    Cocok untuk latihan rutin, sparring, atau open match.
                                </p>
                                <div class="specialty-features">
                                    <span><i class="bi bi-check-circle-fill"></i>Match sesuai jadwal</span>
                                    <span><i class="bi bi-check-circle-fill"></i>Filter level &amp; lokasi</span>
                                </div>
                                <a href="partners.html" class="specialty-link">
                                    Mulai Cari Partner <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="specialty-visual">
                                <img src="assets/img/health/cardiology-1.webp" alt="Cari Partner Olahraga"
                                    class="img-fluid">
                                <div class="visual-overlay">
                                    <i class="bi bi-people"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Specialty Card -->

                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="specialty-card">
                            <div class="specialty-content">
                                <div class="specialty-meta">
                                    <span class="specialty-label">Booking</span>
                                </div>
                                <h3>Booking Lapangan &amp; Venue</h3>
                                <p>
                                    Cek ketersediaan, booking instan, dan kelola jadwal main bareng komunitas.
                                    Semua slot rapi, transparan, dan mudah dipantau.
                                </p>
                                <div class="specialty-features">
                                    <span><i class="bi bi-check-circle-fill"></i>Ketersediaan real-time</span>
                                    <span><i class="bi bi-check-circle-fill"></i>Booking &amp; pengingat
                                        otomatis</span>
                                </div>
                                <a href="venues.html" class="specialty-link">
                                    Lihat Venue <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="specialty-visual">
                                <img src="assets/img/health/neurology-4.webp" alt="Booking Lapangan"
                                    class="img-fluid">
                                <div class="visual-overlay">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Specialty Card -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="department-highlight">
                            <div class="highlight-icon">
                                <i class="bi bi-trophy"></i>
                            </div>
                            <h4>Event &amp; Open Match</h4>
                            <p>
                                Ikut game yang lagi cari pemain, bikin jadwal bareng, atau gabung turnamen mini
                                komunitas.
                            </p>
                            <ul class="highlight-list">
                                <li>Open Match</li>
                                <li>Friendly Match</li>
                                <li>Turnamen Mini</li>
                            </ul>
                            <a href="events.html" class="highlight-cta">Learn More</a>
                        </div>
                    </div><!-- End Department Highlight -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="department-highlight">
                            <div class="highlight-icon">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <h4>Komunitas &amp; Grup</h4>
                            <p>
                                Gabung grup berdasarkan cabang olahraga dan area. Koordinasi makin gampang, vibes makin
                                dapet.
                            </p>
                            <ul class="highlight-list">
                                <li>Grup Cabang Olahraga</li>
                                <li>Chat Koordinasi</li>
                                <li>Rekrut Member</li>
                            </ul>
                            <a href="communities.html" class="highlight-cta">Learn More</a>
                        </div>
                    </div><!-- End Department Highlight -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="department-highlight">
                            <div class="highlight-icon">
                                <i class="bi bi-bar-chart-line"></i>
                            </div>
                            <h4>Leaderboard</h4>
                            <p>
                                Naik peringkat dari aktivitas olahraga kamu. Kumpulin poin, badge, dan jadi top player
                                komunitas.
                            </p>
                            <ul class="highlight-list">
                                <li>Peringkat Mingguan</li>
                                <li>Poin Aktivitas</li>
                                <li>Badge &amp; Reward</li>
                            </ul>
                            <a href="leaderboard.html" class="highlight-cta">Learn More</a>
                        </div>
                    </div><!-- End Department Highlight -->

                </div>

                <div class="emergency-banner" data-aos="fade-up" data-aos-delay="400">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="emergency-content">
                                <h3>Ayo Main Minggu Ini!</h3>
                                <p>
                                    Buat jadwal, ajak partner, dan booking lapangan langsung dari Lumajang Sports Club.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="booking.html" class="emergency-btn">
                                <i class="bi bi-calendar-check-fill"></i>
                                Buat Jadwal Sekarang
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Featured Departments Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Cara Kerja Lumajang Sports Club</h2>
                <p>Dari cari partner sampai main bareng—semua lebih simpel dalam satu platform.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-0">

                    <div class="col-lg-8" data-aos="fade-right" data-aos-delay="200">
                        <div class="featured-service-main">
                            <div class="service-image-wrapper">
                                <img src="{{ asset('client/dist') }}/assets/img/health/consultation-4.webp"
                                    alt="Lumajang Sports Club" class="img-fluid" loading="lazy">
                                <div class="service-overlay">
                                    <div class="service-badge">
                                        <i class="bi bi-people"></i>
                                        <span>Engagement Hub</span>
                                    </div>
                                </div>
                            </div>
                            <div class="service-details">
                                <h2>Satu Platform untuk Semua Aktivitas Olahraga</h2>
                                <p>
                                    Jelajahi komunitas, temukan partner selevel, lalu booking venue tanpa ribet.
                                    Aktivitasmu tercatat dan bisa masuk ke sistem poin &amp; leaderboard.
                                </p>
                                <a href="features.html" class="main-cta">Explore Fitur LSC</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4" data-aos="fade-left" data-aos-delay="300">
                        <div class="services-sidebar">

                            <div class="service-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="service-icon-wrapper">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="service-info">
                                    <h4>Temukan Komunitas</h4>
                                    <p>
                                        Pilih cabang olahraga &amp; area, lalu join komunitas terdekat untuk mulai
                                        aktif.
                                    </p>
                                    <a href="communities.html" class="service-link">Learn More</a>
                                </div>
                            </div>

                            <div class="service-item" data-aos="fade-up" data-aos-delay="500">
                                <div class="service-icon-wrapper">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                                <div class="service-info">
                                    <h4>Cari Partner</h4>
                                    <p>
                                        Match berdasarkan jadwal, level, dan preferensi main biar nggak susah cari
                                        teman.
                                    </p>
                                    <a href="partners.html" class="service-link">Learn More</a>
                                </div>
                            </div>

                            <div class="service-item" data-aos="fade-up" data-aos-delay="600">
                                <div class="service-icon-wrapper">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <div class="service-info">
                                    <h4>Booking Venue</h4>
                                    <p>
                                        Lihat slot kosong dan booking lapangan langsung, lengkap dengan pengingat
                                        jadwal.
                                    </p>
                                    <a href="booking.html" class="service-link">Learn More</a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="specialties-grid" data-aos="fade-up" data-aos-delay="300">
                    <div class="row align-items-center">

                        <div class="col-lg-3 col-md-6">
                            <div class="specialty-card">
                                <div class="specialty-image">
                                    <img src="assets/img/health/maternal-2.webp" alt="Komunitas" class="img-fluid"
                                        loading="lazy">
                                </div>
                                <div class="specialty-content">
                                    <h5>Komunitas</h5>
                                    <span>Join grup &amp; circle main</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="specialty-card">
                                <div class="specialty-image">
                                    <img src="{{ asset('client/dist') }}/assets/img/health/vaccination-3.webp"
                                        alt="Open Match" class="img-fluid" loading="lazy">
                                </div>
                                <div class="specialty-content">
                                    <h5>Open Match</h5>
                                    <span>Gabung game yang butuh pemain</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="specialty-card">
                                <div class="specialty-image">
                                    <img src="{{ asset('client/dist') }}/assets/img/health/emergency-1.webp"
                                        alt="Booking Lapangan" class="img-fluid" loading="lazy">
                                </div>
                                <div class="specialty-content">
                                    <h5>Booking Lapangan</h5>
                                    <span>Jadwal main makin rapi</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="specialty-card">
                                <div class="specialty-image">
                                    <img src="{{ asset('client/dist') }}/assets/img/health/facilities-6.webp"
                                        alt="Leaderboard" class="img-fluid" loading="lazy">
                                </div>
                                <div class="specialty-content">
                                    <h5>Leaderboard</h5>
                                    <span>Naik peringkat &amp; kumpulin badge</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </section><!-- /Featured Services Section -->

        <!-- Find A Doctor Section -->
        <section id="find-a-doctor" class="find-a-doctor section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Temukan Partner Olahraga</h2>
                <p>Cari komunitas, open match, atau partner sesuai jadwal dan level permainanmu.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-8 text-center">
                        <div class="search-section">
                            <h3 class="search-title">Cari Komunitas / Partner yang Pas</h3>
                            <p class="search-subtitle">Masukkan nama komunitas / partner, lalu pilih cabang olahraga.
                            </p>
                            <form class="search-form" action="#!" method="#">
                                <div class="search-input-group">
                                    <div class="input-wrapper">
                                        <i class="bi bi-person"></i>
                                        <input type="text" class="form-control" name="doctor_name"
                                            placeholder="Masukkan nama komunitas / partner">
                                    </div>
                                    <div class="select-wrapper">
                                        <i class="bi bi-activity"></i>
                                        <select class="form-select" name="specialty">
                                            <option value="">Semua Olahraga</option>
                                            <option value="badminton">Badminton</option>
                                            <option value="futsal">Futsal</option>
                                            <option value="basket">Basket</option>
                                            <option value="voli">Voli</option>
                                            <option value="lari">Lari</option>
                                            <option value="tenis-meja">Tenis Meja</option>
                                            <option value="sepeda">Sepeda</option>
                                            <option value="gym">Gym</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="search-btn">
                                        <i class="bi bi-search"></i>
                                        Temukan Partner
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="doctors-grid" data-aos="fade-up" data-aos-delay="300">

                    <!-- Kamu bisa ganti konten card-card ini jadi "Komunitas" atau "Partner Profile" -->
                    <div class="doctor-profile" data-aos="zoom-in" data-aos-delay="100">
                        <div class="profile-header">
                            <div class="doctor-avatar">
                                <img src="{{ asset('client/dist') }}/assets/img/health/staff-2.webp"
                                    alt="Komunitas Badminton Lumajang" class="img-fluid">
                                <div class="status-indicator available"></div>
                            </div>
                            <div class="doctor-details">
                                <h4>Komunitas Badminton Lumajang</h4>
                                <span class="specialty-tag">Badminton • Intermediate</span>
                                <div class="experience-info">
                                    <i class="bi bi-award"></i>
                                    <span>Aktif 4x/minggu</span>
                                </div>
                            </div>
                        </div>
                        <div class="rating-section">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <span class="rating-score">4.9</span>
                            <span class="review-count">(127 anggota)</span>
                        </div>
                        <div class="action-buttons">
                            <a href="#!" class="btn-secondary">Lihat Detail</a>
                            <a href="#!" class="btn-primary">Gabung / Jadwalkan</a>
                        </div>
                    </div>

                    <div class="doctor-profile" data-aos="zoom-in" data-aos-delay="200">
                        <div class="profile-header">
                            <div class="doctor-avatar">
                                <img src="{{ asset('client/dist') }}/assets/img/health/staff-6.webp"
                                    alt="Open Match Futsal Weekend" class="img-fluid">
                                <div class="status-indicator busy"></div>
                            </div>
                            <div class="doctor-details">
                                <h4>Open Match Futsal Weekend</h4>
                                <span class="specialty-tag">Futsal • Beginner–Intermediate</span>
                                <div class="experience-info">
                                    <i class="bi bi-award"></i>
                                    <span>Butuh 2 pemain</span>
                                </div>
                            </div>
                        </div>
                        <div class="rating-section">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <span class="rating-score">4.8</span>
                            <span class="review-count">(89 peserta)</span>
                        </div>
                        <div class="action-buttons">
                            <a href="#!" class="btn-secondary">Lihat Detail</a>
                            <a href="#!" class="btn-primary">Ikut Match</a>
                        </div>
                    </div>

                    <div class="doctor-profile" data-aos="zoom-in" data-aos-delay="300">
                        <div class="profile-header">
                            <div class="doctor-avatar">
                                <img src="{{ asset('client/dist') }}/assets/img/health/staff-4.webp"
                                    alt="Komunitas Lari Pagi Lumajang" class="img-fluid">
                                <div class="status-indicator available"></div>
                            </div>
                            <div class="doctor-details">
                                <h4>Komunitas Lari Pagi Lumajang</h4>
                                <span class="specialty-tag">Lari • All Level</span>
                                <div class="experience-info">
                                    <i class="bi bi-award"></i>
                                    <span>Meetup tiap Minggu</span>
                                </div>
                            </div>
                        </div>
                        <div class="rating-section">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <span class="rating-score">5.0</span>
                            <span class="review-count">(203 anggota)</span>
                        </div>
                        <div class="action-buttons">
                            <a href="#!" class="btn-secondary">Lihat Detail</a>
                            <a href="#!" class="btn-primary">Gabung</a>
                        </div>
                    </div>

                    <div class="doctor-profile" data-aos="zoom-in" data-aos-delay="400">
                        <div class="profile-header">
                            <div class="doctor-avatar">
                                <img src="assets/img/health/staff-8.webp" alt="Sparring Basket Malam"
                                    class="img-fluid">
                                <div class="status-indicator offline"></div>
                            </div>
                            <div class="doctor-details">
                                <h4>Sparring Basket Malam</h4>
                                <span class="specialty-tag">Basket • Intermediate</span>
                                <div class="experience-info">
                                    <i class="bi bi-award"></i>
                                    <span>Jadwal belum ditentukan</span>
                                </div>
                            </div>
                        </div>
                        <div class="rating-section">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <span class="rating-score">4.7</span>
                            <span class="review-count">(156 peserta)</span>
                        </div>
                        <div class="action-buttons">
                            <a href="#!" class="btn-secondary">Lihat Detail</a>
                            <a href="#!" class="btn-primary">Buat Jadwal</a>
                        </div>
                    </div>

                    <div class="doctor-profile" data-aos="zoom-in" data-aos-delay="500">
                        <div class="profile-header">
                            <div class="doctor-avatar">
                                <img src="assets/img/health/staff-11.webp" alt="Komunitas Voli Lumajang"
                                    class="img-fluid">
                                <div class="status-indicator available"></div>
                            </div>
                            <div class="doctor-details">
                                <h4>Komunitas Voli Lumajang</h4>
                                <span class="specialty-tag">Voli • Beginner</span>
                                <div class="experience-info">
                                    <i class="bi bi-award"></i>
                                    <span>Latihan 2x/minggu</span>
                                </div>
                            </div>
                        </div>
                        <div class="rating-section">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                            </div>
                            <span class="rating-score">4.5</span>
                            <span class="review-count">(74 anggota)</span>
                        </div>
                        <div class="action-buttons">
                            <a href="#!" class="btn-secondary">Lihat Detail</a>
                            <a href="#!" class="btn-primary">Gabung</a>
                        </div>
                    </div>

                    <div class="doctor-profile" data-aos="zoom-in" data-aos-delay="600">
                        <div class="profile-header">
                            <div class="doctor-avatar">
                                <img src="assets/img/health/staff-14.webp" alt="Venue Badminton Indoor"
                                    class="img-fluid">
                                <div class="status-indicator available"></div>
                            </div>
                            <div class="doctor-details">
                                <h4>Venue Badminton Indoor</h4>
                                <span class="specialty-tag">Venue • Booking Available</span>
                                <div class="experience-info">
                                    <i class="bi bi-award"></i>
                                    <span>Slot tersedia hari ini</span>
                                </div>
                            </div>
                        </div>
                        <div class="rating-section">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <span class="rating-score">4.9</span>
                            <span class="review-count">(194 booking)</span>
                        </div>
                        <div class="action-buttons">
                            <a href="#!" class="btn-secondary">Lihat Detail</a>
                            <a href="#!" class="btn-primary">Booking</a>
                        </div>
                    </div>

                </div>

                <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="700">
                    <a href="communities.html" class="btn-view-all">
                        Lihat Semua Komunitas
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>

        </section><!-- /Find A Doctor Section -->

        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section light-background">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="hero-content">
                    <div class="row align-items-center">

                        <div class="col-lg-6">
                            <div class="content-wrapper" data-aos="fade-up" data-aos-delay="200">
                                <h1>Olahraga Jadi Lebih Seru Kalau Ada Partner</h1>
                                <p>
                                    Atur jadwal main, cari partner selevel, dan booking lapangan tanpa ribet.
                                    Bangun aktivitas rutin bareng komunitas di Lumajang Sports Club.
                                </p>

                                <div class="cta-wrapper">
                                    <a href="partners.html" class="primary-cta">
                                        <span>Mulai Cari Partner</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                    <a href="booking.html" class="secondary-cta">
                                        <span>Booking Lapangan</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="image-container" data-aos="fade-left" data-aos-delay="300">
                                <img src="assets/img/health/facilities-9.webp" alt="Lumajang Sports Club"
                                    class="img-fluid">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="features-section">

                    <div class="row g-0">

                        <div class="col-lg-4">
                            <div class="feature-block" data-aos="fade-up" data-aos-delay="200">
                                <div class="feature-icon">
                                    <i class="bi bi-funnel"></i>
                                </div>
                                <h3>Match Sesuai Level</h3>
                                <p>Filter berdasarkan level, lokasi, dan jadwal supaya ketemu partner yang pas.</p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="feature-block" data-aos="fade-up" data-aos-delay="300">
                                <div class="feature-icon">
                                    <i class="bi bi-calendar2-check"></i>
                                </div>
                                <h3>Booking Cepat</h3>
                                <p>Cek slot kosong, booking dalam hitungan detik, dan dapat pengingat otomatis.</p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="feature-block" data-aos="fade-up" data-aos-delay="400">
                                <div class="feature-icon">
                                    <i class="bi bi-trophy"></i>
                                </div>
                                <h3>Leaderboard &amp; Badge</h3>
                                <p>Kumpulin poin dari aktivitas dan naik peringkat jadi top player komunitas.</p>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="contact-block">
                    <div class="row">

                        <div class="col-lg-8">
                            <div class="contact-content" data-aos="fade-up" data-aos-delay="200">
                                <h2>Punya Venue atau Komunitas?</h2>
                                <p>Daftarkan venue kamu atau buat komunitas resmi di Lumajang Sports Club untuk
                                    menjangkau lebih
                                    banyak pemain.</p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="contact-actions" data-aos="fade-up" data-aos-delay="300">
                                <a href="tel:5551234567" class="emergency-call">
                                    <i class="bi bi-telephone"></i>
                                    <span>Hubungi Admin</span>
                                </a>
                                <a href="partner-with-us.html" class="contact-link">Daftarkan Venue</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </section><!-- /Call To Action Section -->

    </main>

    <x-client.footer />

    <!-- Scroll Top -->
    <a href="#!" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <x-client.script />

</body>

</html>
