@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Form Data Jenis Komunitas</h4>
                <div>
                    <a href="{{ route('jenis-komunitas.index') }}">Kembali</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('jenis-komunitas.store') }}" method="POST">
                    @csrf

                    {{-- Nama Jenis Komunitas --}}
                    <div class="form-group my-2">
                        <label for="nama_jenis">Nama Jenis Komunitas</label>
                        <input type="text" name="nama_jenis" id="nama_jenis"
                            class="form-control @error('nama_jenis') is-invalid @enderror" value="{{ old('nama_jenis') }}">

                        @error('nama_jenis')
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
