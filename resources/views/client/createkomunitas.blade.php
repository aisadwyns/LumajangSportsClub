@extends('layouts.client')

@section('content')
    <main class="main">
        <div class="page-title" style="background-color: #004AAC">
            <div class="container py-4 text-white text-center">
                <h1 class="heading-title text-white">Buat Komunitas Baru</h1>
                <p class="mb-0">Daftarkan komunitas olahraga Anda di Lumajang Sports Club</p>
            </div>
        </div>

        <section class="section py-4" style="background-color: #f8f9fa; min-height: 100vh;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card shadow-sm p-4" style="border-radius: 15px; border: none;">
                            <form action="{{ route('client.komunitas.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Jenis Komunitas <span
                                                    class="text-danger">*</span></label>
                                            <select name="jenis_komunitas_id"
                                                class="form-select form-select-sm @error('jenis_komunitas_id') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Jenis Olahraga --</option>
                                                @foreach ($jenisKomunitas as $jenis)
                                                    <option value="{{ $jenis->id }}"
                                                        {{ old('jenis_komunitas_id') == $jenis->id ? 'selected' : '' }}>
                                                        {{ $jenis->nama ?? $jenis->nama_jenis }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jenis_komunitas_id')
                                                <div class="invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Nama Komunitas <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="nama_komunitas"
                                                class="form-control form-control-sm @error('nama_komunitas') is-invalid @enderror"
                                                value="{{ old('nama_komunitas') }}"
                                                placeholder="Contoh: Lumajang Badminton Club" required>
                                            @error('nama_komunitas')
                                                <div class="invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Logo Komunitas (Maks: 2MB)</label>
                                            <input type="file" name="logo"
                                                class="form-control form-control-sm @error('logo') is-invalid @enderror">
                                            @error('logo')
                                                <div class="invalid-feedback small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Lokasi / Basecamp</label>
                                            <input type="text" name="lokasi" class="form-control form-control-sm"
                                                value="{{ old('lokasi') }}" placeholder="Contoh: GOR Wira Bhakti">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Kontak Pengurus</label>
                                            <input type="text" name="kontak" class="form-control form-control-sm"
                                                value="{{ old('kontak') }}" placeholder="Contoh: 081234xxxxxx">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Link Group WhatsApp</label>
                                            <input type="url" name="link_wa" class="form-control form-control-sm"
                                                value="{{ old('link_wa') }}"
                                                placeholder="Contoh: https://chat.whatsapp.com/...">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-10 col-lg-4">
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label class="form-label fw-bold small">Harga / Sesi (Rp)</label>
                                                <input type="number" name="harga_per_sesi"
                                                    class="form-control form-control-sm"
                                                    value="{{ old('harga_per_sesi', 0) }}" min="0">
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label fw-bold small">Waktu Latihan</label>
                                                <input type="text" name="waktu" class="form-control form-control-sm"
                                                    value="{{ old('waktu') }}" placeholder="Contoh: Minggu, 15:00">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Deskripsi Komunitas</label>
                                            <textarea name="deskripsi" class="form-control form-control-sm" rows="2"
                                                placeholder="Jelaskan mengenai komunitas Anda...">{{ old('deskripsi') }}</textarea>
                                        </div>

                                        <div class="row g-2 pt-2">
                                            <div class="col-6">
                                                <a href="{{ route('komunitas.public') }}"
                                                    class="btn btn-sm btn-light w-100"
                                                    style="border-radius: 8px;">Kembali</a>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-sm text-white w-100"
                                                    style="background-color: #004AAC; border-radius: 8px;">Kirim</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
