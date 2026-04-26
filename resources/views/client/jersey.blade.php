@extends('layouts.client')

@section('content')
    <section id="jersey-catalog" class="services section">
        <div class="container" data-aos="fade-up">

            <div class="section-title text-center mb-5">
                <h2>Katalog Jersey</h2>
                <p>Koleksi jersey eksklusif Lumajang Sports Club</p>
            </div>

            <div class="row gy-4">
                @forelse ($jerseys as $jersey)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item text-center p-0 overflow-hidden"
                            style="border-radius: 15px; border: 1px solid #eee;">

                            {{-- Gambar Jersey --}}
                            <div class="service-image" style="height: 300px; overflow: hidden;">
                                <img src="{{ asset('storage/jerseys/' . $jersey->image) }}" alt="{{ $jersey->name }}"
                                    class="img-fluid w-100 h-100" style="object-fit: cover;">
                            </div>

                            {{-- Nama Jersey --}}
                            <div class="service-content p-4 bg-white">
                                <h3 class="m-0 fw-bold text-dark">{{ $jersey->name }}</h3>
                                <div class="mt-2" style="height: 3px; width: 40px; background: #004AAC; margin: 0 auto;">
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada jersey yang bisa ditampilkan.</p>
                    </div>
                @endforelse
            </div>

            {{-- <div class="mt-5 d-flex justify-content-center">
                {{ $jerseys->links() }}
            </div> --}}
        </div>
    </section>
@endsection
