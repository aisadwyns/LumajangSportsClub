@extends('layouts.mantis')

@section('content')
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                {{-- Header/Logo (Optional, bisa dihilangkan jika tidak perlu) --}}
                {{-- <div class="auth-header">
                <a href="#"><img src="../assets/images/logo-dark.svg" alt="img"></a>
            </div> --}}

                <div class="card my-5 border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-body">
                        <form action="{{ route('profil.update', 'me') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="d-flex justify-content-between align-items-end mb-4">
                                <h3 class="mb-0"><b>Edit Profil</b></h3>
                                <a href="{{ route('home') }}" class="link-primary text-sm text-decoration-none">Kembali</a>
                            </div>

                            {{-- Foto Profil Section --}}
                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    @php
                                        $avatarUrl = $profile->avatar
                                            ? asset('storage/avatar_user/' . $profile->avatar)
                                            : asset('assets/img/default-avatar.png');
                                    @endphp
                                    <img src="{{ $avatarUrl }}" id="preview-avatar"
                                        class="rounded-circle border border-4 border-light shadow-sm"
                                        style="width: 110px; height: 110px; object-fit: cover;">

                                    <label for="avatar-input"
                                        class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 32px; height: 32px; border: 2px solid #fff; cursor: pointer;">
                                        <i class="bi bi-camera-fill" style="font-size: 0.85rem;"></i>
                                        <input type="file" id="avatar-input" name="avatar" class="d-none"
                                            accept="image/*">
                                    </label>
                                </div>
                            </div>

                            {{-- Alert Error --}}
                            @if ($errors->any())
                                <div class="alert alert-danger py-2 px-3 mb-3" style="font-size: 0.85rem;">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                {{-- Split Nama (First/Last) --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nama Depan*</label>
                                        <input type="text" name="first_name" class="form-control"
                                            value="{{ old('first_name', explode(' ', $user->name)[0]) }}"
                                            placeholder="Nama Depan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nama Belakang</label>
                                        <input type="text" name="last_name" class="form-control"
                                            value="{{ old('last_name', count(explode(' ', $user->name)) > 1 ? implode(' ', array_slice(explode(' ', $user->name), 1)) : '') }}"
                                            placeholder="Nama Belakang">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Alamat Email*</label>
                                <input type="email" class="form-control bg-light" value="{{ $user->email }}" disabled>
                                <small class="text-muted" style="font-size: 0.7rem;">Email tidak dapat diubah</small>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Nomor WhatsApp/HP*</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $profile->phone) }}" placeholder="Contoh: 08123456789" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="address" class="form-control" rows="3" placeholder="Masukkan alamat domisili">{{ old('address', $profile->address) }}</textarea>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary py-2 fw-bold">Simpan Perubahan</button>
                            </div>
                        </form>

                        {{-- Link Ganti Password (Opsional) --}}
                        <div class="text-center mt-3">
                            <p class="text-sm text-muted mb-0">Ingin mengubah keamanan? <a href="#"
                                    class="text-primary text-decoration-none">Ganti Password</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Preview foto langsung setelah pilih file
        document.getElementById('avatar-input').onchange = function(evt) {
            const [file] = this.files;
            if (file) {
                document.getElementById('preview-avatar').src = URL.createObjectURL(file);
            }
        }
    </script>
@endsection
