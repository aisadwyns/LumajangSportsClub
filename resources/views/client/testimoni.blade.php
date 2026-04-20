@extends('layouts.client')
@section('content')
    <section id="featured-testimonials" class="featured-testimonials section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="testimonials-14 swiper init-swiper">
                <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": { "delay": 5000 },
          "slidesPerView": 3,
          "spaceBetween": 24,
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "breakpoints": {
            "320": { "slidesPerView": 1, "spaceBetween": 16 },
            "768": { "slidesPerView": 2, "spaceBetween": 24 },
            "1200": { "slidesPerView": 3, "spaceBetween": 24 }
          }
        }
      </script>

                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>Booking lapangan futsal di Lumajang jadi jauh lebih gampang lewat LSC. Gak perlu telpon
                                satu-satu lagi, tinggal pilih jadwal yang kosong dan bayar via Midtrans. Mantap!</p>
                            <div class="profile">
                                <img src="assets/img/person/person-m-1.webp" class="testimonial-img" alt="User LSC">
                                <div class="info">
                                    <h4>Rizky Pratama <i class="bi bi-patch-check-fill"></i></h4>
                                    <span>@rizky_futsalLMJ</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>Semenjak bergabung dengan Lumajang Sports Club, manajemen jadwal lapangan kami jadi lebih
                                teratur. Tidak ada lagi jadwal yang bentrok (double booking). Sistem dashboard-nya sangat
                                membantu.</p>
                            <div class="profile">
                                <img src="assets/img/person/person-m-2.webp" class="testimonial-img" alt="Owner Venue">
                                <div class="info">
                                    <h4>Hadi Suwarno <i class="bi bi-patch-check-fill"></i></h4>
                                    <span>Owner GOR Lumajang</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>Fitur komunitasnya keren banget! Saya jadi punya banyak teman baru buat mabar bulutangkis
                                setiap weekend. Ekosistem olahraga di Lumajang beneran jadi digital sekarang.</p>
                            <div class="profile">
                                <img src="assets/img/person/person-f-1.webp" class="testimonial-img" alt="Community Member">
                                <div class="info">
                                    <h4>Siska Amalia <i class="bi bi-patch-check-fill"></i></h4>
                                    <span>@siska_badminton</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endsection
