@extends('layouts.client')

@section('content')
    <section id="blogs" class="departments section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-5">

                @foreach ($blogs as $index => $blog)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 + ($index % 3) * 100 }}">

                        <div class="department-card">

                            {{-- icon bebas / bisa statis --}}
                            <div class="department-icon">
                                <i class="fas fa-newspaper"></i>
                            </div>

                            {{-- thumbnail --}}
                            <div class="department-image">
                                @if ($blog->thumbnail)
                                    <img src="{{ asset('storage/blogs/' . $blog->thumbnail) }}" alt="{{ $blog->title }}"
                                        class="img-fluid">
                                @else
                                    <img src="{{ asset('assets/img/health/orthopedics-4.webp') }}" alt="Default Blog"
                                        class="img-fluid">
                                @endif
                            </div>

                            {{-- content --}}
                            <div class="department-content">
                                <h3>{{ $blog->title }}</h3>

                                <p>
                                    {{ Str::limit(strip_tags($blog->excerpt), 120) }}
                                </p>

                                <a href="{{ route('blog.show', $blog->slug) }}" class="learn-more">
                                    <span>Read More</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
