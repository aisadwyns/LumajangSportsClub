@extends('layouts.mantis')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Edit Data Komunitas</h4>
            <a href="{{ route('komunitas.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="card-body">
            <form action="{{ route('komunitas.update', $komunitas->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="row">
                    <div class="col-md-6 form-group my-2">
                        <label for="jenis_komunitas_id">Jenis Komunitas</label>
                        <select id="jenis_komunitas_id" name="jenis_komunitas_id"
                            class="form-control @error('jenis_komunitas_id') is-invalid @enderror">
                            <option value="">-- Pilih Jenis --</option>
                            @foreach ($jenis as $j)
                                <option value="{{ $j->id }}"
                                    {{ old('jenis_komunitas_id', $komunitas->jenis_komunitas_id) == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama ?? ($j->nama_jenis ?? 'Jenis #' . $j->id) }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_komunitas_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label for="nama_komunitas">Nama Komunitas</label>
                        <input type="text" id="nama_komunitas" name="nama_komunitas"
                            class="form-control @error('nama_komunitas') is-invalid @enderror"
                            value="{{ old('nama_komunitas', $komunitas->nama_komunitas) }}">
                        @error('nama_komunitas')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 form-group my-2">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $komunitas->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 form-group my-2">
                        <label for="logo">Logo (opsional)</label>
                        <input type="file" id="logo" name="logo"
                            class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                        @error('logo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        @if ($komunitas->logo)
                            <div class="mt-2">
                                <small class="text-muted d-block">Logo saat ini:</small>
                                <img src="{{ asset('storage/logo_komunitas/' . $komunitas->logo) }}"
                                    alt="{{ $komunitas->logo }}" style="max-height: 160px" class="img-fluid">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi"
                            class="form-control @error('lokasi') is-invalid @enderror"
                            value="{{ old('lokasi', $komunitas->lokasi) }}">
                        @error('lokasi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label for="kontak">Kontak</label>
                        <input type="text" id="kontak" name="kontak"
                            class="form-control @error('kontak') is-invalid @enderror"
                            value="{{ old('kontak', $komunitas->kontak) }}">
                        @error('kontak')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label for="harga_per_sesi">Harga per Sesi</label>
                        <input type="number" step="0.01" id="harga_per_sesi" name="harga_per_sesi"
                            class="form-control @error('harga_per_sesi') is-invalid @enderror"
                            value="{{ old('harga_per_sesi', $komunitas->harga_per_sesi ?? 0) }}">
                        @error('harga_per_sesi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label for="waktu">Waktu (Jam)</label>
                        <input type="time" id="waktu" name="waktu"
                            class="form-control @error('waktu') is-invalid @enderror"
                            value="{{ old('waktu', $komunitas->waktu) }}">
                        @error('waktu')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 form-group my-2">
                        <label for="link_wa">Link WhatsApp</label>
                        <input type="text" id="link_wa" name="link_wa"
                            class="form-control @error('link_wa') is-invalid @enderror"
                            value="{{ old('link_wa', $komunitas->link_wa) }}">
                        @error('link_wa')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
