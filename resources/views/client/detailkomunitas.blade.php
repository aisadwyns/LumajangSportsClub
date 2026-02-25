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
                                <span class="text-muted small">{{ $komunitas->users->count() }} anggota</span>
                            </div>

                            <div class="anggota-join d-flex align-items-center mb-4">
                                <div class="avatar-group d-flex me-2">
                                    @foreach ($komunitas->users->take(5) as $user)
                                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/img/default-avatar.png') }}"
                                            class="avatar-stack" alt="{{ $user->name }}" title="{{ $user->name }}">
                                    @endforeach

                                    @if ($komunitas->users->count() > 5)
                                        <div class="avatar-stack avatar-count">
                                            +{{ $komunitas->users->count() - 5 }}
                                        </div>
                                    @endif
                                </div>
                                <span class="text-muted small">Sudah bergabung di komunitas ini</span>
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
                                            <button type="button" class="tombol-aksi tombol-gabung w-100 py-2 fw-bold mb-3"
                                                data-bs-toggle="modal" data-bs-target="#modalOpsiGabung">
                                                Gabung Sekarang
                                            </button>
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



    {{-- modal bayar --}}
    <div class="modal fade" id="modalOpsiGabung" tabindex="-1" aria-labelledby="modalOpsiGabungLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="modalOpsiGabungLabel">Pilih Metode Bergabung</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pb-4">
                    <p class="text-muted mb-4">Silakan pilih cara Anda ingin bergabung dengan komunitas
                        <strong>{{ $komunitas->nama_komunitas }}</strong>.
                    </p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card h-100 border-primary cursor-pointer hover-shadow" onclick="bayarSekarang(this)"
                                data-url="{{ route('komunitas.joinbayarsekarang', $komunitas->id) }}">
                                <div class="card-body py-4">
                                    <i class="bi bi-credit-card-2-front fs-1 text-primary mb-3"></i>
                                    <h6 class="fw-bold">Bayar Sekarang</h6>
                                    <p class="small text-muted mb-0">Pembayaran instan via Midtrans (Gopay, Transfer Bank,
                                        dll)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('komunitas.join', $komunitas->id) }}" method="POST" class="h-100">
                                @csrf
                                <button type="submit"
                                    class="card h-100 border-0 bg-light w-100 text-start cursor-pointer hover-shadow">
                                    <div class="card-body py-4">
                                        <i class="bi bi-clock-history fs-1 text-secondary mb-3"></i>
                                        <h6 class="fw-bold">Bayar Nanti</h6>
                                        <p class="small text-muted mb-0">Gabung dulu ke komunitas, bayar kemudian saat sesi
                                            dimulai.</p>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Midtrans --}}
    <div class="modal fade" id="modalMidtrans" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pembayaran Midtrans</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-info mb-2">
                        Klik <b>Lanjutkan Pembayaran</b> untuk memilih metode (GoPay/VA/Transfer Bank).
                    </div>
                    <div id="midtransStatus" class="small text-muted"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnPayMidtrans">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_SERVER_KEY') }}">
    </script>

    <script>
        let snapToken = null;

        function bayarSekarang(el) {
            const url = el.getAttribute('data-url');
            const modalEl = document.getElementById('modalMidtrans');
            const modal = new bootstrap.Modal(modalEl);
            document.getElementById('midtransStatus').innerText = 'Menyiapkan pembayaran...';
            document.getElementById('btnPayMidtrans').disabled = true;
            modal.show();

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(res => {
                    if (!res.success) throw new Error(res.message || 'Gagal membuat transaksi.');
                    snapToken = res.snap_token;
                    document.getElementById('midtransStatus').innerText = 'Siap. Klik "Lanjutkan Pembayaran".';
                    document.getElementById('btnPayMidtrans').disabled = false;
                })
                .catch(err => {
                    document.getElementById('midtransStatus').innerText = err.message;
                    document.getElementById('btnPayMidtrans').disabled = true;
                });
        }

        document.getElementById('btnPayMidtrans')?.addEventListener('click', function() {
            if (!snapToken) return;
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    location.reload();
                },
                onPending: function(result) {
                    location.reload();
                },
                onError: function(result) {
                    alert('Pembayaran gagal. Coba lagi.');
                },
                onClose: function() {
                    /* user nutup popup */
                }
            });
        });
    </script>
@endsection
