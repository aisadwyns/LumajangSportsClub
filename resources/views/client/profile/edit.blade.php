@extends('layouts.client')

@section('content')
    <main class="main">
        <div class="page-title">
            <div class="container">
                <h1 class="mb-0">Kelola Profil</h1>
                <p class="text-muted mb-0">Perbarui informasi akun dan profil Anda.</p>
            </div>
        </div>

        <section class="section py-4">
            <div class="container" data-aos="fade-up">
                <div class="row g-4">

                    {{-- KIRI: Ringkasan --}}
                    <div class="col-lg-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center p-4">
                                @php
                                    $avatarUrl = $profile->avatar
                                        ? asset('storage/avatar_user/' . $profile->avatar)
                                        : asset('assets/img/default-avatar.png');
                                @endphp

                                <img src="{{ $avatarUrl }}" class="rounded-circle mb-3" width="96" height="96"
                                    alt="Avatar">

                                <h5 class="mb-1">{{ $user->name }}</h5>
                                <div class="text-muted small">{{ $user->email }}</div>

                                <hr class="my-4">

                                <div class="text-start small">
                                    <div class="mb-2"><span class="text-muted">Telepon:</span>
                                        {{ $profile->phone ?? '-' }}</div>
                                    <div class="mb-2"><span class="text-muted">Alamat:</span>
                                        {{ $profile->address ?? '-' }}</div>
                                    <div class="mb-0"><span class="text-muted">Tgl Lahir:</span>
                                        {{ $profile->birth_date?->format('d M Y') ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KANAN: Form --}}
                    <div class="col-lg-8">
                        {{-- Update Profil --}}
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-white border-0 p-4">
                                <h5 class="mb-0">Informasi Profil</h5>
                                <small class="text-muted">Ubah biodata & foto profil.</small>
                            </div>

                            <div class="card-body p-4">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $err)
                                                <li>{{ $err }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('profil.update', 'me') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $user->name) }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                                            <div class="form-text">Email biasanya tidak diubah dari halaman ini.</div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">No. HP</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone', $profile->phone) }}" placeholder="08xxxxxxxxxx">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="birth_date" class="form-control"
                                                value="{{ old('birth_date', optional($profile->birth_date)->format('Y-m-d')) }}">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Alamat</label>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ old('address', $profile->address) }}"
                                                placeholder="Alamat lengkap">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Bio</label>
                                            <textarea name="bio" class="form-control" rows="4" placeholder="Ceritakan singkat tentang Anda...">{{ old('bio', $profile->bio) }}</textarea>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Foto Profil</label>
                                            <input type="file" name="avatar" class="form-control">
                                            <div class="form-text">JPG/PNG/WEBP, maksimal 2MB.</div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button class="btn btn-primary px-4" type="submit">
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Update Password --}}
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-white border-0 p-4">
                                <h5 class="mb-0">Keamanan</h5>
                                <small class="text-muted">Ganti password akun Anda.</small>
                            </div>

                            <div class="card-body p-4">
                                <form action="{{ route('profil.password') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Password Lama</label>
                                            <input type="password" name="current_password" class="form-control" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Password Baru</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                required>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button class="btn btn-outline-primary px-4" type="submit">
                                            Update Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
