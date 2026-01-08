@extends('layouts.mantis')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Edit Data LSC Team</h4>
            <a href="{{ route('lscteam.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="card-body">
            <form action="{{ route('lscteam.update', $teams->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 form-group my-2">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap"
                            class="form-control @error('nama_lengkap') is-invalid @enderror"
                            value="{{ old('nama_lengkap', $teams->nama_lengkap) }}">
                        @error('nama_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label>NIK</label>
                        <input type="text" name="nik" readonly
                            class="form-control @error('nik') is-invalid @enderror" value="{{ $teams->nik }}">
                        @error('nik')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $teams->email) }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label>Nomor HP</label>
                        <input type="text" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror"
                            value="{{ old('nomor_hp', $teams->nomor_hp) }}">
                        @error('nomor_hp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 form-group my-2">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $teams->alamat) }}</textarea>
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label>Jobdesk</label>
                        <input type="text" name="jobdesk" class="form-control @error('jobdesk') is-invalid @enderror"
                            value="{{ old('jobdesk', $teams->jobdesk) }}">
                        @error('jobdesk')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group my-2">
                        <label>Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan_terakhir"
                            class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                            value="{{ old('pendidikan_terakhir', $teams->pendidikan_terakhir) }}">
                        @error('pendidikan_terakhir')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 form-group my-2">
                        <label>Keahlian</label>
                        <textarea name="keahlian" class="form-control @error('keahlian') is-invalid @enderror">{{ old('keahlian', $teams->keahlian) }}</textarea>
                        @error('keahlian')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 form-group my-2">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                            accept="image/*">

                        @error('foto')
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
