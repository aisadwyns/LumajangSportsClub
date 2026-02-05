@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Form Tambah Event</h4>
                <a href="{{ route('events.index') }}">Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Judul --}}
                    <div class="form-group my-2">
                        <label>Judul Event</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    {{-- <div class="form-group my-2">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}

                    {{-- Jenis Komunitas --}}
                    <div class="form-group my-2">
                        <label>Jenis Komunitas</label>
                        <select name="jenis_komunitas_id"
                            class="form-control @error('jenis_komunitas_id') is-invalid @enderror">
                            <option value="">-- Pilih --</option>
                            @foreach ($jenisKomunitas as $jk)
                                <option value="{{ $jk->id }}">{{ $jk->nama_jenis }}</option>
                            @endforeach
                        </select>
                        @error('jenis_komunitas_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group my-2">
                        <label>Deskripsi</label>
                        <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="form-group my-2">
                        <label>Thumbnail</label>
                        <input type="file" name="thumbnail"
                            class="form-control @error('thumbnail') is-invalid @enderror">
                    </div>

                    {{-- Tanggal Event --}}
                    <div class="form-group my-2">
                        <label>Tanggal Event</label>
                        <input type="date" name="event_date"
                            class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date') }}">
                        @error('event_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Jam Mulai --}}
                    <div class="form-group my-2">
                        <label>Jam Mulai</label>
                        <input type="time" name="start_time"
                            class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}">
                    </div>

                    {{-- Jam Selesai --}}
                    <div class="form-group my-2">
                        <label>Jam Selesai</label>
                        <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror"
                            value="{{ old('end_time') }}">
                    </div>

                    {{-- Lokasi --}}
                    <div class="form-group my-2">
                        <label>Lokasi</label>
                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                            value="{{ old('location') }}">
                    </div>

                    {{-- Link Registrasi --}}
                    <div class="form-group my-2">
                        <label>Link Registrasi</label>
                        <input type="url" name="registration_link"
                            class="form-control @error('registration_link') is-invalid @enderror"
                            value="{{ old('registration_link') }}">
                    </div>

                    {{-- Status --}}
                    <div class="form-group my-2">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                    <div class="my-3 d-flex justify-content-end">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
