@extends('layouts.client')

@section('content')
    <main class="main">
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">{{ $blog->title }}</h1>
                            <p class="mb-0">
                                {{ $blog->excerpt ?? 'Baca artikel terbaru kami untuk mendapatkan wawasan dan informasi menarik.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('client') }}">Home</a></li>
                        <li><a href="{{ route('blogs.public') }}">Blog</a></li>
                        <li class="current">{{ Str::limit($blog->title, 20) }}</li>
                    </ol>
                </div>
            </nav>
        </div>
        <section id="privacy" class="privacy section">

            <div class="container aos-init aos-animate" data-aos="fade-up">

                <div class="privacy-header aos-init aos-animate" data-aos="fade-up">
                    <div class="header-content text-center">
                        <div class="last-updated">
                            Diterbitkan pada: {{ $blog->created_at->format('F d, Y') }}
                        </div>
                        <h1>{{ $blog->title }}</h1>
                        <p class="intro-text">
                            Ditulis oleh: <strong>{{ $blog->author->name ?? 'Admin' }}</strong>
                        </p>
                    </div>
                </div>

                <div class="privacy-content aos-init aos-animate" data-aos="fade-up">

                    @if ($blog->thumbnail)
                        <div class="mb-5 text-center">
                            <img src="{{ asset('storage/blogs/' . $blog->thumbnail) }}" alt="{{ $blog->title }}"
                                class="img-fluid rounded shadow-sm"
                                style="max-height: 400px; width: 100%; object-fit: cover;">
                        </div>
                    @endif

                    <div class="content-section">
                        {!! $blog->content !!}
                    </div>

                </div>

                <div class="privacy-contact aos-init" data-aos="fade-up">
                    <h2>Bagikan Artikel Ini</h2>
                    <p>Jika menurut Anda artikel ini bermanfaat, jangan ragu untuk membagikannya kepada rekan Anda.</p>
                    <div class="contact-details">
                        <a href="{{ route('blogs.public') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Blog
                        </a>
                    </div>
                </div>

            </div>

        </section>
    </main>
@endsection
