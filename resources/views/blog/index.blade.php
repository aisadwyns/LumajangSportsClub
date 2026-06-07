@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Blog</h4>
                </div>
                <div>
                    <a href="{{ route('blog.create') }}" class="btn btn-primary">
                        Tambah Blog
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered align-middle" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Slug</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>Thumbnail</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $index => $blog)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->slug }}</td>
                                <td>{{ $blog->author?->name ?? '-' }}</td>
                                <td>
                                    @if ($blog->status == 'published')
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($blog->thumbnail)
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalThumbnail{{ $blog->id }}">
                                            Lihat
                                        </button>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button type="button" class="dropdown-item text-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#previewClient{{ $blog->id }}">
                                                    Lihat Mockup
                                                </button>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('blog.edit', $blog->id) }}">
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmDelete{{ $blog->id }}">
                                                    Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    @foreach ($blogs as $blog)
        <div class="modal fade" id="confirmDelete{{ $blog->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Blog?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Blog <strong>{{ $blog->title }}</strong> akan dihapus permanen.
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Thumbnail --}}
    @foreach ($blogs as $blog)
        @if ($blog->thumbnail)
            <div class="modal fade" id="modalThumbnail{{ $blog->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thumbnail Blog</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset('storage/blogs/' . $blog->thumbnail) }}" class="img-fluid rounded"
                                alt="{{ $blog->title }}">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    {{-- MODAL SIMULASI TAMPILAN CLIENT (PREVIEW MOCKUP) --}}
    @foreach ($blogs as $blog)
        <div class="modal fade" id="previewClient{{ $blog->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl mt-5">
                <div class="modal-content bg-light rounded-0 border-0 shadow-lg">

                    <div
                        class="modal-header bg-dark text-white border-bottom-0 py-2 px-4 d-flex justify-content-between align-items-center rounded-0">
                        <div>
                            <span class="badge bg-warning text-dark me-2 rounded-0">Mode Simulasi Tampilan</span>
                            <span class="text-white-50">Status Data:</span>
                            @if ($blog->status == 'published')
                                <span class="badge bg-success rounded-0">Published</span>
                            @else
                                <span class="badge bg-secondary rounded-0">Draft</span>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-light rounded-0" data-bs-dismiss="modal">
                            Keluar Pratinjau
                        </button>
                    </div>

                    <div class="modal-body p-0" style="max-height: 75vh; overflow-y: auto;">

                        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 mb-4">
                            <div class="container-fluid px-4 border-start border-primary border-4">
                                <span class="navbar-brand fw-bold text-dark ps-2" style="letter-spacing: 1px;">LUMAJANG
                                    SPORTS CLUB</span>
                                <span class="ms-auto text-muted d-none d-sm-inline" style="font-size: 13px;">
                                    <i class="ti ti-world"></i> Simulasi User View
                                </span>
                            </div>
                        </nav>

                        <div class="px-4 py-3 mb-5">
                            <div class="row justify-content-center">
                                <div class="col-11">

                                    <div class="mb-4">
                                        <div class="d-flex align-items-center gap-2 mb-2" style="font-size: 14px;">
                                            <span
                                                class="text-primary fw-semibold">{{ $blog->author?->name ?? 'Anonim' }}</span>
                                            <span class="text-muted">•</span>
                                            <span
                                                class="text-muted">{{ $blog->created_at ? $blog->created_at->isoFormat('D MMMM Y') : date('d Mylar Y') }}</span>
                                        </div>
                                        <h2 class="fw-bold text-dark mb-3" style="line-height: 1.3;">
                                            {{ $blog->title }}
                                        </h2>
                                        <hr class="my-3">
                                    </div>

                                    @if ($blog->thumbnail)
                                        <div class="row justify-content-center mb-4">
                                            <div class="col-md-5 col-sm-6 text-center">
                                                <div class="bg-white p-2 border">
                                                    <img src="{{ asset('storage/blogs/' . $blog->thumbnail) }}"
                                                        class="img-fluid w-100 rounded-0" alt="{{ $blog->title }}"
                                                        style="height: auto; max-height: 200px; object-fit: contain; display: block; margin: 0 auto;">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="text-dark mt-4 text-break"
                                        style="line-height: 1.8; font-size: 16px; text-align: justify;">
                                        {!! $blog->content ?? '<p class="text-muted italic">Tidak ada isi konten artikel.</p>' !!}
                                    </div>

                                    <div class="mt-5 pt-3 border-top text-muted" style="font-size: 12px;">
                                        <span>Rute URL Asli Klien: <code>/blog/{{ $blog->slug }}</code></span>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
