@extends('layouts.mantis')

@section('content')
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-12">

                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <form action="{{ route('profil.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                                <h4 class="mb-0 fw-bold text-dark">Edit Profil</h4>
                            </div>

                            {{-- Alert Error --}}
                            @if ($errors->any())
                                <div class="alert alert-danger py-2 px-3 mb-4"
                                    style="font-size: 0.85rem; border-radius: 8px;">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row g-4">

                                {{-- KOLOM KIRI: Foto Profil --}}
                                <div class="col-lg-4 text-center border-end-lg">
                                    <div class="card bg-light border-0 p-4 h-100 d-flex flex-column align-items-center justify-content-center"
                                        style="border-radius: 10px;">
                                        <div class="position-relative d-inline-block mb-3">
                                            @php
                                                $avatarUrl = $profile->avatar
                                                    ? asset('storage/avatar_user/' . $profile->avatar)
                                                    : asset('assets/img/default-avatar.png');
                                            @endphp
                                            <img src="{{ $avatarUrl }}" id="preview-avatar"
                                                class="rounded-circle border border-4 border-white shadow-sm"
                                                style="width: 130px; height: 130px; object-fit: cover;">

                                            <label for="avatar-input"
                                                class="position-absolute bottom-0 end-0 text-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                                style="width: 36px; height: 36px; border: 3px solid #fff; cursor: pointer; background-color: #4680ff;">
                                                <i class="ti ti-camera" style="font-size: 1rem;"></i>
                                                <input type="file" id="avatar-input" name="avatar" class="d-none"
                                                    accept="image/*">
                                            </label>
                                        </div>
                                        <h6 class="mb-1 fw-bold text-dark">{{ $user->name }}</h6>
                                        <p class="text-muted small mb-0">Klik ikon kamera untuk mengubah foto profil</p>
                                    </div>
                                </div>

                                {{-- KOLOM KANAN: Input Data Fields --}}
                                <div class="col-lg-8">
                                    <div class="row">
                                        {{-- Nama Depan --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Nama Depan <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="first_name" class="form-control"
                                                value="{{ old('first_name', explode(' ', $user->name)[0]) }}"
                                                placeholder="Nama Depan" required>
                                        </div>

                                        {{-- Nama Belakang --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Nama Belakang</label>
                                            <input type="text" name="last_name" class="form-control"
                                                value="{{ old('last_name', count(explode(' ', $user->name)) > 1 ? implode(' ', array_slice(explode(' ', $user->name), 1)) : '') }}"
                                                placeholder="Nama Belakang">
                                        </div>

                                        {{-- Alamat Email (Disabled) --}}
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Alamat Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control bg-light text-muted"
                                                value="{{ $user->email }}" disabled style="cursor: not-allowed;">
                                            <div class="form-text text-muted" style="font-size: 0.75rem;">
                                                <i class="bi bi-info-circle me-1"></i> Email akun utama tidak dapat diubah
                                            </div>
                                        </div>

                                        {{-- Nomor WhatsApp --}}
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-semibold text-secondary">Nomor WhatsApp/HP <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light text-secondary fw-semibold">+62</span>
                                                <input type="text" name="phone" class="form-control"
                                                    value="{{ old('phone', preg_replace('/^(\+62|62|0)/', '', $profile->phone)) }}"
                                                    placeholder="Contoh: 8167243897" required>
                                            </div>
                                        </div>

                                        {{-- Alamat Lengkap --}}
                                        <div class="col-12 mb-2">
                                            <label class="form-label fw-semibold text-secondary">Alamat Lengkap</label>
                                            <textarea name="address" class="form-control" rows="3" placeholder="Masukkan alamat domisili lengkap kamu">{{ old('address', $profile->address) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end align-items-center mt-3 pt-2 border-top">
                                        <button type="submit" class="btn btn-primary px-4 py-2 fw-bold shadow-sm">
                                            <i class="ti ti-check me-1"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
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
