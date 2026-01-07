@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Form Data Lapangan</h4>
                <div>
                    <a href="{{ route('lapangan.index') }}">Kembali</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('lapangan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-2">
                        <label for="nama_lapangan">Nama Lapangan</label>
                        <input type="text" name="nama_lapangan" id="nama_lapangan"
                            class="form-control @error('nama_lapangan') is-invalid @enderror"
                            value="{{ old('nama_lapangan') }}">

                        @error('nama_lapangan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="jenis_lapangan">Jenis Lapangan</label>
                        <input type="text" name="jenis_lapangan" id="jenis_lapangan"
                            class="form-control @error('jenis_lapangan') is-invalid @enderror"
                            value="{{ old('jenis_lapangan') }}">
                        @error('jenis_lapangan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="harga_per_jam">Harga per Jam</label>
                        <input type="number" name="harga_per_jam" id="harga_per_jam"
                            class="form-control @error('harga_per_jam') is-invalid @enderror"
                            value="{{ old('harga_per_jam') }}" step="0.01">
                        @error('harga_per_jam')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="fasilitas">Fasilitas</label>
                        <textarea name="fasilitas" id="fasilitas" rows="3" class="form-control @error('fasilitas') is-invalid @enderror">{{ old('fasilitas') }}</textarea>
                        @error('fasilitas')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="foto">Foto Lapangan</label>
                        <input type="file" name="foto" id="foto" accept="image/*"
                            class="form-control @error('foto') is-invalid @enderror">
                        @error('foto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-3 d-flex justify-content-end">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
