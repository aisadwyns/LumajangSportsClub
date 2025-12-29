@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-item-center">
                <h4 class="card-title">Form Data Member</h4>
                <div>
                    <a href="{{ route('member.index') }}">kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('member.update', $datamember->id) }}" method="POST" class="">
                    @csrf
                    @method('PUT')
                    <div class="form-group my-2">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                            class="text form-control  @error('nama_lengkap') is-invalid @enderror"
                            value="{{ $datamember->nama_lengkap }}">
                        @error('nama_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="nama_club">Nama Club</label>
                        <input type="text" name="nama_club" id="nama_club"
                            class="text form-control  @error('nama_club') is-invalid @enderror"
                            value="{{ $datamember->nama_club }}">
                        @error('nama_club')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="no_telpon">Nomor Telpon</label>
                        <input type="text" name="no_telpon" id="no_telpon"
                            class="text form-control  @error('no_telpon') is-invalid @enderror"
                            value="{{ $datamember->no_telpon }}">
                        @error('no_telpon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="my-2 d-flex justify-content-end">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
