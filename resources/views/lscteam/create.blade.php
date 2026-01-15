@extends('layouts.mantis')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Tambah Data LSC Team</h4>
            <a href="{{ route('lscteam.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="card-body">
            <form action="{{ route('lscteam.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 form-group my-2">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap"
                            class="form-control @error('nama_lengkap') is-invalid @enderror"
                            value="{{ old('nama_lengkap') }}">
                        @error('nama_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" name="nik"
                            class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}">
                        @error('nik')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label for="nomor_hp">Nomor HP</label>
                        <input type="text" id="nomor_hp" name="nomor_hp"
                            class="form-control @error('nomor_hp') is-invalid @enderror" value="{{ old('nomor_hp') }}">
                        @error('nomor_hp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 form-group my-2">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group my-2">
                        <label for="bagian_id">Bagian</label>
                        <select id="bagian_id" name="bagian_id"
                            class="form-control @error('bagian_id') is-invalid @enderror">
                            <option value="">-- Pilih Bagian --</option>
                            @foreach ($bagians as $bagian)
                                <option value="{{ $bagian->id }}"
                                    {{ old('bagian_id') == $bagian->id ? 'selected' : '' }}>
                                    {{ $bagian->nama_bagian }}
                                </option>
                            @endforeach
                        </select>
                        @error('bagian_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group my-2">
                        <label for="jobdesk">Jobdesk</label>
                        <input type="text" id="jobdesk" name="jobdesk"
                            class="form-control @error('jobdesk') is-invalid @enderror" value="{{ old('jobdesk') }}">
                        @error('jobdesk')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                        <input type="text" id="pendidikan_terakhir" name="pendidikan_terakhir"
                            class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                            value="{{ old('pendidikan_terakhir') }}">
                        @error('pendidikan_terakhir')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 form-group my-2">
                        <label for="keahlian">Keahlian</label>
                        <textarea id="keahlian" name="keahlian" class="form-control @error('keahlian') is-invalid @enderror">{{ old('keahlian') }}</textarea>
                        @error('keahlian')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 form-group my-2">
                        <label for="foto">Foto</label>
                        <input type="file" id="foto" name="foto"
                            class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                        @error('foto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
